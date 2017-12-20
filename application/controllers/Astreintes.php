<?php 

	/**
	* Controlleur du module des astreintes
	*/
	class Astreintes extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Plannings des Astreintes';

		function __construct(){

			parent::__construct();
			$this->load->model('Astreintes_model', 'astrnt_model');
			// $this->load->helper('url_helper');
		}


		//affichage de la vue/page des plannings d'astreintes
		public function display_astreintes(){

			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

			$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
			/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
			$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
			$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
			// var_dump($data);

			/*$data['news'] = $this->News_model->get_news();
			// var_dump('contol_news: '.$data);*/
			// $date = date("l F jS Y");

			$this->load_head_page($data);
			$this->load->view('astreintes', $data);
			$this->load_foot_page($data);

		}




		/* ==================================================================================================== */		


		/*==========  								========== *\
							PLANNINGS TEMPORAIRES
		\*==========								========== */


			//affichage de la vue/page des plannings d'astreintes temporaires
			//TMC-Evt
			public function display_astreintes_temporaire_tmc_event(){

				$data['title'] = 'Planning automatique - TMC_EVT';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['service_table'] = 'tmc_event_table.php';
				$data['nom_service'] = 'TMC - EVT';
				/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
				// var_dump($data);

				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/
				// $date = date("l F jS Y");

				$this->load_head_page($data);
				$this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/astreintes_temporaire', $data);

				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/astreintes/astreintes_temporaire_script', $data);
				$this->load->view('vw-templates/page_foot');

			}

			//affichage de la vue/page des plannings d'astreintes temporaires
			//SASSBD
			public function display_astreintes_temporaire_sassbd(){

				$data['title'] = 'Planning automatique - SASSBD';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['service_table'] = 'sassbd_table.php';//fichier qui sera charged en include, pour inserer la table du service courant
				$data['nom_service'] = 'Sécurité, Administration système et Bases de données';
				/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
				// var_dump($data);

				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/
				// $date = date("l F jS Y");

				$this->load_head_page($data);
				$this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/astreintes_temporaire', $data);

				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/astreintes/astreintes_temporaire_script', $data);
				$this->load->view('vw-templates/page_foot');

			}

			//affichage de la vue/page des plannings d'astreintes temporaires
			//SMC MANAGEMENT
			public function display_astreintes_temporaire_smc_management(){

				$data['title'] = 'Planning automatique - SMC MANAGEMENT';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['service_table'] = 'smc_management_table.php';//fichier qui sera charged en include, pour inserer la table du service courant
				$data['nom_service'] = 'SMC MANAGEMENT';
				/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
				// var_dump($data);

				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/
				// $date = date("l F jS Y");

				$this->load_head_page($data);
				$this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/astreintes_temporaire', $data);

				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/astreintes/astreintes_temporaire_script', $data);
				$this->load->view('vw-templates/page_foot');

			}

			//affichage de la vue/page des plannings d'astreintes temporaires
			//SMC MAINTENANCE
			public function display_astreintes_temporaire_smc_maintenance(){

				$data['title'] = 'Planning automatique - SMC MAINTENANCE';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['service_table'] = 'smc_maintenance_table.php';//fichier qui sera charged en include, pour inserer la table du service courant
				$data['nom_service'] = 'SMC MAINTENANCE';
				/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
				// var_dump($data);

				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/
				// $date = date("l F jS Y");

				$this->load_head_page($data);
				$this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/astreintes_temporaire', $data);

				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/astreintes/astreintes_temporaire_script', $data);
				$this->load->view('vw-templates/page_foot');

			}

			//affichage de la vue/page des plannings d'astreintes temporaires
			//OSI BSS
			public function display_astreintes_temporaire_osi_bss(){

				$data['title'] = 'Planning automatique - OSI BSS';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration_astreintes/create_new_planning";

				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['service_table'] = 'osi_bss_table.php';//fichier qui sera charged en include, pour inserer la table du service courant
				$data['nom_service'] = 'OSI BSS';
				/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
				$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
				// var_dump($data);

				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/
				// $date = date("l F jS Y");

				$this->load_head_page($data);
				$this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/astreintes_temporaire', $data);

				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/astreintes/astreintes_temporaire_script', $data);
				$this->load->view('vw-templates/page_foot');

			}

		/* ==================================================================================================== */

		public function calc_week()	{
			# code...

			$date_picked = $this->input->post('js_picked_date');

			$date_int = strtotime($date_picked);
			// echo '$date_int: '.$date_int;

			$date_date = date($date_int);
			$weeknumber = date('W', $date_int);

			echo $weeknumber;
		}

		//function d'affichage au chargement de la page
		public function astreintes_du_jour(){
			
			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			//formatage des dates 
			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			//echo 'date sent to the server: '.$server_date.'/';


			//test de l'existence d'un planning en BD
			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			//s'il n'y a pas de planning, l'instruction renvoie "null"
			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$plannings = $this->astrnt_model->display_all_services_plannings($periode_id);

				echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}


		//function d'affichage du planning du service smc maintenance
		public function display_astreintes_smc_maintenance(){
			
			// echo "display_astreintes_smc_maintenance controller  <br> ";

			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			/*if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}*/

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			// echo 'maintenance__ date sent to the server: '.$server_date.'/';

			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$this->astrnt_model->display_smc_maintenance_planning($periode_id);

				// echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}


		//function d'affichage du planning du service management
		public function display_astreintes_smc_management(){
			
			// echo "display_astreintes_smc_management controller <br>";

			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			/*if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}*/

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			// echo 'management__ date sent to the server: '.$server_date.'/';

			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$this->astrnt_model->display_smc_management_planning($periode_id);

				// echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}


		//function d'affichage du planning du service tmc
		public function display_astreintes_tmc_evt(){
			
			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			//echo 'date sent to the server: '.$server_date.'/';

			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$this->astrnt_model->display_tmc_evt_planning($periode_id);

				// echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}


		//function d'affichage du planning du service ssassbd
		public function display_astreintes_sassbd(){
			
			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			//echo 'date sent to the server: '.$server_date.'/';

			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$this->astrnt_model->display_astreintes_sassbd_planning($periode_id);

				// echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}


		//function d'affichage du planning du service osi_bss
		public function display_astreintes_osi_bss(){
			
			$lundi_frm_client = $this->input->post('date_lundi');
			$month_frm_client = $this->input->post('month');
			$year_frm_client = $this->input->post('year');

			if ($lundi_frm_client<10) {

				$lundi_frm_client = '0'.$lundi_frm_client;
			}

			if ($month_frm_client<10) {

				$month_frm_client = '0'.$month_frm_client;
			}

			$server_date = $year_frm_client.'-'.$month_frm_client.'-'.$lundi_frm_client;
			//echo 'date sent to the server: '.$server_date.'/';

			$periode = $this->astrnt_model->get_corresponding_period($server_date);
			//print_r($periode);

			if ($periode == null) {
				
				echo 'Aucune astreinte programmée pour cette période.';
			}else{
				/*echo 'periode concerned: ';
				echo 'periode: '.$periode[0]->periode_id;*/
				$periode_id = $periode[0]->periode_id;
				$this->astrnt_model->display_osi_bss_plannings($periode_id);

				// echo $plannings;
			}
			//test de la date avec format du serveur 
			// $maintenance_rot = $this->
		}




		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/astreintes/astreintes_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/astreintes/astreintes_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}
?>