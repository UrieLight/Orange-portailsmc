<?php 

	/**
	* Controlleur du catalogue des services
	*/
	class Catalogue extends CI_Controller{
		
		// public $root_path = '../..';
		public $root_path = '../../..';
		public $title = 'Catalogue technique des services';
		public $services_family_caracter = 'none';

		function __construct(){

			parent::__construct();
			$this->load->model('Get_all_tables_Model', 'cat_model');
			$this->load->helper('form');
			//$this->load->helper('url_helper');
		}

		//fonction d'affichage des donnes statiques
		public function view(){
			
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;

			/*$data['news'] = $this->News_model->get_news();
			// var_dump('contol_news: '.$data);*/

			$this->load_head_page($data);
			$this->load->view('catalogue', $data);
			$this->load_foot_page($data);
		}

		/*
		//dynamiq data services disyplaying
		public function services_display(){

			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";

			$data['nbr_services'] = count($this->cat_model->getall_services_info());

			$data['services'] = $this->cat_model->getall_services_info();

			$data['responsables'] = $this->cat_model->getall_responsables();

			$data['groupes_sout'] = $this->cat_model->getall_groupsoutien();

			$data['chaines_sout'] = $this->cat_model->getall_chains_support();

			$data['chaines_esc'] = $this->cat_model->getall_chains_escalation();

			$data['platesformes'] = $this->cat_model->getall_platesformes();

			$data['outils'] = $this->cat_model->getall_outils();

			$data['service_plateformes'] = $this->cat_model->getall_service_plateformes();

			$data['service_outils'] = $this->cat_model->getall_service_outils();

			$data['all_architectures'] = $this->cat_model->getall_architectures();

			$data['all_services_architectures'] = $this->cat_model->getall_services_architectures();
			// var_dump($data);

			$this->load_head_page($data);
			$this->load->view('catalogue', $data);
			// $this->load->view('includings/catalogue/catalogue_script', $data);
			$this->load_foot_page($data);

		}*/

		public function services_family_get($clicked_family){


			//$clicked_family = $this->input->post('clicked_family');
			//echo "We've gota: ".$clicked_family.".";
			$this->services_family_caracter = $clicked_family;
			$this->services_display();
			// redirect($this->site_url().'/Catalogue/services_family_get', 'refresh');

		}

		//dynamiq data services with family parameter disyplaying
		public function services_display($service_family){

			/*echo 'site_url: ';
			var_dump('site_url'.site_url())*/;

			//$clicked_family = $this->input->post('clicked_family');
	
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";
			$data['service_family_caracter'] = $service_family;
			


			$data['nbr_services'] = count($this->cat_model->getall_services_info($service_family));
			
			$data['services'] = $this->cat_model->getall_services_info($service_family);

			$data['cat_service_family'] = $service_family;

			$data['responsables'] = $this->cat_model->getall_responsables();

			$data['groupes_sout'] = $this->cat_model->getall_groupsoutien();

			$data['chaines_sout'] = $this->cat_model->getall_chains_support();

			$data['chaines_esc'] = $this->cat_model->getall_chains_escalation();

			$data['platesformes'] = $this->cat_model->getall_platesformes();

			$data['outils'] = $this->cat_model->getall_outils();

			$data['service_plateformes'] = $this->cat_model->getall_service_plateformes();

			$data['service_outils'] = $this->cat_model->getall_service_outils();

			$data['all_architectures'] = $this->cat_model->getall_architectures('');

			$data['all_services_architectures'] = $this->cat_model->getall_services_architectures();
		
			//$a = 1+5;

			//$clicked_family = $this->input->post('clicked_family');
			//$data['service_family_caracter'] = $this->services_family_caracter;//$clicked_family;//
			//echo "We've got: ".$this->services_family_caracter." // ".$a;

			//var_dump($data['service_family_caracter']);//['service_family_caracter']);


			$this->load_service_view($data);

		}

		public function load_service_view($data){
			# code...
			//var_dump($data['service_family_caracter']);

			$this->load_head_page($data);
			$this->load->view('catalogue', $data);
			$this->load_foot_page($data);
		}


		//affichage de la chaine d'escalade associée
		public function escation_of_chainsout_level_selected(){
			$nom_responsable_niveau_sout = $this->input->post('nom_responsable_pour_affich_escalade');

			$this->cat_model->get_this_chainsout_level_escalation_chain($nom_responsable_niveau_sout);
			
			// echo $nom_responsable_niveau_sout;


		}

		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/catalogue/catalogue_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/catalogue/catalogue_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}

?>