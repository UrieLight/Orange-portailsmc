<?php 
	// session_start();

	/**
	* Controlleur de la page d'accueil 
	* des services
	*/
	class Services extends CI_Controller{
		
		public $root_path = '../..';
		public $title = '';

		function __construct(){
			
			parent::__construct();
			$this->load->model('Administration_Model', 'admin_model');
		}

		//Services homepage
		public function services_homepage() {

			//recup nom user connected to put in the session variables
			// $_SESSION['sess_var_user_name'] = $this->input->post('user_name');
			// $data['sess_var_user_name']

			//setting up the page
			$data['title'] = 'Services - Accueil';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['base_url'] = base_url();
			$data['administration_page_url'] = "Administration/admin_homepage";


			$this->load_head_page($data);
			$this->load->view('includings/catalogue/service_homepage_style', $data);
			$this->load->view('vw-pages/services_homepage', $data);
			$this->load->view('vw-templates/body_footer');
			// $this->load->view('includings/administration/administration-update_service_scrip', $data);//699810913 melanie
			$this->load->view('vw-templates/page_foot');
		}

		//Services Familles
		public function services_family_page() {

			//recup nom user connected to put in the session variables
			// $_SESSION['sess_var_user_name'] = $this->input->post('user_name');
			// $data['sess_var_user_name']

			//setting up the page
			$data['title'] = 'Services - Familles';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['base_url'] = base_url();
			$data['administration_page_url'] = "Administration/admin_homepage";


			$this->load_head_page($data);
			$this->load->view('includings/catalogue/service_homepage_style', $data);
			$this->load->view('vw-pages/services_family_page', $data);
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/catalogue/services_family_page_script', $data);//699810913 melanie
			$this->load->view('vw-templates/page_foot');
		}

		/* ==================================================================================================== */





		/*==========  								========== *\
								FILES COMON DATA 
		\*==========								========== */

		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			// $this->load->view('includings/administration/administration_home_page_style', $data);
			$this->load->view('includings/administration/administration-service_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			// $this->load->view('includings/administration/administration-service_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}

 ?>