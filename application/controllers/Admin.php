<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//require_once 'C:\composer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Admin extends CI_Controller
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
        $this->load->model('Passports_model');

        //change status of others admins session
        //$this->admin_compte_block();
        //$this->is_active();
    }

    /**
     *@ Check is admin is logged
     */
    private function is_logged()
    {
        if (!$this->session->authentified_admin) {
            // code...
            return redirect(base_url() . 'main/index');
        }
    }

    function admin_compte_block()
    {
        if ($this->session->authentified_admin) {
            //block all acount others admins
            $data['users'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();
            foreach ($data['users'] as $user) {
                if ($user->asset_username != $this->session->username) {
                    //Change status of all admin account to 0
                    $asset_type = 'administrator';
                    $status = 0;
                    $data_user = compact('status');
                    $this->Passports_model->set_update('tb_school_assets', $data_user, ['asset_type' => $asset_type]);
                }
            }
        }
    }

    function is_active()
    {
        if ($this->session->authentified_admin) {
            $status = 1;
            $data_user = compact('status');
            $this->Passports_model->set_update('tb_school_assets', $data_user, ['asset_username' => $this->session->username]);
        } else {
            //Change status of all admin account to 0
            $asset_type = 'administrator';
            $status = 1;
            $data_user = compact('status');
            $this->Passports_model->set_update('tb_school_assets', $data_user, ['asset_type' => $asset_type]);
        }

    }
    ########################################   *   ########################################
    #
    #						    # DASHBORAD FUNCTIONS
    #
    ########################################   *   ########################################

    public function Dashboard()
    {
        // Data du graphique
        $data['envois'] = $this->Get_model->get_livraisons();

        $demande_par_mois = $this->Get_model->get_demande_by_month();
        // var_dump($demande_par_mois) or die();
        $arr = [];
        foreach ($demande_par_mois as $v) {
            // code...

            if ($v->num_rows() > 0) {

                $arr[] = $v->num_rows();
            } else {
                $arr[] = 0;
            }
        }
        $data['demandes_par_mois'] = $arr;

        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();

        //chargement de la vue avec des données
        $data['view'] = 'admin/dashboard/index';
        $this->load->view('admin/main', $data);
    }


    ########################################   *   ########################################
    #
    #								 # AGENT FUNCTIONS
    #
    ########################################   *   ########################################

    public function ResetPassword()
    {
        $id = $this->uri->segment(4);
        $data['page'] = 'admin-interface';
        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();
        $data['id_asset'] = $id;
        $data['view'] = 'admin/agent/reset_password';
        $this->load->view('admin/main', $data);
    }

    /**
     *@ List of agents and admin
     */
    public function Agent()
    {

        $data['page'] = 'admin-interface';
        $data['managers'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();

        $data['view'] = 'admin/agent/index';
        $this->load->view('admin/main', $data);
    }

    /**
     *@ Add an agent
     */
    public function Add_agent()
    {
        //recupere infos users existants
        $data['users'] = $this->Get_model->get('tb_school_assets', 'date_connected')->result();


        $this->form_validation->set_rules('asset_name', 'asset_name', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        $this->form_validation->set_rules('asset_username', 'asset_username', 'required', array(
            'required' => 'Le nom utilisateur est obligatoire',
        ));

        $this->form_validation->set_rules('asset_email', 'asset_email', 'required', array(
            'required' => 'L\'email est obligatoire',
        ));

        $this->form_validation->set_rules('asset_password', 'asset_password', 'required', array(
            'required' => 'Le mot de passe est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run() && $this->input->post('asset_type') != "" &&
            $this->input->post('asset_departement') != "" && $this->input->post('asset_email') != "") {

            $user_name = trim(strtolower($this->input->post('asset_name')));
            $user_username = trim(strtolower($this->input->post('asset_username')));
            $user_mail = trim(strtolower($this->input->post('asset_email')));
            $user_password_default = $this->input->post('asset_password');

            $user_existant = $this->Get_model->user_existant($user_name);

            //Infos utilisateurs existant
            $username_db = '';
            $usermail_db = '';
            if (!empty($user_existant)) {

                $userdata = array(
                    'asset_name' => $user_existant->asset_name,
                    'asset_username' => $user_existant->asset_username,
                    'asset_email' => $user_existant->asset_email,
                    'asset_password' => $user_existant->asset_password
                );
                $username_db = $user_existant->asset_username;
                $usermail_db = $user_existant->asset_email;
            }
            //|| ($user_existant->asset_email == $user_mail)
            if (($username_db == $user_name) || ($usermail_db == $user_mail)) {
                $this->get_msg("L'utilisateur $user_name ayant l'adresse e-mail $user_mail existe déjà.");
                // redirection
                return redirect(base_url() . 'admin/agent');
            } else {
                //ajout des elements à l'algorithme de cryptage.
                $options = array(
                    'cost' => 12,
                );
                //Mise en tableau des informations du compte a créé
                $data = array(
                    'asset_name' => $user_name,
                    'asset_username' => $user_username,
                    'asset_password' => password_hash($this->input->post('asset_password'), PASSWORD_BCRYPT, $options),
                    'asset_departement' => $this->input->post('asset_departement'),
                    'asset_email' => $user_mail,
                    'asset_type' => $this->input->post('asset_type'),
                    'groupe' => $this->input->post('groupe'),
                    'status' => 1,
                );
                // insert datas in database
                $this->Insert_model->insert_data($data, 'tb_school_assets');
                $this->get_msg("Le compte utilisateur de $user_name a été créé avec succès", 'success');
                //envoi de la notification à l'utilisateur du compte créé

               // $this->sendIdentifiantConnexion($user_mail, $user_name, $user_password_default, "Vos identifiants de connexion à l'application School Management");
                // redirection
                return redirect(base_url() . 'admin/agent');
            }

        } else {
            $this->get_msg('Erreur de création du compte utilisateur en raison système');
            $this->session->set_flashdata('type', 'agent');
            $this->Add_form();
        }
    }


    /**
     * Edit Agent Form
     */
    public function Update_agent()
    {
        //$data['agents_effectifs'] = $this->Get_model->get_effectif();

        $this->form_validation->set_rules('asset_name', 'asset_name', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        $this->form_validation->set_rules('asset_username', 'asset_username', 'required', array(
            'required' => 'Le nom utilisateur est obligatoire',
        ));

        $this->form_validation->set_rules('asset_email', 'asset_email', 'required', array(
            'required' => 'L\'email est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run() && $this->input->post('asset_type') != "" &&
            $this->input->post('asset_departement') != "" && $this->input->post('asset_email') != "") {
            $fullname = $this->input->post('asset_name');
            $data = array(
                'asset_name' => $this->input->post('asset_name'),
                'asset_username' => $this->input->post('asset_username'),
                'asset_departement' => $this->input->post('asset_departement'),
                'asset_email' => $this->input->post('asset_email'),
                'asset_type' => $this->input->post('asset_type'),
                'groupe' => $this->input->post('groupe'),
                'status' => 1,
            );

            // update
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_assets', $data, array('id_asset' => $id))) {
                $this->get_msg("Modification du compte utilisateur de $fullname effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/agent');
            } else {
                $this->get_msg("Erreur de modification du compte utilisateur");
                $this->session->set_flashdata('type', 'agent');
                $this->Update_form();
            }

        } else {
            //this->get_msg("Erreur de modification du compte utilisateur");
            $this->session->set_flashdata('type', 'agent');
            $this->Update_form();
        }
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
        $data['view'] = 'admin/classe/index';
        $this->load->view('admin/main', $data);
    }

    /**
     *@ Add an agent
     */
    public function add_classe()
    {
        # recuperation of username
        $this->form_validation->set_rules('classe_nom', 'classe_nom', 'required', array(
            'required' => 'Le nom de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('classe_cycle', 'classe_cycle', 'required', array(
            'required' => 'Le cycle de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('classe_effectif_eleves', 'classe_effectif_eleves', 'required', array(
            'required' => 'Effectif de la classe obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $classe_nom = trim(strtoupper($this->input->post('classe_nom')));
            $dep_existant = $this->Get_model->get_classe($classe_nom);
            $departdata = array(
                'nom_classe' => $dep_existant->nom_classe,
                'cycle' => $dep_existant->cycle,
                'effectif' => $dep_existant->effectif,
                'id_classe' => $dep_existant->id_classe
            );
            if (isset($departdata)) {
                if ($classe_nom != $dep_existant->nom_classe) {
                    $data = array(
                        'nom_classe' => $classe_nom,
                        'effectif' => $this->input->post('classe_effectif_eleves'),
                        'cycle' => $this->input->post('classe_cycle'),
                    );
                    // insert datas in database
                    $this->Insert_model->insert_data($data, 'tb_school_classes');
                    $this->get_msg("Enregistrement de la classe $classe_nom effectué avec succès", "success");
                    // redirection
                    return redirect(base_url() . 'admin/classe');
                } else {
                    $this->get_msg("Lea classe scolaire $classe_nom existe déjà. Vous ne pouvez pas l'enregistrer en nouveau.");
                    $this->session->set_flashdata('type', 'classe');
                    $this->Add_form();
                }
            }
        } else {
            $this->get_msg("Erreur d'ajout d'une nouvelle classe scolaire. Enregistrement non effectué");
            $this->session->set_flashdata('type', 'classe');
            $this->Add_form();
        }
    }

    /**
     *@ update classe
     */
    public function update_classe()
    {
        # recuperation of username
        $this->form_validation->set_rules('classe_nom', 'classe_nom', 'required', array(
            'required' => 'Le nom de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('classe_cycle', 'classe_cycle', 'required', array(
            'required' => 'Le cycle de la classe est obligatoire',
        ));

        $this->form_validation->set_rules('classe_effectif_eleves', 'classe_effectif_eleves', 'required', array(
            'required' => 'Effectif de la classe obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array

            $data = array(
                'nom_classe' => $this->input->post('classe_nom'),
                'effectif' => $this->input->post('classe_effectif_eleves'),
                'cycle' => $this->input->post('classe_cycle'),
            );
            // update
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_classes', $data, array('id_classe' => $id))) {
                $this->get_msg("Modification de la classe effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/classe');
            } else {
                $this->get_msg("Erreur de modification du compte utilisateur");
                $this->session->set_flashdata('type', 'classe');
                $this->Update_form();
            }
        } else {
            //$this->get_msg("Erreur de modification du département. Mise à jour non effectuée");
            $this->session->set_flashdata('type', 'classe');
            $this->Update_form();
        }
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
        $data['view'] = 'admin/section/index';
        $this->load->view('admin/main', $data);
    }

    /**
     *@ Add an agence
     */
    public function add_section()
    {
        #==============add new visa card type===================
        $this->form_validation->set_rules('nom_section', 'nom_section', 'required', array(
            'required' => 'Le nom de la section est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $nom_section = trim(strtoupper($this->input->post('nom_section')));
            $section_existant = $this->Get_model->get_section_existant($nom_section);
            $visadata = array(
                'nom_section' => $section_existant->nom_section
            );
            if (isset($visadata)) {
                if ($nom_section != $section_existant->nom_section) {
                    $data = array(
                        'nom_section' => $this->input->post('nom_section'),
                    );
                    // insert datas in database
                    $this->Insert_model->insert_data($data, 'tb_school_sections');
                    $this->get_msg("Enregistrement de la nouvelle section. Ajout effectué avec succès !", "success");
                    // redirection
                    return redirect(base_url() . 'admin/section');
                } else {
                    $this->get_msg("Cette section existe déjà. Désolé !");
                    $this->session->set_flashdata('type', 'section');
                    $this->Add_form();
                }
            }

        } else {
            $this->get_msg("Erreur d'ajout de la section. Enregistrement non effectué");
            $this->session->set_flashdata('type', 'section');
            $this->Add_form();
        }
    }

    /**
     * Edit Agence Form
     */

    public function update_section()
    {

        $this->form_validation->set_rules('nom_section', 'nom_section', 'required', array(
            'required' => 'Le nom de la section est obligatoire',
        ));
        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $data = array(
                'nom_section' => $this->input->post('nom_section'),
            );

            // insert datas in database
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_sections', $data, array('id_section' => $id))) {
                $this->get_msg("Modification de la section effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/section');
            } else {
                $this->get_msg("Erreur de modification de la section");
                $this->session->set_flashdata('type', 'section');
                $this->Update_form();
            }
        } else {
            //$this->get_msg("Erreur de modification type visa. Mise à jour non effectuée");
            $this->session->set_flashdata('type', 'section');
            $this->Update_form();
        }
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

        $data['view'] = 'admin/option/index';
        $this->load->view('admin/main', $data);
    }

    /**
     *@ Add an agence
     */
    public function add_option()
    {
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        #=====================add new option========================

        $this->form_validation->set_rules('nom_option', 'nom_option', 'required', array(
            'required' => 'Le nom option est obligatoire',
        ));
        $this->form_validation->set_rules('section_id', 'section_id', 'required', array(
            'required' => 'La section est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array
            $nom_option = trim(strtoupper($this->input->post('nom_option')));
            $option_existante = $this->Get_model->get_option_existant($nom_option);
            $optiondata = array(
                'nom_option' => $option_existante->nom_option
            );
            if (isset($optiondata)) {
                if ($nom_option != $option_existante->agence_nom) {
                    $data = array(
                        'nom_option' => $this->input->post('nom_option'),
                        'id_section' => $this->input->post('section_id'),
                    );
                    // insert datas in database
                    $this->Insert_model->insert_data($data, 'tb_school_options');
                    $this->get_msg("Ajout d'une nouvelle option effectuée avec succès", "success");
                    // redirection
                    return redirect(base_url() . 'admin/option');
                } else {
                    $this->get_msg("Désolé ! L'option $nom_option existe déjà");
                    $this->session->set_flashdata('type', 'option');
                    $this->Add_form();
                }
            }

        } else {
            //$this->get_msg("Erreur d'ajout de la nouvelle agence. Enregistrement non effectué");
            $this->session->set_flashdata('type', 'option');
            $this->Add_form();
        }
    }

    /**
     * Edit Agence Form
     */

    public function update_option()
    {
        $data['sections'] = $this->Get_model->get('tb_school_sections', 'nom_section')->result();
        #=====================add new option========================

        $this->form_validation->set_rules('nom_option', 'nom_option', 'required', array(
            'required' => 'Le nom option est obligatoire',
        ));
        $this->form_validation->set_rules('section_id', 'section_id', 'required', array(
            'required' => 'La section est obligatoire',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock datas in array

            $data = array(
                'nom_option' => $this->input->post('nom_option'),
                'id_section' => $this->input->post('section_id'),
            );

            // insert datas in database
            $id = $this->uri->segment(4);
            if ($this->Update_model->set_update('tb_school_options', $data, array('id_option' => $id))) {
                $this->get_msg("Modification option effectuée avec succès", "success");
                // redirection
                return redirect(base_url() . 'admin/option');
            } else {
                $this->get_msg("Erreur de modification de l'option indiquée");
                $this->session->set_flashdata('type', 'option');
                $this->Update_form();
            }
        } else {
            $this->get_msg("Erreur de modification. Mise à jour non effectuée de l'option indiquée");
            $this->session->set_flashdata('type', 'option');
            $this->Update_form();
        }
    }

    /**
     * Edit Agent Form
     */

    public function reset_agent_password()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        //algo cryptage
        $options = array(
            'cost' => 12,
        );
        $asset_password = password_hash("123456", PASSWORD_BCRYPT, $options);
        $data_user = compact('asset_password');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Réinitialisation effectuée du mot de passe utilisateur", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
            return $this->Dashboard();
        }
    }

    # bloquer agent - desactivation d'un compte utilisateur
    public function bloquer_agent()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        $status = 0;
        $data_user = compact('status');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Agent bloqué - compte utilisateur désactivé avec succès", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
            return $this->Dashboard();
        }
    }

    # débloquer agent - activation d'un compte utilisateur
    public function debloquer_agent()
    {
        //id user
        $id_user = $this->input->get('id_asset');
        $status = 1;
        $data_user = compact('status');
        if ($this->Passports_model->set_update('tb_school_assets', $data_user, array('id_asset' => $id_user))) {

            //redirect  with message notifie
            $this->get_msg("Agent débloqué - compte utilisateur activé avec succès", "success");
            return redirect(base_url() . 'admin/agent');
        } else {
            return $this->Dashboard();
        }
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
        #=================forms information======================
        $type = $this->uri->segment(3) ?? $this->session->type;
        $data['view'] = "admin/$type/add";
        $this->load->view('admin/main', $data);
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

        //Nouvelles fonctions sur school management
        $data['classe'] = $this->Get_model->get_onces($id, 'classe');
        $data['section'] = $this->Get_model->get_onces($id, 'section');
        $data['option'] = $this->Get_model->get_onces($id, 'option');

        $data['view'] = "admin/$type/update";
        $this->load->view('admin/main', $data);
    }

    # ========================logs users - journalisation des actions utilisateurs=============================
    public function log()
    {
        $data['logs'] = $this->Get_model->get('tb_school_logs', 'log_username')->result();
        $data['view'] = 'admin/log_user/index';
        $this->load->view('admin/main', $data);
    }

    public function log_archiver()
    {

        $data['logs'] = $this->Get_model->get('tb_school_logs', 'log_username')->result();
        $data['view'] = 'admin/log_user/archives';
        $this->load->view('admin/main', $data);
    }

    //suppression d'un journal
    public function archiver_log()
    {

        //id user
        $log_id = $this->input->get('log_id');
        $log_statut = 'offline';
        $data_log = compact('log_statut');
        if ($this->Passports_model->set_update('tb_school_logs', $data_log, array('log_id' => $log_id))) {

            //redirect  with message notifie
            $this->get_msg("Archivage du journal effectuée avec succès", "success");
            return redirect(base_url() . 'admin/log');
        } else {
            return $this->Dashboard();
        }
    }

    #====================================edition du profil utilisateur===============================charger vue profil
    public function vue_profil()
    {
        //$data['visiteurs'] = $this->Get_model->get('vue_details_visitors', 'date_signup')->result();
        $data['view'] = 'admin/vue_profil_utilisateur';
        $this->load->view('admin/main', $data);
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

        $anc_mot_pass_db = $this->Passports_model->get_unique('tb_pm_assets',
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
                    redirect('admin/dashboard');

                } else {
                    $this->get_msg("Impossible de mettre à jour votre mot de passe utilisateur !");
                    $data['view'] = 'admin/vue_profil_utilisateur';
                    $this->load->view('admin/main', $data);
                }
            } else {
                $error_anc_mot_pass = TRUE;
                $this->session->set_flashdata(compact('error_anc_mot_pass'));
                $this->get_msg("Impossible de mettre à jour les données car votre 
                mot de passe en cours est incorrect");
                $data['view'] = 'admin/vue_profil_utilisateur';
                $this->load->view('admin/main', $data);
            }
            //redirect('agent/vue_profil');
        } else {
            $this->get_msg("Mise à jour du mot de passe non effectuée en raison d'une erreur survenue 
            lors de la validation de données !");
            $data['view'] = 'admin/vue_profil_utilisateur';
            $this->load->view('admin/main', $data);
        }
    }

    #===================================deconnexon - fermeture de session===========================================
    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(base_url() . 'main/index');
    }
    #======================================================================================================
    #============================envoi des mails de creation des comptes==================================

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
            //return $redirect;
            //echo $e->errorMessage();
        }
    }
}
