<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//require_once 'C:\composer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Administratif extends CI_Controller
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
        // Data du graphique
        $data['envois'] = $this->Get_model->get_livraisons();

        $inscriptions_encours = $this->Get_model->get_inscriptions_encours();
        $inscriptions_traitees = $this->Get_model->get_inscriptions_traitees();
        $demande_par_mois = $this->Get_model->get_demande_by_month();
        //var_dump($demande_par_mois) or die();
        $arr = array();
        $arr_encours = array();

        //bouckage des données encours
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

        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();

        //chargement de la vue avec des données
        $data['view'] = 'administratif/dashboard/index';
        $this->load->view('administratif/main', $data);
    }


    ########################################   *   ########################################
    #
    #								 # AGENT FUNCTIONS
    #
    ########################################   *   ########################################

    public function ResetPassword()
    {
        $id = $this->uri->segment(4);
        $data['page'] = 'administratif-interface';
        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();
        $data['id_asset'] = $id;
        $data['view'] = 'administratif/agent/reset_password';
        $this->load->view('administratif/main', $data);
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
        $data['view'] = 'administratif/eleve/index';
        $this->load->view('administratif/main', $data);
    }
#==================================================================================
#-----------------------------------Inscription eleve------------------------------
#======================================================================================
    function add_eleve()
    {
        //Form valdation constraint
        #get fullname student
        $this->form_validation->set_rules('nom_complet', 'nom_complet', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        #get father name student
        $this->form_validation->set_rules('nom_pere', 'nom_pere', 'required', array(
            'required' => 'Le nom du père est obligatoire',
        ));
        #get mother name student
        $this->form_validation->set_rules('nom_mere', 'nom_mere', 'required', array(
            'required' => 'Le nom de la mère est obligatoire',
        ));
        #get gendar student
        $this->form_validation->set_rules('genre', 'genre', 'required', array(
            'required' => 'Le sexe est obligatoire',
        ));#get gendar student
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' => 'Adresse e-mail obligatoire',
        ));
        $this->form_validation->set_rules('cycle', 'cycle', 'required', array(
            'required' => 'Le cycle obligatoire',
        ));
        $this->form_validation->set_rules('nom_classe', 'nom_classe', 'required', array(
            'required' => 'La classe est obligatoire',
        ));
        $this->form_validation->set_rules('date_naissance', 'date_naissance', 'required', array(
            'required' => 'La date de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('lieu_naissance', 'lieu_naissance', 'required', array(
            'required' => 'Le lieu de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('adresse_eleve', 'adresse_eleve', 'required', array(
            'required' => 'Adresse de residence obligatoire',
        ));
        $this->form_validation->set_rules('contact_eleve', 'contact_eleve', 'required', array(
            'required' => 'Numéro téléphone obligatoire',
        ));
        if ($this->form_validation->run()) {

            $nom_complet = trim($this->input->post('nom_complet'));
            $email = trim($this->input->post('email'));
            $genre = trim($this->input->post('genre'));
            $nom_pere = trim($this->input->post('nom_pere'));
            $nom_mere = ($this->input->post('nom_mere'));
            $nom_tuteur = ($this->input->post('nom_tuteur'));
            $cycle = ($this->input->post('cycle') == "EB") ? "secondaire" : trim(($this->input->post('cycle')));
            $nom_classe = trim($this->input->post('nom_classe'));
            $nom_option = ucfirst($this->input->post('cycle') == "secondaire") ? ucfirst(trim($this->input->post('nom_option'))) : NULL;
            #get full year
            $annee_actuel = date('Y');
            $annee_scolaire = $annee_actuel . '-' . ($annee_actuel + 1);
            $date_demande = date('Y-m-d');
            $date_inscription = date('Y-m-d');
            if ($nom_option == "Biochimie" OR $nom_option == "Math-physique" OR $nom_option == "Scientifique") {
                $nom_section = "Scientifique";
            } elseif ($nom_option == "Mécanique générale" OR $nom_option == "Electronique" OR $nom_option == "Electricité" OR
                $nom_option == "Mécanique Auto" OR $nom_option == "Coupe & couture" OR $nom_option == "Construction"
                OR $nom_option == "Ménuisérie" OR $nom_option == "Agronomie" OR $nom_option == "Industrielle" OR $nom_option == "Nutrition") {
                $nom_section = "Technique";
            } elseif ($nom_option == "Pedagogie générale") {
                $nom_section = "Pedagogique";
            } elseif ($nom_option == "Latin-philo") {
                $nom_section = "Littéraire";
            } elseif ($nom_option == "Gestion informatique" OR $nom_option == "Commerciale administrative" OR $nom_option == "Commerciale") {
                $nom_section = "Commerciale";
            } else {
                $nom_section = NULL;
            }

            $date_naissance = trim($this->input->post('date_naissance'));
            $lieu_naissance = trim($this->input->post('lieu_naissance'));
            $contact_eleve = trim($this->input->post('contact_eleve'));
            $adresse_eleve = trim($this->input->post('adresse_eleve'));
            $etat_inscription = "en attente";

            $data_eleve = compact('nom_complet', 'email', 'genre', 'date_naissance', 'lieu_naissance',
                'adresse_eleve', 'contact_eleve', 'nom_pere', 'nom_mere', 'nom_tuteur');

            if ($this->School_management->set_insert('tb_school_eleves', $data_eleve)) {
                $id_eleve = $this->School_management->get_unique('tb_school_eleves', ['email' => $email])->id_eleve;

                if ($id_eleve < 10) {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-00" . $id_eleve;
                } elseif ($id_eleve >= 10 AND $id_eleve < 100) {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-0" . $id_eleve;
                } else {
                    $matricule_eleve = "EL-" . $annee_scolaire . "-" . $id_eleve;
                }
                if ($this->School_management->set_update('tb_school_eleves', compact('matricule_eleve'), ['email' => $email])) {

                    $data_inscription = compact('date_inscription', 'matricule_eleve', 'annee_scolaire', 'nom_classe',
                        'nom_option', 'nom_section', 'cycle', 'date_demande', 'etat_inscription');
                    $this->School_management->set_insert('tb_school_inscriptions', $data_inscription);
                }
            } else {
                $this->get_msg("Impossible d'inscrire l'élève. $nom_complet");
                $this->session->set_flashdata('type', 'eleve');
                $this->Add_form();
            }
            $this->get_msg("L'élève $nom_complet a été inscrit avec succès!", 'success');
            return redirect(base_url() . 'administratif/eleve');
        } else {
            $this->session->set_flashdata('type', 'eleve');
            $this->Add_form();
        }
    }
#==================================================================================
#-----------------------------------update eleve------------------------------
#======================================================================================


    /**
     * Edit Agent Form
     */
    public function update_eleve()
    {
        //Form valdation constraint
        #get fullname student
        $this->form_validation->set_rules('nom_complet', 'nom_complet', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        #get father name student
        $this->form_validation->set_rules('nom_pere', 'nom_pere', 'required', array(
            'required' => 'Le nom du père est obligatoire',
        ));
        #get mother name student
        $this->form_validation->set_rules('nom_mere', 'nom_mere', 'required', array(
            'required' => 'Le nom de la mère est obligatoire',
        ));
        #get gendar student
        $this->form_validation->set_rules('genre', 'genre', 'required', array(
            'required' => 'Le sexe est obligatoire',
        ));#get gendar student
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required' => 'Adresse e-mail obligatoire',
        ));

        $this->form_validation->set_rules('date_naissance', 'date_naissance', 'required', array(
            'required' => 'La date de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('lieu_naissance', 'lieu_naissance', 'required', array(
            'required' => 'Le lieu de naissance est obligatoire',
        ));
        $this->form_validation->set_rules('adresse_eleve', 'adresse_eleve', 'required', array(
            'required' => 'Adresse de residence obligatoire',
        ));
        $this->form_validation->set_rules('contact_eleve', 'contact_eleve', 'required', array(
            'required' => 'Numéro téléphone obligatoire',
        )); $this->form_validation->set_rules('statut_eleve', 'statut_eleve', 'required', array(
            'required' => 'Stattut access obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {

            $nom_complet = trim($this->input->post('nom_complet'));
            $email = trim($this->input->post('email'));
            $genre = trim($this->input->post('genre'));
            $nom_pere = trim($this->input->post('nom_pere'));
            $nom_mere = ($this->input->post('nom_mere'));
            $nom_tuteur = ($this->input->post('nom_tuteur'));
            $date_naissance = trim($this->input->post('date_naissance'));
            $lieu_naissance = trim($this->input->post('lieu_naissance'));
            $contact_eleve = trim($this->input->post('contact_eleve'));
            $adresse_eleve = trim($this->input->post('adresse_eleve'));//
            $statut_eleve = trim($this->input->post('statut_eleve'));//
            $data_eleve = compact('nom_complet', 'email', 'genre', 'date_naissance', 'lieu_naissance',
                'adresse_eleve', 'contact_eleve', 'nom_pere', 'nom_mere', 'nom_tuteur','statut_eleve');

            // update
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_eleves', $data_eleve, array('id_eleve' => $id))) {
                $this->get_msg("Modification des infos de l'élève $nom_complet effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'administratif/eleve');
            } else {
                //$this->get_msg("Erreur de modification du compte utilisateur");
                $this->session->set_flashdata('type', 'eleve');
                $this->Update_form();
            }

        } else {
            //this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'eleve');
            $this->Update_form();
        }
    }

