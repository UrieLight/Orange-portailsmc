<?php 

	/**
	* Model d'architectures
	*/
	class Architectures_model extends CI_Model{
		
		function __construct()
		{
			# code...
			$this->load->database();
		}



		/*==========  								========== *\
					  		Getall function
		\*==========								========== */

			//Récupération de toutes les architectures
			public function getall_architectures(){

				$this->db->order_by('architectur_nom_srvc', 'ASC');
				$architectures = $this->db->get('architecture');

				return $architectures->result();
			}

			

		/*==========  								========== *\
					  		get ids functions
		\*==========								========== */

		    //fonction de récupération des id des platesformes sélectionnées
		    public function get_architectures_id($plateforme_name){
		    	
		    	// $pltforme_id_array = array();

		    	//Ajax autocomplete textbox using jQuery...code
		        $this->db->select('plateforme_id');
		        $this->db->like('plateforme_nom', $plateforme_name, 'both');
		        // $this->db->order_by('responsable_nomprenom', 'ASC');
		        $get_pltform_id_query = $this->db->get('plateforme');
		        // var_dump($ac_resp_query->result());
		        return $get_pltform_id_query->result();
		    }
	


		/*==========  								========== *\
					  			UPDATE
		\*==========								========== */


		    //fonction de sauvegarde des modifications sur un service
		    public function save_architecture_update($updated_architecture_id, $updated_architecture_name, $updated_architecture_desc, $architecture_update_date, $updated_architecture_author, $file_name_updated){
		    	
		    	$update_architecture_data = array(
							'architectur_nom_srvc' => $updated_architecture_name,
							'architecture_desc' => $updated_architecture_desc,
							'architectur_author' => $updated_architecture_author,
							'architectur_last_modif_date' => $architecture_update_date,
							'file_path' => $file_name_updated
		    	);

		    	//var_dump('architecture_update_date model');
		    	//var_dump($architecture_update_date);

		    	// print_r($new_service_data);
		    	$this->db->update('architecture', $update_architecture_data, "architectur_id = ".$updated_architecture_id);

		    			    	
		        // return $id_last_service->result_array();
		    }
	

		
		/*==========  								========== *\
					  			SEARCH
		\*==========								========== */
			//fonction d'affichage des services re
			public function display_services_searched($name, $root_path){

		        //Ajax autocomplete textbox using jQuery...code
		        // $this->db->select('service_nom, service_id');
		        $this->db->like('architectur_nom_srvc', $name, 'both');
		        $this->db->order_by('architectur_nom_srvc', 'ASC');
		        $search_service_query = $this->db->get('architecture');
		        // var_dump($ac_resp_query->result());
		        // echo 'services returned: ';
		        $search_architecture_query = $search_architecture_query->result();
				// var_dump($search_architecture_query);

				$rang_architecture = 1; //Rang (pour le dénombrement des architectures) -->	
				
				foreach ($search_architecture_query as $architecture){
				
					echo'<div class="architecture">

						<div class="service_head container-fluid "> 

							<div class="architecture_img ">	
								<img class="img-rounded img-responsive img_architecture" src="'.$root_path.'/img/administration/architecture_icon.png" alt="img-architecture" />
							</div>

							<span style="font-size: 20px;">
								<strong class="architecture_name">'.$architecture_service->architectur_nom_srvc.'</strong>
							</span>

							<blockquote class="service_description">
								<small>'.ucfirst($architecture_service->architecture_desc).'</small>
							</blockquote>
						</div>

						

						<!-- INFORMATIONS SUR LE architecture: CHAINES DE SOUTIEN ET D\'ESCALADE -->
						<br />
						<div class="service_info table-responsive" style="margin-bottom: 2em;">
							
							<div class="">								

								<!-- LISTE DES ARCHITECTURES DE SERVICES ENREGISTREES -->
												
								<div class="info_content" id="architecture" align="center"><!-- id="architecture" -->
																
									<hr />
									<span style="float: left;">
										<strong class="author">Edité par: </strong>
										'.$architecture_service->architectur_author.'
									</span>
									
									<span style="float: right;">
										<i class="last_modified_date">Dernière mise à jour: </i>
										<i>'.$architecture_service->architectur_last_modif_date.'</i>
									</span>
									
									<br>
									<br>
									<div class="diagramme" rang="'.$rang_architecture.'" id="architecture'.$rang_architecture.'" style="width: 895px; height: 500px;"></div><!-- style="margin:2% auto; width:500px; height:250px; background-color: #DAE4E4;" -->
									<!-- <p>Aucune architecture pour ce service !!</p> -->
									<br>
									<span class="btn btn-success" title="Générer l\'image et Télécharger cette architecture" id="download_button'.$rang_architecture.'">
										<span class="glyphicon glyphicon-download" style="color: black;"></span>
										Télécharger
									</span>
									
									<input id="architecture_jsonfile" type="hidden" value="'.$architecture_service->file_path.'">
								</div>
								
							</div>
						</div>
					</div>';
					
					$rang_architecture++;
				}
		    }
	}
?>