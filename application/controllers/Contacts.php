<?php 

	/**
	* Controlleur du catalogue des services
	*/
	class Contacts extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Contacts partenaires et supports';

		function __construct(){

			parent::__construct();
			$this->load->model('Get_all_tables_Model');
			$this->load->model('Contacts_Model');
			// $this->load->helper('url_helper');
		}

		//fonction d'affichage des donnes statiques
		/*
			public function view(){
			
			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;

			$this->load_head_page($data);
			$this->load->view('catalogue', $data);
			$this->load_foot_page($data);
			}
		*/

		//dynamiq data services disyplaying
		public function contacts_display(){

			$data['title'] = $this->title;
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";

			$data['nbr_contacts'] = count($this->Get_all_tables_Model->getall_groupsoutien());

			$data['responsables'] = $this->Get_all_tables_Model->getall_responsables();

			$data['groupes_sout'] = $this->Get_all_tables_Model->getall_groupsoutien();

			$data['chaines_esc'] = $this->Get_all_tables_Model->getall_chains_escalation();

			$this->load_head_page($data);
			$this->load->view('contacts', $data);
			// $this->load->view('includings/catalogue/catalogue_script', $data);
			$this->load_foot_page($data);

		}


		//methode de recherche et d'affichage des contacts recherched dans le catalogue des contacts
		public function search_contact(){

			$name_of_the_contact = $this->input->post('contact_name_input');

			// var_dump($name);
			$name_of_the_contact = trim($name_of_the_contact);
			$this->Contacts_Model->display_contacts_searched($name_of_the_contact, $this->root_path);
	    }

		//affichage de la chaine d'escalade associée
		/*public function escation_of_chainsout_level_selected(){
			$nom_responsable_niveau_sout = $this->input->post('nom_responsable_pour_affich_escalade');

			$this->contacts_model->get_this_chainsout_level_escalation_chain($nom_responsable_niveau_sout);
			
			// echo $nom_responsable_niveau_sout;
		}*/


		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/catalogue/catalogue_style', $data);
			$this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/contacts/contacts_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}

?>