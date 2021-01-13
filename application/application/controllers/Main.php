<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once 'C:\composer\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Main extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        // charge all models
        $this->load->model('Main_model');
        $this->load->model('Get_model');
        $this->load->model('Insert_model');
        $this->load->model('Passports_model');
        //systeme de cryptage
        $this->_encrypt = "aazzbbyyccxxddwweevvffuu";
    }

    /**
     *@ Home function
     */
    public function index()
    {
        #verification de l'existance d'un compte administrateur pour la configuration du systeme
        $data['admin_exist'] = $this->Main_model->admin_existant();
        #redirection if admin or agent is logged
        if ($this->session->userdata('authentified_admin')) {
            // code...
            return redirect(base_url() . 'admin/dashboard');
        } elseif ($this->session->userdata('authentified_agent')) {
            // code...
            $user_session=$this->session->fullname ? $this->session->fullname : $this->session->username;
            return redirect(base_url() . $user_session.'/dashboard');
        }

        # charge of the home page
        $data['page'] = 'Home page';
        $this->load->view('main/login', $data);
    }

    #=======================function create admin account activing all systeme
    public function creer_compte_admin()
    {
        # recuperation of username
        $this->form_validation->set_rules('nom_complet', 'nom_complet', 'required', array(
            'required' => 'Le nom complet est obligatoire',
        ));
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => 'Le nom utilisateur est obligatoire',
        ));

        # recuperation of password
        $this->form_validation->set_rules('password', 'Paswword', 'min_length[5]|max_length[75]', 'required',
            array(
                'min_length' => 'Le champ %s doit contenir au moins cinq caractères',
                'max_length' => 'Le champ %s doit contenir au plus septante cinq caractères',
                'required' => 'Le champ %s est obligatoire',
            ));
        # confirmation mot de passe créé pour eviter la mauvaise saisie
        $this->form_validation->set_rules('password_confirmation', 'Password_confirmation', 'matches[password]',
            array(
                'matches' => 'Le champ %s doit correspondre avec le champ nouveau mot de passe'
            )
        );
        # verifie si les donnees du formulaire sont valides
        if ($this->form_validation->run()) {
            // recupere le username
            $asset_username = $this->input->post('username');
            //recupere le nom complet
            $asset_name = $this->input->post('nom_complet');
            $asset_email = $this->input->post('email');
            //le role
            $asset_type = 'administrator';
            //le statut
            $status = 1;
            //algorithme de cryptage du mot de passe
            $options = array(
                'cost' => 12,
            );
            //crypter mot de passe utilisateur
            $asset_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
            //compacter les données avant insertion dans la base
            // date creation et id_user sont auto
            $data_admin = compact('asset_name', 'asset_username', 'asset_password', 'asset_type', 'asset_email', 'status');
            //insertion de données dans la base puis teste de valdation
            if ($this->Insert_model->set_insert('tb_school_assets', $data_admin)) {
                //confirmation par message
                $this->get_msg("Le compte admin a ete creee avec succès!", 'success');
                //Connexion automatique
                $infos_admin = $this->Main_model->infos_admin($asset_username, $asset_password);

                // Creation du tableau de donnees de l'admin
                $userdata = array(
                    'id' => $infos_admin->id_asset,
                    'fullname' => $infos_admin->asset_name,
                    'username' => $infos_admin->asset_username,
                    'password' => $infos_admin->asset_password,
                    'email' => $infos_admin->asset_email,
                    'status' => $infos_admin->status,
                    'authentified_admin' => TRUE
                );
                // Stocker les infos admin dans la session
                $this->session->set_userdata($userdata);
                //message de bienvenue
                $name_admin = ucfirst($asset_name);
                $this->get_msg("$name_admin, Bienvenue sur votre espace d'administration de 
                School Management Application,
                         vous êtes connecté entant qu'administrateur système", 'success');
                // rediret admin
                return redirect(base_url() . 'admin/dashboard');

            } else {
                //si difficile de creer le compte admin
                $this->get_msg("Impossible de creer le compte administrateur");
                return redirect(base_url() . 'main/login');
            }
        } else {
            $this->get_msg('');
            return redirect(base_url() . 'main/login');
        }
    }

    /**
     * @Verifie datas coming from login form
     */
    public function Login()
    {
        $this->form_validation->set_rules('save_Password', 'save_Password'
        );
        # recuperation of username
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => 'Username is required',
        ));

        # recuperation of password
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => 'Password is required',
        ));
        # vérification de l'existance du compte administrateur

        $data['admin_exist'] = $this->Main_model->admin_existant();

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {

            $save_password = $this->input->post('save_Password');

            // stock username and password
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // var_dump($this->Main_model->infos_employ($username, $password)) or die();

            // checking datas in the database
            if ($this->Main_model->infos_admin($username, $password)) {
                // stock datas from database
                $infos_admin = $this->Main_model->infos_admin($username, $password);

                // stock datas in array
                $userdata = array(
                    'id' => $infos_admin->id_asset,
                    'fullname' => $infos_admin->asset_name,
                    'username' => $infos_admin->asset_username,
                    'password' => $infos_admin->asset_password,
                    'email' => $infos_admin->asset_email,
                    'status' => $infos_admin->status,
                    'authentified_admin' => TRUE
                );
                if ($infos_admin->status != 0) {
                    // stock datas in the session
                    $this->session->set_userdata($userdata);
                    //message de bienvenue
                    $name_admin = ucfirst($infos_admin->asset_username);
                    $this->get_msg("$name_admin, Bienvenue sur votre espace d'administration de 
                        School Management Application, vous êtes connecté entant qu'administrateur système", 'success');
                    // rediret admin
                    return redirect(base_url() . 'admin/dashboard');
                } else {
                    # Redirect to login page and show the message error
                    $data['page_error'] = "Session administrateur bloquée, Car elle est ouverte par un autre.";
                    $this->load->view('main/login', $data);
                }

            } elseif ($this->Main_model->infos_agent($username, $password)) {
                // stock datas from database
                $infos_agent = $this->Main_model->infos_agent($username, $password);
                //$pass_code_default = sha1($this->_encrypt . (123456));
                $pass_code_default = "123456";
                $options = array('cost' => 12);
                $default_password = password_hash("123456", PASSWORD_BCRYPT, $options);
                // stock datas in array
                if ($infos_agent) {
                    $userdata = array(
                        'id' => $infos_agent->id_asset,
                        'fullname' => $infos_agent->asset_name,
                        'username' => $infos_agent->asset_username,
                        'password' => $infos_agent->asset_password,
                        'status' => $infos_agent->status,
                        'email' => $infos_agent->asset_email,
                        'groupe' => $infos_agent->groupe,
                        'authentified_agent' => TRUE
                    );
                    //verification du statut de l'agent
                    if ($infos_agent->status != 0) {
                        //if (password_verify($pass_code_default, $infos_agent->asset_password)) {
                           // $_SESSION['users'] = $infos_agent->asset_username;
                           // $_SESSION['users_id'] = $infos_agent->id_asset;
                           // redirect('main/vue_profil');
                       // } else {
                            //login administratif
                            if ($infos_agent->groupe == "administratif") {
                                //Connexion  des administratifs
                                // stock datas in the session
                                $this->session->set_userdata($userdata);
                                //message de bienvenue
                                $username = strtoupper($infos_agent->asset_username);
                                $this->get_msg("$username, Bienvenue sur votre espace d'administration de 
                                            School Management Application, 
                                            vous êtes connecté entant qu'administratif", 'success');
                                // redirect administratif
                                return redirect(base_url() . 'administratif/dashboard');
                            //login financier
                            } elseif ($infos_agent->groupe == "financier") {
                                //Connexion  des administratifs
                                // stock datas in the session
                                $this->session->set_userdata($userdata);
                                //message de bienvenue
                                $username = strtoupper($infos_agent->asset_username);
                                $this->get_msg("$username, Bienvenue sur votre espace d'administration de 
                                            School Management Application, 
                                            vous êtes connecté entant qu'financier", 'success');
                                // redirect administratif
                                return redirect(base_url() . 'financier/dashboard');
                            }
                        //}
                    } else {
                        # Redirect to login page and show the message error
                        $data['page_error'] = "Votre compte utilisateur est déjà bloqué.
                     Veuillez conctacter l'administrateur système";
                        $this->load->view('main/login', $data);
                    }
                } else {
                    // redirect if username or password is not true
                    $data['page_error'] = "Compte utilisateur non existant dans le système.";
                    $this->load->view('main/login', $data);
                }
            } else {
                // redirect if username or password is not true
                $data['page_error'] = "Mot de passe ou nom utilisateur incorrect.";
                $this->load->view('main/login', $data);
            }
        } else {
            // redirect if username or password is not true
            $data['page_error'] = "Vous devez disposer un compte utilisateur pour accéder à cette application.
                         Veuillez conctacter l'administrateur système pour plus de détails.";
            $this->load->view('main/login', $data);
        }
    }

    # ===========================functions de changement du mot de passe par defaut===================================
    public function vue_profil()
    {
        //$data['view'] = 'session/vue_session_expire';
        $this->load->view('session/main');
    }

    //reset password
    public function reset_password()
    {
        //$data['view'] = 'session/vue_session_expire';
        $this->load->view('session/reset_password');
    }

    //reset password via email link

    public function password_reset()
    {
        //$data['view'] = 'session/vue_session_expire';
        $this->load->view('session/reset_password_link');
    }

    //reset password via email
    public function password_reset_via_email()
    {
        $asset_user_email = $this->input->post('email');
        $nvo_mot_pass = $this->input->post('nvo_mot_pass');
        $conf_mot_pass = $this->input->post('conf_mot_pass');

        $options = array(
            'cost' => 12,
        );
        if ($asset_user_email != "") {
            if ($nvo_mot_pass == $conf_mot_pass) {
                //$asset_password=$nvo_mot_pass;
                $asset_password = password_hash($nvo_mot_pass, PASSWORD_BCRYPT, $options);

                $data_ut = compact('asset_password');
                //mise à jour du mot de passe
                if ($this->Passports_model->set_update('tb_school_assets', $data_ut, array('asset_email' => $asset_user_email))) {

                    $this->get_msg("Veuillez vous connecter à nouveau.", 'success');
                    // rediret agent
                    return redirect(base_url() . 'main/login');

                } else {
                    $this->get_msg("Impossible de mettre à jour votre mot de passe utilisateur !");
                    $data['error_update'] = 'Impossible de mettre à jour votre mot de passe utilisateur !';
                    $this->load->view('main/login', $data);
                }
            } else {
                $this->get_msg("Le nouveau mot de passe utilisateur doit etre égal au mot de passe de confirmation!");
                $data['error_update'] = 'Le nouveau mot de passe utilisateur doit etre égal au mot de passe de confirmation';
                $this->load->view('main/login', $data);
            }
        } else {
            $this->get_msg("Erreur de connexion");
            $data['error_update'] = 'Adresse email incorrect';
            $this->load->view('main/login', $data);
        }
    }


    //reset password form
    public function reset_password_form()
    {
        $asset_user_email = $this->input->post('email');

        if ($asset_user_email != "") {

            //Recuperation des infos de connexion
            $user_data = $this->Main_model->info_by_email($asset_user_email);
            //$asset_password=$nvo_mot_pass;
            if ($user_data == false) {
                $this->get_msg("L'adresse email $asset_user_email est introuvable!");
                $data['error_update'] = 'L\'adresse email  est introuvable!';
                $this->load->view('session/reset_password', $data);
            } else {

                $time = rand(1000, 9999);
                $token = sha1(md5($time));

                $options = array(
                    'cost' => 12,
                );

                $new_token = password_hash($token, PASSWORD_BCRYPT, $options);

                $data = array(
                    'email' => $asset_user_email,
                    'token' => $new_token,
                );
                if ($this->Passports_model->set_insert('tb_school_reset_passsword', $data)) {

                    $link = base_url() . 'main/password_reset/' . $new_token;
                    $body = "Cliquez sur ce lien pour réinitialiser votre mot de passe: " . $link;
//                Email email
                    $this->sendEmail($asset_user_email, "Reinitialisation du mot de passe", $body);
                    $this->get_msg("Un email de réinitialisation a été envoyé à votre adresse email.", 'success');
                    $this->load->view('session/reset_password');
                }
            }

        }
    }

    //send issue recorded
    public function aide()
    {
//        $tb = mb_split("/",current_url());
//        $redirect = $tb[count($tb)-2]."/".$tb[count($tb)-1];

        $tb = mb_split("/", current_url());

        $redirect = "";
        for ($i = 8; $i < count($tb); $i++) {
            $redirect = $redirect . $tb[$i] . "/";
        }

        # recuperation of username
        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => 'Email is required',
        ));
//
        $this->form_validation->set_rules('name', 'name', 'required', array(
            'required' => 'Name is required',
        ));

//
        $this->form_validation->set_rules('subject', 'Subject', 'required', array(
            'required' => 'Subject is required',
        ));
//
        $this->form_validation->set_rules('issue', 'Issue', 'required', array(
            'required' => 'Issue is required',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {

            $asset_user_name = $this->input->post('name');

            $asset_user_email = $this->input->post('email');

            $asset_user_subject = $this->input->post('subject');

            $asset_user_issue = $this->input->post('issue');

            if ($asset_user_name != "" && $asset_user_email != "" && $asset_user_subject != "" && $asset_user_issue != "") {

                $data = array(
                    'name' => $asset_user_name,
                    'email' => $asset_user_email,
                    'subject' => $asset_user_subject,
                    'issue' => $asset_user_issue
                );

                if ($this->Passports_model->set_insert('tb_school_aide', $data)) {
                    //send Email to Admin
                    $this->sendIssueToAdmin($data);
                    $this->get_msg("Votre problème a été soumis avec succès", 'success');
                    // rediret agent
                    return redirect($redirect);

                }
            }
        }
    }

    //send issue to super Admin
    public function aide_super_admin()
    {
        $tb = mb_split("/", current_url());

        $redirect = "";
        for ($i = 8; $i < count($tb); $i++) {
            $redirect = $redirect . $tb[$i] . "/";
        }
        # recuperation of username
        $this->form_validation->set_rules('email', 'Email', 'required', array(
            'required' => 'Email is required',
        ));
//
        $this->form_validation->set_rules('name', 'name', 'required', array(
            'required' => 'Name is required',
        ));

//
        $this->form_validation->set_rules('subject', 'Subject', 'required', array(
            'required' => 'Subject is required',
        ));
//
        $this->form_validation->set_rules('issue', 'Issue', 'required', array(
            'required' => 'Issue is required',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {

            $asset_user_name = $this->input->post('name');

            $asset_user_email = $this->input->post('email');

            $asset_user_subject = $this->input->post('subject');

            $asset_user_issue = $this->input->post('issue');

            if ($asset_user_name != "" && $asset_user_email != "" && $asset_user_subject != "" && $asset_user_issue != "") {

                $data = array(
                    'name' => $asset_user_name,
                    'email' => $asset_user_email,
                    'subject' => $asset_user_subject,
                    'issue' => $asset_user_issue
                );

                if ($this->Passports_model->set_insert('tb_school_aide', $data)) {
                    //send Email to Admin
                    $this->sendIssueToSuperAdmin($data);
                    $this->get_msg("Votre problème a été soumis avec succès", 'success');
                    // rediret agent
                    return redirect(base_url() . $redirect);

                }
            }
        }

    }

    #changement du mot de passe et connexion automatique après changement
    public function changer_password_default()
    {
        $asset_user_id = trim(($this->input->post('username_id')));
        $asset_username = trim($this->input->post('username'));
        $nvo_mot_pass = trim($this->input->post('nvo_mot_pass'));
        $conf_mot_pass = trim($this->input->post('conf_mot_pass'));

        $options = array(
            'cost' => 12,
        );
        if ($asset_username != "") {
            if ($nvo_mot_pass == $conf_mot_pass) {


                //$asset_password=$nvo_mot_pass;
                $asset_password = password_hash($nvo_mot_pass, PASSWORD_BCRYPT, $options);

                $data_ut = compact('asset_password');
                //mise à jour du mot de passe
                if ($this->Passports_model->set_update('tb_school_assets', $data_ut, array('id_asset' => $asset_user_id))) {
                    //recuperation des infos de la session utilisateur du changement du mot de passe
                    $infos_agents = $this->Main_model->infos_agent($asset_username, $nvo_mot_pass);

                    // stock datas in array
                    $userdata_session = array(
                        'id' => $infos_agents->id_asset,
                        'fullname' => $infos_agents->asset_name,
                        'username' => $infos_agents->asset_username,
                        'status' => $infos_agents->status,
                        'email' => $infos_agents->asset_email,
                        'groupe' => $infos_agents->groupe,
                        'authentified_agent' => TRUE
                    );
                    //test du groupe auquel l'utilisateur appartient
                    if ($infos_agents->groupe == "administratif") {
                        //Connexion  des administratifs
                        // stock datas in the session
                        $this->session->set_userdata($userdata_session);
                        //message de bienvenue
                        $username = strtoupper($infos_agents->asset_username);
                        $this->get_msg("$username, Bienvenue sur votre espace d'administration de 
                                            School Management Application, 
                                            vous êtes connecté entant qu'administratif", 'success');
                        // redirect administratif
                        return redirect(base_url() . 'administratif/dashboard');

                    } elseif ($infos_agents->groupe == "financier") {
                        //Connexion  des financiers
                        // stock datas in the session
                        $this->session->set_userdata($userdata_session);
                        //message de bienvenue
                        $username = strtoupper($infos_agents->asset_username);
                        $this->get_msg("$username, Bienvenue sur votre espace d'administration de 
                                            School Management Application, 
                                            vous êtes connecté entant qu'financier", 'success');
                        // redirect administratif
                        return redirect(base_url() . 'financier/dashboard');
                    }

                } else {
                    $this->get_msg("Impossible de mettre à jour votre mot de passe utilisateur !");
                    $data['error_update'] = 'Impossible de mettre à jour votre mot de passe utilisateur !';
                    $this->load->view('session/main', $data);
                }
            } else {
                $this->get_msg("Le nouveau mot de passe utilisateur doit etre égal au mot de passe de confirmation!");
                $data['error_update'] = 'Le nouveau mot de passe utilisateur doit etre égal au mot de passe de confirmation';
                $this->load->view('session/main', $data);
            }
        } else {
            $this->get_msg("Mise à jour du mot de passe non effectuée en raison d'une erreur survenue lors de la validation de données !");
            $data['error_update'] = 'Nom utilisateur non trouvé';
            $this->load->view('session/main', $data);
        }
    }

    public function sendEmail($email, $subject, $body)
    {

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
            $mail->addAddress($from, 'IT Support');
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }

            $mail->addCC('info@congoagile.net', 'Webmaster IT Support');
            $mail->addCC("eliemwez.rubuz@gmail.com", "Elie Mwez Rubuz - CEO Congo Agile");
            $mail->Subject = $subject;

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Body = $body;
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

    //send issue to Local Administrateur
    public function sendIssueToAdmin($data)
    {
        if (is_array($data)) {

        }
        $from = $data['email'];
        $subject = $data['subject'];
        $name = $data['name'];
        $issue = $data['issue'];

        //get Admin email adsresses
        $admins = $this->Main_model->getAllAdmin();


        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom('mwez.rubuz@congoagile.net', 'School Management Application');
            $mail->addAddress($from, $name);

            foreach ($admins as $admin) {
                $mail->addCC($admin->asset_email, $admin->asset_username);
            }
            $mail->addCC('info@congoagile.net', 'Webmaster IT Support');
            $mail->addCC("eliemwez.rubuz@gmail.com", "Elie Mwez Rubuz - CEO Congo Agile");
            $mail->Subject = $subject;

            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Body = "Salut l'équipe,<br/> L'utilisateur " . $name . " a rencontré le problème décrit  ci-dessous:<br/>
<br/><strong>" . $issue . "</strong> <br/><br/> dans l'application School Management";

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
            //others options sending email to user
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

    //send Email to super Admin

    //send issue to Local Administrateur
    public function sendIssueToSuperAdmin($data)
    {
        if (is_array($data)) {

        }
        $from = $data['email'];
        $subject = $data['subject'];
        $name = $data['name'];
        $issue = $data['issue'];

        //get Admin email adsresses

        $mail = new PHPMailer(TRUE);
        try {

            $mail->setFrom('mwez.rubuz@congoagile.net', 'School Management Application');
            $mail->addAddress($from, $name);
            $mail->addCC('info@congoagile.net', 'Webmaster IT Support');
            $mail->addCC("eliemwez.rubuz@gmail.com", "Elie Mwez Rubuz - CEO Congo Agile");

            $mail->Subject = $subject;
            $mail->isHTML(true);

            $mail->CharSet = 'UTF-8';

            $mail->Body = "Salut l'équipe,<br/> L'administrateur " . $name . " a 
            rencontré le problème décrit  ci-dessous:<br/><br/>
            <strong>" . $issue . "</strong> <br/><br/> dans l'application School Management";

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
            //others options sending mail
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

    /**
     *# VISITOR FUNCTIONS
     */

    /**
     *@ Visiteurs function
     */
    public function eleves()
    {
        #redirection if admin or agent is logged
        if ($this->session->userdata('authentified_eleve')) {
            // code...
            return redirect(base_url() . 'eleve/index');
        }

        # charge of the home page
        $data['page'] = 'Home page eleves';
        $this->load->view('main/login_eleves', $data);
    }

    /**
     * @Verifie datas coming from login form
     */
    public function login_eleves()
    {
        # recuperation of passeport number
        $this->form_validation->set_rules('matricule', 'Matricule', 'required', array(
            'required' => 'Votre numéro matricule est requis',
        ));

        # verifie if datas are corrects and redirect
        if ($this->form_validation->run()) {
            // stock username and password
            $matricule = $this->input->post('matricule');

            // var_dump($this->Main_model->infos_employ($username, $password)) or die();

            // checking datas in the database
            if ($this->Main_model->infos_eleve($matricule)) {
                // stock datas from database
                $infos_eleve = $this->Main_model->infos_eleve($matricule);

                // stock datas in array
                $userdata = array(
                    'id_eleve' => $infos_eleve->id_eleve,
                    'matricule' => $infos_eleve->matricule_eleve,
                    'username' => $infos_eleve->nom_complet,
                    'email' => $infos_eleve->email,
                    'authentified_eleve' => TRUE
                );

                // var_dump($userdata) or die();

                // stock datas in the session
                $this->session->set_userdata($userdata);
                //message de bienvenue
                $this->get_msg("Bienvenue sur votre espace d'administration de 
                        School Management Application, vous êtes connecté entant qu'élève", 'success');
                // rediret admin
                return redirect(base_url() . 'eleve/index');
            } else {
                // redirect if username or password is not true
                $data['page_error'] = "Ce numéro matricule est incorrect, veuillez indiquer réessayer";
                $this->load->view('main/login_eleves', $data);
            }
        } else {
            // redirect if username or password is not true
            $data['page_error'] = "Vous devez disposer un compte utilisateur préalablement créé par un administrateur";
            $this->load->view('main/login_eleves', $data);
        }
    }
    #=========================================================================
    #                          deconnexion function
    #=============================================================================================
    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(base_url() . 'main/index');
    }
}
