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

// WEEKLY PLANS
$route['weekly-plan'] = "Doctor/weekly_plan";
$route['search-plan'] = "Doctor/search_plan";
$route['create-plan-submit'] = "Doctor/create_plan_submit";
$route['edit-plan-submit'] = "Doctor/edit_plan_submit";
$route['remove-plan-submit'] = "Doctor/remove_plan_submit";

// USERS
$route['manage-users'] = "Users";
$route['add-user'] = "Users/add";
$route['user-submit'] = "Users/user_submit";
$route['edit-user/(:any)'] = "Users/edit_user/$1";
$route['user-update'] = "Users/user_update";
$route['manage-app-users'] = "Users/app_users";
$route['edit-app-user/(:any)'] = "Users/edit_app_user/$1";
$route['add-app-user'] = "Users/add_app_user";
$route['app-user-submit'] = "Users/app_user_submit";

$route['edit-app-user-submit'] = "Users/edit_app_user_submit";


//locations
$route['manage-locations'] = "Locations";
$route['add-location'] = "Locations/add";
$route['location-submit'] = "Locations/location_submit";




//products
$route['manage-products'] = "Products";
$route['add-product'] = "Products/add";
$route['product-submit'] = "Products/product_submit";
$route['edit-products/(:any)'] = "Products/edit_product/$1";
$route['product-update'] = "Products/product_update";


//specialities
$route['manage-specialities'] = "Specialities";

// APP USER
$route['login-app-user'] = "Appuser";
$route['app-login-submit'] = "Appuser/login_submit";
$route['app-logout'] = "Appuser/logout";
$route['app-dashboard'] = "Appuser/dashboard";
$route['app-view-doctor-location'] = "Appuser/doctor_location";
$route['app-call-submit'] = "Appuser/call_submit";
$route['app-get-my-history'] = "Appuser/get_my_history";
$route['app-new-location-submit'] = "Appuser/new_location_submit";


// Reports

$route['report-doctors'] = "Report/doctors";
$route['report-get-doctors'] = "Report/get_doctors";
$route['report-calls'] = "Report/calls";
$route['report-calls-get'] = "Report/get_calls_report";
$route['dynamic-report'] = "Report/dynamic_report";
$route['dynamic-reports-get'] = "Report/get_dynamic_reports";
