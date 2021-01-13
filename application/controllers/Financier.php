<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//require_once 'C:\composer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Financier extends CI_Controller
{

    public function __construct()
    {
        parent:: __construct();
        // verifie of login
        $this->is_logged();

        // charge all models
        $this->load->model('Main_model');
        $this->load->model('Get_model');
        $this->load->model('Insert_model');
        $this->load->model('Update_model');
        $this->load->model('School_management');

        $this->_annee_actuel = date('Y');
        $this->_annee_sco_act = $this->_annee_actuel . '-' . ($this->_annee_actuel + 1);
    }

    /**
     *@ Check is admin is logged
     */
    private function is_logged()
    {
        if (!$this->session->authentified_agent) {
            // code...
            return redirect(base_url() . 'main/index');
        }
    }

    ########################################   *   ########################################
    #
    #						    # DASHBORAD FUNCTIONS
    #
    ########################################   *   ########################################

    public function dashboard()
    {
        //infos vue d'ensemble
        $inscriptions_encours = $this->Get_model->get_paiements_encours();
        $inscriptions_traitees = $this->Get_model->get_paiements_traitees();
        $paiements_amorces = $this->Get_model->get_paiements_amorces();
        //$demande_par_mois = $this->Get_model->get_demande_by_month();
        //var_dump($demande_par_mois) or die();
        $arr = array();
        $arr_encours = array();
        $arr_amorces = array();

        //bouckage des données encours
        foreach ($paiements_amorces as $amorce) {
            // code...
            if ($amorce->num_rows() > 0) {
                $arr_amorces[] = $amorce->num_rows();
            } else {
                $arr_amorces[] = 0;
            }
        }//bouckage des données encours
        foreach ($inscriptions_encours as $encours) {
            // code...
            if ($encours->num_rows() > 0) {
                $arr_encours[] = $encours->num_rows();
            } else {
                $arr_encours[] = 0;
            }
        }
        //bouckage des données traitées
        foreach ($inscriptions_traitees as $traitee) {
            // code...
            if ($traitee->num_rows() > 0) {
                $arr[] = $traitee->num_rows();
            } else {
                $arr[] = 0;
            }
        }
        $data['inscriptions_encours'] = $arr_encours;
        $data['inscriptions_traitees'] = $arr;
        $data['paiements_amorces'] = $arr_amorces;

        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();

        //chargement de la vue avec des données
        $data['view'] = 'financier/dashboard/index';
        $this->load->view('financier/main', $data);
    }


    ########################################   *   ########################################
    #
    #                            # ELEVES SCOLAIRES FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Show user form
     */
    public function eleve()
    {
        #get full year
        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['eleves'] = $this->db->get_where('view_school_eleves_inscrits', array('annee_scolaire' => $annee_scolaire))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        } else {
            $data['eleves'] = $this->db->get_where('view_school_eleves_inscrits', array('annee_scolaire' => $annee_sco_act))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        }
        //$this->dd($data['eleves']);
        $data['view'] = 'financier/eleve/index';
        $this->load->view('financier/main', $data);
    }

    public function paiement()
    {
        #get full year
        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['paiements'] = $this->db->get_where('view_school_paiements', array('annee_scolaire' => $annee_scolaire))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        } else {
            //$data['paiements'] = $this->db->get_where('tb_school_paiements', array('matricule_eleve' => $id_visiteur))->result();
            //$data['paiements'] = $this->Get_model->get('view_school_paiements', 'date_paiement')->result();
            $data['paiements'] = $this->db->get_where('view_school_paiements', array('annee_scolaire' => $annee_sco_act))->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        }
        $data['view'] = 'financier/paiement/paiement_frais';
        $this->load->view('financier/main', $data);
    }
