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

$route['default_controller'] = "home";
$route['404_override'] = 'home';
$rout['user/char_ranking/(:num)'] = 'user/char_ranking/$1';
$rout['user/guild_ranking/(:num)'] = 'user/guild_ranking/$1';
$route['admin/user/index/(:num)'] = 'admin/user/index/$2';
$route['admin/user/char_index/(:num)'] = 'admin/user/char_index/$2';
$route['admin/logs/(:num)'] = 'admin/logs/index/$2';
$route['admin/logs/vip_logs/(:num)'] = 'admin/logs/vip_logs/$2';
$route['admin/logs/cash_logs/(:num)'] = 'admin/logs/cash_logs/$2';
$route['admin/logs/user_logs/(:num)'] = 'admin/logs/user_logs/$2';
$route['download_menager/(:any)/(:any)'] = 'download_menager/index/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */