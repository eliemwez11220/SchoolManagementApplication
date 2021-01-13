<?php

/**
 * Created by PhpStorm.
 * User: Moi
 * Date: 27/09/2019
 * Time: 19:25
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require_once 'C:\composer\vendor\autoload.php';
class SendEmail extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        // verifie of login
        //$this->is_logged();

        // charge all models
        $this->load->model('Main_model');
        $this->load->model('Get_model');
        $this->load->model('Insert_model');
        $this->load->model('Update_model');
        $this->load->model('Passports_model');
    }
    public function send()
    {

        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom('mwez.rubuz@congoagile.net', 'School Management Application');

            $mail->addAddress('info@congoagile.net', 'IT Support');

            $mail->Subject = '';

            $mail->isHTML(true);

            $mail->Body = '<html><strong>Hi All, <br/></strong> This is an automatic 
<strong>School Management Application Report.</strong><p>The daily report have been generated, 
Please follow the link below for more details.</p><a href="https://schoolmanagement.congoagile.net/">School Management reporting</a></html>';

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
            $mail->send();

        } catch (Exception $e) {
            echo $e->errorMessage();
        }
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
            //return $redirect;
            //echo $e->errorMessage();
        }
    }
}
