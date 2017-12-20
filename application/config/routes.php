<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*

	$route['catalogue/services_display'] = 'catalogue/services_display';
	$route['catalogue/escation_of_chainsout_level_selected'] = 'catalogue/escation_of_chainsout_level_selected';

	$route['Administration/new_service_creation'] = 'Administration/new_service_creation';
	$route['Administration/search_responsable'] = 'Administration/search_responsable';
	$route['Administration/save_new_chainsout'] = 'Administration/save_new_chainsout';
	$route['Administration/refresh_chainsout_list'] = 'Administration/refresh_chainsout_list';

	$route['Administration/display_escalationchain'] = 'Administration/display_escalationchain';

	$route['Administration/nouvelle_chaine_soutien'] = 'Administration/nouvelle_chaine_soutien';
	$route['Administration/save_new_groupe_de_sout'] = 'Administration/save_new_groupe_de_sout';

	$route['Administration/administration-nouvelle_chaine_plateforme'] = 'Administration/new_chain_plateforme';
	$route['Administration/administration-plateforme'] = 'Plateforme/new_plateforme';
	$route['Administration/plateformes_selected'] = 'Administration/plateformes_selected';

	$route['Administration/refresh_plateformes_list'] = 'Administration/refresh_plateformes_list';

	$route['Administration/outils_selected'] = 'Administration/outils_selected';
	$route['Administration/refresh_outils_list'] = 'Administration/refresh_outils_list';

	$route['Plateforme/save_new_plateforme'] = 'Plateforme/save_new_plateforme';

	$route['Administration/recuperation_model_json_architecture'] = 'Administration/recuperation_model_json_architecture';
	$route['Administration/create_new_architecture'] = 'Administration/create_new_architecture';
	$route['Administration/save_new_architecture'] = 'Administration/save_new_architecture';
*/

/*
| -------------------------------------------------------------------------
| Astreintes ROUTING
| -------------------------------------------------------------------------
*/

/*
	$route['Astreintes/display_astreintes'] = 'Astreintes/display_astreintes';
	$route['Astreintes/astreintes_du_jour'] = 'Astreintes/astreintes_du_jour';
	$route['Astreintes/display_astreintes_smc_maintenance'] = 'Astreintes/display_astreintes_smc_maintenance';
	$route['Astreintes/display_astreintes_smc_management'] = 'Astreintes/display_astreintes_smc_management';
	$route['Astreintes/display_astreintes_tmc_evt'] = 'Astreintes/display_astreintes_tmc_evt';
	$route['Astreintes/display_astreintes_sassbd'] = 'Astreintes/display_astreintes_sassbd';
	$route['Astreintes/display_astreintes_osi_bss'] = 'Astreintes/display_astreintes_osi_bss';

	$route['Administration_astreintes/create_new_planning'] = 'Administration_astreintes/create_new_planning';
*/

	/*$route['(:any)'] = 'catalogue/services_display';
	$route['(:any)/portail_smc2'] = 'Services/services_homepage';
	$route['default_controller'] = 'catalogue/services_display';*/


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
$route['default_controller'] = 'Welcome/authentify';
$route['catalogue/services_display/(:any)'] = 'catalogue/services_display';
/*$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/
