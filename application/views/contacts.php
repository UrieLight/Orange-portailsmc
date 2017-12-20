/*TODO: manger 
*TODO: tenir
*/

<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

	.img_contact{
		/* width: 10%;
		height: 10%; */
		margin-top: 17%;
	}

	/* .contact_name:hover{
		color: #ff6501;
		cursor: pointer;
	} */

</style>

<span id="site_url" site_url="<?= $site_url; ?>" style="visibility: hidden;"></span>
<!-- ================ 	CONTENU DU CATALOGUE ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><img class="img-responsive" src="<?= $root_path ?>/img/administration/Contacts.png" alt="Contacts_img" /></div>
		
		<div class="content_title"><h2> Contacts partenaires & supports <span class="badge" title="<?= $nbr_contacts; ?> Contacts enregistrés">(<?= $nbr_contacts; ?>)</span></h2></div>

		<div class="search_field" style="float: right;">

			<input id="recherche_contact" class="input-sm form-control recherche_contact" type="text" style="width:150px; margin-top: 1.7em; font-style: italic; display: inline-block;  vertical-align: middle;" placeholder="Rechercher un contact">

			<button  class="btn btn-primary btn_recherche recherche_contact"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>

	<span title="Remonter vers le haut"><img id="scroll" src="<?= $root_path ?>/img/content/top.png" alt="top"></span>

	<!-- Contacts -->

	<span title="Remonter vers le haut"><img id="scroll" src="<?= $root_path ?>/img/content/top.png" alt="top"></span>

	<div id="bloc_service">
		<?php $rang_contact = 1; ?><!-- Rang (pour le dénombrement des services) -->	
		<?php foreach ($groupes_sout as $groupe_sout): ?>
			
			<div class="contact">

				<div class="service_head container-fluid "> 

					<div class="contact_img ">	
						<img class="img-rounded img-responsive img_contact" src="<?= $root_path ?>/img/administration/groupe_sout.png" alt="img-contact" />
					</div>

					<span style="font-size: 20px;">
						<strong class="contact_name"><?= $groupe_sout->groupe_de_soutien_nom; ?></strong>
					</span>

					<blockquote class="service_description">
						<small><?= ucfirst($groupe_sout->groupe_de_soutien_details); ?></small>
					</blockquote>
				</div>

				

				<!-- INFORMATIONS SUR LE CONTACT: CHAINES DE SOUTIEN ET D'ESCALADE -->
				<br />
				<br />
				<div class="service_info table-responsive">
					
					<div class="">								

						<!-- TABLEAU CHAINE D'ESCALADE-->
										
						<?php 

							foreach ($chaines_esc as $chainesc) {

								// if ($chainesc->chainesc_groupesout_id == $groupesout_id) {
								if ($chainesc->chainesc_groupesout_id == $groupe_sout->groupe_de_soutien_id) {

									echo "<hr>";

									$niv = 1;//chain escalation level
									$esc_level = "esc".$niv;

									//printing the chain support level
									// echo "<div>";<li>Niveau '.$chainesc->chainesc_chainesout_niv.'</li>

									echo '<div style="overflow: auto;">';
									echo '<ul style="/*display: none;" class="niveau_soutien">
											<li style="color: #ff6501;font-weight:bold;">'.strtoupper($chainesc->chainesc_description).'</li>
										 </ul>';

									echo '<table class="table-striped table-bordered table-responsive table-hover" id="chainesc" style="table-layout:fixed;width:inherit;">

										<thead>';
										
									/* == HEAD OF TABLE DISPLAYING ==*/
									// $niv+=1;
									while (!is_null($chainesc->$esc_level) AND $niv<=7) {
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
									// var_dump('niv: '.$niv);
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

												/*$trimmed_name = trim($resp->responsable_nomprenom);
												$exploded_names = explode('#', $trimmed_name);
												$removed_slashes_names = implode('\n', $exploded_names);
												
												$trimmed_mails = trim($resp->responsable_email);
												$removed_slashes_mails = implode(' ', explode('/', $trimmed_mails));
												$removed_slashes_mails = implode(' ', explode(';', $removed_slashes_mails));
												$exploded_mail = explode(' ', $removed_slashes_mails);*/

												echo '
													<td>
														<p name="info_responsable">
															<span class="nom_responsable"><b>';
															// .implode('\\n', explode('/', trim($resp->responsable_nomprenom))).
															/*foreach ($exploded_names as $one_name) {
																# code...
																echo $one_name;
																echo "<br>";
															}*/
															//echo $resp->responsable_nomprenom.'</b>
															
															/*
															foreach($exploded_names as $resp_info){
																echo $resp_info.'<br>';
															}
															echo '</span><br /><br />';
															*/

															//removing the * at the begining of the name
															$nom_resp = $resp->responsable_nomprenom;

															if (substr($nom_resp, 0, 1) == '*') {
																
																$nom_resp = substr($nom_resp, 1);
															}

															new_line_for_nw_rsp_info($nom_resp);
															echo '</b></span>';
															//echo $removed_slashes_names.'</span><br /><br />';
															
															//affichage de la fonction si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
																# code...
																echo '<span class="fonction_responsable">';//.$resp->responsable_fonct.'</span><br /><br />';
																new_line_for_nw_rsp_info($resp->responsable_fonct);
																echo '</span>';
															}

															//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
																# code...
																echo '<span class="tel1">';//.$resp->responsable_tel1.'</span><br /><br />';
																new_line_for_nw_rsp_info($resp->responsable_tel1);
																echo '</span>';
															}

															//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
																# code...
																echo '<span class="tel2">';//.$resp->responsable_tel2.'</span><br /><br />';
																new_line_for_nw_rsp_info($resp->responsable_tel2);
																echo '</span>';
															}

															//affichage de responsable_email si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
																# code...
																echo '<span class="email">';//.$resp->responsable_email.'</span><br /><br />';	
																new_line_for_nw_rsp_info($resp->responsable_email);
																echo '</span>';
															}

															// echo implode('', explode(' ', trim($resp->responsable_email)));
															/*foreach ($exploded_mail as $one_mail) {
																# code...
																echo $one_mail;
																echo "<br>";
															}*/

															// echo $resp->responsable_email.'</span>';

															//affichage de la dispo si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
																# code...
																echo '<span class="disponibility">';//.$resp->responsable_disponibilite.'</span><br />';
																new_line_for_nw_rsp_info($resp->responsable_disponibilite);
																echo '</span>';
															}

															//affichage de la EDS si ce n'est pas vide, pour ne pas 
															//inserer des <br> inutilement
															// echo 'eds: ';
															// var_dump($resp->responsable_eds);
															if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
																# code...
																echo '<span class="eds"> EDS: ';//.$resp->responsable_eds.'</span>';
																new_line_for_nw_rsp_info($resp->responsable_eds);
																echo '</span>';
															}

															echo '
														</p>
													</td>
													';

												break;
											}
										}

										$count++;
										$nbr_resp++;
										if ($nbr_resp < 8) {
											# code...
											$esc_level = "esc".$nbr_resp;//updating the chain support level
										}
										
									}
									
									// var_dump('count: '.$count);

									echo '
											</tr>
										</tbody>
									</table>';
									
									echo "</div>";
								
								}
							}

						?>
						
					</div>
				</div>
			</div>
			
			<?php //$nbr_de_niveau_de_soutien = 0; ?>
			<?php $rang_contact++; ?>
		<?php endforeach; ?>
	</div>
</div>

<?php

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