#==================================================================================
#-----------------------------------validation paiement eleve------------------------------
#======================================================================================
    function paiements_eleves()
    {
        //numero matricule et année scolaire comme critere de selection
        $matricule_eleve = $this->input->get('matricule');
        $data['annee_scolaire'] = $this->input->get('annee');
        //selection de données d'inscription
        $data['el'] = $this->db->get_where('view_school_eleves_inscrits',
            array('annee_scolaire' => $data['annee_scolaire'], 'matricule_eleve' => $matricule_eleve))->result();
        //selection de données de paiement
        $data['paiements_eleves'] = $this->db->get_where('view_school_paiements',
            array('annee_scolaire' => $data['annee_scolaire'], 'matricule_eleve' => $matricule_eleve))->result();
        //test de valeeur

        if (($data['el'])) {
            $etat = '';
            $cycle = '';
            foreach ($data['el'] as $value) {
                $etat = $value->etat_inscription;
                $cycle = $value->cycle;
                $annee_scolaire = $value->annee_scolaire;
            }
            $data['frais'] = ($etat == "en attente") ? $this->db->get_where('view_school_eleves_inscrits',
                array('annee_scolaire' => $annee_scolaire, 'cycle' => $cycle))->result() :
                $this->db->get_where('view_school_eleves_inscrits',
                    array('annee_scolaire' => $data['annee_scolaire'], 'cycle' => $cycle))->result();
            //, 'type_frais !=' => "inscription"

            $data['mois'] = $this->Get_model->get('tb_school_mois', 'id')->result();
            //var_dump($data['paiements_el']) or die();
            //$this->data('paiements_el', compact('data'));
            //$this->dd($data['mois']);
            $data['eleve'] = $this->Get_model->get_all_onces('view_school_eleves_inscrits', $matricule_eleve, $annee_scolaire, $cycle, $etat);
            
            $data['paie'] = $this->db->get_where('tb_school_frais',
                array('annee_scolaire' => $data['annee_scolaire'], 'type_frais !=' => "inscription"))->result();
//$this->dd($data['paie']);

        } else {
            //$this->get_msg("Elève non existant!");
            return redirect(base_url() . 'financier/eleve');
        }
        $data['view'] = 'financier/paiement/paiements_eleves';
        $this->load->view('financier/main', $data);
    }

public function viewRecu($codePaie){
        $data['paiement'] = $this->School_management->view_paiement_eleve($codePaie);
       //$this->dd($data['paiement']);
         $data['view'] = 'financier/paiement/imprimer_recu';
        $this->load->view('financier/main', $data);
    }

    public function viewPaiement($codePaie){
        $data['paiement'] = $this->School_management->view_paiement_eleve($codePaie);
       //$this->dd($data['paiement']);
         $data['view'] = 'financier/paiement/validation_paiement';
        $this->load->view('financier/main', $data);
    }