#==================================================================================
#-----------------------------------validation demande Inscription eleve------------------------------
#======================================================================================
    public function valider_inscription()
    {
        #recupere data update
        $nom_complet = trim($this->input->post('nom_complet'));
        $matricule_eleve = trim($this->input->post('matricule_eleve'));
        $etat_inscription = trim('validé');//
        $id_inscription = trim($this->input->post('id_inscription'));//
        $date_validation=date('Y-m-d H:i:s');
        $data_eleve = compact('etat_inscription', 'date_validation');

        if ($this->Update_model->set_update('tb_school_inscriptions', $data_eleve, array('id_inscription' => $id_inscription))) {
            $this->get_msg("Validation de l'incription de l'élève $nom_complet matriculé $matricule_eleve effectuée avec succès", "success");
            // redirection
            return redirect(base_url() . 'administratif/inscription');
        } else {
            //$this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'inscription');
            $this->Update_form();
        }
    }
#==================================================================================
#-----------------------------------update Inscription eleve------------------------------
#======================================================================================
    public function update_inscription()
    {
        #recupere data update
        #recupere data update
        $nom_complet = trim($this->input->post('nom_complet'));
        $matricule_eleve = trim($this->input->post('matricule_eleve'));
        $etat_inscription = trim($this->input->post('etat_inscription'));//
        //$id_inscription = trim($this->input->post('id_inscription'));//
        $date_validation=date('Y-m-d H:i:s');
        $data_eleve = compact('etat_inscription', 'date_validation');
        $id_inscription = $this->uri->segment(4);
        if ($this->Update_model->set_update('tb_school_inscriptions', $data_eleve, array('id_inscription' => $id_inscription))) {
            $this->get_msg("Validation de l'incription de l'élève $nom_complet matriculé $matricule_eleve effectuée avec succès", "success");
            // redirection
            return redirect(base_url() . 'administratif/inscription');
        } else {
            //$this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'inscription');
            $this->Update_form();
        }
    }
#==================================================================================
#-----------------------------------réinscription eleve------------------------------
#======================================================================================
    function reinscrire_eleve()
    {
        $nom = $this->input->post('nom_eleve');
        $postnom = $this->input->post('postnom_eleve');
        $prenom = $this->input->post('prenom_eleve');
        $genre = $this->input->post('genre_eleve');
        $date_naissance = $this->input->post('date_naissance');
        $lieu_naissance = $this->input->post('lieu_naissance');
        $telephone = $this->input->post('telephone');
        $adresse = $this->input->post('adresse');
        $code_classe = $this->input->post('nouvelle_classe');
        $num_eleve = $this->input->post('num_eleve');
        $annee = date('Y') . '-' . (date('Y') + 1);
        $date_reinscrip = date('Y-m-d');

        $data_eleve = compact('nom', 'postnom', 'prenom', 'genre', 'date_naissance', 'lieu_naissance',
            'telephone', 'adresse', 'num_eleve');
        $data_inscrip = compact('num_eleve', 'code_classe', 'annee', 'date_reinscrip');

    }
