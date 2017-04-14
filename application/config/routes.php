<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['webhook']['GET'] = "webhook/getInit";
$route['webhook']['POST'] = "webhook/postReciveMessage";
$route['dashboard'] = 'dashboard';
$route['users'] = "users";
$route['api'] = "api";