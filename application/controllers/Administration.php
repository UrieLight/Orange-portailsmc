<?php 

	/**
	* Page d'administration
	*/
	class Administration extends CI_Controller{
		
		public $root_path = '../..';
		public $title = 'Administration -';
		public $architecture_id = 0;


		function __construct(){
			
			parent::__construct();
			$this->load->model('Administration_Model', 'admin_model');
			$this->load->model('Architectures_model', 'arch_model');
			$this->load->helper('url_helper');
			$this->load->helper('form_helper');
		}


		//administration homepage
		public function admin_homepage(){

			$data['title'] = $this->title.'Administration';
			$data['root_path'] = $this->root_path;
			$data['site_url'] = site_url();
			$data['base_url'] = base_url();
			$data['administration_page_url'] = "Administration/admin_homepage";


			// $this->load_head_page($data);

			$this->load->view('vw-templates/page_head', $data);
			// $this->load->view('includings/administration/administration-update_service_style', $data);
			$this->load->view('includings/administration/administration-service_style', $data);
			$this->load->view('includings/administration/administration_home_page_style', $data);
			$this->load->view('vw-templates/body_header', $data);
			
			$this->load->view('vw-administration/administration_home_page', $data);
			$this->load->view('vw-templates/body_footer');
			// $this->load->view('includings/administration/administration-update_service_scrip', $data);//699810913 melanie
			$this->load->view('vw-templates/page_foot');
		}



		/*==========  								========== *\
							DATA CREATING PAGES
		\*==========								========== */


			//Affichage de la page de creation d'un nouveau service
			public function new_service_creation(){

				$data['title'] = $this->title.' Nouveau service';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";


				$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();
				// var_dump($data['all_chaines_soutien'][0]->chainesout_id);

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();

				$data['all_platesformes'] = $this->admin_model->getall_platesformes();

				$data['all_outils'] = $this->admin_model->getall_outils();

				$data['all_architectures'] = $this->admin_model->getall_architectures();
				// var_dump('contol_news: '.$data);

				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/administration-new_service', $data);
				// $this->load_foot_page($data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-service_script', $data);
				// $this->load->view('includings/administration/administration_service_architecture_script');
				$this->load->view('vw-templates/page_foot');
			}


		    //methode de recuperation des noms des services pour l'autocompletion
		    /*public function search_service(){

				$name_of_the_service = $this->input->post('nom_service');
				// var_dump($name);
				$output = '<ul class="ul_service_list list-unstyled">';

				$data['services'] = $this->admin_model->autocomplete_nom_service($name_of_the_service);

				// var_dump($data['services']);

				//if nombre de result 
				if(count($data['services']) > 0){

					foreach ($data['services'] as $service) {
						
						$output .= '<li id="'.$service->service_id.'">'.$service->service_nom.'</li>';
					}
		        	
				}else
					$output .= '<li></li>';

				// $output ;

				echo $output.= '</u>';
		    }*/

		    //page de création d'une nouvelle architecture
			public function create_new_architecture(){
				
				$data['title'] = $this->title.' Nouvelle architecture';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				$data['all_architectures'] = $this->arch_model->getall_architectures();
				
				//$data['all_architectures'] = $this->admin_model->getall_architectures();
				
				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/administration-new_architecture', $data);
				// $this->load_foot_page($data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-service_script', $data);
				$this->load->view('includings/administration/administration_service_architecture_script');
				$this->load->view('vw-templates/page_foot');
			}



			//====== RESPONSABLES ESCALADES MANAGEMENT ====== 
			//page de création d'un nouveau responsable
			public function create_new_groupe_de_soutien(){
				
				$data['title'] = $this->title.' Nouveau responsable';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();
				
				//$data['all_architectures'] = $this->admin_model->getall_architectures();
				
				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/administration-new_responsable', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-responsable_script', $data);
				$this->load->view('vw-templates/page_foot');
			}



			//creation d'une nouvelle chaine de soutien, par consequent, sa chaine d'escalade
			public function nouvelle_chaine_soutien(){

				$data['title'] = $this->title.' Nouvelle chaine de soutien';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();


				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/nouvelle_chaine_soutien', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/Nouvelle_chaine_script', $data);
				$this->load->view('vw-templates/page_foot');
			}


			//Affichage de la page de creation d'une famille des services
			public function family_services(){

				$data['title'] = $this->title.' Famille de services';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				
				$data['all_services'] = $this->admin_model->getall_services();
				$data['all_families_services'] = $this->admin_model->getall_families_services();


				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/administration_family_services', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-famille_services_script', $data);
				$this->load->view('vw-templates/page_foot');
			}

		/* ==================================================================================================== */





		/*==========  								========== *\
							DATA SEARCHING
		\*==========								========== */



			//methode de recherche et d'affichage des services recherched dans le catalogue
			public function search_service(){

				$name_of_the_service = $this->input->post('service_name_input');

				// var_dump($name);
				$name_of_the_service = trim($name_of_the_service);
				// $data['services'] = $this->admin_model->autocomplete_nom_service($name_of_the_service);
				$this->admin_model->display_services_searched($name_of_the_service, $this->root_path);

				/*// var_dump($data['services']);

				//if nombre de result 
				if(count($data['services']) > 0){

					foreach ($data['services'] as $service) {
						
						$output .= '<li id="'.$service->service_id.'">'.$service->service_nom.'</li>';
					}
		        	
				}else
					$output .= '<li></li>';

				// $output ;

				echo $output.= '</u>';*/
		    }

			//methode de recuperation des noms des responsables pour l'autocompletion
			public function search_responsable(){

				$name = $this->input->post('nom_responsable');
				// var_dump($name);
				$output = '<ul class="list-unstyled">';

				$data['responsables'] = $this->admin_model->autocomplete($name);

				//if nombre de result 
				if(count($data['responsables']) > 0){

					foreach ($data['responsables'] as $responsable) {
						
						$output .= '<li id="'.$responsable->responsable_id.'">'.$responsable->responsable_nomprenom.'</li>';
					}
		        	
				}else
					$output .= '<li></li>';

				// $output ;

				echo $output.= '</u>';
		    }

			//methode de recuperation des noms des responsables pour l'autocompletion
			public function search_group_de_soutien(){

				$name = $this->input->post('nom_groupesout');
				// var_dump($name);
				$output = '<ul class="list-unstyled">';

				$data['groupes_sout'] = $this->admin_model->autocomplete_nom_groupe($name);

				//if nombre de result non null
				if(count($data['groupes_sout']) > 0){

					foreach ($data['groupes_sout'] as $groupe_sout) {
						
						$output .= '<li id="'.$groupe_sout->groupe_de_soutien_id.'">'.$groupe_sout->groupe_de_soutien_nom.'</li>';
					}
		        	
				}else
					$output .= '<li></li>';

				// $output ;

				echo $output.= '</u>';
		    }

		    //method of retrieving the id of the last created group
		    public function controller_last_created_group_id()		    {
		    	# code...
		    	$last_group_id = $this->admin_model->model_last_created_group_id();
		    	echo $last_group_id;
		    }

	    /* ==================================================================================================== */




	    /*==========  								========== *\
					ELSE (TRANSFORMING. DISPLAYING)
		\*==========								========== */

		    //affichage de la chaine de soutien selected
		    public function display_selected_chainsout(){

		    	$chainesc_chainesout_id = $this->input->post('id_chaineselected');
		    	$this->admin_model->display_correspondant_chainsout($chainesc_chainesout_id);
		    	// print_r($chainesc_chainesout_id);	    	
		    }


		    //affichage de la chaine d'escalade du groupe de soutien selected
		    public function display_selected_groupesout_chainesc(){

		    	$chainesc_groupsout_id = $this->input->post('id_groupe_selected');
		    	$this->admin_model->display_correspondant_groupesout_chainesc($chainesc_groupsout_id);
		    	// print_r($chainesc_chainesout_id);	    	
		    }


		    //affichage de la chaine de soutien selected
		    public function display_desc_selected_chainsout(){

		    	$chainesout_id = $this->input->post('id_chaineselected');
		    	$this->admin_model->display_correspondant_chainsout_desc($chainesout_id);
		    	// print_r($chainesc_chainesout_id);	    	
		    }


		    //affichage de la chaine d'escalade associated to the support chain selected
		    public function display_escalationchain(){

		    	$chainesc_chainesout_id = $this->input->post('id_chaineselected');
		    	$this->admin_model->display_correspondant_escalation_chain($chainesc_chainesout_id);
		    	// print_r($chainesc_chainesout_id);	    	
		    }


			//plates-formes selected
			public function plateformes_selected($selected_plateforms_names){
				/*$selected_plateforms_names = $this->input->post('plateformes_selected');
				var_dump($selected_plateforms_names);*/
				$pltforme_id_array = array();

				foreach ($selected_plateforms_names as $plateforme_name) {
					// print_r($plateforme_name);
					array_push($pltforme_id_array, $this->admin_model->get_plateformes_id($plateforme_name)); 
				}

				// echo "<br>end";
				// json_encode($pltforme_id_array)
				// print_r($pltforme_id_array);//array

				$plateforme_ids_array = array();
				foreach ($pltforme_id_array as $pltforme_id) {

					array_push($plateforme_ids_array, $pltforme_id[0]->plateforme_id);
				}

				return $plateforme_ids_array;
			}


			//outils selected
			public function outils_selected($selected_outils_names){
				// $selected_outils_names = $this->input->post('outils_selected');

				$outils_id_array = array();//la requete vers la BD renvoie un tableau de tableaux d'objets qui contien les ids 

				foreach ($selected_outils_names as $outil_name) {
					// print_r($plateforme_name);
					array_push($outils_id_array, $this->admin_model->get_outils_id($outil_name)); 
				}

				// echo "<br>end";
				// json_encode($outils_id_array)
				// print_r($outils_id_array);//array

				//outils_id_array contient bien les ids, mais c'est un tableau associatif, alors
				//je simplifie le result returned par la BD, pour avoir un tableau n'ayant que les ids
				$outils_ids_array = array();
				foreach ($outils_id_array as $outil_id) {

					array_push($outils_ids_array, $outil_id[0]->outil_id);
				}

				return $outils_ids_array;
			}

			//creation d'une nouvelle chaine de soutien niveau plate-forme
		 	/*	
		 	public function new_chain_plateforme(){

				$data['title'] = $this->title.' Nouvelle chaine de soutien (plate-forme)';
				$data['root_path'] = $this->root_path;

				// $data['news'] = $this->News_model->get_news();
				// var_dump('contol_news: '.$data);

				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/Nouvelle_chaine_de_soutien_platfrm', $data);
				//footer
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-service_script', $data);
				$this->load->view('vw-templates/page_foot');
			}
			*/

	    /* ==================================================================================================== */



		/*==========  								========== *\
								refreshing
		\*==========								========== */

			//fonction de rafraichissement 
			public function refresh_chainsout_list(){

				$all_chaines_soutien = $this->admin_model->getall_chains_support();
				echo '<option selected="" value=""></option>';
				// print_r($all_chaines_soutien);
				foreach ($all_chaines_soutien as $chaine_soutien){

					echo '
						
						<option value="'.$chaine_soutien->chainesout_nom.'" id="'.$chaine_soutien->chainesout_id.'" >
							'.$chaine_soutien->chainesout_nom.'
						</option>';
				}
			}


			//fonction de rafraichissement 
			public function refresh_plateformes_list(){

				$all_platesformes = $this->admin_model->getall_platesformes();
				echo '<option selected="" value=""></option>';
				// print_r($all_chaines_soutien);
				foreach ($all_platesformes as $plateforme){

					echo '
						
						<option value="'.$plateforme->plateforme_nom.'" id="'.$plateforme->plateforme_id.'" >
							'.$plateforme->plateforme_nom.'
						</option>';
				}
			}


			//fonction de rafraichissement 
			public function refresh_outils_list(){

				$all_outils = $this->admin_model->getall_outils();
				echo '<option selected="" value=""></option>';
				// print_r($all_chaines_soutien);
				foreach ($all_outils as $outil){

					echo '
						<option value="'.$outil->outil_nom.'" id="'.$outil->outil_id.'" title="'.$outil->outil_desc.'">
							'.$outil->outil_nom.'
						</option>';
				}
			}


			//fonction de rafraichissement 
			public function refresh_architectur_list(){

				$all_architectures = $this->admin_model->getall_architectures();
				echo '<option selected="" value=""></option>';
				// print_r($all_chaines_soutien);
				foreach ($all_architectures as $architecture){

					echo '
						<option value="'.$architecture->architectur_nom_srvc.'" id="'.$architecture->architectur_id.'" title="'.$architecture->groupe_de_soutien_details.'">
							'.$architecture->architectur_nom_srvc.'
						</option>';
				}
			}

			//fonction de rafraichissement 
			public function refresh_services_family_list(){

				$all_families_services = $this->admin_model->getall_families_services();
				//echo '<option selected="" value=""></option>';
				// print_r($all_chaines_soutien);
				foreach ($all_families_services as $family){

					echo '
						<input type="checkbox" name="famille_'.$family->famille_id.'" /><label style="margin-left: 1em;" family_caracter="'.$family->famille_caracter.'"> '.$family->famille_name.'</label><br />';
				}
			}

		/* ==================================================================================================== */





	    /*==========  								========== *\
							DATA SAVING
		\*==========								========== */


		    //sauvegarde d'une nouvelle chaine de soutien
		    public function save_new_groupe_de_sout(){

		    	// var_dump('@b\'s : 1/ )');
		    	$groupesout_data = $this->input->post('new_groupe_sout_obj');
		    	$groupesout_chainesc_data = $this->input->post('responsable_id_obj');
		    	
		    	//print_r($groupesout_data);//data['id_new_chain']

		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->group_support_creation($groupesout_data, $groupesout_chainesc_data);//retrieve the id of the last chainsout just created

		    	$this->new_service_creation();
		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support

		    	/*foreach ($DB_id_new_chain[0] as $id_chain) {
		    		echo $id_chain;
		    	}*/	    	
		    }


		    //sauvegarde d'une nouvelle chaine de soutien
		    public function add_new_matrix_to_groupe_de_sout(){

		    	// var_dump('@b\'s : 1/ )');
		    	$last_group_id = $this->input->post('last_group_id');
		    	$groupesout_chainesc_data = $this->input->post('responsable_id_obj');
		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->group_support_add_new_chainesc($last_group_id, $groupesout_chainesc_data);//retrieve the id of the last chainsout just created
    	
		    }


		    //sauvegarde d'une nouvelle chaine de soutien
		    public function save_new_chainsout(){

		    	// var_dump('@b\'s : 1/ )');
		    	$groupe_de_sout_data = $this->input->post('groupesout_id_obj');
		    	
		    	// print_r($chainesout_data);data['id_new_chain']
		    	$DB_id_new_chain = $this->admin_model->chainsupport_creation($groupe_de_sout_data);//retrieve the id of the last chainsout just created

		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support
		    	foreach ($DB_id_new_chain[0] as $id_chain) {
		    		echo $id_chain;
		    	}	    	
		    }


			//fonction de sauvegarde d'un nouveau responsable
			public function save_new_responsable(){

		    	// var_dump('@b\'s : 1/ )');
		    	$responsable_data = $this->input->post('new_resp_obj');
		    	
		    	//print_r($groupesout_data);//data['id_new_chain']

		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->responsable_creation($responsable_data);

		    	echo "responsable créé avec succès";
		    	// $this->new_service_creation();
		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support

		    }


			//fonction de sauvegarde d'une nouvelle architecture
			public function save_new_architecture(){
				
				$model_json_arch = $this->input->post('model_json');
				$architecture_name = $this->input->post('architecture_name');
				$architecture_desc = $this->input->post('architecture_desc');
				$architeture_creation_date = $this->input->post('architeture_creation_date');
				$architecture_author = $this->input->post('architecture_author');

				//echo "nom arch: ".$architecture_name." \ndesc_arc: ".$architecture_desc;
				$architecture_file_name = implode('_', explode(' ', trim(strtolower($architecture_name))));//
				
				/*Tests
				$base_url = base_url().'architectures_JSON_files/';
				echo "\n";
				echo 'base url'.$base_url;
				echo "\nSite url: ".site_url()."\n";
				*/

				// $file_path = $base_url.$architecture_name.'.json';  
				$file_path = '/wamp/www/portail_smc2/architectures_JSON_files/'.$architecture_file_name.'.json';
				
				echo "scandir search ";	
				$dir = "/wamp//www/portailsmc/";
				$dir = scandir($dir);
				echo "scandir: ";
				var_dump($dir);
	  
				// echo "file path: ".$file_path."\n";

				// echo "\n";

				$file = fopen($file_path, "a+");
				fwrite($file, $model_json_arch);
				fclose($file);

				$architecture_id = $this->admin_model->save_new_architecture_data($architecture_name, $architecture_desc, $architeture_creation_date, $architecture_author, $architecture_file_name.'.json');//storin the filename(serice_name) with extension

				$architecture_id = $architecture_id[0]->architectur_id;

				echo $architecture_id;
			}


			//enregistrement d'un nouveau service dans la BD
			public function save_new_service(){

				$data['title'] = 'Catalogue technique des services';
				$data['root_path'] = $this->root_path;

				$new_service_name = $this->input->post('service_name');
				$new_service_desc = $this->input->post('service_desc');
				$new_service_chainesout_id = $this->input->post('service_chainsout_id');
				$new_service_plateforms_id_array = $this->input->post('plateformes_selected');
				$new_service_outils_id_array = $this->input->post('outils_selected');
				$new_service_architecture_id = $this->input->post('id_architecture');
				

				// echo "<br>Description: ";
				// print_r($new_service_desc);

				// echo "<br>Id Chaine de soutien: ";
				// print_r($new_service_chainesout_id);

				// echo "<br>id Plateformes: ";
				$selected_platerformes_ids_array = $this->plateformes_selected($new_service_plateforms_id_array);
				// print_r($selected_platerformes_ids_array);

				// print_r($this->plateforme_ids_array);
				// $platerformes_ids = plateformes_selected();//array of the ids of the selected plateformes
				
				// echo "<br>Id outils: ";

				$selected_outils_ids_array = $this->outils_selected($new_service_outils_id_array);
				// print_r($selected_outils_ids_array);

				$new_service_data = array(
									'service_nom' => $new_service_name, 
									'service_desc' => $new_service_desc, 
									'service_chainesout_id' => intval($new_service_chainesout_id)
									);
				// print_r($new_service_data);
				/*if (condition) {
					# code...
				}*/

				$this->admin_model->save_new_service(
														 $new_service_data, 
														 $selected_platerformes_ids_array, 
														 $selected_outils_ids_array, 
														 $new_service_architecture_id
													 );


				echo "Service successfully created";
				

				// print_r($this->outils_ids_array);
			}

			//enregistrement d'une nouvelle famille de service dans la BD
			public function ctrl_insert_new_family_into_db(){
				/*
					$data['title'] = 'Catalogue technique des services';
					$data['root_path'] = $this->root_path;
				*/

				$nom_new_family = $this->input->post('nom_famille_typed');
				$nom_new_family = ucfirst($nom_new_family);

				//traitement de la chaine, minuscules, separation par underscore
		    	$family_caracter = implode("_", explode(" ", strtolower($nom_new_family)));
				
				$this->admin_model->mod_insert_new_family($nom_new_family, $family_caracter);

				echo "Family successfully created: ";//.$nom_new_family;
				

				// print_r($this->outils_ids_array);
			}


		/* ==================================================================================================== */





	    /*==========  									========== *\
							DATA UPDATING PAGES
		\*==========									========== */

			//Mise à jour d'un service, page de modification
			public function service_updating(){

				$data['title'] = $this->title.' Modifier un service';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";


				$data['all_services'] = $this->admin_model->getall_services();

				$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();
				// var_dump($data['all_chaines_soutien'][0]->chainesout_id);

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();

				$data['all_platesformes'] = $this->admin_model->getall_platesformes();

				$data['all_outils'] = $this->admin_model->getall_outils();

				$data['all_architectures'] = $this->admin_model->getall_architectures();
				// var_dump('contol_news: '.$data);

				$this->load_head_page($data);
				// $this->load->view('includings/administration/administration-update_service_style', $data);
				$this->load->view('vw-administration/vw-catalogue/updating/administration-update_a_service', $data);
				// $this->load_foot_page($data);
				$this->load->view('vw-templates/body_footer');
				// $this->load->view('includings/administration/administration-service_script', $data);
				$this->load->view('includings/administration/administration-update_service_script', $data);
				$this->load->view('vw-templates/page_foot');
			}

			//Mise à jour d'une chaine de soutien, page de modification
			public function chain_support_updating(){

				$data['title'] = $this->title.' Modifier une chaine de soutien';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";


				$data['all_services'] = $this->admin_model->getall_services();

				$data['all_chaines_soutien'] = $this->admin_model->getall_chains_support();
				// var_dump($data['all_chaines_soutien'][0]->chainesout_id);

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();


				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/updating/administration-update_chaine_soutien', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/Nouvelle_chaine_script', $data);
				$this->load->view('includings/administration/administration-update_chaine_soutien_script', $data);
				$this->load->view('vw-templates/page_foot');
			}


			//Mise à jour d'un groupe de soutien, page de modification
			public function groupe_de_soutien_updating(){
				
				$data['title'] = $this->title.' Modification groupe de soutien';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['all_groupes_support'] = $this->admin_model->getall_group_support();

				$data['responsables'] = $this->admin_model->getall_responsables();
				
				//$data['all_architectures'] = $this->admin_model->getall_architectures();
				
				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/updating/update-groupe_soutien', $data);
				$this->load->view('vw-templates/body_footer');
				// $this->load->view('includings/administration/administration-responsable_script', $data);
				$this->load->view('includings/administration/administration-update_groupe_soutien_script', $data);
				$this->load->view('vw-templates/page_foot');
			}


			//page d'affichage du formulaire de modification d'un responsable
			public function membre_groupe_soutien_editing(){
				
				$data['title'] = $this->title.' Modifier un responsable';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				$data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();
				
				//$data['all_architectures'] = $this->admin_model->getall_architectures();
				
				$this->load_head_page($data);
				$this->load->view('vw-administration/vw-catalogue/updating/responsable_editing_form', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/administration-update_responsable_script', $data);
				$this->load->view('vw-templates/page_foot');
			}


			//page d'affichage de la liste des responsables
			public function membre_groupe_soutien_updating(){
				
				$data['title'] = $this->title.' Liste des membres';
				$data['root_path'] = $this->root_path;
				$data['site_url'] = site_url();
				$data['base_url'] = base_url();
				$data['administration_page_url'] = "Administration/admin_homepage";

				// $data['all_chaines_esc'] = $this->admin_model->getall_chains_esc();

				$data['responsables'] = $this->admin_model->getall_responsables();
				
				//$data['all_architectures'] = $this->admin_model->getall_architectures();
				
				$this->load_head_page($data);
				$this->load->view('includings/administration/update_membre_groupe_soutien_style', $data);
				$this->load->view('vw-administration/vw-catalogue/updating/update-membre_groupe_de_soutien', $data);
				$this->load->view('vw-templates/body_footer');
				$this->load->view('includings/administration/member_list_to_manage_script', $data);
				$this->load->view('vw-templates/page_foot');
			}

		/* ==================================================================================================== */





		/*==========  								========== *\
					  DATA UPDATES SAVING METHODS
		\*==========								========== */


			//enregistrement des modifications sur un service dans la BD
			public function update_service(){

				/*$data['title'] = 'Catalogue technique des services';
				$data['root_path'] = $this->root_path;*/
				$update_service_outils_id_array = array();


				$update_service_id = $this->input->post('service_id');
				$update_service_name = $this->input->post('service_name');
				$update_service_desc = $this->input->post('service_desc');
				$update_service_chainesout_id = $this->input->post('service_chainsout_id');
				$update_service_plateforms_id_array = $this->input->post('plateformes_selected');//les noms des platesformes
				$update_service_outils_id_array = $this->input->post('outils_selected');
				$update_service_architecture_id = $this->input->post('id_architecture');
				

				//affichages des donnees recues pour connaitre leur type
				echo "update_service_outils_id_array info ";
				// if(length($update_service_outils_id_array)){
				//=============	
				/*foreach ($update_service_outils_id_array as $value) {
					# code...
					if (!empty($value)){
						# code...
						echo "update_service_outils_id_array length is null";
					}else{
						echo "update_service_outils_id_array not null ";
						print_r($update_service_outils_id_array);
					}
					break;
				}*/
				//test si le array des outils est vide avant d'aller chercher les correspondances des ids en BD
				foreach ($update_service_outils_id_array as $value) {
					# code...
					if (!empty($value)){
						# code...
						echo "update_service_outils_id_array length is not null \n update_service_outils_id_array: ";
						print_r($update_service_outils_id_array);

						$selected_outils_ids_array = $this->outils_selected($update_service_outils_id_array);//plateformes_selected($update_service_plateforms_id_array);

						echo "\n selected_outils_ids_array: ";
						print_r($selected_outils_ids_array);

					}else{
						echo "update_service_outils_id_array is null ";
					}
					break;
				}

				/*echo "var_dump: ";
					var_dump($update_service_outils_id_array);
					echo "update_service_outils_id_array length is ".count($update_service_outils_id_array)." *";*/
				// }

				// echo "update_service_plateforms_id_array: ";
				// var_dump($update_service_plateforms_id_array);

				// test si l'array des plateformes est null, cet a dire, si les modifications ont ete faites
				$selected_platerformes_ids_array = null;
				foreach ($update_service_plateforms_id_array as $update_service_plateforms_id_array_value) {
					# code...
					if (!empty($update_service_plateforms_id_array_value)){
						# code..
						$selected_platerformes_ids_array = $this->plateformes_selected($update_service_plateforms_id_array);
						
					}else{
						echo "platforms array null";
						/*echo "update_service_outils_id_array not null ";
						print_r($update_service_outils_id_array);*/
					}
					break;
				}
					

				//appel de la fontion de transfmation des noms en id
				// $selected_platerformes_ids_array = $this->plateformes_selected($update_service_plateforms_id_array);//test
				echo 'selected_platerformes_ids_array after the empty test: ';
				var_dump($selected_platerformes_ids_array);

				// print_r($this->plateforme_ids_array);
				// $platerformes_ids = plateformes_selected();//array of the ids of the selected plateformes

				//appel de la fontion de transfmation des noms en id
				// $selected_outils_ids_array = $this->outils_selected($update_service_outils_id_array);
				echo 'selected_outils_ids_array after the empty test: ';
				var_dump($selected_outils_ids_array);

				$update_service_data = array(
									'service_nom' => $update_service_name, 
									'service_desc' => $update_service_desc, 
									'service_chainesout_id' => intval($update_service_chainesout_id)
									);
				// print_r($update_service_data);
				/*if (condition) {
					# code...
				}*/

				$this->admin_model->model_update_service(
														 $update_service_id,
														 $update_service_data, 
														 $selected_platerformes_ids_array, 
														 $selected_outils_ids_array, 
														 $update_service_architecture_id
													 );

				// $this->service_updating();
				echo "Service successfully updated";
				

				// print_r($this->outils_ids_array);
			}

			//enregistrement des modifications sur une chaine de soutien dans la BD
			public function update_chainsout(){

				$update_chainesout_id = $this->input->post('id_chaineselected');
				$groupe_de_sout_data = $this->input->post('groupesout_id_obj');
		    	
		    	// print_r($chainesout_data);data['id_new_chain']
		    	// $DB_id_new_chain = 
		    	$this->admin_model->model_chainsupport_updating($groupe_de_sout_data, $update_chainesout_id);//retrieve the id of the last chainsout just created

		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support
		    	/*foreach ($DB_id_new_chain[0] as $id_chain) {
		    		echo $id_chain;
		    	}*/

				// $this->service_updating();
				echo "Support chain successfully updated";
				

				// print_r($this->outils_ids_array);
			}


			//enregistrement des modifications sur un groupe de soutien
		    public function update_groupe_de_sout(){

		    	// var_dump('@b\'s : 1/ )');
		    	$update_groupesout_id = $this->input->post('id_groupe_selected');
		    	$update_groupesout_data = $this->input->post('update_groupe_sout_obj');
		    	/*$id_chainesc = $this->input->post('id_chainesc');
		    	$groupesout_chainesc_data = $this->input->post('responsable_id_obj');*/
		    	
		    	//print_r($update_groupesout_data);//data['id_new_chain']

		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->group_support_updating($update_groupesout_data, $update_groupesout_id);//updating the support group informations

		    	// $this->new_service_creation();
		    	echo "Support group successfully updated";
		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support

		    	/*foreach ($DB_id_new_chain[0] as $id_chain) {
		    		echo $id_chain;
		    	}*/	    	
		    }

			//enregistrement des modifications sur la chaine d'escalade d'un groupe de soutien
		    public function update_chainesc_groupe_de_sout(){

		    	var_dump('update_chainesc_groupe_de_sout entering');
		    	// var_dump('@b\'s : 1/ )');
		    	/*$update_groupesout_data = $this->input->post('update_groupe_sout_obj');*/
		    	$update_groupesout_id = $this->input->post('id_groupe_selected');
		    	$id_chainesc = $this->input->post('id_chainesc');
		    	$groupesout_chainesc_data = $this->input->post('responsable_id_obj');
		    	
		    	//print_r($update_groupesout_data);//data['id_new_chain']

		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->chainesc_group_support_updating($groupesout_chainesc_data, $id_chainesc, $update_groupesout_id);//retrieve the id of the last chainsout just created

		    	var_dump('echo update ');
		    	// $this->new_service_creation();
		    	echo "Group support escalation successfully updated";
		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support

		    	/*foreach ($DB_id_new_chain[0] as $id_chain) {
		    		echo $id_chain;
		    	}*/	    	
		    }



			//fonction de sauvegarde des modifications sur un responsable
			public function save_responsable_updated_infos(){

		    	// var_dump('@b\'s : 1/ )');
		    	$responsable_data = $this->input->post('new_resp_obj');
		    	$id_responsable_to_update = $this->input->post('responsable_id');
		    	
		    	//print_r($groupesout_data);//data['id_new_chain']

		    	
		    	// $DB_id_new_chain = 
		    	$this->admin_model->responsable_modification($responsable_data, $id_responsable_to_update);

		    	echo "responsable modifié avec succès";
		    	// $this->new_service_creation();
		    	// print_r($id_new_chain);
		    	//sending to the view, the id of the last created chain support

		    }

		/* ==================================================================================================== */


		/*==========  				========== *\
					  DELETE DATA
		\*==========				========== */
			
			//Suppression d'un membre
			public function suppression_membre(){
				# code...
				$id_responsable_to_delete = $this->input->post('id_responsable_to_delete');
				$this->admin_model->delete_responsable($id_responsable_to_delete);
			}

			//sauvegarde d'une nouvelle chaine de soutien
		    public function delete_matrix_from_groupe_de_sout(){

		    	// var_dump('@b\'s : 1/ )');
		    	$id_of_chainesc_to_delete = $this->input->post('id_of_chainesc_to_delete');
				$this->admin_model->model_delete_chainesc($id_of_chainesc_to_delete);
    	
		    }

		/* ==================================================================================================== */


		/*==========  								========== *\
								COMON DATA 
		\*==========								========== */

			//fonction de load des hauts de pages
			public function load_head_page($data){
				$this->load->view('vw-templates/page_head', $data);
				$this->load->view('includings/administration/administration-update_service_style', $data);
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