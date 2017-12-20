<h2>Plate forme cree avec succes</h2>
<!-- PLATES-FOREMES DU SERVICE -->
<div class="info_content" id="plateforme">
	
	<table class="table-bordered table-hover table-striped">
		
		<thead>

			<th>Identifiant</th>
			<th>Constructeur</th>
			<th>Localisation</th>
		</thead>

		<tbody style="text-align: center; ">

			<?php 

				$id_pltform = 1;
				//parcours de la table service-platesformes
				foreach ($service_plateformes as $srv_pltfrm) {
					//si le service match avec une plate-forme, on va chercher 
					// la plate-forme dans la table des plates-formes
					if($service->service_id == $srv_pltfrm->sp_service_id){

						foreach ($platesformes as $plateforme){

							if ($plateforme->plateforme_id == $srv_pltfrm->sp_plateform_id){
								
								echo '
									<tr>
										<td><span  data-toggle="modal" href="#'.implode('', explode(' ', trim($service->service_nom))).$id_pltform.'" class="chaines_platesformes" style="cursor: pointer;">'.$plateforme->plateforme_nom.'</span></td>
										<td>'.$plateforme->constructeur.'</td>
										<td>'.$plateforme->plateforme_location.'</td>
									</tr>';

								$id_pltform ++;
							}
						}
					}
				}
				
			?>
		</tbody>
	</table>
	
	<!-- CHAINES DE SOUTIEN ET D'ESCALADES DES PLATES-FORMES EN FENÊTRES MODALES -->

	<h1>Chaines de soutien</h1>
	
	<?= foreach($chaines_sout as $chaine_sout): ?>  

		
												<table class="table-bordered table-responsive">

													<thead>
														<!-- want to stop when the id of the chain support matches with the one in the service  -->';
														
														foreach ($chaine_sout_service as $chainesout){
															//stops when the id of the chain support matches with the one in the service
															if($chainesout->chainesout_id == $plateforme->plateforme_chainesout_id){

																$niv = 1;//chain support level
																$chain_level = "chainesout_niv".$niv;
																$normal = true;//to display the text "normal" in the first column

																// == HEAD OF TABLE DISPLAYING ==
																while (!is_null($chainesout->$chain_level) AND $niv<=7) {
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
																	

																	foreach ($responsables as $resp){
																		// var_dump($count);
																		if ($resp->responsable_id == $chainesout->$chain_level) {

																			include 'includings\catalogue\responsables_fetching_and_filling.php';

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
														
													echo '</thead>

													<tbody>

													</tbody>
												</table>
											</div>

											<!-- chaine(s) d\'escalade(s) -->
											<div class="pltfrm_che plateforme_chaines_tab">

												<br>
												<ul  style="font-size: 16px; list-style: none;">
													<li><img src="'.$root_path.'/img/content/escalade.png" alt="escalade"><b style="color: #ff6501;"> Chaine(s) d\'escalade(s)</b></li>
												</ul><br />';

												
														
														//parcours de la table de la chaine d'escalade
														foreach ($chaine_esc_service as $chainesc) {

															//stops when the id of the chain escalation matches with the one in the plateform chain support, meaning that 
															//the escalation chain is linked to the chain support of the platform
															if($chainesc->chainesc_chainesout_id == $plateforme->plateforme_chainesout_id){

																$niv = 1;//chain escalation level
																$esc_level = "esc".$niv;

																//printing the chain support level
																echo '<ul>
																		<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>
																	 </ul>';

															echo '<table class="table-bordered table-responsive">

																	<thead>';
																/* == HEAD OF TABLE DISPLAYING ==*/

																while (!is_null($chainesc->$esc_level) AND $niv<=7) {
																	
																	echo '<th style="background-color: #74dcff;">Escalade '.$niv.'</th>';

																	$niv++;
																	$esc_level = "esc".$niv;//updating the chain escalation level
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

																			include 'includings\catalogue\responsables_fetching_and_filling.php';

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
																	';
															}
														}

												echo '
											</div>
										</div>
									</div>
								</div>
							</div>';

					
	<?= endforeach(); ?>
</div>