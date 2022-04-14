<?php defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;

// front routes
$route["callback"]['post'] = "home/callback";
$route["institutional"]['post'] = "home/institutional";
$route["upload-prescription"]['post'] = "home/prescription";

/* if ($this->uri->segment(1) !== $admin)
{
    $route['(:any)(/:any)?'] = 'home/shop/$1$2';
    $route['(:any)/(:any)/(:any)'] = 'home/product/$1/$2/$3';
} */

// admin routes
$route[ADMIN."/forgot-password"] = ADMIN."/login/forgot_password";
$route[ADMIN."/check-otp"] = ADMIN."/login/check_otp";
$route[ADMIN."/change-password"] = ADMIN."/login/change_password";
$route[ADMIN."/dashboard"] = ADMIN."/home";