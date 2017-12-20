<?php 
	
	/**
	* Modele de la page d'administration
	*/
	class Administration_Model extends CI_Model{
		
		function __construct(){

			$this->load->database();
		}


		/* ==================================================================================================== */


	    /*==========  								========== *\
					  		Getall functions
		\*==========								========== */


			//Récupération de toutes les chaines de soutien
			public function getall_services(){

				$this->db->order_by('service_nom', 'ASC');
				$services = $this->db->get('service');

				return $services->result();
			}

			//Récupération de toutes les chaines de soutien
			public function getall_families_services(){

				$this->db->order_by('famille_name', 'ASC');
				$services = $this->db->get('famille_de_services');

				return $services->result();
			}


			//Récupération de toutes les chaines de soutien
			public function getall_chains_support(){

				$this->db->order_by('chainesout_nom', 'ASC');
				$chaine_sout_query = $this->db->get('chaine_soutien');

				return $chaine_sout_query->result();
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


			//Récupération de toutes les plates-formes
			public function getall_platesformes(){

				$this->db->order_by('plateforme_nom', 'ASC');
				$plateforme_query = $this->db->get('plateforme');

				return $plateforme_query->result();
			}


			//Récupération de tous les outils
			public function getall_outils(){

				$this->db->order_by('outil_nom', 'ASC');
				$outil_query = $this->db->get('outil');

				return $outil_query->result();
			}


			//Récupération de toutes les architectures
			public function getall_architectures(){

				$this->db->order_by('architectur_nom_srvc', 'ASC');
				$architectur_query = $this->db->get('architecture');

				return $architectur_query->result();
			}


			//Récupération de toutes les liaisons architecture-service
			public function getall_services_architectures(){

				// $this->db->order_by('plateforme_nom', 'DESC');
				$service_archtctr_query = $this->db->get('service-arch');

				return $service_archtctr_query->result();
			}



			//Récupération de toutes les liasons services-outils
			public function getall_service_outils(){

				// $this->db->order_by('outil_nom', 'ASC');
				$service_outil_query = $this->db->get('service-outil');

				return $service_outil_query->result();
			}


			//Récupération de toutes les liasons services-plateformes
			public function getall_service_plateformes(){

				// $this->db->order_by('outil_nom', 'ASC');
				$service_plateforme_query = $this->db->get('service-plateforme');

				return $service_plateforme_query->result();
			}


			//Récupération de toutes les liasons services-archs
			public function getall_service_archs(){

				// $this->db->order_by('outil_nom', 'ASC');
				$service_arch_query = $this->db->get('service-arch');

				return $service_arch_query->result();
			}
		
		/* ==================================================================================================== */



	    /*==========  								========== *\
					  		display data functions
		\*==========								========== */

			//fonction d'affichage des services re
			public function display_services_searched($name, $root_path){

		        //Ajax autocomplete textbox using jQuery...code
		        // $this->db->select('service_nom, service_id');
		        $this->db->like('service_nom', $name, 'both');
		        $this->db->order_by('service_nom', 'ASC');
		        $search_service_query = $this->db->get('service');
		        // var_dump($ac_resp_query->result());
		        // echo 'services returned: ';
		        $search_service_query = $search_service_query->result();
				// var_dump($search_service_query);

				$rang_service = 1; //Rang (pour le dénombrement des services) -->	
				
				foreach ($search_service_query as $service){
				
					echo '<input type="hidden" id="rang_service" value="'.$rang_service.'" />

						<div class="service" style="border-bottom: 2px solid #ff6501;">

							<div class="service_head container-fluid "> 

								<div class="service_img ">	
									<img class="img-rounded img-responsive img_service" src="'.$root_path.'/img/content/'.$service->icon_url.'" alt="img-service" />
								</div>

								<span style="font-size: 20px;">
									<strong class="service_name">'.$service->service_nom.'</strong>
								</span>

								<blockquote class="service_description">
									<small>'.ucfirst($service->service_desc).'</small>
								</blockquote>
							</div>

							<!-- INFORMATIONS SUR LE SERVICE: CHAINES DE SOUTIEN ET D\'ESCALADE, PLATES-FORMES, OUTILS, ARCHITECTURES -->
							<br />
							<br />
							<div class="service_info table-responsive">
								
								<!-- header de la liste des infos du service -->
								<div class="nav_tabs">

									<ul class="nav nav-tabs onglets_info">

										<li role="presentation" class="active">
											<a class="onglet_info" href="#chainesout" data-toggle="tab">
												<img src="'.$root_path.'/img/content/soutien.png" alt="soutien_img" />  Chaine de soutien
											</a>
										</li>

										

										<li role="presentation">
											<a class="onglet_info" href="#plateforme" data-toggle="tab">
												<img src="'.$root_path.'/img/content/plateforme.png" alt="plateforme_img" /> Plates-formes
											</a>
										</li>';

										/*echo '<li role="presentation">
											<a class="onglet_info" href="#outil" data-toggle="tab">
												<img src="'.$root_path.'/img/content/outil.png" alt="outil_img" /> Outils de supervision
											</a>
										</li>';*/

										echo '<li role="presentation">
											<a class="onglet_info" href="#architecture" data-toggle="tab">
												<img src="'.$root_path.'/img/content/architecture.png" alt="architecture_img" /> Architecture
											</a>
										</li>
									</ul>
								</div>

								<br />
								<br />
								
								<div class="navs_content">';
									
									$chaines_sout = $this->getall_chains_support();
									$groupes_sout = $this->getall_group_support();

									$groupesout_array_ids = array();
									$groupesout_array_noms = array();
									$indice_groupesout_ids_array = 1;
									$nbr_de_niveau_de_soutien = 0;//pour savoir cbn de fenêtre modale je vais afficher, car il en faut une pour chaque niveau de soutien

									//parcours de la table de la chaine de soutien
									foreach ($chaines_sout as $chainesout) {
										
										//stops when the id of the chain support matches with the one in the service
										if($chainesout->chainesout_id == $service->service_chainesout_id){
											
											$id_chainesout_service = $service->service_chainesout_id;

											echo '
												<table class="info_content active table-bordered table-striped table-hover" id="chainesout">
													<thead>';

											$niv = 1;//chain support level
											$chain_level = "chainesout_niv".$niv;
											$normal = true;//to display the text "normal" in the first column

											/* == HEAD OF TABLE DISPLAYING ==*/
											while (!is_null($chainesout->$chain_level) AND $niv<7) {
												//getting the responsables data of each level of the corresponding chain support
												// foreach ($responsables as $resp) { //not at the right place
												if($normal){
							
													echo "<th>Normal</th>";
							
													$normal = false;
													//$next_column = false;//if we pass trough this condition, then we should not display the next column
													$niv++;//incrementing before breaking, to switch to the next level
													$chain_level = "chainesout_niv".$niv;//updating the chain support level
													continue;
												}
												
												$niv--;
												echo "<th>Niveau $niv</th>";

												$niv+= 2;
												$chain_level = "chainesout_niv".$niv;//updating the chain support level
											}

											echo "</thead>";

											echo "<tbody>";

											echo "<tr>";
													
											$nbr_resp = 1;
											$count = 0;
											$chain_level = "chainesout_niv".$nbr_resp;//adapting the chain_level variable to the responsable_id changing
											
											while (!is_null($chainesout->$chain_level) AND $count < $niv-1) {//$nbr_resp <= $niv
												
												$nbr_de_niveau_de_soutien++;

												foreach ($groupes_sout as $groupe_sout){
													// var_dump($groupe_sout);
													if ($groupe_sout->groupe_de_soutien_id == $chainesout->$chain_level) {
														
														array_push($groupesout_array_ids, $groupe_sout->groupe_de_soutien_id); 
														array_push($groupesout_array_noms, $groupe_sout->groupe_de_soutien_nom); 

														echo '
															<td>
																<span data-toggle="modal" id="" href="#chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_service.'" class="" title="">
																	<p name="info_responsable">
																		<span class="nom_responsable"><b>'.$groupe_sout->groupe_de_soutien_nom.'</b></span><br /><br />
																		<span class="tel1">'.$groupe_sout->groupe_de_soutien_pays.'</span><br />
																		<span class="email">'.$groupe_sout->groupe_de_soutien_details.'</span><br />
																		<span class="eds">'.$groupe_sout->groupe_de_soutien_disponibility.'</span><br />
																	</p>
																</span>
															</td>
															';

														$indice_groupesout_ids_array++;//j'me souviens plus très bien, mais j'crois que 
														//j'avais mis ça pour connaître la taille du tableau contenant les ids des groupes de soutien

														break;
													}
												}

												$count++;
												$nbr_resp++;
												$chain_level = "chainesout_niv".$nbr_resp;//updating the chain support level
											}
												
											echo "
													</tr>
												</tbody>
											</table>";
										}
									}

									
									/*  =========================  CHAINE D'ESCALADE  =========================  */

									$chaines_esc = $this->getall_chains_esc();
									$responsables = $this->getall_responsables();
									$indice_groupesout_ids_array = 1;//j'commence à 1 pour ne pas ajouter 1.
											
									foreach ($groupesout_array_ids as $groupesout_id) {//parcours du tableau des ids des groupes de soutiens


										foreach ($chaines_esc as $chainesc) {

											// if ($chainesc->chainesc_groupesout_id == $groupesout_id) {
											if ($chainesc->chainesc_groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {


												echo '
									
													<div class="modal fade" id="chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_service.'">

														<div class="modal-dialog modal-lg modal-sm">

															<div class="modal-content">

																<div class="modal-header">

																	<button type="button" class="close" data-dismiss="modal">x</button>
																	<h4 class="modal-title">Chaine d\'escalade: <b>'.$groupesout_array_noms[$indice_groupesout_ids_array-1].'</b></h4>
																</div>

																<div class="modal-body">
																	<div class=" level_sout_chainesc" style="border-bottom: 1px solid #e5e5e5;">
												';

												$niv = 1;//chain escalation level
												$esc_level = "esc".$niv;

												//printing the chain support level
												// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>


												echo '<ul style="display: none;" class="niveau_soutien">
														<li>'.$chainesc->chainesc_description.'</li>
													 </ul>';

												echo '<table class="table-striped table-bordered table-responsive table-hover" id="chainesc">

													<thead>';
													
												/* == HEAD OF TABLE DISPLAYING ==*/

												while (!is_null($chainesc->$esc_level) AND $niv<7) {

													$nivo = $niv-1;
													echo '<th style="background-color: #74dcff;">Escalade '.$nivo.'</th>';
													// echo '<th style="background-color: #74dcff;">Escalade '.$niv.'</th>';

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
																	<p name="info_responsable"><b>';
																		//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

																		$this->new_line_for_nw_rsp_info($resp->responsable_nomprenom);
																		echo '</b>';
																		//affichage de la fonction si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																			# code...
																			echo '<span class="fonction_responsable">';
																			$this->new_line_for_nw_rsp_info($resp->responsable_fonct);						
																		}

																		//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																			# code...
																			echo '<span class="tel1">';
																			$this->new_line_for_nw_rsp_info($resp->responsable_tel1);					
																		}

																		//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																			# code...
																			echo '<span class="tel2">';
																			$this->new_line_for_nw_rsp_info($resp->responsable_tel2);
																		}

																		//affichage de responsable_email si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																			# code...
																			echo '<span class="email">';
																			$this->new_line_for_nw_rsp_info($resp->responsable_email);																											
																		}

																		//affichage de la dispo si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																			# code...
																			echo '<span class="disponibility">';
																			$this->new_line_for_nw_rsp_info($resp->responsable_disponibilite);
																		}

																		//affichage de la EDS si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		// echo 'eds: ';
																		// var_dump($resp->responsable_eds);
																		if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																			# code...
																			echo '<span class="eds"> EDS: ';
																			$this->new_line_for_nw_rsp_info($resp->responsable_eds);
																		}

																	echo '</p>
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
											

												echo '
																</div>
															</div>
														</div>
													</div>
												</div>';
											}
										}

										$indice_groupesout_ids_array++;
									}

									$groupesout_array_ids = null;


									/*  ========================= PLATEFORMES  =========================  */
									

									echo '
										
										<div class="info_content" id="plateforme" style="display:none;">
								
											<table class="table table-bordered table-hover table-striped">
												
												<thead>

													<th>Identifiant</th>
													<th>Description</th>
													<th>URL de connexion</th>
												</thead>

												<tbody style="text-align: center; "> 

													';

													$id_pltform = 1;
													$service_plateformes = $this->getall_service_plateformes();
													$platesformes = $this->getall_platesformes();

													//parcours de la table service-platesformes
													foreach ($service_plateformes as $srv_pltfrm) {
														//si le service match avec une plate-forme, on va chercher 
														// la plate-forme dans la table des plates-formes
														if($service->service_id == $srv_pltfrm->sp_service_id){

															// echo "ce service a une plateforme: ";

															foreach ($platesformes as $plateforme){

																if ($plateforme->plateforme_id == $srv_pltfrm->sp_plateform_id){

																	echo '
																		<tr>
																			<td><span  data-toggle="modal" href="#'.implode('', explode(' ', trim($service->service_nom))).$id_pltform.'" class="chaines_platesformes" style="cursor: pointer;">'.$plateforme->plateforme_nom.'</span></td>
																			<td>'.$plateforme->plateforme_description.'</td>
																			<td>'.$plateforme->plateforme_adress.'</td>
																		</tr>';

																	$id_pltform ++;
																	break;
																}
															}
														}
													}
														
													echo'
												</tbody>
											</table>';
												
											
											//CHAINES DE SOUTIEN ET D'ESCALADES DES PLATES-FORMES EN FENÊTRES MODALES -->
											 
											$id_pltform = 1;
											$exist_chaines = 0;
											

											//parcours de la table service-platesformes
											foreach ($service_plateformes as $srv_pltfrm) {
												//si le service match avec une plate-forme, on va chercher 
												// la plate-forme dans la table des plates-formes
												if($service->service_id == $srv_pltfrm->sp_service_id){

													foreach ($platesformes as $plateforme){

														if ($plateforme->plateforme_id == $srv_pltfrm->sp_plateform_id){
															
															$pltfrm_groupesout_array_ids = array();//contient les ids de tous groupes de la chaine de soutien de la plate-forme
															$pltfrm_groupesout_array_noms = array();//contient les noms de tous groupes de la chaine de soutien de la plate-forme
															$pltfrm_indice_groupesout_ids_array = 1;//contient la taille de l'array des ids des groupes de la chainsout, pour

															echo '
																<div class="modal fade" id="'.implode('', explode(' ', trim($service->service_nom))).$id_pltform.'">

																	<div class="modal-dialog modal-lg modal-sm">

																		<div class="modal-content">

																			<!-- Nom de la plate-forme sélectionnée -->
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal">x</button>
																				<h2 class="modal-title" style="color: #ff6501;">'.$plateforme->plateforme_nom.'</h2>
																			</div>

																			<!-- Chaine de soutien et d\'escalades de la plate-forme -->
																			<div class="modal-body">

																				<!-- CHAINE DE SOUTIEN -->
																				<div class="pltfrm_chs plateforme_chaines_tab" style="border-bottom: 1px solid #e5e5e5;">

																					<ul style="font-size: 16px; list-style: none;">
																						<li><img src="'.$root_path.'/img/content/soutien.png" alt="soutien"><b style="color: #ff6501;"> Chaine de soutien</b></li>
																					</ul><br />

																					<table class="table-bordered table-responsive" style="margin: 0 auto 2em;">

																						<thead>
																							<!-- want to stop when the id of the chain support matches with the one in the plateforme(i first wrote "service")  -->';
																							
																							foreach ($chaines_sout as $chainesout){

																								//stops when the id of the chain support matches with the one in the platforme
																								if($chainesout->chainesout_id == $plateforme->plateforme_chainesout_id){
																									
																									$exist_chaines = 1;//just want to change the variable value, to check if this condition is true, even once

																									$niv = 1;//chain support level
																									$chain_level = "chainesout_niv".$niv;
																									$normal = true;//to display the text "normal" in the first column

																									$pltfrm_nbr_de_niveau_de_soutien = 0;//pour savoir cbn de fois je vais boucler pour afficher les chaines des groupes (qui peuvent quand même avoir plusieurs chaines d'escalades)
																									$pltfrm_indice_groupesout_ids_array = 1;

																									// == HEAD OF TABLE DISPLAYING ==
																									while (!is_null($chainesout->$chain_level) AND $niv<7) {
																										//getting the responsables data of each level of the corresponding chain support
																										// foreach ($responsables as $resp) { //not at the right place
																										if($normal){

																											echo '<th style="background-color: #ffff0f;">Normal</th>';

																											$normal = false;
																											//$next_column = false;//if we pass trough this condition, then we should not display the next column
																											$niv++;//incrementing before breaking, to switch to the next level
																											$chain_level = "chainesout_niv".$niv;//updating the chain support level
																											continue;
																										}
																										
																										$niv--;
																										echo '<th style="background-color: #ffff0f;">Niveau '.$niv.'</th>';

																										$niv+= 2;
																										$chain_level = "chainesout_niv".$niv;//updating the chain support level
																									}

																									echo "</thead>";

																									echo "<tbody>";

																									echo "<tr>";

																									$nbr_resp = 1;
																									$count = 0;
																									$chain_level = "chainesout_niv".$nbr_resp;//adapting the chain_level variable to the responsable_id changing
																									
																									while (!is_null($chainesout->$chain_level) AND $count < $niv-1) {//$nbr_resp <= $niv
																										
																										

																										foreach ($groupes_sout as $groupe_sout){
																											// var_dump($groupe_sout);
																											if ($groupe_sout->groupe_de_soutien_id == $chainesout->$chain_level) {

																												array_push($pltfrm_groupesout_array_ids, $groupe_sout->groupe_de_soutien_id);
																												array_push($pltfrm_groupesout_array_noms, $groupe_sout->groupe_de_soutien_nom);//je mets aussi les noms des groupes de soutiens (qui seront affichés dans les entêtes, de sorte à spécifier leurs chaines d'escalades), pour ne pas utiliser un tableau associatif

																												echo '
																													<td>
																														<span data-toggle="modal" id="" href="#chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_service.'" class="" title="">
																															<p name="info_responsable">
																																<span class="nom_responsable"><b>'.$groupe_sout->groupe_de_soutien_nom.'</b></span><br /><br />
																																<span class="tel1">'.$groupe_sout->groupe_de_soutien_pays.'</span><br />
																																<span class="email">'.$groupe_sout->groupe_de_soutien_details.'</span><br />
																																<span class="eds">'.$groupe_sout->groupe_de_soutien_disponibility.'</span><br />
																															</p>
																														</span>
																													</td>
																													';

																												$pltfrm_indice_groupesout_ids_array++;
																												$pltfrm_nbr_de_niveau_de_soutien++;//autant il y a de groupes de soutiens qui correspondent, autant il  y a de niveaux de soutien

																												break;
																											}
																										}

																										$count++;
																										$nbr_resp++;
																										$chain_level = "chainesout_niv".$nbr_resp;//updating the chain support level
																									}

																									echo "</tr>";
																								}
																							}
																							
																							if ($exist_chaines == 0) {
																								echo "Aucune chaine créee pour cette plateforme.";
																								break;
																							}
																						echo '</thead>

																						<tbody>

																						</tbody>
																					</table>
																				</div>

																				<!-- CHAINE(S) D\'ESCALADE(S) -->
																				<div class="pltfrm_che plateforme_chaines_tab">

																					<br>
																					<ul  style="font-size: 16px; list-style: none;">
																						<li><img src="'.$root_path.'/img/content/escalade.png" alt="escalade"><b style="color: #ff6501;"> Chaine(s) d\'escalade(s)</b></li>
																					</ul><br />';

																					$pltfrm_indice_groupesout_ids_array = 1;//$pltfrm_indice_groupesout_ids_array count_indice_groupesout_ids_array;// = 1;//j'commence à 1 pour ne pas ajouter 1.

																					foreach ($pltfrm_groupesout_array_ids as $groupesout_id) {
																						
																						$nom_groupe = null;
																						//récupération du nom du group portant cet id
																						foreach ($groupes_sout as $groupe_sout) {
																							
																							if($groupe_sout->groupe_de_soutien_id == $groupesout_id){

																								$nom_groupe = $groupe_sout->groupe_de_soutien_nom;
																							}
																						}

																						echo '<u>Matrice d\'escalade :</u> <b>'.$nom_groupe.' </b><br /><br />';

																						//parcours de la table de la chaine d'escalade
																						foreach ($chaines_esc as $chainesc) {
																							
																							if($chainesc->chainesc_groupesout_id == $groupesout_id){

																								$niv = 1;//chain escalation level
																								$esc_level = "esc".$niv;

																								//printing the chain support level
																								echo '<ul>
																										<li style="color: #ff6501;font-weight:bold;">'.$chainesc->chainesc_description.'</li>
																									 </ul>';

																								echo '<div style="overflow-x: auto;"><table class="table-bordered table-responsive">

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
																													<p name="info_responsable"><b>';
																														//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

																														//removing the * at the begining of the name
																														$nom_resp = $resp->responsable_nomprenom;

																														if (substr($nom_resp, 0, 1) == '*') {
																															
																															$nom_resp = substr($nom_resp, 1);
																														}

																														$this->new_line_for_nw_rsp_info($nom_resp);
																														echo '</b>';
																														//affichage de la fonction si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																															# code...
																															echo '<span class="fonction_responsable">';
																															$this->new_line_for_nw_rsp_info($resp->responsable_fonct);						
																														}

																														//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																															# code...
																															echo '<span class="tel1">';
																															$this->new_line_for_nw_rsp_info($resp->responsable_tel1);					
																														}

																														//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																															# code...
																															echo '<span class="tel2">';
																															$this->new_line_for_nw_rsp_info($resp->responsable_tel2);
																														}

																														//affichage de responsable_email si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																															# code...
																															echo '<span class="email">';
																															$this->new_line_for_nw_rsp_info($resp->responsable_email);																											
																														}

																														//affichage de la dispo si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																															# code...
																															echo '<span class="disponibility">';
																															$this->new_line_for_nw_rsp_info($resp->responsable_disponibilite);
																														}

																														//affichage de la EDS si ce n'est pas vide, pour ne pas 
																														//inserer des <br> inutilement
																														// echo 'eds: ';
																														// var_dump($resp->responsable_eds);
																														if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																															# code...
																															echo '<span class="eds"> EDS: ';
																															$this->new_line_for_nw_rsp_info($resp->responsable_eds);
																														}

																													echo '</p>
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
																							</table>
																									</div><br /><br />';
																							}
																						}

																						$pltfrm_indice_groupesout_ids_array++;
																					}

																					echo '
																				</div>
																			</div>
																		</div>
																	</div>
																</div>';
															$id_pltform ++;
														}
													}
												}
											}

												// $pltfrm_groupesout_array_ids = null;
										echo'
									</div>';


									/*  ========================= OUTILS  =========================  */

									echo '<div class="info_content" id="outil" style="display:none;">
								
										<table class="table table-bordered table-striped">
											
											<thead>

												<th style="background:#4fd592"><b>Identifiant de l\'outil</b></th>
												<th style="background:#4fd592"><b>Description</b></th>
											</thead>

											<tbody>
										';

										$service_outils = $this->getall_service_outils();
										$outils = $this->getall_outils();

										//parcours de la table service-plates-formes
										foreach ($service_outils as $srv_outil) {
											//si le service match avec une plate-forme, on va chercher 
											// la plate-forme dans la table des plates-formes
											if($service->service_id == $srv_outil->so_service_id){

												foreach ($outils as $outil){

													if($outil->outil_id == $srv_outil->so_outil_id){
														echo '
															<tr>
																<td style="text-align: center;">'.$outil->outil_nom.'</td>
																<td><em>'.$outil->outil_desc.'</em></td>
															</tr>';
													}
												}
											}
										}

									echo'
									</tbody>
								</table>
							</div>';

									/*  ========================= ARCHITECTURE  =========================  */

									echo '<div class="info_content" id="architecture" align="center" style="display:none;">
								
								<div class="diagrammes" rang="'.$rang_service.'" id="architecture'.$rang_service.'" ></div>
								';
								

									$all_services_architectures = $this->getall_services_architectures();
									$all_architectures = $this->getall_architectures();

									//parcours de la table architecture
									foreach ($all_services_architectures as $service_architecture) {
										
										//sotps when we've found a service who has an architecture
										if ($service->service_id == $service_architecture->sa_service_id) {
											
											//recherche de l'équivalent dans la table des architectures
											foreach ($all_architectures as $architecture) {

												// echo "recherche de son architecture...";
												//stops when the id in the service-architecture id matches the architecture id
												if ($architecture->architectur_id == $service_architecture->sa_architecture_id) {
													
													// echo "architectur found !!";
													echo '
														<input id="architecture_jsonfile" type="hidden" value="'.$architecture->file_path.'">';

													break;
												}
											}
										}
									}

								echo '
											</div>	
										</div>
									</div>
								</div>';
				
					 	
									echo'
								</div>
							</div>
						</div>';

						$nbr_de_niveau_de_soutien = 0;
						$rang_service++;
				}

				$rang_service = $rang_service-1;
				echo '<input id="nbr_total_service" type="hidden" value="'.$rang_service.'" />';
				// echo 'rang_service: '.$rang_service;
		    }

		    //affichage de la chaine de la chaine de soutien selected
		    public function display_correspondant_chainsout($id_chainesout){
		    		
		    	$all_chaines_sout = $this->getall_chains_support();
		    	$groupes_sout = $this->getall_group_support();

		    	$all_chaines_esc = $this->getall_chains_esc();
		    	$all_responsables = $this->getall_responsables();
		    	//initialisation des variables
		    	$groupesout_array_ids = array();
				$groupesout_array_noms = array();
				$indice_groupesout_ids_array = 1;

		    	//parcours de la table de la chaine de soutien
				foreach ($all_chaines_sout as $chainesout) {
					
					//stops when the id of the chain support matches with the one in the service
					if($chainesout->chainesout_id == $id_chainesout){
						
						$niv = 1;//chain support level
						$chain_level = "chainesout_niv".$niv;
						$normal = true;//to display the text "normal" in the first column

						echo '
							<table class="info_content active table-bordered table-striped table-hover table" id="chainesout" style="width: 70%; margin: auto;">
								<thead>';

						/* == HEAD OF TABLE DISPLAYING ==*/
						while (!is_null($chainesout->$chain_level) AND $niv<7) {
							//getting the responsables data of each level of the corresponding chain support
							// foreach ($responsables as $resp) { //not at the right place
							if($normal){
		
								echo "<th>Normal</th>";
		
								$normal = false;
								//$next_column = false;//if we pass trough this condition, then we should not display the next column
								$niv++;//incrementing before breaking, to switch to the next level
								$chain_level = "chainesout_niv".$niv;//updating the chain support level
								continue;
							}
							
							$niv--;
							echo "<th>Niveau $niv</th>";

							$niv+= 2;
							$chain_level = "chainesout_niv".$niv;//updating the chain support level
						}

						echo "</thead>";

						echo "<tbody>";

						echo "<tr>";
								
						$nbr_resp = 1;
						$count = 0;
						$chain_level = "chainesout_niv".$nbr_resp;//adapting the chain_level variable to the responsable_id changing
						
						while (!is_null($chainesout->$chain_level) AND $count < $niv-1) {//$nbr_resp <= $niv
							

							foreach ($groupes_sout as $groupe_sout){
								// var_dump($groupe_sout);
								if ($groupe_sout->groupe_de_soutien_id == $chainesout->$chain_level) { 

									array_push($groupesout_array_ids, $groupe_sout->groupe_de_soutien_id); 
									array_push($groupesout_array_noms, $groupe_sout->groupe_de_soutien_nom); 

									echo '
										<td>
											<span data-toggle="modal" href="#chainesc_of_level_'.$indice_groupesout_ids_array.'_of_support" class="" title="">
												<p name="info_responsable">
													<span class="nom_responsable"><b>'.$groupe_sout->groupe_de_soutien_nom.'</b></span><br /><br />
													<span class="tel1">'.$groupe_sout->groupe_de_soutien_pays.'</span><br />
													<span class="email">'.$groupe_sout->groupe_de_soutien_details.'</span><br />
													<span class="eds">'.$groupe_sout->groupe_de_soutien_disponibility.'</span><br />
												</p>
											</span>
										</td>
									';

									$indice_groupesout_ids_array++;

									break;
								}
							}

							$count++;
							$nbr_resp++;
							$chain_level = "chainesout_niv".$nbr_resp;//updating the chain support level
						}
							
						echo "
								</tr>
							</tbody>
						</table>";
					}
				}

				$indice_groupesout_ids_array = 1;

				foreach ($groupesout_array_ids as $groupesout_id) {//pour chaque id dans le tableau des ids des groupes de soutien,
							
					// if ($groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {

						foreach ($all_chaines_esc as $chainesc) {
												
							// if ($chainesc->chainesc_groupesout_id == $groupesout_id) {
							// if ($chainesc->chainesc_groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {//4 tests
							if ($chainesc->chainesc_groupesout_id == $groupesout_id) {

								echo '
					
									<div class="modal fade" id="chainesc_of_level_'.$indice_groupesout_ids_array.'_of_support">

										<div class="modal-dialog modal-lg modal-sm">

											<div class="modal-content">

												<div class="modal-header">

													<button type="button" class="close" data-dismiss="modal">x</button>
													<h4 class="modal-title">Chaine d\'escalade: <b>'.$groupesout_array_noms[$indice_groupesout_ids_array-1].'</b></h4>
												</div>

												<div class="modal-body" style="overflow: auto;">
													<div class=" level_sout_chainesc" style="border-bottom: 1px solid #e5e5e5;">
								';

								$niv = 1;//chain escalation level
								$esc_level = "esc".$niv;

								//printing the chain support level
								// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>


								echo '<ul style="display: none;" class="niveau_soutien">
										<li>'.$chainesc->chainesc_description.'</li>
									 </ul>';

								echo '<table class="table-striped table-bordered table-responsive table table-hover" id="chainesc" style="width: 70%;margin: auto; margin-bottom: 5%;">

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
									
									foreach ($all_responsables as $resp){
										// var_dump($count);
										if ($resp->responsable_id == $chainesc->$esc_level) {

											echo '
												<td>
													<p name="info_responsable"><b>';
														//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

														$this->new_line_for_nw_rsp_info($resp->responsable_nomprenom);
														echo '</b>';
														//affichage de la fonction si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
															# code...
															echo '<span class="fonction_responsable">';
															$this->new_line_for_nw_rsp_info($resp->responsable_fonct);						
														}

														//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
															# code...
															echo '<span class="tel1">';
															$this->new_line_for_nw_rsp_info($resp->responsable_tel1);					
														}

														//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
															# code...
															echo '<span class="tel2">';
															$this->new_line_for_nw_rsp_info($resp->responsable_tel2);
														}

														//affichage de responsable_email si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
															# code...
															echo '<span class="email">';
															$this->new_line_for_nw_rsp_info($resp->responsable_email);																											
														}

														//affichage de la dispo si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
															# code...
															echo '<span class="disponibility">';
															$this->new_line_for_nw_rsp_info($resp->responsable_disponibilite);
														}

														//affichage de la EDS si ce n'est pas vide, pour ne pas 
														//inserer des <br> inutilement
														// echo 'eds: ';
														// var_dump($resp->responsable_eds);
														if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
															# code...
															echo '<span class="eds"> EDS: ';
															$this->new_line_for_nw_rsp_info($resp->responsable_eds);
														}

													echo '</p>
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
							

								echo '
												</div>
											</div>
										</div>
									</div>
								</div>';

								break;
							}
						}

						$indice_groupesout_ids_array++;
					//}
				}
		    }


		    //affichage de la chaine de la chaine de soutien selected
		    public function display_correspondant_chainsout_desc($chainesout_id){
		    		
		    	$all_services = $this->getall_services();
		    	// $groupes_sout = $this->getall_group_support();

		    	//parcours de la table de la chaine de soutien
				foreach ($all_services as $service) {
					
					//stops when the id of the chain support matches with the one in the service
					if($service->service_id == $chainesout_id){

						echo $service->service_desc;
						
					}
				}

		    }

		    
		    //affichage de la chaine d'escalade associcated to la l'id de la chaine de soutien, passed in parameters
		    public function display_correspondant_escalation_chain($id_chainesout){
		    		
		    	$all_chaines_esc = $this->getall_chains_esc();
		    	$responsables = $this->getall_responsables();

		    	$compteur_de_niveau_escalades = 1;
		    	//parcours de la table de la chaine d'escalade
				foreach ($all_chaines_esc as $chainesc) {

					//stops when the id of the chain escalation matches with the one selected in the chain support select list
					if($chainesc->chainesc_chainesout_id == $id_chainesout){
						
						$niv = 1;//chain escalation level
						$esc_level = "esc".$niv;
						// $esc_chainsout_level = $niv;

						echo '<div><ul><li>Escalade '.$compteur_de_niveau_escalades.'</li></ul><br>
							<div style="overflow: auto;">
							<table class="info_content table-bordered table-striped table-hover table-responsive" id="chainesc" style="width: 80%;">
								<thead>
							';
						/* == HEAD OF TABLE DISPLAYING ==*/
						
						//on récupère uniquement les niveaux non nulls
						while (!is_null($chainesc->$esc_level) AND $niv<7) {
							
							// echo '<th>Escalade '.$niv.'</th>';
							$nivo = $niv-1;
							echo "<th>Escalade $nivo </th>";

							$niv++;
							$esc_level = "esc".$niv;//updating the chain escalation level
							// $esc_chainsout_level = $niv;

							//pour ne pas depasser le nombre de colonne d'une chaine d'escalade
							if ($niv == 8) {
								# code...
								break;
							}
						}

						echo "</thead>";

						echo "<tbody>";

						echo "<tr>";

						$nbr_resp = 1;
						$count = 0;
						$esc_level = "esc".$nbr_resp;//adapting the esc_level variable to the responsable_id changing
						while (!is_null($chainesc->$esc_level) AND $count < $niv-1) {//$nbr_resp <= $niv
							
							foreach ($responsables as $resp){
								// var_dump($count);
								if ($resp->responsable_id == $chainesc->$esc_level) {

									$trimmed_mails = trim($resp->responsable_email);
									$removed_slashes_mails = implode(' ', explode('/', $trimmed_mails));
									$removed_slashes_mails = implode(' ', explode(';', $removed_slashes_mails));
									$exploded_mail = explode(' ', $removed_slashes_mails);


									echo '
										<td>
											<p name="info_responsable"><b>';
												//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

												$this->new_line_for_nw_rsp_info($resp->responsable_nomprenom);
												echo '</b>';
												//affichage de la fonction si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
													# code...
													echo '<span class="fonction_responsable">';
													$this->new_line_for_nw_rsp_info($resp->responsable_fonct);						
												}

												//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
													# code...
													echo '<span class="tel1">';
													$this->new_line_for_nw_rsp_info($resp->responsable_tel1);					
												}

												//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
													# code...
													echo '<span class="tel2">';
													$this->new_line_for_nw_rsp_info($resp->responsable_tel2);
												}

												//affichage de responsable_email si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
													# code...
													echo '<span class="email">';
													$this->new_line_for_nw_rsp_info($resp->responsable_email);																											
												}

												//affichage de la dispo si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
													# code...
													echo '<span class="disponibility">';
													$this->new_line_for_nw_rsp_info($resp->responsable_disponibilite);
												}

												//affichage de la EDS si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												// echo 'eds: ';
												// var_dump($resp->responsable_eds);
												if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
													# code...
													echo '<span class="eds"> EDS: ';
													$this->new_line_for_nw_rsp_info($resp->responsable_eds);
												}

											echo '</p>
										</td>
										';

									break;
								}
							}

							$count++;
							$nbr_resp++;
							$esc_level = "esc".$nbr_resp;//updating the chain support level
						}
						
						echo "			</tr>
									</tbody>
								</table>
								</div>
							</div>";


						$compteur_de_niveau_escalades++;
					}
				}
		    }

		    
		    //affichage de la chaine d'escalade associcated to la l'id de la chaine de soutien, passed in parameters
		    public function display_correspondant_groupesout_chainesc($chainesc_groupsout_id){
		    		
		    	$all_chaines_esc = $this->getall_chains_esc();
		    	$responsables = $this->getall_responsables();

		    	// $compteur_de_niveau_escalades = 1;
		    	//parcours de la table de la chaine d'escalade
				foreach ($all_chaines_esc as $chainesc) {

					//stops when the id of the chain escalation matches with the one selected in the chain support select list
					if($chainesc->chainesc_groupesout_id == $chainesc_groupsout_id){
						
						$niv = 1;//chain escalation level
						$esc_level = "esc".$niv;
						// $esc_chainsout_level = $niv;
						echo '<br>';

						echo '<ul style="/*display: none;" class="niveau_soutien">
								<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc->chainesc_description).'</li>
							 </ul>';
						echo '<span id="modif_chainesc'.$chainesc->chainesc_id.'" 
								chainesc_groupsout_id="'.$chainesc->chainesc_id.'" 
								class="btn btn-default glyphicon glyphicon-edit" 
								title="Modifier la chaine '.$chainesc->chainesc_description.'" 
								style="float: right; display: none;"> </span>'; 
						
						echo '<span id="suppr_chainesc'.$chainesc->chainesc_id.'" 
								chainesc_groupsout_id="'.$chainesc->chainesc_id.'" 
								class="btn btn-danger class_of_chainesc glyphicon glyphicon-trash" 
								title="Supprimer la chaine '.$chainesc->chainesc_description.'" 
								style="float: right;"> </span>';

						echo "<br />";

						echo '
							<input type="hidden" id="id_chainesc" id_chainesc="'.$chainesc->chainesc_id.'"/>
							<div style="overflow: auto;">
							<table class="info_content table-bordered table-striped table-hover table-responsive" id="chainesc" style="width: 80%;">
								<thead>
							';
						/* == HEAD OF TABLE DISPLAYING ==*/
						
						//on récupère uniquement les niveaux non nulls
						while (!is_null($chainesc->$esc_level) AND $niv<7 AND $chainesc->$esc_level != 0) {
							
							// echo "<th>Escalade $niv</th>";
							$nivo = $niv-1;
							echo "<th>Escalade $nivo </th>";//en tête du tableau, niveaux d'escalade

							$niv++;
							$esc_level = "esc".$niv;//updating the chain escalation level
							// $esc_chainsout_level = $niv;

							//pour ne pas depasser le nombre de colonne d'une chaine d'escalade
							if ($niv == 8) {
								# code...
								break;
							}
						}

						echo "</thead>";

						echo "<tbody>";

						echo "<tr>";

						$nbr_resp = 1;
						$count = 0;
						$esc_level = "esc".$nbr_resp;//adapting the esc_level variable to the responsable_id changing
						while (!is_null($chainesc->$esc_level) AND $count < $niv-1) {//$nbr_resp <= $niv
							
							foreach ($responsables as $resp){
								// var_dump($count);
								if ($resp->responsable_id == $chainesc->$esc_level) {

									/*echo '
										<td>
											<p name="info_responsable">
												<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />
												<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br />
												<span class="tel1">'.$resp->responsable_tel1.'</span><br />
												<span class="tel2">'.$resp->responsable_tel2.'</span><br />
												<span class="email">'.implode('\\', explode(' ', trim($resp->responsable_email))).'</span><br />
												<span class="eds">'.$resp->responsable_eds.'</span><br />
												<span class="disponibility">'.$resp->responsable_disponibilite.'</span>
											</p>
										</td>
										';*/
									
									echo '
										<td>
											<p name="info_responsable"><b>';
												//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

												$this->new_line_for_nw_rsp_info($resp->responsable_nomprenom);
												echo '</b>';
												//affichage de la fonction si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
													# code...
													echo '<span class="fonction_responsable">';
													$this->new_line_for_nw_rsp_info($resp->responsable_fonct);						
												}

												//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
													# code...
													echo '<span class="tel1">';
													$this->new_line_for_nw_rsp_info($resp->responsable_tel1);					
												}

												//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
													# code...
													echo '<span class="tel2">';
													$this->new_line_for_nw_rsp_info($resp->responsable_tel2);
												}

												//affichage de responsable_email si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
													# code...
													echo '<span class="email">';
													$this->new_line_for_nw_rsp_info($resp->responsable_email);																											
												}

												//affichage de la dispo si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
													# code...
													echo '<span class="disponibility">';
													$this->new_line_for_nw_rsp_info($resp->responsable_disponibilite);
												}

												//affichage de la EDS si ce n'est pas vide, pour ne pas 
												//inserer des <br> inutilement
												// echo 'eds: ';
												// var_dump($resp->responsable_eds);
												if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
													# code...
													echo '<span class="eds"> EDS: ';
													$this->new_line_for_nw_rsp_info($resp->responsable_eds);
												}

											echo '</p>
										</td>
										';

									break;
								}
							}

							$count++;
							$nbr_resp++;
							$esc_level = "esc".$nbr_resp;//updating the chain support level
						}
						
						echo "			</tr>
									</tbody>
								</table>
							</div>";


						// $compteur_de_niveau_escalades++;
					}
				}

				echo '<span id="ajouter_chaine_escalade'.$chainesc_groupsout_id.'" class="btn btn-success glyphicon glyphicon-plus-sign" title="Ajouter une chaine d\'escalade à ce groupe" style="/*float: right;" />';
		    }


			function new_line_for_nw_rsp_info($resp_info){
			
				$trimmed_info1 = trim($resp_info);
				$exploded_info1 = explode(';', $trimmed_info1);
				$imploded_info = implode('#', $exploded_info1);
				$exploded_info2 = explode('#', $imploded_info);
				//$removed_slashes_names = implode('\n', $exploded_info);
				
				$info_arranged = ''; //initialisation de la chaine finale
				foreach($exploded_info2 as $resp_info){
					
					$info_arranged .= $resp_info.'<br>';
				}
				
				$info_arranged .= '</span><br /><br />';
				
				echo $info_arranged;
			}
	    /* ==================================================================================================== */



	    /*==========  								========== *\
					  		autocomplete functions
		\*==========								========== */

		    /*
			//fonction d'autocompletion du champ dans le tableau de creation 
			//de chaine de soutien
			public function autocomplete_nom_service($name){

		        //Ajax autocomplete textbox using jQuery...code
		        $this->db->select('service_nom, service_id');
		        $this->db->like('service_nom', $name, 'both');
		        $this->db->order_by('service_nom', 'ASC');
		        $autocomplete_service_query = $this->db->get('service');
		        // var_dump($ac_resp_query->result());
		        return $autocomplete_service_query->result();

		    }*/


			//fonction d'autocompletion du champ dans le tableau de creation 
			//de chaine de soutien
			public function autocomplete_nom_groupe($name){

		        //Ajax autocomplete textbox using jQuery...code
		        $this->db->select('groupe_de_soutien_nom, groupe_de_soutien_id');
		        $this->db->like('groupe_de_soutien_nom', $name, 'both');
		        $this->db->order_by('groupe_de_soutien_nom', 'ASC');
		        $autocomplete_groupe_query = $this->db->get('groupes_de_soutien');
		        // var_dump($ac_resp_query->result());
		        return $autocomplete_groupe_query->result();

		    }


			//fonction d'autocompletion du champ dans le tableau de creation 
			//de chaine de soutien
			public function autocomplete($name){

		        //Ajax autocomplete textbox using jQuery...code
		        $this->db->select('responsable_nomprenom, responsable_id');
		        $this->db->like('responsable_nomprenom', $name, 'both');
		        $this->db->order_by('responsable_nomprenom', 'ASC');
		        $autocomplete_resp_query = $this->db->get('responsable');
		        // var_dump($ac_resp_query->result());
		        return $autocomplete_resp_query->result();

		    }



		/* ==================================================================================================== */



	    /*==========  								========== *\
					  		get ids functions
		\*==========								========== */

		    //fonction de récupération des id des platesformes sélectionnées
		    public function get_plateformes_id($plateforme_name){
		    	
		    	// $pltforme_id_array = array();

		    	//Ajax autocomplete textbox using jQuery...code
		        $this->db->select('plateforme_id');
		        $this->db->like('plateforme_nom', $plateforme_name, 'both');
		        // $this->db->order_by('responsable_nomprenom', 'ASC');
		        $get_pltform_id_query = $this->db->get('plateforme');
		        // var_dump($ac_resp_query->result());
		        return $get_pltform_id_query->result();
		    }


		    //fonction de récupération des id des outils sélectionnées
		    public function get_outils_id($outil_name){
		    	
		    	// $pltforme_id_array = array();

		    	//Ajax autocomplete textbox using jQuery...code
		        $this->db->select('outil_id');
		        $this->db->like('outil_nom', $outil_name, 'both');
		        // $this->db->order_by('responsable_nomprenom', 'ASC');
		        $get_outil_id_query = $this->db->get('outil');
		        // var_dump($ac_resp_query->result());
		        return $get_outil_id_query->result();
		    }



		/* ==================================================================================================== */



	    /*==========  								========== *\
					SAVES, new data creation functions
		\*==========								========== */

		    //fonction de creation d'une chaine de soutien
		    //ecriture des data dans la database
			public function chainsupport_creation($chainesout_data){

				//chain data, will be insert into the array, which will be sent to the query
				$data = array();

		        $count = 0;//compteur du tableau associatif contenant les informations sur la nouvelle chaine de soutien
		    	foreach ($chainesout_data as $chainesout_info => $info) {
		    		
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
		    	// print_r($data);
		        $this->db->insert('chaine_soutien', $data);

		        //retrieving of the id of this chain support who was the last created
		        $this->db->select('chainesout_id');
		        $this->db->order_by('chainesout_id', 'DESC');
		        $this->db->limit(1);

		        $id_last_chainesout = $this->db->get('chaine_soutien');
		        return $id_last_chainesout->result_array();
		    }


		    //fonction de creation d'un groupe de soutien
		    //ecriture des data dans la database
			public function group_support_creation($groupesout_data, $groupesout_chainesc_data){

				//insertion of the new group into the database
		        $this->db->insert('groupes_de_soutien', $groupesout_data);

		        //retrieving the id of the recently created group, to insert its id into its escalation chain, about to be created
		        $this->db->select('groupe_de_soutien_id');
		        $this->db->order_by('groupe_de_soutien_id', 'DESC');
		        $this->db->limit(1);

		        $id_last_groupesout = $this->db->get('groupes_de_soutien');
		        $id_last_groupesout = $id_last_groupesout->result_array();

				//chain data, will be insert into the array, which will be sent to the query
				$data = array();

				$id_last_groupesout = intval($id_last_groupesout[0]['groupe_de_soutien_id']);
				$data['chainesc_groupesout_id'] = $id_last_groupesout;

				// print_r($groupesout_chainesc_data);

		        $count = 0;
		    	foreach ($groupesout_chainesc_data as $groupesout_chainesc_info => $info) {
		    		
		    		if ($count == 0) {

		    			//the chain name is at the zero index
		    			//adding to the data array, to send to the database
		    			$data['chainesc_description'] = $info;

		    		}else{

		    			//parcour du tableau associatif des responsables
		    			foreach ($info as $id => $val) {
		    				
		    				// echo "Responsable".$count." id: ".$val;
		    				$data['esc'.$count] = $val;
		    				//incrementation du compteur
		    				$count++;
		    			}
		    		}
		    		$count++;
		    	}

		        $this->db->insert('chaine_escalade', $data);//test ok
		    }

		    //fonction de creation d'un groupe de soutien
		    //ecriture des data dans la database
			public function group_support_add_new_chainesc($last_group_id, $groupesout_chainesc_data){

				/*//insertion of the new group into the database
		        $this->db->insert('groupes_de_soutien', $groupesout_data);

		        //retrieving the id of the recently created group, to insert its id into its escalation chain, about to be created
		        $this->db->select('groupe_de_soutien_id');
		        $this->db->order_by('groupe_de_soutien_id', 'DESC');
		        $this->db->limit(1);

		        $id_last_groupesout = $this->db->get('groupes_de_soutien');
		        $id_last_groupesout = $id_last_groupesout->result_array();

				//chain data, will be insert into the array, which will be sent to the query
				$data = array();

				$id_last_groupesout = intval($id_last_groupesout[0]['groupe_de_soutien_id']);*/
				$data['chainesc_groupesout_id'] = $last_group_id;

				// print_r($groupesout_chainesc_data);

		        $count = 0;
		    	foreach ($groupesout_chainesc_data as $groupesout_chainesc_info => $info) {
		    		
		    		if ($count == 0) {

		    			//the chain name is at the zero index
		    			//adding to the data array, to send to the database
		    			$data['chainesc_description'] = $info;

		    		}else{

		    			//parcour du tableau associatif des responsables
		    			foreach ($info as $id => $val) {
		    				
		    				// echo "Responsable".$count." id: ".$val;
		    				$data['esc'.$count] = $val;
		    				//incrementation du compteur
		    				$count++;
		    			}
		    		}
		    		$count++;
		    	}

		        $this->db->insert('chaine_escalade', $data);//test ok
		    }

		    //last created group id
		    public function model_last_created_group_id()		    {
		    	# code...
		    	//retrieving of the id of this chain support who was the last created
		        $this->db->select('groupe_de_soutien_id');
		        $this->db->order_by('groupe_de_soutien_id', 'DESC');
		        $this->db->limit(1);

		        $id_last_groupesout = $this->db->get('groupes_de_soutien');
		        $id_last_groupesout = $id_last_groupesout->result_array();

		        $id_last_groupesout = intval($id_last_groupesout[0]['groupe_de_soutien_id']);

		        return $id_last_groupesout;
		    }


		    //fonction de sauvegarde d'un nouveau service
		    public function save_new_service($new_service_data, $new_service_plateforms_id_array, $new_service_outils_id_array, $architecture_id){
		    	
		    	// print_r($new_service_data);
		    	$this->db->insert('service', $new_service_data);


		    	//retrieving of the id of this service who was the last created
		        $this->db->select('service_id');
		        $this->db->order_by('service_id', 'DESC');
		        $this->db->limit(1);
		    	$id_last_service = $this->db->get('service');
		    	$id_last_service = $id_last_service->result();

		    	$id_last_service = $id_last_service[0]->service_id;

		    	//service relationship with other tables
		    	//service-plateforme
		    	foreach ($new_service_plateforms_id_array as $plateforms_id) {
		    		
		    		$service_plateforme_id_array = array(
		    										'sp_plateform_id' => intval($plateforms_id),
		    										'sp_service_id' => intval($id_last_service)
		    										);
		    		/*echo "sp, ";*/
		    		// print_r($service_plateforme_id_array);
		    		$this->db->insert('service-plateforme', $service_plateforme_id_array);
		    	}


		    	//service-outil
		    	foreach ($new_service_outils_id_array as $outil_id) {
		    		
		    		$service_outils_id_array = array(
		    										'so_outil_id' => intval($outil_id),
		    										'so_service_id' => intval($id_last_service)
		    										);
		    		/*echo "so, ";*/
		    		// print_r($service_outils_id_array);
		    		$this->db->insert('service-outil', $service_outils_id_array);
		    	}


		    	$service_archictectur_array = array(
		    										'sa_architecture_id'=> intval($architecture_id),
		    										'sa_service_id' => intval($id_last_service)
		    										);

		    	$this->db->insert('service-arch', $service_archictectur_array);
		        // return $id_last_service->result_array();
		    }


			


		    //fonction de sauvegarde d'une architecture
		    public function save_new_architecture_data($architecture_name, $architecture_desc, $architeture_creation_date, $architecture_author, $file_name){
		    	
		    	$architecture_data_array = array(
		    								'architectur_nom_srvc' => $architecture_name,
		    								'architecture_desc' => $architecture_desc,
		    								'architectur_author' => $architecture_author,
		    								'architectur_last_modif_date' => $architeture_creation_date,
		    								'file_path' => $file_name
		    								);

		    	// var_dump($architecture_data_array);
		    	$this->db->insert('architecture', $architecture_data_array);

		    	$this->db->select('architectur_id');
		    	$this->db->order_by('architectur_id', 'DESC');
		    	$this->db->limit(1);
		    	$this_architecture_id = $this->db->get('architecture');
		    	$this_architecture_id = $this_architecture_id->result();

		    	// print_r($this_architecture_id[0]);
		    	return $this_architecture_id;

		    }


		    //fonction de creation d'un nouveau responsable
		    public function responsable_creation($responsable_data){

		        $this->db->insert('responsable', $responsable_data);//test ok
		    }


		    //fonction de creation d'une nouvelle famille de service
		    public function mod_insert_new_family($nom_new_family, $family_caracter){

		    	$data = array();

		    	$data['famille_name'] = $nom_new_family;
		    	$data['famille_caracter'] = $family_caracter;

		        $this->db->insert('famille_de_services', $data);//test ok
		    }


		/* ==================================================================================================== */



	    /*==========  								========== *\
					  			UPDATES
		\*==========								========== */


		    //fonction de sauvegarde des modifications sur un service
		    public function model_update_service($update_service_id, $update_service_data, $selected_platerformes_ids_array, $selected_outils_ids_array, $update_service_architecture_id){
		    	
		    	// print_r($new_service_data);
		    	$this->db->update('service', $update_service_data, "service_id = ".$update_service_id);

		    	//service relationship with other tables
		    	/* SERVICE-PLATEFORME UPDATING */
		    	$all_service_plateformes = $this->getall_service_plateformes();

		    	// if (!is_null($selected_platerformes_ids_array)) {
		    		# code...
			    	foreach ($all_service_plateformes as $all_service_plateforme) {//update de la liste des liaisons service-plateforme
		    			
		    			if ($all_service_plateforme->sp_service_id == $update_service_id) {//si on trouve u plate-forme pour un service, l'update aura lieu. sinon on fera l'ajout
		    				
		    				$sp_id = $all_service_plateforme->sp_id;
		    				$this->db->where('sp_id', $sp_id);
		    				$this->db->delete('service-plateforme');
		    			}

		    		}


			    	foreach ($selected_platerformes_ids_array as $plateforms_id) {
			    		
			    		$service_plateforme_id_array = array(
			    										'sp_plateform_id' => intval($plateforms_id),
			    										'sp_service_id' => intval($update_service_id)
			    										);

			    		$this->db->insert('service-plateforme', $service_plateforme_id_array);
			    	}
		    	// }
	    		

		    	/*=========================*/


		    	/* SERVICE-OUTIL UPDATING */
		    	$all_service_outils = $this->getall_service_outils();

		    	// if (!is_null($selected_outils_ids_array)) {
		    		# code...
			    	//suppression de toutes les liaisons service-outils existantes
			    	foreach ($all_service_outils as $service_outil) {
		    			
		    			if ($service_outil->so_service_id == $update_service_id) {//si on trouve u plate-forme pour un service, l'update aura lieu. sinon on fera l'ajout
		    				
		    				$so_id = $service_outil->so_id;
		    				$this->db->where('so_id', $so_id);
		    				$this->db->delete('service-outil');
		    			}

		    		}

		    		//insertion des nouvelles liaisons
			    	foreach ($selected_outils_ids_array as $outil_id) {
			    		
			    		$service_outils_id_array = array(
			    										'so_outil_id' => intval($outil_id),
			    										'so_service_id' => intval($update_service_id)
			    										);
			    		
			    		$this->db->insert('service-outil', $service_outils_id_array);
			    		
			    	}
			    // }


		    	/*=========================*/

		    	/* SERVICE-ARCHITECTURE UPDATING*/
		    	$service_has_arch = false;
		    	$all_service_archs = $this->getall_service_archs();

		    	foreach ($all_service_archs as $service_arch) {
		    			
	    			if ($service_arch->sa_service_id == $update_service_id) {//si on trouve une architecture pour un service, l'update aura lieu. sinon on fera l'ajout
	    				
	    				$sa_id = $service_arch->sa_id;
	    				$this->db->where('sa_id', $sa_id);
	    				$this->db->delete('service-arch');
	    			}
	    		}


		    	$service_archictectur_array = array(
		    										'sa_architecture_id'=> intval($update_service_architecture_id),
		    										'sa_service_id' => intval($update_service_id)
		    										);

		    	$this->db->insert('service-arch', $service_archictectur_array);

		    	
		        // return $id_last_service->result_array();
		    }


		    //fonction de sauvegarde des modifications sur une chaine de soutien
		    public function model_chainsupport_updating($groupe_de_sout_data, $update_chainesout_id){
		    	
		    	//emptying the chain, before updating; cause update will only touch the cells updated
		    	//and if the cells number change, the effects wnt be applied
		    	$this->db->set('chainesout_niv1', NULL);
				$this->db->set('chainesout_niv2', NULL);
				$this->db->set('chainesout_niv3', NULL);
				$this->db->set('chainesout_niv4', NULL);
				$this->db->set('chainesout_niv5', NULL);
				$this->db->set('chainesout_niv6', NULL);
				$this->db->set('chainesout_niv7', NULL);
				$this->db->where('chainesout_id', $update_chainesout_id);
				$this->db->update('chaine_soutien');
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
		    }


		    //fonction de sauvegarde des modifications sur un groupe de soutien
			public function group_support_updating($groupesout_data, $update_groupesout_id){

				//update of the group informations into the database
		        $this->db->update('groupes_de_soutien', $groupesout_data, "groupe_de_soutien_id = ".$update_groupesout_id);
		    }


		    //fonction de sauvegarde des modifications sur la chaine d'escalade d'un groupe de soutien
			public function chainesc_group_support_updating($groupesout_chainesc_data, $id_chainesc, $update_groupesout_id){

				//insertion of the new group into the database
		        // $this->db->update('groupes_de_soutien', $groupesout_data, "groupe_de_soutien_id = ".$update_groupesout_id);

				// print_r($groupesout_chainesc_data);
				
				//commented for test
				/*$null_data = array(
							'chainesc_description' => '',
							'chainesc_groupesout_id' => $update_groupesout_id,
							'esc1' => NULL, 
							'esc2' => NULL, 
							'esc3' => NULL, 
							'esc4' => NULL, 
							'esc5' => NULL, 
							'esc6' => NULL,
							'esc7' => NULL);*/

				// print_r($null_data);
				/*for ($i=0; $i <7 ; $i++) { 
					
					array_push($null_data[$i], null);
				}*/

				//commented for test
				/*$this->db->set('esc1', NULL);
				$this->db->set('esc2', NULL);
				$this->db->set('esc3', NULL);
				$this->db->set('esc4', NULL);
				$this->db->set('esc5', NULL);
				$this->db->set('esc6', NULL);
				$this->db->set('esc7', NULL);
				$this->db->where('chainesc_id', $id_chainesc);
				$this->db->update('chaine_escalade');*/

				// $this->db->update('chaine_escalade', $null_data, "chainesc_id = ".$id_chainesc);
				var_dump('Model update_chainesc_groupe_de_sout entering');
				$all_chainesc = $this->getall_chains_esc();

				//delete all existing group escalation chain in order to update
				foreach ($all_chainesc as $chainesc) {
					# code...
					if ($chainesc->chainesc_groupesout_id == $update_groupesout_id) {
						# code...
						var_dump('to be thrown ');
						$id_chainesc_to_delete = $chainesc->chainesc_id;
						$this->db->where('chainesc_id', $id_chainesc_to_delete);
		    			$this->db->delete('chaine_escalade');
					}
				}

		        $count = 0;
		    	foreach ($groupesout_chainesc_data as $groupesout_chainesc_info => $info) {
		    		
		    		if ($count == 0) {

		    			//the chain name is at the zero index
		    			//adding to the data array, to send to the database
		    			$data['chainesc_description'] = $info;

		    		}else{

		    			//parcour du tableau associatif des responsables
		    			foreach ($info as $id => $val) {
		    				
		    				// echo "Responsable".$count." id: ".$val;
		    				$data['esc'.$count] = $val;
		    				//incrementation du compteur
		    				$count++;
		    			}
		    		}
		    		$count++;
		    	}

		    	var_dump('data_groupe_de_sout entering');
		    	$data['chainesc_groupesout_id'] = $update_groupesout_id;
		    	var_dump('data_groupe_de_sout coming out');
		    	// echo count($data);
		    	// $this->db->set($data);
		    	// $this->db->where('chainesc_id', $id_chainesc);
		    	// $this->db->update('chaine_escalade');//, $data, "chainesc_id = ".$id_chainesc);
		    	$this->db->insert('chaine_escalade', $data);
		    }


		    //fonction de sauvegarde des modifications sur un responsable
		    public function responsable_modification($responsable_data, $id_responsable_to_update){
		    	$null_data = array(
							'responsable_nomprenom' => NULL,
							'responsable_fonct' => NULL,
							'responsable_email' => NULL, 
							'responsable_tel1' => NULL, 
							'responsable_tel2' => NULL, 
							'responsable_eds' => NULL, 
							'responsable_disponibilite' => NULL);


		        $this->db->update('responsable', $null_data, 'responsable_id = '.$id_responsable_to_update);
		        $this->db->update('responsable', $responsable_data, 'responsable_id = '.$id_responsable_to_update);
		    }

		    public function delete_responsable($id_responsable_to_delete) {

		    	
		    	$responsables = $this->getall_responsables();

		    	echo '

		    		<table class="table table-striped">

						<thead>

						    <tr>
							    <th>#</th>
							    <th>Nom & prénom</th>
							    <th>Fonction</th>
							    <th>Téléphone</th>
							    <th class="center_data">email</th>
							    <th>EDS</th>
							    <th>Disponibilité</th>
							    <th></th>
						    </tr>
						</thead>

					  	<tbody>
					  	'; 
							$rang = 1;
							foreach ($responsables as $responsable) {
								
								echo '
									<tr>
									    <td style="color:#ff6501;">'.$rang.'- </td>
									    <td class="responsable_nomprenom"><b>'.$responsable->responsable_nomprenom.'</b></td>
									    <td>'.$responsable->responsable_fonct.'</td><input type="hidden" responsable_fonct="'.$responsable->responsable_fonct.'">
									    <td>'.$responsable->responsable_tel1.'<br>'.$responsable->responsable_tel2.'</td>
									    <td>'.$responsable->responsable_email.'</td>
									    <td class="center_data">'.$responsable->responsable_eds.'</td>
									    <td class="center_data">'.$responsable->responsable_disponibilite.'</td>
									    

							   
										<form  method="post" action="'.$site_url.'/administration/membre_groupe_soutien_editing">
											<input type="hidden" name="responsable_nomprenom" value="'.$responsable->responsable_nomprenom.'">
											<input type="hidden" name="responsable_tel1" value="'.$responsable->responsable_tel1.'">
											<input type="hidden" name="responsable_tel2" value="'.$responsable->responsable_tel2.'">
											<input type="hidden" name="responsable_email" value="'.$responsable->responsable_email.'">
											<input type="hidden" name="responsable_eds" value="'.$responsable->responsable_eds.'">
											<input type="hidden" name="responsable_disponibilite" value="'.$responsable->responsable_disponibilite.'">
											<input type="hidden" name="responsable_id" value="'.$responsable->responsable_id.'">

										    <td class="managing_buttons">

										      	<button class="material-icons button edit center_data" title="Modifier"><span class="glyphicon glyphicon-pencil"></span></button>

										      	<button id="delete'.$rang.'" data-toggle="modal" href="#supprimer_responsable'.$rang.'" class="material-icons button delete center_data" title="Supprimer"><span class="glyphicon glyphicon-trash"></span></button>
												
										    </td>
								      	</form>

							      	 </tr>

							      	 <div class="modal fade" id="supprimer_responsable'.$rang.'">

										<div class="modal-dialog">

											<div class="modal-content">

												<div class="modal-header">

													<button type="button" class="close" data-dismiss="modal">x</button>
													<h4 class="modal-title">Confirmation</h4>
												</div>

												<div class="modal-body">
													Voulez-vous vraiment <b>supprimer ce membre</b> ?
												</div>

												<div class="modal-footer">
													<button data-dismiss="modal" id="modifier_responsable" class="btn" >Oui</button>
													<button data-dismiss="modal" id="annuler_modifier_responsable" class="btn" >non</button>
												</div>
											</div>
										</div>
									</div>
								';

								$rang++;
							}

						echo'    
					  	</tbody>
					</table>
		    	';
		    }

		/* ==================================================================================================== */



	    /*==========  								========== *\
					  			DELETE
		\*==========								========== */
    		
    		public function model_delete_chainesc($id_of_chainesc_to_delete){
    			# code...
    			$this->db->where('chainesc_id', $id_of_chainesc_to_delete);
				$this->db->delete('chaine_escalade');
    		}
	}

	
?>