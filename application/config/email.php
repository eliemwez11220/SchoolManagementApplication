<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 05/01/2020
 * Time: 19:47
 */
//$this->load->library('email');
#==============Sending Email preferences=======================
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;

//$this->email->initialize($config);