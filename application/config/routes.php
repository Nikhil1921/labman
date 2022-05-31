<?php defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;

// front routes
$route["select-city"] = "home/select_city";
$route["getTests"] = "home/getTests";
$route["search"] = "home/search";
$route["callback"]['post'] = "home/callback";
$route["institutional"]['post'] = "home/institutional";
$route["upload-prescription"]['post'] = "home/prescription";
$route["contact"]['post'] = "home/contact";
$route["franchise"]['post'] = "home/franchise";
$route["package/(:num)"] = "home/package/$1";
$route["test/(:num)"] = "home/test/$1";
$route["tests/(:num)"] = "home/tests/$1";
$route["lab/(:num)"] = "home/lab/$1";
$route["add-to-cart"]['post'] = "home/add_to_cart";
$route["cart"] = "user/cart";
$route["logout"] = "user/logout";
$route["add-address"]['post'] = "user/add_address";
$route["add-member"]['post'] = "user/add_member";
$route["add-order"]['post'] = "user/add_order";
$route["thankyou"]['get'] = "user/thankyou";
$route["getTotal"]['get'] = "user/getTotal";
$route["clear-cart"]['post'] = "user/clear_cart";

$route["verify-otp"] = "login/verify_otp";
$route["register"] = "login/register";

// static pages
$route["about"] = "pages/about";
$route["how-to-work"] = "pages/how_to_work";
$route["packages"] = "pages/packages";
$route["labs"] = "pages/labs";
$route["career"] = "pages/career";
$route["faq"] = "pages/faq";
$route["gallery"] = "pages/gallery";
$route["contact"]['get'] = "pages/contact";
$route["corporate"] = "pages/corporate";
$route["institute"] = "pages/institute";
$route["franchise-inquiry"] = "pages/franchise_inquiry";
$route["lab-registration"]['get'] = "pages/lab_registration";
$route["lab-registration"]['post'] = "pages/lab_register";
$route["employee-registration"]['get'] = "pages/employee_registration";
$route["employee-registration"]['post'] = "pages/employee_register";
$route["terms-condition"] = "pages/terms_condition";
$route["refund"] = "pages/refund";

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