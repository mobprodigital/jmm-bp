<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['users/dashboard/home']		= 'users/home';
$route['users/statistics/adcampstats'] 				= 'users/adcampstats';

$route['users/preferences/setting'] 		= 'users/setting';
$route['crossdomain.xml']					= 'users/crossdomain';

$route['admin/users/advertisement'] 	= 'users/advertisement';
$route['advertiser/logout'] 			= 'login/advertiserLogout';
$route['advertiser/login'] 				= 'login/advertiserLogin';


$route['advertiser/signup']					= 'login/advertiserSignup';
$route['advertiser/validate_credentials']	= 'login/validateUser';
$route['advertiser/(\d+)']					= 'advertiser/index';
$route['advertiser/(\d+)/viewadvertiser']	= 'advertiser/viewadvertiser';

$route['executive/login'] 					= 'login/executiveLogin';
$route['executive/logout'] 					= 'login/executiveLogout';
$route['executive/validate_credentials']	= 'login/validateUser';
$route['advertiser/advertiser-campaigns']	= 'executive/advertiserCampaigns';
$route['executive/campaign-banners']		= 'executive/campaignBanners';











$route['publisher/validate_credentials']	= 'login/validateUser';
$route['publisher/logout']					= 'login/publisherLogout';
$route['publisher/login']					= 'login/publisherLogin';
$route['publisher/signup']					= 'login/publisherSignup';






$route['publisher/']					= 'publisher/index';
$route['publisher/viewwebsite']		= 'publisher/viewwebsites';
$route['publisher/website']			= 'publisher/website';

$route['registration']				= 'login/registration';


$route['signup'] 				    = 'user/signupCommon';
$route['users/client-access']		= 'users/clientAccess';

$route['admin'] 				    = 'user/index';
$route['admin/login'] 				= 'user/index';
$route['admin/logout'] 				= 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';
$route['(:any)/dashboard']			='dashboard';
$route['admin/dashboard']			='dashboard';
$route['admin/users'] = 'users/index';
$route['admin/users/create'] = 'users/create';
$route['admin/users/edit/(:any)'] = 'users/edit/$1';
$route['admin/users/delete/(:any)'] = 'users/delete/$1';
$route['(:any)/settings/(:any)']='users/settings/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */