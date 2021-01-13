<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @include library sending mail function
 */
//require_once 'C:\composer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Eleve extends CI_Controller {
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
        $this->load->model('Passports_model');
    }

    /**
     *@ Check is agent is logged
     */
    private function is_logged()
    {
        if (!$this->session->authentified_eleve) {
            // code...
            return redirect(base_url() . 'main/index');
        }
    }


    ########################################   *   ########################################
    #
    #					             # STUDENT FUNCTIONS
    #
    ########################################   *   ########################################

    public function index() {
        $classes = $this->Get_model->get('tb_school_classes', 'nom_classe')->result();
        // traitement des visas
        $arr = array();

        foreach ($classes as $v) {
          // code...
          $nature = strtolower($v->nom_classe);
          $arr[$nature] = $v->nom_classe;
        }

        $data['classes'] = $arr;

        $agences = $this->Get_model->get('tb_school_periodes', 'annee_scolaire')->result();

        // traitement des visas
        $arr = array();

        foreach ($agences as $v) {
          // code...
          $code = strtolower($v->annee_scolaire);
          $arr[$code] = $v->annee_scolaire;
        }
        // var_dump($arr) or die();

        $data['periodes'] = $arr;
        $id_visiteur = $this->session->matricule;
        //infos inscription
        $data['d'] = ($this->Get_model->get_join('tb_school_eleves', 'date_inscription',
        array(['matricule_eleve', 'tb_school_inscriptions', 'matricule_eleve']))->result())[0];
        //infos paiement
        $data['paiements'] = ($this->Get_model->get_join('tb_school_eleves', 'date_paiement',
        array(['matricule_eleve', 'tb_school_paiements', 'matricule_eleve']))->result())[0];

        $data['view'] = 'eleve/index';
        $this->load->view('eleve/main', $data);
    }

    /**
    *@ View visitor details
    */
    public function dossier_eleve()
    {
      //consultation d'un eleve
      $id_visiteur = $this->session->matricule;
      $data['eleve'] = $this->Get_model->get_eleve($id_visiteur);
      $data['documents'] = $this->db->get_where('tb_school_documents', array('matricule_eleve' => $id_visiteur))->result();
      $data['view'] = 'eleve/dossier_eleve';
      $this->load->view('eleve/main', $data);
    }
   /**
    *@ View parcours scolaires eleves
    */
    public function parcours_scolaire()
    {
        //consultation d'un eleve
        $id_visiteur = $this->session->matricule;
        $data['eleve'] = $this->Get_model->get_eleve($id_visiteur);
        $data['inscriptions'] = $this->db->get_where('tb_school_resultats', array('matricule_eleve' => $id_visiteur))->result();
        $data['view'] = 'eleve/parcours_scolaire';
        $this->load->view('eleve/main', $data);
    }
    /**
    *@ View paiement_frais scolaires by eleves
    */
    public function paiement_frais()
    {
        //consultation d'un eleve
        $id_visiteur = $this->session->matricule;
        $data['eleve'] = $this->Get_model->get_eleve($id_visiteur);
        $data['inscriptions'] = $this->Get_model->get_parcours_eleve($id_visiteur);
        $data['paiements'] = $this->db->get_where('tb_school_paiements', array('matricule_eleve' => $id_visiteur))->result();
        $data['view'] = 'eleve/paiement_frais';
        $this->load->view('eleve/main', $data);
    }
    /**
     *@ View parcours scolaires eleves
     */
    public function inscription_reinscription()
    {
        //consultation d'un eleve
        $id_visiteur = $this->session->matricule;
        $data['eleve'] = $this->Get_model->get_eleve($id_visiteur);
        $data['inscriptions'] = $this->db->get_where('tb_school_inscriptions', array('matricule_eleve' => $id_visiteur))->result();
        $data['view'] = 'eleve/inscription_reinscription';
        $this->load->view('eleve/main', $data);
    }
    /**
     *@ View infos scolaires
     */
    public function infos_ecole()
    {
        $data['infos'] = $this->Get_model->get('tb_school_actualites', 'date_created')->result();
        $data['view'] = 'eleve/infos_ecole';
        $this->load->view('eleve/main', $data);
    }
    /**
     * @ se deconnecter
     */
    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(base_url() . 'main/index');
    }

}
