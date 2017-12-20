<?php 

	/**
	* Controlleur du portail de l'info
	*/
	class Portail_info extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Portail de l\'info';

		function __construct(){
			
			parent::__construct();
			// $this->load->model('Astreintes_model', 'astrnt_model');
		}

		//affichage des informations en cours de traitement
		public function info_display(){

			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration_info/manage_info";

			// $data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
			/*$data['all_periode'] = $this->astrnt_model->getall_personnel();
			$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();
			$data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();*/
			// var_dump($data);

			/*$data['news'] = $this->News_model->get_news();
			// var_dump('contol_news: '.$data);*/
			// $date = date("l F jS Y");

			$this->load_head_page($data);
			$this->load->view('portail_info', $data);
			$this->load_foot_page($data);

		}




		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/portail_info/portail_info_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			// $this->load->view('includings/astreintes/astreintes_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}
?>