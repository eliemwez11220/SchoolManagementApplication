<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['pdf'] = 'agent/pdf';
$route['404_override'] = 'Errors/error404';
$route['translate_uri_dashes'] = FALSE;


$route['success-flash'] = 'MyFlashController/success';
$route['error-flash'] = 'MyFlashController/error';
$route['warning-flash'] = 'MyFlashController/warning';
$route['info-flash'] = 'MyFlashController/info';
$route['edit-agence'] = 'Admin/editAgence';
