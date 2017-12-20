<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

	.table {
	    width: 90%;
	    max-width: 100%;
	    margin: 0 auto 25px;
	}

</style>

<span id="site_url" site_url="<?= $site_url; ?>" style="visibility: hidden;"></span>
<span id="famille_des_services" famille="<?= $service_family_caracter; ?>" style="visibility: hidden;"></span>

<!-- ================ 	CONTENU DU CATALOGUE ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><a href="<?= $site_url ?>/Services/services_family_page"><img class="img-responsive" src="<?= $root_path ?>/img/content/return_arrow.png" alt="catalog" style="width: 2em; height: 2em; margin-bottom: -0.5em;" /></a></div>
		
		<div class="content_title"><h2> <span class="glyphicon glyphicon-cirle-arrow-left"></span> Catalogue technique des services <span class="badge" title="<?= $nbr_services; ?> Services enregistrés">(<?= $nbr_services; ?>)</span></h2></div>

		<div class="search_field" style="float: right;">

			<input id="recherche_service" class="input-sm form-control recherche_service" type="text" style="width:150px; margin-top: 1.7em; font-style: italic; display: inline-block;  vertical-align: middle;" placeholder="Rechercher un service">

			<button  class="btn btn-primary btn_recherche recherche_service"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>

	<span title="Remonter vers le haut"><img id="scroll" src="<?= $root_path ?>/img/content/top.png" alt="top"></span>

	<!-- SERVICE -->
	<div id="bloc_service">
		<?php $rang_service = 1; ?><!-- Rang (pour le dénombrement des services) -->	
		<?php foreach ($services as $service): ?>
			
			<input type="hidden" id="rang_service" value="<?= $rang_service; ?>" />

			<div class="service">

				<div class="service_head container-fluid "> 

					<div class="service_img ">	
						<img class="img-rounded img-responsive img_service" src="<?= $root_path ?>/img/content/<?= $service->icon_url; ?>" alt="img-service" />
					</div>

					<span style="font-size: 20px;">
						<strong class="service_name"><?= $service->service_nom; ?></strong>
					</span>

					<blockquote class="service_description">
						<small><?= ucfirst($service->service_desc); ?></small>
					</blockquote>
				</div>



				<!-- INFORMATIONS SUR LE SERVICE: CHAINES DE SOUTIEN ET D'ESCALADE, PLATES-FORMES, OUTILS, ARCHITECTURES -->
				<br />
				<br />
				<div class="service_info table-responsive">
					
					<!-- header de la liste des infos du service -->
					<div class="nav_tabs">

						<ul class="nav nav-tabs onglets_info">

							<li role="presentation" class="active">
								<a class="onglet_info" href="#chainesout" data-toggle="tab">
									<img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" />  Chaine de soutien
								</a>
							</li>

							

							<li role="presentation">
								<a class="onglet_info" href="#plateforme" data-toggle="tab">
									<img src="<?= $root_path ?>/img/content/plateforme.png" alt="plateforme_img" /> Plates-formes
								</a>
							</li>

							<!-- <li role="presentation">
								<a class="onglet_info" href="#outil" data-toggle="tab">
									<img src="<= $root_path ?>/img/content/outil.png" alt="outil_img" /> Outils de monitoring ou d'administration
								</a>
							</li> -->

							<li role="presentation">
								<a class="onglet_info" href="#architecture" data-toggle="tab">
									<img src="<?= $root_path ?>/img/content/architecture.png" alt="architecture_img" /> Architecture
								</a>
							</li>
						</ul>
					</div>

					<br />
					<br />
					
					<div class="navs_content">
					
						<!-- TABLEAU CHAINE DE SOUTIEN -->

						<!-- want to stop when the id of the chain support matches with the one in the service  -->
						<?php 

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
					
											echo "<th>Chaine normale</th>";
					
											$normal = false;
											//$next_column = false;//if we pass trough this condition, then we should not display the next column
											$niv++;//incrementing before breaking, to switch to the next level
											$chain_level = "chainesout_niv".$niv;//updating the chain support level
											continue;
										}
										
										$niv--;
										echo "<th>Chaine $niv</th>";

										$niv+= 2;
										$chain_level = "chainesout_niv".$niv;//updating the chain support level

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
									$chain_level = "chainesout_niv".$nbr_resp;//adapting the chain_level variable to the responsable_id changing
									
									while (!is_null($chainesout->$chain_level) AND $count < $niv-1) {//$nbr_resp <= $niv
										

										/*foreach ($responsables as $resp){
											// var_dump($count);
											if ($resp->responsable_id == $chainesout->$chain_level) {
												
												include 'includings\catalogue\responsables_fetching_and_filling.php';

												break;
											}
										}*/
										$nbr_de_niveau_de_soutien++;
										

										foreach ($groupes_sout as $groupe_sout){
											// var_dump($groupe_sout);
											if ($groupe_sout->groupe_de_soutien_id == $chainesout->$chain_level) {
												
												array_push($groupesout_array_ids, $groupe_sout->groupe_de_soutien_id); 
												array_push($groupesout_array_noms, $groupe_sout->groupe_de_soutien_nom); 

												include 'includings\catalogue\groupesout_fetching_and_filling.php';

												$indice_groupesout_ids_array++;//j'me souviens plus très bien, mais j'crois que 
												//j'avais mis ça pour connaître la taille du tableau contenant les ids des groupes de soutien

												break;
											}
										}
										/*echo "array des indices: ";
										var_dump($groupesout_array_ids);*/

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
						?>
							
						

						<!-- TABLEAU CHAINE D'ESCALADE-->
										
						<?php 

							
							$indice_groupesout_ids_array = 1;//j'commence à 1 pour ne pas ajouter 1.
							// var_dump('nbre de niveau de sout: '.$nbr_de_niveau_de_soutien);
							//for ($i=0; $i <$nbr_de_niveau_de_soutien ; $i++) { //pour autant de niveau de soutien qu'il y en a.//test,19/099/8h8
								
								/*echo "tab ids groupes: ";
								var_dump($groupesout_array_ids);*/
								
								foreach ($groupesout_array_ids as $groupesout_id) {//parcours du tableau des ids des groupes de soutiens

									// if ($groupesout_id == $indice_groupesout_ids_array) {
									// if ($groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {//test,19/099/8h8
										# code...

										//pour une nouvelle chaine
										$nombre_de_chaine = 0;//début du comptage à partir de 0 pr éviter les problèmes dans la boucle de comptage du nombre de chaines
										$rang_chaine = 1;
										foreach ($chaines_esc as $chainesc) {

											if ($chainesc->chainesc_groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {

												$chainesc_temp = $chainesc; //Saving the value of the chain, cause it gets modified after the following tests.

												//entete fenetre modale et calcul du nombre de chaines d'escalades
												if ($rang_chaine == 1) {
													#code...

													//calcul du nombre d'occurences de chaines d'escalades d'un groupe
													foreach ($chaines_esc as $chainesc) {
													
														if ($chainesc->chainesc_groupesout_id == $groupesout_array_ids[$indice_groupesout_ids_array-1]) {
															
															$nombre_de_chaine++;
														}
													}
													// echo '<br>nombre de chaine(s) pour ce groupe: '.$nombre_de_chaine;

													//affichage de la fenetre modale uniquement lorsqu'on tombe sur la premiere chaine												
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
												}else
													echo "<hr>";



												// if ($chainesc->chainesc_groupesout_id == $groupe_sout->groupe_de_soutien_id) {


												$niv = 1;//chain escalation level
												$esc_level = "esc".$niv;

												//printing the chain support level
												// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>

												/*echo 'chainesc_temp: ';
												var_dump($chainesc_temp);*/

												// echo '<div style="overflow:auto;">';

												echo '<ul style="/*display: none;" class="niveau_soutien">
														<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc_temp->chainesc_description).'</li>
													 </ul>';

												echo '<table class="table-striped table-bordered table-responsive table-hover" id="chainesc">

													<thead>';
													
												/* == HEAD OF TABLE DISPLAYING ==*/

												while (!is_null($chainesc_temp->$esc_level) AND $niv<7) {
													
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

												while (!is_null($chainesc_temp->$esc_level) AND $count < $niv-1) {//$nbr_resp <= $niv
													
													foreach ($responsables as $resp){
														// var_dump($count);
														if ($resp->responsable_id == $chainesc_temp->$esc_level) {

															echo '
																<td>
																	<p name="info_responsable"><b>';
																		//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';
																		
																		//removing the * at the begining of the name
																		$nom_resp = $resp->responsable_nomprenom;

																		if (substr($nom_resp, 0, 1) == '*') {
																			
																			$nom_resp = substr($nom_resp, 1);
																		}

																		new_line_for_nw_rsp_info($nom_resp);
																		// new_line_for_nw_rsp_info($resp->responsable_nomprenom);
																		echo '</b>';
																		
																		//affichage de la fonction si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																			# code...
																			// echo '<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br /><br />';
																			echo '<span class="fonction_responsable">';
																			new_line_for_nw_rsp_info($resp->responsable_fonct);															
																		}

																		//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																			# code...
																			// echo '<span class="tel1">'.$resp->responsable_tel1.'</span><br /><br />';
																			echo '<span class="tel1">';
																			new_line_for_nw_rsp_info($resp->responsable_tel1);																
																		}

																		//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																			# code...
																			// echo '<span class="tel2">'.$resp->responsable_tel2.'</span><br /><br />';
																			echo '<span class="tel2">';
																			new_line_for_nw_rsp_info($resp->responsable_tel2);																
																		}

																		//affichage de responsable_email si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																			# code...
																			// echo '<span class="mail">'.$resp->responsable_email.'</span><br /><br />';
																			echo '<span class="email">';
																			new_line_for_nw_rsp_info($resp->responsable_email);															
																		}

																		//affichage de la dispo si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																			# code...
																			// echo '<span class="disponibility">'.$resp->responsable_disponibilite.'</span><br />';
																			echo '<span class="disponibility">';
																			new_line_for_nw_rsp_info($resp->responsable_disponibilite);	
																		}

																		//affichage de la EDS si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		// echo 'eds: ';
																		// var_dump($resp->responsable_eds);
																		if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																			# code...
																			// echo '<span class="eds"> EDS: '.$resp->responsable_eds.'</span>';
																			echo '<span class="eds">';
																			new_line_for_nw_rsp_info($resp->responsable_eds);	
																		}

																	echo '</p>
																</td>
																';

															//include 'includings\catalogue\groupesout_fetching_and_filling.php';

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

												//bouclage de la fenetre modale
												if ($rang_chaine == $nombre_de_chaine) {
													# code...
													echo '
																	</div>
																</div>
															</div>
														</div>
													</div>';
												}else
													$rang_chaine++;//fin d'affichage d'une chaine d'escalade
												
											}
										}

									// }//test,19/099/8h8

									$indice_groupesout_ids_array++;
								}

							// $indice_groupesout_ids_array = 1;
							$groupesout_array_ids = null;
						?>
						 
						<!-- PLATES-FORMES DU SERVICE -->
						<div class="info_content" id="plateforme">
							
							<table class="table table-bordered table-hover table-striped">
								
								<thead>

									<th>Identifiant</th>
									<th>Description</th>
									<th>URL de connexion</th>
								</thead>

								<tbody style="text-align: center; ">

									<?php 

										$id_pltform = 1;
										//parcours de la table service-platesformes
										foreach ($service_plateformes as $srv_pltfrm) {
											//si le service match avec une plate-forme, on va chercher 
											// la plate-forme dans la table des plates-formes
											if($service->service_id == $srv_pltfrm->sp_service_id){

												// echo "ce service a une plateforme: ";

												foreach ($platesformes as $plateforme){

													if ($plateforme->plateforme_id == $srv_pltfrm->sp_plateform_id){
														
														// echo "plateforme existante: ";

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
										
									?>
								</tbody>
							</table>
							
							<!-- CHAINES DE SOUTIEN ET D'ESCALADES DES PLATES-FORMES EN FENÊTRES MODALES -->
							<?php  

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

																									include 'includings\catalogue\groupesout_fetching_and_filling.php';

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
																	<div class="pltfrm_che plateforme_chaines_tab" style="margin: 0 auto 2em;">

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
																			// echo "";

																			//parcours de la table de la chaine d'escalade
																			foreach ($chaines_esc as $chainesc) {
																				
																				if($chainesc->chainesc_groupesout_id == $groupesout_id){

																					$niv = 1;//chain escalation level
																					$esc_level = "esc".$niv;

																					//printing the chain support level
																					echo '
																						<ul>
																							<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc->chainesc_description).'</li>
																						</ul>';

																					echo '<div style="overflow-x: auto;"><table class="table-bordered table-responsive">

																						<thead>';
																					/* == HEAD OF TABLE DISPLAYING ==*/

																					while (!is_null($chainesc->$esc_level) AND $niv<7) {
																						
																						echo '<th style="background-color: #74dcff;">Escalade '.$niv.'</th>';

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

																								// include 'includings\catalogue\responsables_fetching_and_filling.php';
																								echo '
																								<td>
																									<p name="info_responsable">';
																										//<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />';

																										//removing the * at the begining of the name
																										$nom_resp = $resp->responsable_nomprenom;

																										if (substr($nom_resp, 0, 1) == '*') {
																											
																											$nom_resp = substr($nom_resp, 1);
																										}

																										new_line_for_nw_rsp_info($nom_resp);
																										// new_line_for_nw_rsp_info($resp->responsable_nomprenom);
																										// new_line_for_nw_rsp_info($resp->responsable_nomprenom);
																										echo '</b>';
																										
																										//affichage de la fonction si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																											# code...
																											// echo '<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br /><br />';
																											echo '<span class="fonction_responsable">';
																											new_line_for_nw_rsp_info($resp->responsable_fonct);															
																										}

																										//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																											# code...
																											// echo '<span class="tel1">'.$resp->responsable_tel1.'</span><br /><br />';
																											echo '<span class="tel1">';
																											new_line_for_nw_rsp_info($resp->responsable_tel1);																
																										}

																										//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																											# code...
																											// echo '<span class="tel2">'.$resp->responsable_tel2.'</span><br /><br />';
																											echo '<span class="tel2">';
																											new_line_for_nw_rsp_info($resp->responsable_tel2);																
																										}

																										//affichage de responsable_email si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																											# code...
																											// echo '<span class="mail">'.$resp->responsable_email.'</span><br /><br />';
																											echo '<span class="email">';
																											new_line_for_nw_rsp_info($resp->responsable_email);															
																										}

																										//affichage de la dispo si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																											# code...
																											// echo '<span class="disponibility">'.$resp->responsable_disponibilite.'</span><br />';
																											echo '<span class="disponibility">';
																											new_line_for_nw_rsp_info($resp->responsable_disponibilite);	
																										}

																										//affichage de la EDS si ce n'est pas vide, pour ne pas 
																										//inserer des <br> inutilement
																										// echo 'eds: ';
																										// var_dump($resp->responsable_eds);
																										if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																											# code...
																											// echo '<span class="eds"> EDS: '.$resp->responsable_eds.'</span>';
																											echo '<span class="eds">';
																											new_line_for_nw_rsp_info($resp->responsable_eds);	
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
							?>
						</div>
						
						<!-- OUTILS DE SURPERVISION DU SERVICE -->
						<div class="info_content" id="outil" style="display: none;">
							
							<table class="table table-bordered table-striped">
								
								<thead>

									<th style="background:#4fd592"><b>Identifiant de l'outil</b></th>
									<th style="background:#4fd592"><b>Description</b></th>
								</thead>

								<tbody>
								<?php 

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
								?>
								</tbody>
							</table>
						</div>
						
						<!-- ARCHITECTURE DU SERVICE -->
						<div class="info_content" id="architecture" align="center"><!-- id="architecture" -->
							
							<div class="diagrammes" rang="<?= $rang_service; ?>" id="architecture<?= $rang_service; ?>" ></div><!-- style="margin:2% auto; width:500px; height:250px; background-color: #DAE4E4;" -->
							<!-- <p>Aucune architecture pour ce service !!</p>
							<span></span> -->
						
							<?php 

								// $id_pltform = 1;
								//parcours de la table architecture
								foreach ($all_services_architectures as $service_architecture) {
									
									//sotps when we've found a service who has an architecture
									if ($service->service_id == $service_architecture->sa_service_id) {
										
										// $this_service_architecture_id = $service_architecture->sa_architecture_id;

										// echo "ce service dispose d'une architecture!! ";
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
							?>
						</div>	
					</div>
				</div>
			</div>
			
			<?php $nbr_de_niveau_de_soutien = 0; ?>
			<?php $rang_service++; ?>
		<?php endforeach; ?>
	
		<?php $rang_service--; ?>
		<input id="nbr_total_service" type="hidden" value="<?= $rang_service; ?>" />
	</div>
</div>


<?php
	
	//fonction de formatage des infos sur les responsables
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
?>