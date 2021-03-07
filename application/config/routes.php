<?php
/**
 * M_setup class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
/* power-admin */
$route['power-admin/master/contact'] = 'power-admin/contact';
$route['power-admin/dashboard'] = 'power-admin/home/dashboard';
$route['power-admin'] = 'power-admin/home';

/* services/v1/ */
$route['services/v1/settings/setup/([a-zA-Z0-9\-\_]+)'] = 'services_v1/settings_setup/$1';
$route['services/v1/settings/setup'] = 'services_v1/settings_setup';
$route['services/v1/settings/accounts/([a-zA-Z0-9\-\_]+)/([0-9]+)'] = 'services_v1/settings_accounts/$1/$2';
$route['services/v1/settings/accounts/([a-zA-Z0-9\-\_]+)'] = 'services_v1/settings_accounts/$1';
$route['services/v1/settings/accounts'] = 'services_v1/settings_accounts';
$route['services/v1/([a-zA-Z0-9\-\_]+)/(:any)/(:any)/(:any)/(:any)'] = 'services_v1/$1/$2/$3/$4/$5';
$route['services/v1/([a-zA-Z0-9\-\_]+)/(:any)/(:any)/(:any)'] = 'services_v1/$1/$2/$3/$4';
$route['services/v1/([a-zA-Z0-9\-\_]+)/(:any)/(:any)'] = 'services_v1/$1/$2/$3';
$route['services/v1/([a-zA-Z0-9\-\_]+)/(:any)'] = 'services_v1/$1/$2';
$route['services/v1/([a-zA-Z0-9\-\_]+)'] = 'services_v1/$1';

/* media */
$route['media/([a-zA-Z0-9\-\+]+)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'media/view/$1/$2/$3/$4/$5/$6/$7';
$route['media/([a-zA-Z0-9\-\+]+)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'media/view/$1/$2/$3/$4/$5/$6/';
$route['media/([a-zA-Z0-9\-\+]+)/(:any)/(:any)/(:any)/(:any)'] = 'media/view/$1/$2/$3/$4/$5/';
$route['media/([a-zA-Z0-9\-\+]+)/(:any)/(:any)/(:any)'] = 'media/view/$1/$2/$3/$4';
$route['media/([a-zA-Z0-9\-\+]+)/(:any)/(:any)'] = 'media/view/$1/$2/$3';
$route['media/([a-zA-Z0-9\-\+]+)/(:any)'] = 'media/view/$1/$2';

$route['about'] = 'main/about';
$route['token'] = 'main/token';

/* default */
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
