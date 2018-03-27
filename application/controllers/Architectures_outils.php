<?php 


	/*
	* Controlleur des architectures des outils
	*/

	class Architectures_outils extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Architectures des outils';

		function __construct(){

			parent::__construct();
			$this->load->model('Architectures_model', 'arch_model');
			$this->load->model('Get_all_tables_Model', 'gat_model');
			$this->load->helper('url_helper');
		}



		//fonction d'affichage des données statiques // past utilisé, je crois
		public function view(){
			
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;

			/*$data['news'] = $this->News_model->get_news();
			// var_dump('contol_news: '.$data);*/

			$this->load_head_page($data);
			$this->load->view('architectures_outils', $data);
			$this->load_foot_page($data);
		}



		//page de création d'une nouvelle architecture
		public function create_new_architecture(){
			
			$data['title'] = 'Administration - Nouvelle architecture';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['base_url'] = base_url();
			$data['administration_page_url'] = "Administration/admin_homepage";
			
			$data['all_architectures'] = $this->arch_model->getall_architectures();
			
			$this->load_head_page($data);
			$this->load->view('vw-administration/vw-catalogue/administration-new_architecture', $data);
			// $this->load_foot_page($data);
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/administration/administration-service_script', $data);
			$this->load->view('includings/administration/administration_service_architecture_script');
			$this->load->view('vw-templates/page_foot');
		}



		//dynamiq data services disyplaying
		public function display(){//architectures_display

			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";

			$data['nbr_architectures'] = count($this->gat_model->getall_architectures('outil'));

			// $data['all_architectures'] = $this->arch_model->getall_architectures();
			$data['all_architectures'] = $this->gat_model->getall_architectures('outil');


			$this->load_head_page($data);
			$this->load->view('architectures_outils', $data);
			// $this->load->view('includings/catalogue/catalogue_script', $data);
			$this->load_foot_page($data);

		}



		//methode de recherche et d'affichage des arhitectures recherched dans le catalogue des architectures
		public function search_architecture(){

			$name_of_the_architecture = $this->input->post('architecture_name_input');

			// var_dump($name);
			$name_of_the_architecture = trim($name_of_the_architecture);
			// $data['services'] = $this->admin_model->autocomplete_nom_service($name_of_the_architecture);
			$this->arch_model->display_services_searched($name_of_the_architecture, $this->root_path);
			
	    }

		//dynamiq architecture update disyplaying
		public function architectures_update_display(){

			$data['title'] = 'Administration - Mise à jour Architecture';//$this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";

			// $data['nbr_architectures'] = count($this->gat_model->getall_architectures());

			$data['all_architectures'] = $this->arch_model->getall_architectures();
			// $data['json_file'] = $this->arch_model->getall_architectures();


			$this->load_head_page($data);
			$this->load->view('vw-administration/vw-catalogue/updating/administration-update_architecture', $data);
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/administration/administration-update_architecture_script', $data);
			$this->load->view('vw-templates/page_foot');
			// $this->load_foot_page($data);

		}


		//dynamiq architecture update saving
		public function architectures_update_saving(){

			// $this->load_foot_page($data);

			$updated_model_json_arch = $this->input->post('updated_model_json');
			$updated_architecture_id = $this->input->post('updated_architecture_id');
			$updated_architecture_name = $this->input->post('updated_architecture_name');
			$updated_architecture_desc = $this->input->post('updated_architecture_desc');
			// $updated_architecture_jsonfile = $this->input->post('updated_architecture_jsonfile');
			$architecture_update_date = $this->input->post('architecture_update_date');
			$updated_architecture_author = $this->input->post('updated_architecture_author');

			// echo "nom arch: ".$architecture_name." \ndesc_arc: ".$architecture_desc;
			$updated_architecture_file_name = implode('_', explode(' ', trim(strtolower($updated_architecture_name))));//
			
			//var_dump('architecture_update_date Controlleur');
		    //var_dump($architecture_update_date);//*/

			$file_path = '/wamp/www/portail_smc2/architectures_JSON_files/'.$updated_architecture_file_name.'.json';  
			//var_dump('file_name controller');
		    //var_dump($updated_architecture_name);
			// echo "\n";

			$file = fopen($file_path, "w+");
			fwrite($file, $updated_model_json_arch);
			fclose($file);

			$this->arch_model->save_architecture_update($updated_architecture_id, $updated_architecture_name, $updated_architecture_desc, $architecture_update_date, $updated_architecture_author, $updated_architecture_file_name.'.json');//storing the filename(architecture_name) with extension

			// $architecture_id = $architecture_id[0]->architectur_id;

			// echo $architecture_id;
		}


		//affichage de la chaine d'escalade associée
		public function escation_of_chainsout_level_selected(){
			$nom_responsable_niveau_sout = $this->input->post('nom_responsable_pour_affich_escalade');

			$this->arch_model->get_this_chainsout_level_escalation_chain($nom_responsable_niveau_sout);
			
			// echo $nom_responsable_niveau_sout;


		}

		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/architectures/architectures_style', $data);
			$this->load->view('includings/administration/administration-service_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/architectures/architectures_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}
?>