#==================================================================================
#-----------------------------------get all paiement functions ------------------------------
#======================================================================================
    public function code_validation(){
        //$al = "0123456789abcdefghijklmnopqrstuvwxyz.-#_|\;,:/*+=ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $al = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code_validation = substr(str_shuffle(str_repeat($al, rand(5, 20))), 0, 5);

        //$this->form_validation->set_data(compact('code_validation'));
        $this->form_validation->set_rules('code_validation', "code_validation", 'is_unique[tb_school_paiements.code_validation]',
            ['is_unique' => "%s déjà utilisé"]);

        return ($this->form_validation->run()) ? $code_validation : $this->code_validation();
    }

    public function valider_paiement ()
    {
        $matricule_eleve = $this->input->post('matricule_eleve');
        $code_validation = $this->code_validation();
        $date_paiement = $this->input->post('date_paiement');
        $date_validation = date('Y-m-d');
        $montant_percu = $this->input->post('montant_paye');
        $devise_percu = $this->input->post('devise');
        $type_frais = $this->input->post('type_frais');
        $mois = $this->input->post('mois');
        $annee_scolaire = $this->input->post('annee_scolaire');
        $mode_paiement = "local";

        $data['el'] = $this->School_management->get_join(['tb_school_eleves', 'tb_school_inscriptions', 'tb_school_classes'], ['matricule_eleve', 'nom_classe'],
            ['`tb_school_inscriptions.annee_scolaire' => $annee_scolaire, 'tb_school_inscriptions.matricule_eleve' => $matricule_eleve],
            'tb_school_eleves.*, tb_school_inscriptions.*, tb_school_classes.*', 'tb_school_eleves.nom_complet', 'ASC', 'row');

        $frais = $this->School_management->get_unique('tb_school_frais', ['type_frais' => $type_frais, 'cycle' => $data['el']->cycle, 'annee_scolaire' => $data['el']->annee_scolaire]);

        $compte = $this->School_management->get_unique('tb_school_comptes', ['devise' => $frais->devise]);

        $paiements_eleve = $this->School_management->get_join(['tb_school_paiements', 'tb_school_inscriptions'], ['matricule_eleve'],
            ['tb_school_paiements.annee_scolaire' => $annee_scolaire, 'tb_school_paiements.matricule_eleve' => $matricule_eleve],
            'tb_school_paiements.*', 'tb_school_paiements.id', 'ASC');

        $paiement_frais = FALSE;
        $paiement_mois = FALSE;
        foreach ($paiements_eleve as $paiement_eleve){
            if (($paiement_eleve->type_frais == $type_frais) AND ($paiement_eleve->annee_scolaire == $annee_scolaire)){
                $paiement_frais = TRUE;
            }
            elseif (($type_frais == "minerval") AND ($paiement_eleve->mois == $mois)){
                $paiement_mois = TRUE;
            }
        }

        if ($devise_percu == $frais->devise){

            $montant_restant = $frais->montant_fixe - $montant_percu;
            $statut_paiement = ($montant_restant == 0) ? "validé" : "amorcé" ;
            $montant_paye = $montant_percu;
            $devise = $devise_percu;
            if (($montant_paye >= $frais->montant_fixe * 0.5) AND ($montant_paye <= $frais->montant_fixe * 1)){

                $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_paye',
                    'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement', 'devise');

                if ((($type_frais != "minerval") AND (!$paiement_frais)) OR (($type_frais == "minerval") AND (!$paiement_mois))){
                    if ($this->School_management->set_insert('tb_school_paiements', $data_pay)){
                        $total_entree = $compte->total_entree + $montant_paye;
                        $solde_courant = $total_entree - $compte->total_sortie;
                        if ($type_frais == "inscription" AND $montant_paye == $frais->montant_fixe * 1){
                            $etat_inscription = "validé" ;
                            $date_inscription = date('Y-m-d') ;
                            $data_inscriptions = compact('etat_inscription', 'date_inscription');
                            $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                                ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                        }
                        $data_compte = compact('total_entree', 'solde_courant');
                        $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                        $this->get_msg("$statut_paiement avec succès!", 'success');
                    } else{
                        $this->get_msg("Impossible d'enregistrer ce paiement!");
                    }
                }
                else{
                    $this->get_msg("L'élève a déjà payé le frais correspondant!");
                }

            }else{

                $this->get_msg("Incohérence entre montant fixé et montant payé!");
            }

        }
        else{
            if ($frais->devise == "USD"){
                $devise = "USD";
                $montant_paye = round($montant_percu / $frais->taux_change, 1);
                $montant_restant = $frais->montant_fixe - $montant_paye;
                $statut_paiement = ($montant_restant == 0) ? "validé" : "amorcé" ;
                if (($montant_paye >= $frais->montant_fixe * 0.5) AND ($montant_paye <= $frais->montant_fixe * 1)){

                    $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_paye',
                        'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement', 'devise');

                    if ((($type_frais != "minerval") AND (!$paiement_frais)) OR (($type_frais == "minerval") AND (!$paiement_mois))){
                        if ($this->School_management->set_insert('tb_school_paiements', $data_pay)){
                            $total_entree = $compte->total_entree + $montant_paye;
                            $solde_courant = $total_entree - $compte->total_sortie;

                            if ($type_frais == "inscription" AND $montant_paye >= $frais->montant_fixe * 1){
                                $etat_inscription = "validé" ;
                                $date_inscription = date('Y-m-d') ;
                                $data_inscriptions = compact('etat_inscription', 'date_inscription');
                                $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                                    ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                            }

                            $data_compte = compact('total_entree', 'solde_courant');
                            $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                            $this->get_msg("$statut_paiement avec succès!", 'success');
                        } else{
                            $this->get_msg("Impossible d'enregistrer ce paiement!");
                        }
                    }
                    else{
                        $this->get_msg("L'élève a déjà payé le frais correspondant!");
                    }

                } else{
                    $this->get_msg("Incohérence entre montant fixé et montant payé!");
                }
            }
            else{
                $devise = "CDF";
                $montant_paye = round($montant_percu * $frais->taux_change, -3);
                $montant_restant = $frais->montant_fixe - $montant_paye;
                $statut_paiement = ($montant_restant == 0) ? "validé" : "amorcé" ;
                if (($montant_paye >= $frais->montant_fixe * 0.5) AND ($montant_paye <= $frais->montant_fixe * 1)){

                    $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_paye',
                        'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement', 'devise');

                    if ((($type_frais != "minerval") AND (!$paiement_frais)) OR (($type_frais == "minerval") AND (!$paiement_mois))){
                        if ($this->School_management->set_insert('tb_school_paiements', $data_pay)){
                            $total_entree = $compte->total_entree + $montant_paye;
                            $solde_courant = $total_entree - $compte->total_sortie;

                            if ($type_frais == "inscription" AND $montant_paye >= $frais->montant_fixe * 1){
                                $etat_inscription = "validé" ;
                                $date_inscription = date('Y-m-d') ;
                                $data_inscriptions = compact('etat_inscription', 'date_inscription');
                                $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                                    ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                            }

                            $data_compte = compact('total_entree', 'solde_courant');
                            $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                            $this->get_msg("$statut_paiement avec succès!", 'success');
                        } else{
                            $this->get_msg("Impossible d'enregistrer ce paiement!");
                        }
                    }
                    else{
                        $this->get_msg("L'élève a déjà payé le frais correspondant!");
                    }

                } else{
                    $this->get_msg("Incohérence entre montant fixé et montant payé!");
                }
            }
        }
        redirect('financier/paiement');
        //redirect('financier/paiements_eleves?matricule='. $matricule_eleve.'&annee='.$annee_scolaire);
    }

    function completer_paiement ()
    {
        $matricule_eleve = $this->input->post('matricule_eleve');
        $code_validation = $this->input->post('code_validation');
        $date_paiement = $this->input->post('date_paiement');
        $date_validation = date('Y-m-d');
        $montant_percu = ($this->input->post('montant_restant') !='') ? $this->input->post('montant_restant'):0;
        $devise = $this->input->post('devise');
        $type_frais = $this->input->post('type_frais');
        $mois = $this->input->post('mois');
        $annee_scolaire = $this->input->post('annee_scolaire');
        $mode_paiement = "local";
        $statut_paiement = "validé";

        $data['el'] = $this->School_management->get_join(['tb_school_eleves', 'tb_school_inscriptions', 'tb_school_classes'], ['matricule_eleve', 'nom_classe'],
            ['tb_school_inscriptions.annee_scolaire' => $annee_scolaire, 'tb_school_inscriptions.matricule_eleve' => $matricule_eleve],
            'tb_school_eleves.*, tb_school_inscriptions.*, tb_school_classes.*', 'tb_school_eleves.nom_complet', 'DESC', 'row');

        $paiement_correspondant = $this->School_management->get_unique('tb_school_paiements', ['code_validation' => $code_validation, 'annee_scolaire' => $data['el']->annee_scolaire]);
        
        $frais = $this->School_management->get_unique('tb_school_frais', ['type_frais' => $type_frais, 'cycle' => $data['el']->cycle, 'annee_scolaire' => $data['el']->annee_scolaire]);

        $compte = $this->School_management->get_unique('tb_school_comptes', ['devise' => $frais->devise]);

        $paiements_eleve = $this->School_management->get_join(['tb_school_paiements', 'tb_school_inscriptions'], ['matricule_eleve'],
            ['tb_school_paiements.annee_scolaire' => $annee_scolaire, 'tb_school_paiements.matricule_eleve' => $matricule_eleve],
            'tb_school_paiements.*', 'tb_school_paiements.id', 'DESC');

        if ($devise == $frais->devise){
            $montant_percu_avant = $this->School_management->get_unique('tb_school_paiements', 
                array('code_validation' => $code_validation, 'annee_scolaire' => $data['el']->annee_scolaire))->montant_paye;
            $montant_complet = $montant_percu + $montant_percu_avant. " ". $devise;
            $montant_restant = $paiement_correspondant->montant_restant - $montant_percu;
            if ($montant_restant == 0){
                $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_complet',
                    'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement');

                if ($this->School_management->set_update('tb_school_paiements', $data_pay, compact('code_validation'))){
                    $total_entree = $compte->total_entree + $montant_percu;
                    $solde_courant = $total_entree - $compte->total_sortie;

                    if ($type_frais == "inscription"){
                        $etat_inscription = "validé" ;
                        $date_inscription = date('Y-m-d') ;
                        $data_inscriptions = compact('etat_inscription', 'date_inscription');
                        $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                            ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                    }

                    $data_compte = compact('total_entree', 'solde_courant');
                    $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                    $this->get_msg("$statut_paiement avec succès!", 'success');
                } else{
                    $this->get_msg("Impossible d'enregistrer ce paiement!");
                }
            } else{

                $this->get_msg("Incohérence entre montant fixé et montant payé!");
            }

        }
        else{

            if ($frais->devise == "USD"){
                $montant_restant_convert = round($paiement_correspondant->montant_restant * $frais->taux_change, -3);
                $montant_restant = ($montant_restant_convert - $montant_percu);
                

                $montant_paye_avant = $this->School_management->get_unique('tb_school_paiements', 
                array('code_validation' => $code_validation, 'annee_scolaire' => $data['el']->annee_scolaire))->montant_paye;
           
                 $montant_complet = $paiement_correspondant->montant_restant + $montant_paye_avant. " ". $frais->devise;

                if ($montant_restant == 0){

                    $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_complet',
                        'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement');

                    if ($this->School_management->set_update('tb_school_paiements', $data_pay, compact('code_validation'))){
                        $total_entree = $compte->total_entree + $paiement_correspondant->montant_restant;
                        $solde_courant = $total_entree - $compte->total_sortie;

                        if ($type_frais == "inscription"){
                            $etat_inscription = "validé" ;
                            $date_inscription = date('Y-m-d') ;
                            $data_inscriptions = compact('etat_inscription', 'date_inscription');
                            $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                                ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                        }

                        $data_compte = compact('total_entree', 'solde_courant');
                        $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                        $this->get_msg("$statut_paiement avec succès!", 'success');
                    } else{
                        $this->get_msg("Impossible d'enregistrer ce paiement!");
                    }

                } else{
                    $this->get_msg("Incohérence entre montant fixé et montant payé!");
                }

            }
            else{
                $montant_restant_convert = round($paiement_correspondant->montant_restant / $frais->taux_change, 1);
                $montant_restant = ($montant_restant_convert - $montant_percu);
                //$montant_complet = $paiement_correspondant->montant_restant ." ". $frais->devise;

                 $montant_paye_avant = $this->School_management->get_unique('tb_school_paiements', 
                array('code_validation' => $code_validation, 'annee_scolaire' => $data['el']->annee_scolaire))->montant_paye;
           
                 $montant_complet = $paiement_correspondant->montant_restant + $montant_paye_avant. " ". $frais->devise;


                if ($montant_restant == 0){

                    $data_pay = compact('matricule_eleve', 'code_validation', 'date_paiement', 'date_validation', 'montant_complet',
                        'type_frais', 'mois','annee_scolaire', 'montant_restant', 'mode_paiement', 'statut_paiement');

                    if ($this->masomo_meneja_model->set_update('tb_school_paiements', $data_pay, compact('code_validation'))){
                        $total_entree = $compte->total_entree + $paiement_correspondant->montant_restant;
                        $solde_courant = $total_entree - $compte->total_sortie;

                        if ($type_frais == "inscription"){
                            $etat_inscription = "validé" ;
                            $date_inscription = date('Y-m-d') ;
                            $data_inscriptions = compact('etat_inscription', 'date_inscription');
                            $this->School_management->set_update('tb_school_inscriptions', $data_inscriptions,
                                ['matricule_eleve' => $matricule_eleve, 'annee_scolaire' => $annee_scolaire]);
                        }

                        $data_compte = compact('total_entree', 'solde_courant');
                        $this->School_management->set_update('tb_school_comptes', $data_compte, ['devise' => $frais->devise]);
                        $this->get_msg("$statut_paiement avec succès!", 'success');
                    } else{
                        $this->get_msg("Impossible d'enregistrer ce paiement!");
                    }

                } else{
                    $this->get_msg("Incohérence entre montant fixé et montant payé!");
                }
            }
        }

        redirect('financier/paiement');
    }

    ########################################   *   ########################################
    #
    #					     	# GENERIC FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Add data
     */
    public function Add_form()
    {
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        $data['classes_mat'] = $this->db->get_where('tb_school_classes', array('cycle' => 'maternel'))->result();
        $data['classes_pri'] = $this->db->get_where('tb_school_classes', array('cycle' => 'primaire'))->result();

        $data['date_naiss_max'] = ((new DateTime())->modify('-3 year'))->format('Y-m-d');
        $data['date_naiss_min'] = ((new DateTime())->modify('-25 year'))->format('Y-m-d');

        #=================forms information======================
        $type = $this->uri->segment(3) ?? $this->session->type;
        $data['view'] = "financier/$type/add";
        $this->load->view('financier/main', $data);
    }

    /**
     *@ Update data
     */
    public function Update_form()
    {
        #=======================forms update data====================
        $id = $this->uri->segment(4);
        $type = $this->uri->segment(3) ?? $this->session->type;
        //infos sessions utilisateurs for edit
        $data['agents'] = $this->Get_model->get_info_by_table_by_id($id, 'tb_school_assets', 'id_asset');
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        //Nouvelles fonctions sur school management
        $data['classe'] = $this->Get_model->get_onces($id, 'classe');
        $data['section'] = $this->Get_model->get_onces($id, 'section');
        $data['option'] = $this->Get_model->get_onces($id, 'option');
        $data['eleve'] = $this->Get_model->get_onces($id, 'eleve');
        //$data['inscription'] = $this->Get_model->get_onces($id, 'inscription');
        $data['inscription'] = $this->Get_model->get_view_onces($id, 'eleves_inscrit', 'id_inscription');

        $data['view'] = "financier/$type/update";
        $this->load->view('financier/main', $data);
    }

    #====================================edition du profil utilisateur===============================charger vue profil
    public function vue_profil()
    {
        //$data['visiteurs'] = $this->Get_model->get('vue_details_visitors', 'date_signup')->result();
        $data['view'] = 'financier/vue_profil_utilisateur';
        $this->load->view('financier/main', $data);
    }
    //Traitement de la mise à jour des informations du profil
    //fonction de modification du mot de passe proprement-dite
    function profil()
    {
        //$asset_username = $this->session->username;
        //$asset_email = $this->session->username;
        $nvo_mot_pass = $this->input->post('nvo_mot_pass');
        $conf_mot_pass = $this->input->post('conf_mot_pass');

        $options = array(
            'cost' => 12,);
        $anc_mot_pass = password_hash($this->input->post('anc_mot_pass'), PASSWORD_BCRYPT, $options);
        $validate = array();

        $this->form_validation->set_rules('nvo_mot_pass', 'Nouveau Mot de passe', 'min_length[6]|max_length[12]',
            array(
                'min_length' => 'Le champ %s doit contenir au moins huit caractères',
                'max_length' => 'Le champ %s doit contenir au plus douze caractères'
            ));

        $this->form_validation->set_rules('conf_mot_pass', 'Confirmer Mot de passe', 'matches[nvo_mot_pass]',
            array(
                'matches' => 'Le champ %s doit correspondre avec le champ Nouveau Mot de passe'
            ));

        $anc_mot_pass_db = $this->Passports_model->get_unique('tb_school_assets',
            array('asset_username' => $this->session->username))->asset_password;

        $this->form_validation->set_data(array_merge($validate, compact('nvo_mot_pass', 'conf_mot_pass')));

        if ($this->form_validation->run()) {

            if ($anc_mot_pass != $anc_mot_pass_db) {
                //$asset_password=$nvo_mot_pass;
                $asset_password = empty($nvo_mot_pass) ? $anc_mot_pass : password_hash($nvo_mot_pass, PASSWORD_BCRYPT, $options);

                $data_ut = compact('asset_password');

                if ($this->Passports_model->set_update('tb_school_assets', $data_ut,
                    array('asset_username' => $this->session->username))) {

                    //redirection with message notification success
                    $this->get_msg(' Mise à jour de votre mot de passe utilisateur effectuée avec succès', 'success');
                    redirect('financier/dashboard');

                } else {
                    $this->get_msg("Impossible de mettre à jour votre mot de passe utilisateur !");
                    $data['view'] = 'financier/vue_profil_utilisateur';
                    $this->load->view('financier/main', $data);
                }
            } else {
                $error_anc_mot_pass = TRUE;
                $this->session->set_flashdata(compact('error_anc_mot_pass'));
                $this->get_msg("Impossible de mettre à jour les données car votre 
                mot de passe en cours est incorrect");
                $data['view'] = 'financier/vue_profil_utilisateur';
                $this->load->view('financier/main', $data);
            }
            //redirect('agent/vue_profil');
        } else {
            $this->get_msg("Mise à jour du mot de passe non effectuée en raison d'une erreur survenue 
            lors de la validation de données !");
            $data['view'] = 'financier/vue_profil_utilisateur';
            $this->load->view('financier/main', $data);
        }
    }

    #===================================fin===========================================
    public function logout()
    {
        //déconnexion - fermeture de la session
        $this->session->sess_destroy();
        return redirect(base_url() . 'main/index');
    }

    public function sendIdentifiantConnexion($email, $username, $password, $subject)
    {
        $from = "";
        $cc1 = "";
        $addresses = mb_split(";", $email);
        if (count($addresses) > 1) {
            $from = $addresses[0];
            $cc1 = $addresses[1];
        } else {
            $from = $email;
        }
        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom('mwez.rubuz@congoagile.net', 'School Management Application');
            $mail->addAddress($from, '');
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
            $mail->addCC('info@congoagile.net', 'Webmaster IT Support');
            $mail->Subject = $subject;

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Body = '<html><strong>Cher ' . $from . '<br/></strong> Votre compte a été crée avec succès
            <strong> veuillez trouver ci-dessous les identifiants de connexion. <br/>Username:  ' . $username . '<br/>Mot de passe: ' . $password . '<br/></strong>
            <p> Veuillez suivre le lien ci-après pour vous connecter.</p><a href="https://schoolmanagement.congoagile.net"> 
            School Management Application.</a></html>';

            /* SMTP parameters. */

            $mail->isSMTP();

            //$mail->SMTPDebug = 2;

            /* SMTP server address. */
            $mail->Host = 'mail.congoagile.net';

            /* Use SMTP authentication. */
            $mail->SMTPAuth = TRUE;

            /* Set the encryption system. */
            $mail->SMTPSecure = 'tls';

            /* SMTP authentication username. */
            $mail->Username = 'mwez.rubuz@congoagile.net';

            /* SMTP authentication password. */
            $mail->Password = '*ELIEMWEZ@EMAR.RUCHI11220';

            /* Set the SMTP port. */
            $mail->Port = 465;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            /* Finally send the mail. */
            //$mail->send();
            //return $redirect;
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        } catch (Exception $e) {
        }
    }
}
