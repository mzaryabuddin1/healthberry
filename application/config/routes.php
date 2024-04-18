<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Appuser';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// AUTH
$route['login'] = "Authentication";
$route['login-submit'] = "Authentication/login_submit";
$route['logout'] = "Authentication/logout";
$route['forgot-password'] = "Authentication/forgot_password";
$route['forgot-password-submit'] = "Authentication/forgot_password_submit";

// DASHBOARD
$route['dashboard'] = "Dashboard";

// DOCTOR
$route['manage-doctor'] = "Doctor";

// USERS
$route['manage-users'] = "Users";

// APP USER
$route['login-app-user'] = "Appuser";
$route['app-login-submit'] = "Appuser/login_submit";
$route['app-logout'] = "Appuser/logout";
$route['app-dashboard'] = "Appuser/dashboard";