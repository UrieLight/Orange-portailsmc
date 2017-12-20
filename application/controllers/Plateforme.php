<?php 
	
	/**
	* Page de création de plates formes
	*/
	class Plateforme extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Administration -';

		function __construct(){
			
			parent::__construct();
			$this->load->model('Plateforme_Model', 'pltfrm_mod');
			$this->load->model('Administration_Model', 'admin_model');
			$this->load->model('Get_all_tables_Model', 'getall_model');
			/*$this->load->helper('form_helper');
			$this->load->helper('url_helper');*/
		}

		//affichage de la page de creation d'une plateforme
		public function new_plateforme(){
			
			$data['title'] = $this->title.' Nouvelle plate-formee';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['base_url'] = base_url();
			$data['administration_page_url'] = "Administration/admin_homepage";


			$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();

			$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

			$data['responsables'] = $this->admin_model->getall_responsables();

			$data['all_platesformes'] = $this->admin_model->getall_platesformes();

			$data['all_outils'] = $this->admin_model->getall_outils();

			/*$data['news'] = $this->News_model->get_news();
			// var_dump('contol_news: '.$data);*/

			$this->load_head_page($data);
			$this->load->view('vw-administration/vw-catalogue/administration-plateforme', $data);
			$this->load_foot_page($data);
		}

		//methode de creation d'une plateforme
		public function save_new_plateforme2(){
			
			/*$data['title'] = $this->title.' Nouvelle plate-formee';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();*/
			/*
			$new_platform_name = $this->input->post('platform_nom');
			$new_platform_outil_supervision = $this->input->post('outils_supervision_plateforme');
			$new_platform_constructor = $this->input->post('platform_constructeur');
			*/
				//transformation des id des outils en leur noms
				// $new_platform_outil_supervision = $this->outils_selected($new_platform_outil_supervision);

				/*$new_platform_chainsout_method = $this->input->post('chaine_sout_radiobtn');

				//test de la provenance du nom de la chaine de soutien
				//soit selectionnee, soit created
				if ($new_platform_chainsout_method == "nouvelle_chaine") {
					
					$new_platform_chainsout_name = $this->input->post('nom_chaine');//reception du nom de la chaine
					$new_platform_chainsout_id = $this->pltfrm_mod->get_chainsout_id($new_platform_chainsout_name);//retrieving of the id of the chain with that name

				}elseif ($new_platform_chainsout_method == "selection_chaine") {*/

			/*			
			$new_platform_chainsout_name = $this->input->post('select_chaine_sout');//reception du nom de la chaine//mais qui vient d'où?
			$new_platform_chainsout_id = $this->pltfrm_mod->get_chainsout_id($new_platform_chainsout_name);
			$new_platform_chainsout_id = intval($new_platform_chainsout_id[0]['chainesout_id']);

			echo 'id chaine de soutien de la plate-forme';
			var_dump($new_platform_chainsout_id);

			echo 'outils de supervision de la plate-forme';
			var_dump($new_platform_outil_supervision);
				// }

			$plateforme_data = array(
							'plateforme_nom' => $new_platform_name,
							'plateforme_outil_supervision' => $new_platform_outil_supervision,
							'plateforme_fournisseur' => $new_platform_constructor,
							'plateforme_chainesout_id' => $new_platform_chainsout_id
							);

			$this->pltfrm_mod->save_new_plateform($plateforme_data);

			*/	

				/*var_dump('Nom: '.$new_platform_name);
				var_dump('Localisation: '.$new_platform_outil_supervision);
				var_dump('Constructeur: '.$new_platform_constructor);
				echo "'Chaine de soutien: ";
				var_dump($new_platform_chainsout_id);*/

				// var_dump($new_platform_data[]);

				// $data['platesformes'] = $this->pltfrm_mod->getall_platesformes();
				/*$data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);*/

				/*$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/plateforme_successul_created', $data);
				$this->load_foot_page($data);*/
				// $this->new_plateforme();//pour recharger la page
		}

		//methode de creation d'une plateforme2
		public function save_new_plateforme(){

			$new_platform_name = $this->input->post('platform_nom');
			// $new_platform_outil_supervision = $this->input->post('outils_supervision_plateforme');
			$new_platform_desc = $this->input->post('platform_desc');
			$new_platform_adress = $this->input->post('platform_adresse');
			$new_platform_chainsout_id = $this->input->post('id_chaineselected');
			// echo 'avant: outils de supervision de la plate-forme';
			// var_dump($new_platform_desc);

			$liste_nom_outils = "";

			// $index = 1;//index pour ne pas mettre la virgule au debut de la liste
			/*foreach ($new_platform_outil_supervision as $outil) {
				# code...
				if ($index == 1) {
					# code...
					$liste_nom_outils .= $outil;
				}else
					$liste_nom_outils.= ", ".$outil;

				$index++;
			}*/

			// echo 'liste outils de supervision de la plate-forme';


			

				// $new_platform_chainsout_id = $this->input->post('id_chaineselected');
				
				/*echo 'id chaine de soutien de la plate-forme';
				var_dump($new_platform_chainsout_id);*/


			/*$plateforme_data = array(
							'plateforme_nom' => $new_platform_name,
							'plateforme_outil_supervision' => $liste_nom_outils,
							'plateforme_fournisseur' => $new_platform_constructor,
							'plateforme_chainesout_id' => $new_platform_chainsout_id
							);*/

			$plateforme_data = array(
							'plateforme_nom' => $new_platform_name,
							'plateforme_description' => $new_platform_desc,
							'plateforme_adress' => $new_platform_adress,
							'plateforme_chainesout_id' => $new_platform_chainsout_id
							);

			$this->pltfrm_mod->save_new_plateform($plateforme_data);
			// $this->new_plateforme();//pour recharger la page
		}


		//fonction de transformation des ids des outils en leurs noms, dans un array
		////mais j'avais pas besoin de ca par ce aue j'inserais les noms des plateformes dans la bd, et non leurs ids
		public function outils_selected($selected_outils_names){
			# code...
			$outils_id_array = array();//la requete vers la BD renvoie un tableau de tableaux d'objets qui contien les ids 

			foreach ($selected_outils_names as $outil_name) {
				// print_r($plateforme_name);
				array_push($outils_id_array, $this->admin_model->get_outils_id($outil_name)); 
			}

			// echo "<br>end";
			// json_encode($outils_id_array)
			// print_r($outils_id_array);//array

			//je simplifie le result returned par la BD, pour avoir un tableau n'ayant que les ids
			$outils_ids_array = array();
			foreach ($outils_id_array as $outil_id) {

				array_push($outils_ids_array, $outil_id[0]->outil_id);
			}

			return $outils_ids_array;
		}

		//plaeformes disyplaying
		public function platesformes_display(){

			$data['title'] = 'Plates-formes & Outils';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['administration_page_url'] = "Administration/admin_homepage";

			$data['nbr_platesformes'] = count($this->getall_model->getall_platesformes());

			// $data['services'] = $this->cat_model->getall_services_info();

			$data['responsables'] = $this->getall_model->getall_responsables();

			$data['groupes_sout'] = $this->getall_model->getall_groupsoutien();

			$data['chaines_sout'] = $this->getall_model->getall_chains_support();

			$data['chaines_esc'] = $this->getall_model->getall_chains_escalation();

			$data['platesformes'] = $this->getall_model->getall_platesformes();

			$data['outils'] = $this->getall_model->getall_outils();

			/*$data['service_plateformes'] = $this->getall_model->getall_service_plateformes();

			$data['service_outils'] = $this->getall_model->getall_service_outils();

			$data['all_architectures'] = $this->getall_model->getall_architectures();

			$data['all_services_architectures'] = $this->getall_model->getall_services_architectures();*/
			// var_dump($data);

			$this->load_head_page($data);
			$this->load->view('includings/catalogue/catalogue_style', $data);
			$this->load->view('plateformes', $data);
			$this->load->view('vw-templates/body_footer');
			// $this->load->view('includings/catalogue/catalogue_script', $data);
			$this->load->view('includings/platesformes/platesformes_script', $data);
			$this->load->view('vw-templates/page_foot');

		}

		//methode de recherche et d'affichage des plateformes recherched dans le catalogue des plateformes
		public function search_plateforme(){

			$name_of_the_platform = $this->input->post('platform_name_input');

			// var_dump($name);
			$name_of_the_platform = trim($name_of_the_platform);
			$this->pltfrm_mod->display_platforms_searched($name_of_the_platform, $this->root_path);
	    }



	    /*==========  									========== *\
						PLATFORM DATA UPDATING PAGES
		\*==========									========== */

			//Mise à jour d'une plate-forme, page de modification
			public function plateform_updating(){

				$data['title'] = $this->title.' Modifier une plate-forme';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";



				$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();

				$data['all_platesformes'] = $this->admin_model->getall_platesformes();

				$data['all_outils'] = $this->admin_model->getall_outils();

				// var_dump('contol_news: '.$data);
				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/updating/update_plateforme', $data);
				// $this->load_foot_page($data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-update_plateforme_script', $data);
				$this->load->view('vw-templates/page_foot');
				/*
				$this->load_head_page($data);
				$this->load->view('includings/administration/administration-update_service_style', $data);
				$this->load->view('vw-administration/vw-catalogue/updating/update_plateforme', $data);
				// $this->load_foot_page($data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-service_script', $data);
				$this->load->view('includings/administration/administration-update_service_script', $data);
				$this->load->view('vw-templates/page_foot');*/
			}


		/*==========  								========== *\
					 PLATFORM DATA UPDATES METHODS
		\*==========								========== */

			//enregistrement des modifications sur un groupe de soutien
		    public function update_plateforme(){

		    	// var_dump('@b\'s : 1/ )');
		    	$update_plateforme_id = $this->input->post('plateforme_selected_id');
		    	$update_platform_nom = $this->input->post('platform_nom');
		    	$update_platform_desc = $this->input->post('platform_desc');
		    	$update_platform_adresse = $this->input->post('platform_adresse');
		    	$update_id_chaineselected = $this->input->post('id_chaineselected');

		    	/*echo 'avant: outils de supervision de la plate-forme';
				var_dump($new_platform_outil_supervision);*/


				$liste_nom_outils = "";

				$index = 1;//index pour ne pas mettre la virgule au debut de la liste
				foreach ($update_outils_supervision_plateforme as $outil) {
					# code...
					if ($index == 1) {
						# code...
						$liste_nom_outils .= $outil;
					}else
						$liste_nom_outils.= ", ".$outil;

					$index++;
				}


				echo 'liste outils de supervision de la plate-forme';
				var_dump($liste_nom_outils);
				

				/*$new_platform_chainsout_id = $this->input->post('id_chaineselected');
				echo 'id chaine de soutien de la plate-forme';
				var_dump($new_platform_chainsout_id);*/
				

				$plateforme_data = array(
								'plateforme_nom' => $update_platform_nom,
								'plateforme_description' => $update_platform_desc,
								'plateforme_adress' => $update_platform_adresse,
								'plateforme_chainesout_id' => $update_id_chaineselected
								);


				$this->pltfrm_mod->model_update_plateform($update_plateforme_id, $plateforme_data);
		    }

		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/administration/administration-service_style', $data);
			$this->load->view('includings/administration/administration-plateforme_style', $data);
			$this->load->view('vw-templates/body_header');
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			$this->load->view('vw-templates/body_footer');
			$this->load->view('includings/administration/administration-plateforme_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
	}
?>