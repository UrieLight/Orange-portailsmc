<?php 

	/**
	* Controller de la page 
	* d'administration des astreintes
	*/
	class Administration_astreintes extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Administration - Plannings des Astreintes';

		function __construct(){
			
			parent::__construct();
			$this->load->model('Administration_astreintes_Model', 'admin_astrnt_model');
		}

		public function create_new_planning(){
			
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration_astreintes/create_new_planning";
			
			// $data['all_personnel_astreintes'] = $this->astrnt_model->getall_personnel();jfioi


			$this->load_head_page($data);
			$this->load->view('vw-administration/vw-astreintes/administration_astreintes', $data);
			$this->load_foot_page($data);
		}




		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/astreintes/astreintes_style', $data);
			$this->load->view('includings/astreintes/administration_astreintes_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/astreintes/admin_astreintes_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}

?>