#==================================================================================
#-----------------------------------get all demandes Inscription eleve------------------------------
#======================================================================================
    function list_dmd_reinscriptions()
    {
        $this->get_msg("Fonctionnalité en cours de dévéloppement");
        $this->index();
    }
    public function inscription()
    {
        #get full year
        $annee_actuel = date('Y');
        $annee_sco_act = $annee_actuel . '-' . ($annee_actuel + 1);
        #==============all department===============

        $annee_scolaire = ($this->input->post('annee_scolaire'));
        $data['select'] = $annee_scolaire;
        if (isset($annee_scolaire)) {
            $data['inscriptions'] = $this->db->get_where('view_school_eleves_inscrits', array('annee_scolaire' => $annee_scolaire))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        } else {
            $data['inscriptions'] = $this->db->get_where('view_school_eleves_inscrits', array('annee_scolaire' => $annee_sco_act))->result();
            //$data['eleves'] = $this->Get_model->get('view_eleves_inscrits ', 'nom_complet')->result();
            $data['periodes'] = $this->Get_model->get('tb_school_periodes', 'date_created')->result();
        }
        //$this->dd($data['eleves']);
        $data['view'] = 'administratif/inscription/index';
        $this->load->view('administratif/main', $data);
    }
    ########################################   *   ########################################
    #
    #                            # CLASSES SCOLAIRES FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Show user form
     */
    public function classe()
    {
        #==============all department===============
        $data['classes'] = $this->Get_model->get('tb_school_classes', 'nom_classe')->result();
        $data['view'] = 'administratif/classe/index';
        $this->load->view('administratif/main', $data);
    }

    ########################################   *   ########################################
    #
    #								# SECTIONS FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ S
     */
    public function section()
    {

        #================all sections ======================
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        $data['view'] = 'administratif/section/index';
        $this->load->view('administratif/main', $data);
    }

    ########################################   *   ########################################
    #
    #							  # OPTIONS FUNCTIONS
    #
    ########################################   *   ########################################

    /**
     *@ Show user form
     */
    public function option()
    {
        #=================all agency =================
        $data['options'] = $this->Get_model->get('tb_school_options', 'nom_option')->result();

        $data['view'] = 'administratif/option/index';
        $this->load->view('administratif/main', $data);
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
        $data['view'] = "administratif/$type/add";
        $this->load->view('administratif/main', $data);
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
        $data['inscription'] = $this->Get_model->get_view_onces($id, 'eleves_inscrit','id_inscription');

        $data['view'] = "administratif/$type/update";
        $this->load->view('administratif/main', $data);
    }

    #====================================edition du profil utilisateur===============================charger vue profil
    public function vue_profil()
    {
        //$data['visiteurs'] = $this->Get_model->get('vue_details_visitors', 'date_signup')->result();
        $data['view'] = 'administratif/vue_profil_utilisateur';
        $this->load->view('administratif/main', $data);
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
                    redirect('administratif/dashboard');

                } else {
                    $this->get_msg("Impossible de mettre à jour votre mot de passe utilisateur !");
                    $data['view'] = 'administratif/vue_profil_utilisateur';
                    $this->load->view('administratif/main', $data);
                }
            } else {
                $error_anc_mot_pass = TRUE;
                $this->session->set_flashdata(compact('error_anc_mot_pass'));
                $this->get_msg("Impossible de mettre à jour les données car votre 
                mot de passe en cours est incorrect");
                $data['view'] = 'administratif/vue_profil_utilisateur';
                $this->load->view('administratif/main', $data);
            }
            //redirect('agent/vue_profil');
        } else {
            $this->get_msg("Mise à jour du mot de passe non effectuée en raison d'une erreur survenue 
            lors de la validation de données !");
            $data['view'] = 'administratif/vue_profil_utilisateur';
            $this->load->view('administratif/main', $data);
        }
    }

    #===================================fermeture session===========================================
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
