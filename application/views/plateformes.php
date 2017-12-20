<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

	.service_info img {
	    float: none;
	}

</style>

<span id="site_url" site_url="<?= $site_url; ?>" style="visibility: hidden;"></span>
<!-- ================ 	CONTENU DU CATALOGUE ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><img class="img-responsive" src="<?= $root_path ?>/img/content/plateform_and_systems.png" alt="plateform_and_systems-img" style="width: 35px;" /></div>
		
		<div class="content_title"><h2> Plates-formes & Systèmes <span class="badge" title="<?= $nbr_platesformes; ?> Plates-formes enregistrées">(<?= $nbr_platesformes; ?>)</span></h2></div>

		<div class="search_field" style="float: right;">

			<input id="recherche_plateforme" class="input-sm form-control recherche_plateforme" type="text" style="width:180px; margin-top: 1.7em; font-style: italic; display: inline-block;  vertical-align: middle;" placeholder="Rechercher une plate-forme">

			<button  class="btn btn-primary btn_recherche recherche_plateforme"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>

	<span title="Remonter vers le haut"><img id="scroll" src="<?= $root_path ?>/img/content/top.png" alt="top"></span>

	<!-- SERVICE -->
	<div id="bloc_service">
		<?php $rang_plateforme = 1; ?><!-- Rang (pour le dénombrement des services) -->	
		<?php foreach ($platesformes as $plateforme): ?>
			
			<input type="hidden" id="rang_plateforme" value="<?= $rang_plateforme; ?>" />

			<div class="plateformes">

				<div class="service_head container-fluid "> 

					<div class="plateforme_img ">	
						<img class="img-rounded img-responsive img_plateforme" src="<?= $root_path ?>/img/content/plateform_img.png" alt="img-plateforme" />
					</div>

					<span style="font-size: 20px;">
						<strong class="plateforme_name"><?= $plateforme->plateforme_nom; ?></strong>
					</span>

					<blockquote class="plateforme_info">
						<small title="Description"><?= ucfirst($plateforme->plateforme_description); ?></small>
						<br>
						<small title="URL de connexion">URL: <span style="color: #0875d2;"><?= $plateforme->plateforme_adress; ?></span><a target="_blank" href=""></a></small>
					</blockquote>
				</div>



				<!-- INFORMATIONS SUR LA PLATEFORME OU LE SYSTEME: CHAINES DE SOUTIEN ET D'ESCALADE, OUTILS, ET SERVICES MAYBE -->
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

							
							<!-- 
							<li role="presentation">
								<a class="onglet_info" href="#plateforme" data-toggle="tab">
									<img src="<= $root_path ?>/img/content/plateforme.png" alt="plateforme_img" /> Plates-formes
								</a>
							</li> -->

							<!-- <li role="presentation">
								<a class="onglet_info" href="#outil" data-toggle="tab">
									<img src="<= $root_path ?>/img/content/outil.png" alt="outil_img" /> Outils de supervision
								</a>
							</li> -->

							<!-- <li role="presentation">
								<a class="onglet_info" href="#architecture" data-toggle="tab">
									<img src="<= $root_path ?>/img/content/architecture.png" alt="architecture_img" /> Architecture
								</a>
							</li> -->
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
								if($chainesout->chainesout_id == $plateforme->plateforme_chainesout_id){
									
									// $id_chainesout_service = $service->service_chainesout_id;

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

												echo '
													<td>
														<span data-toggle="modal" id="" href="#chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_plateforme.'" class="" title="">
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

											// if ($chainesc->chainesc_groupesout_id == $groupesout_id) {
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
										
														<div class="modal fade" id="chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_plateforme.'">

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

												$niv = 1;//chain escalation level
												$esc_level = "esc".$niv;

												//printing the chain support level
												// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>


												echo '<ul style="/*display: none;*/" class="niveau_soutien">
														<!--li>'.$chainesc->chainesc_description.'</li-->

														<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc_temp->chainesc_description).'</li>
													 </ul>';

												echo '<table class="table-striped table-bordered table-responsive table-hover" id="chainesc">

													<thead>';
													
												/* == HEAD OF TABLE DISPLAYING ==*/

												while (!is_null($chainesc->$esc_level) AND $niv<7) {
													
													$nivo = $niv-1;
													echo '<th style="background-color: #74dcff;">Escalade '.$nivo.'</th>';
													//echo '<th style="background-color: #74dcff;">Escalade '.$niv.'</th>';

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
																		$nom_resp = $resp->responsable_nomprenom;

																		if (substr($nom_resp, 0, 1) == '*') {
																			
																			$nom_resp = substr($nom_resp, 1);
																		}
																		
																		new_line_for_nw_rsp_info($nom_resp);
																		echo '</b>';
																		//affichage de la fonction si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																			# code...
																			echo '<span class="fonction_responsable">';
																			new_line_for_nw_rsp_info($resp->responsable_fonct);						
																		}

																		//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																			# code...
																			echo '<span class="tel1">';
																			new_line_for_nw_rsp_info($resp->responsable_tel1);					
																		}

																		//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																			# code...
																			echo '<span class="tel2">';
																			new_line_for_nw_rsp_info($resp->responsable_tel2);
																		}

																		//affichage de responsable_email si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																			# code...
																			echo '<span class="email">';
																			new_line_for_nw_rsp_info($resp->responsable_email);																											
																		}

																		//affichage de la dispo si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																			# code...
																			echo '<span class="disponibility">';
																			new_line_for_nw_rsp_info($resp->responsable_disponibilite);
																		}

																		//affichage de la EDS si ce n'est pas vide, pour ne pas 
																		//inserer des <br> inutilement
																		// echo 'eds: ';
																		// var_dump($resp->responsable_eds);
																		if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																			# code...
																			echo '<span class="eds"> EDS: ';
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

												/*
												echo '
																</div>
															</div>
														</div>
													</div>
												</div>';*/
											}
										}

									// }//test,19/099/8h8

									$indice_groupesout_ids_array++;
								}
								
								// echo div X 5


								// $indice_groupesout_ids_array++;//test,19/099/8h8
							// }//test,19/099/8h8

							// $indice_groupesout_ids_array = 1;
							$groupesout_array_ids = null;
						?>
						
						<!-- OUTILS DE SURPERVISION DU SERVICE -->
						<div class="info_content" id="outil">
							
							<table class="table table-bordered table-striped">
								
								<thead>

									<th style="background:#4fd592"><b>Identifiant de l'outil</b></th>
									<!-- <th style="background:#4fd592"><b>Description</b></th> -->
								</thead>

								<tbody>
								<?php 

									//parcours de la table service-plates-formes
									/*foreach ($outils as $outil) {
										//si le service match avec une plate-forme, on va chercher 
										// la plate-forme dans la table des plates-formes
										if($plateforme->plateforme_outil_supervision == $outil->outil_id){

											foreach ($outils as $outil){

												if($outil->outil_id == $srv_outil->so_outil_id){
													echo '
														<tr>
															<td style="text-align: center;">'.$plateforme->plateforme_outil_supervision.'</td>
															
														</tr>';
												}//<td><em>'.$outil->outil_desc.'</em></td>
											}
										}
									}*/
									echo '
										<tr>
											<td style="text-align: center;">'.$plateforme->plateforme_outil_supervision.'</td>
											
										</tr>';

								?>
								</tbody>
							</table>
						</div>
						
						<!-- SERVICES DE TRANSIT -->
						<div class="info_content" id="architecture" align="center"><!-- id="architecture" -->
							
							<div class="diagrammes" rang="<?= $rang_plateforme; ?>" id="architecture<?= $rang_plateforme; ?>" ></div><!-- style="margin:2% auto; width:500px; height:250px; background-color: #DAE4E4;" -->
							<!-- <p>Aucune architecture pour ce service !!</p>
							<span></span> -->
						
							<?php 

								// $id_pltform = 1;
								//parcours de la table architecture
								/*
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
								*/
							?>
						</div>	
					</div>
				</div>
			</div>
			
			<?php $nbr_de_niveau_de_soutien = 0; ?>
			<?php $rang_plateforme++; ?>
		<?php endforeach; ?>
	
		<?php $rang_plateforme--; ?>
		<input id="nbr_total_service" type="hidden" value="<?= $rang_plateforme; ?>" />
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