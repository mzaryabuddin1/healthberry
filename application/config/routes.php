<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// AUTH
$route['login'] = "Authentication";
$route['forgot-password'] = "Authentication/forgot_password";
$route['forgot-password-submit'] = "Authentication/forgot_password_submit";
