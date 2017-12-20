<?php 
	
	/**
	* Modele de la page d'administration
	*/
	class Contacts_Model extends CI_Model{
		
		function __construct(){

			$this->load->database();
		}


		//Récupération de toutes les chaines de soutien
		public function getall_group_support(){

			$this->db->order_by('groupe_de_soutien_nom', 'ASC');
			$groupe_sout_query = $this->db->get('groupes_de_soutien');

			return $groupe_sout_query->result();
		}


		//Récupération de toutes les chaines d'escalade
		public function getall_chains_esc(){

			$chaine_esc_query = $this->db->get('chaine_escalade');

			return $chaine_esc_query->result();
		}


		//Récupération de tous les responsables
		public function getall_responsables(){

			$this->db->order_by('responsable_nomprenom', 'ASC');
			$responsables_query = $this->db->get('responsable');

			return $responsables_query->result();
		}


		//fonction d'affichage des services re
		public function display_contacts_searched($name, $root_path){

	        //Ajax autocomplete textbox using jQuery...code
	        $this->db->like('groupe_de_soutien_nom', $name, 'both');
	        $this->db->order_by('groupe_de_soutien_nom', 'ASC');
	        $search_contacts_query = $this->db->get('groupes_de_soutien');
	        // var_dump($ac_resp_query->result());
	        // echo 'services returned: ';
	        $search_contacts_query = $search_contacts_query->result();
			// var_dump($search_contacts_query);

			$rang_contacts = 1; //Rang (pour le dénombrement des services) -->	
			
			foreach ($search_contacts_query as $groupe_de_soutien){
			
				echo '
					<div class="contact">

						<div class="service_head container-fluid "> 

							<div class="contact_img ">	
								<img class="img-rounded img-responsive img_contact" src="'.$root_path.'/img/administration/groupe_sout.png" alt="img-contact" />
							</div>

							<span style="font-size: 20px;">
								<strong class="contact_name">'.$groupe_de_soutien->groupe_de_soutien_nom.'</strong>
							</span>

							<blockquote class="service_description">
								<small>'.ucfirst($groupe_de_soutien->groupe_de_soutien_pays).'</small>
							</blockquote>
						</div>

						

						<!-- INFORMATIONS SUR LE CONTACT: CHAINES DE SOUTIEN ET D\'ESCALADE -->
						<br />
						<br />
						<div class="service_info table-responsive">
							<hr>
							<div class="">
				
				';

				$chaines_esc = $this->getall_chains_esc();
				$responsables = $this->getall_responsables();
				


				foreach ($chaines_esc as $chainesc) {

					// if ($chainesc->chainesc_groupesout_id == $groupesout_id) {
					if ($chainesc->chainesc_groupesout_id == $groupe_de_soutien->groupe_de_soutien_id) {

						$niv = 1;//chain escalation level
						$esc_level = "esc".$niv;

						//printing the chain support level
						// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>


						echo '<ul style="display: none;" class="niveau_soutien">
								<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc->chainesc_description).'</li>
							 </ul>';

						echo '<table class="table-striped table-bordered table-responsive table-hover" id="chainesc">

							<thead>';
							
						/* == HEAD OF TABLE DISPLAYING ==*/

						while (!is_null($chainesc->$esc_level) AND $niv<7) {
							
							// echo '<th style="background-color: #74dcff;">Escalade '.$niv.'</th>';
							$nivo = $niv-1;
							echo '<th style="background-color: #74dcff;">Escalade '.$nivo.'</th>';

							$niv++;
							$esc_level = "esc".$niv;//updating the chain escalation level
							
							//pour ne pas depasser le nombre de colonne d'une chaine d'escalade
							if ($niv == 8) {
								# code...
								break;
							}
						}

						echo "</thead>";
						

						/* == BODY OF TABLE DISPLAYING == */
						echo "<tbody>";

						echo "<tr>";

						$nbr_resp = 1;
						$count = 0;
						$esc_level = "esc".$nbr_resp;//adapting the esc_level variable to the responsable_id changing

						while (!is_null($chainesc->$esc_level) AND $count < $niv-1) {//$nbr_resp <= $niv
							
							foreach ($responsables as $resp){
								// var_dump($count);
								if ($resp->responsable_id == $chainesc->$esc_level) {

									echo '
										<td>
											<p name="info_responsable">
												<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />
												<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br />
												<span class="tel1">'.$resp->responsable_tel1.'</span><br />
												<span class="tel2">'.$resp->responsable_tel2.'</span><br />
												<span class="email">'.implode('\n', explode('\n', trim($resp->responsable_email))).'</span><br />
												<span class="eds"> EDS: '.$resp->responsable_eds.'</span><br />
												<span class="disponibility">disponibilité: '.$resp->responsable_disponibilite.'</span>
											</p>
										</td>
										';

									break;
								}
							}

							$count++;
							$nbr_resp++;
							$esc_level = "esc".$nbr_resp;//updating the chain support level
						}
						
						echo '
								</tr>
							</tbody>
						</table>';
						
						echo "<br>";
					
					}
				}

				echo'
							</div>
						</div>
					</div>';
			}

			// $nbr_de_niveau_de_soutien = 0;
			$rang_contacts++;
			

			$rang_contacts = $rang_contacts-1;
			echo '<input id="nbr_total_service" type="hidden" value="'.$rang_contacts.'" />';
			// echo 'rang_service: '.$rang_service;
	    }

	   


	    /*==========  								========== *\
					  			UPDATES
		\*==========								========== */

	    //fonction de sauvegarde des modifications sur une chaine de soutien
	    /*public function model_chainsupport_updating($groupe_de_sout_data, $update_chainesout_id){
	    	
	    	//chain data, will be insert into the array, which will be sent to the query
			$data = array();

	        $count = 0;//compteur du tableau associatif contenant les informations sur la nouvelle chaine de soutien
	    	foreach ($groupe_de_sout_data as $groupe_de_sout_info => $info) {
	    		
	    		if ($count == 0) {

	    			//the chain name is at the zero index
	    			//adding to the data array, to send to the database
	    			$data['chainesout_nom'] = $info;

	    		}else{

	    			//parcour du tableau associatif des groupes de soutien
	    			foreach ($info as $id => $val) {
	    				
	    				// echo "Responsable".$count." id: ".$val;
	    				$data['chainesout_niv'.$count] = $val;
	    				//incrementation du compteur
	    				$count++;
	    			}
	    		}
	    		$count++;
	    	}

	    	// print_r($new_service_data);
	    	$this->db->update('chaine_soutien', $data, "chainesout_id = ".$update_chainesout_id);
	    	
	        // return $id_last_service->result_array();
	    }*/
	}
?>