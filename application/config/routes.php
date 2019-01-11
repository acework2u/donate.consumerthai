<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'donate';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/****** lang **/



/*** Backend Dashboard ***/
$route['admin'] = "backend/Dashboard/index";
$route['admin/dashboard'] = "backend/Dashboard/Dashboard";
$route['admin/reports'] = "backend/Reports/index";

/**** Report **/
$route['api-01/report/donation-list'] = "backend/Reports/jsonDonationList";
$route['admin/reports/get-invoice/(:num)'] = "backend/Reports/genInvoice/$1";
$route['admin/reports/exportxls'] = "backend/Reports/exportxls";
$route['admin/reports/update-donation'] = "backend/Reports/updateDonationStatus";



/***User Profile****/
$route['signup'] = 'auth/register';
$route['signin'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dologin'] = 'auth/doLogin';
$route['profile'] = 'auth/index';
$route['userlist'] = 'auth/userList';
$route['user-list'] = 'auth/users_list';

/**** User ****/
$route['api-v01/user/user-list'] = "auth/get_user_list";
$route['api-v01/user/group-list'] = "auth/get_group_list";
$route['api-v01/user/ma'] = "auth/actionUser";
$route['api-v01/user/logon'] = "auth/jsonLogin";
$route['api-v01/user/register'] = "auth/actionUserCreate";

/**API***/
$route['api-v01/banklist'] = "api/jsonBankList";
$route['api-v01/payment-status-code'] = "api/jsonPaymentStatusCode";


/**** Font ***/
$route['result'] = "frontend/result/index";
$route['demo-donate'] = "donate/demoDonate";
$route['donation/2c2p-payment'] = "donate/paymentBy2c2p";
$route['thank-you-for-your-donation'] = "donate/donateSuccess";

$route['api-v01/confirm-data'] = "donate/confirmData2c2p";

