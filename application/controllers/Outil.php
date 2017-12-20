<?php 

	/**
	* Controller de la vue de création d'un nouvel outil
	*/
	class Outil extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Administration - Nouvel Outil';

		function __construct(){
			
			parent::__construct();
			$this->load->model('Outil_model', 'outil_model');
		}


		//affichage de la page formulaire pour la création d'un nouvel outil
		public function new_outil_form(){
			
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/new_service_creation";
			
			$this->load_head_page($data);
			$this->load->view('vw-administration/vw-catalogue/administration-new_outil', $data);
			$this->load_foot_page($data);
		}


		//Création/sauvegarde d'un nouvel outil
		public function save_new_outil(){
			
			$new_outil_name = $this->input->post('outil_nom');
			$new_outil_desc = $this->input->post('outil_desc');

			$outil_data = array(
							'outil_nom' => $new_outil_name,
							'outil_desc' => $new_outil_desc
							);

			$this->outil_model->save_new_outil($outil_data);

			$this->new_outil_form();
		}


		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/administration/administration-service_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/administration/administration_outil_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}
?>