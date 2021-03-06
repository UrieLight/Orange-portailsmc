
<style>
	
	td p{

		padding: 1% 3%;
	}	

	table th {
    	
    	background-color: #74dcff;
	}

</style>

<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">

			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration_img" />
		</div>
		
		<div class="content_title"><h2> Administration</h2></div>
	</div>

	<!--formulaire de chaine vide -->
	<!-- admin module header -->
	<div class="admin_module container-fluid" style="margin-top: 2%; margin-left:3%;">

		<img src="<?= $root_path ?>/img/administration/group.png" alt="groupe_soutien_img" style="width: initial; height: initial;" />
			
		<span class="admin_module_title" ><b>Modfication d'un groupe</b></span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">

		<!-- ==================== NOUVEAU GROUPE DE SOUTIEN ET CHAINE D'ESCALADE ==================== -->
			
		<div class="new_groupe_de_soutien service_info">
			

			<!-- sélection du groupe de soutien et affichage de celui-ci -->
			<br>
			<br>
			<div>
				<p>Sélectionnez le groupe de soutien à modifier <span class="caret"></span></p>
				<select id="select_groupe_sout_to_update" name="select_groupe_sout_to_update" class="form-control" style="width: 50%;" >
					<option value=""></option>
					<?php 

						foreach ($all_groupes_support as $groupe_support) {
					
							echo '<option id="'.$groupe_support->groupe_de_soutien_id.'" value="'.$groupe_support->groupe_de_soutien_nom.'" pays="'.$groupe_support->groupe_de_soutien_pays.'" disponibilite="'.$groupe_support->groupe_de_soutien_disponibility.'" detail="'.$groupe_support->groupe_de_soutien_details.'">'.$groupe_support->groupe_de_soutien_nom.'</option>';
						}
					?>
				</select>

			</div>


			<br>
			<!-- en tête du bloc d'info du service -->
			<div class="page-header">
				<p class="info_title"><b>Modifier ce groupe de soutien</b> <img src="<?= $root_path ?>/img/administration/group.png" alt="groupe_img" /></p>
			</div>

			<div class="service_info_content">
					
				<!-- s'affiche lorsque la chaine de soutien a été crée >							
				<label for="esc_nouvelle_chaine"> Nouvelle chaine d'escalade </label>-->
				<br /> 
				<!-- <div id="esc_nouvelle_chaine" style="/*display: none;*/"> test-->
					
				<input type="hidden" id="chainesc_chainesout_id" name="chainesc_chainesout_id" value="" />

				<!-- <p>Créez la chaine d'escalade du service</p> -->

				<div class="groupe_de_soutien">
					
					<h4><img src="<?= $root_path ?>/img/content/profile.png" alt="profile_img" style="float: none; margin-left: 1px;"/> <b>Informations sur le groupe</b></h4>
					<br>

					<div class="groupe_soutien_info" style="/*display: inline-block; float: left;">
					  	<label for=""> - Nom du groupe de soutien  <sup class="required_field" title="champ obligatoire">*</sup><span class="caret"></span></label>
						<input id="groupe_nom" type="text" required="required" value="" class=" form-control">
					</div>

					<br>
					<div class="groupe_soutien_info" style="/*display: inline-block; float: left;">
						<label for=""> - Localisation <span class="caret"></span></label>
						<input id="groupe_localisation" type="text" value="" class=" form-control">
					</div>
					
					<br>
					<div class="groupe_soutien_info" style="/*display: inline-block; float: left;">
						<label for=""> - Disponibilité <span class="caret"></span></label>
						<input id="groupe_disponibility" type="text" value="" class=" form-control">
					</div>

					<br>
					<div class="groupe_soutien_info" style="/*display: inline-block; float: left;">
						<label for=""> - Autre(s) infromation(s) <span class="caret"></span></label>
						<!-- <input type="text" value="" class=" form-control"> -->
						<textarea id="groupe_other_info" name="" id="" cols="30" rows="10" class=" form-control"></textarea>
					</div>
					

				</div>

				<hr>
				<br>
				
				<!-- </div> test-->
				
				<!-- ici on affiche la chaine d'escalade associée à la chaine de soutien sélectionnée -->							
				<!-- TABLEAU CHAINE D'ESCALADE-->
				<!-- safe group info update validation -->
					<span id="bouton_confirmtn_modification_groupe_de_sout" data-toggle="modal" href="#safe_service_validation_groupe_de_sout" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez les modifications sur ce groupe de soutien">
				
						<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
						Enregistrer 
					</span>



					<div class="modal fade" id="safe_service_validation_groupe_de_sout">

						<div class="modal-dialog">

							<div class="modal-content">

								<div class="modal-header">

									<button type="button" class="close" data-dismiss="modal">x</button>
									<h4 class="modal-title">Confirmation</h4>
								</div>

								<div class="modal-body">
									Vous allez <b>modifier ce groupe de soutien</b>. Confirmez vous ces informations ?
								</div>

								<div class="modal-footer">
									<button data-dismiss="modal" id="modifier_groupe_de_sout" class="btn" >Oui</button>
								</div>
							</div>
						</div>
					</div>
			</div>	
		</div>
		<br>

		<!-- ici, s'affichera le tableau (hidden by default) de la chaine d'escalade du groupe qui sera choisi -->
		<div id="selected_groupesout" style="overflow: auto;"></div>

		<!-- ajout d'une nouvelle chaine d'escalade, en chaine mais que j'ai deactivated avec le display none -->
		<div class="service_info" style="display: none;"><!-- chaine d'escalade -->
			<div class="page-header">
				<p class="info_title"><b>Modifier la chaine d'escalade du groupe de soutien</b> <img src="<?= $root_path ?>/img/content/escalade.png" alt="escalade_img" /></p>
			</div>

			<div class="service_info_content">
				<div class="chaine_escalade esc_nouvelle_chaine_pane">

					<!-- <h4><img src="<?= $root_path ?>/img/content/escalade.png" alt="escalade_img" style="float: none; margin-left: 1px;"/> </h4> -->
					
					<br>
					<div>
						<p>Description de la chaine <span class="caret"></span></p>
						<input type="text" id="desc_chainesc" name="desc_chainesc" class="form-control" style="width: 35%;">
					</div>

					<br>
					<!-- Liens de creation des membres de la chaine d'escalade du groupe -->
					<br>
					
					<!-- boutons de variation des niveaux d'escalades -->
					<br />
					<span class="btn btn-default glyphicon glyphicon-minus" id="sup_col_esc" style="color: #ff6501;"></span>
					
					<label>Niveaux </label> 
					
					<span class="btn btn-default glyphicon glyphicon-plus" id="ajoute_col_esc" style="color: #ff6501;"></span>
					<br />
					<br />
					

					<!-- TABLEAU DE LA CHAINE D'ESCALADE -->
					<div class="table-responsive">

						<table class="nouvelle_chaine_table table-striped">

							<thead>
								<tr>
									<th id="1">Niveau 1 <span class="required_field" title="champ obligatoire">*</span></th>
								</tr>
							</thead>

							<tbody class="list_respsbl_input esc">
								<tr>
									<td >
										<br>
										<input autocomplete="off" type="text" id="responsable_esc1" name="responsable_esc1" class="form-control respnble_input" ><!-- onkeyUp="autocomplet()" -->
										 
									</td>
								</tr>

								<tr>
									<td><div id="responsable_list1"></div>
								</tr>
							</tbody>
						</table>
					</div>

					<hr>					
					<!-- safe group info update validation -->
					<span id="bouton_confirmtn_modification_chainesc_groupe_de_sout" data-toggle="modal" href="#safe_chainesc_update_validation_groupe_de_sout" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez les modifications sur la chaine d'escalade de ce groupe de soutien">
				
						<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
						Enregistrer 
					</span>



					<div class="modal fade" id="safe_chainesc_update_validation_groupe_de_sout">

						<div class="modal-dialog">

							<div class="modal-content">

								<div class="modal-header">

									<button type="button" class="close" data-dismiss="modal">x</button>
									<h4 class="modal-title"><b>Confirmation</b></h4>
								</div>

								<div class="modal-body">
									Vous allez <b>modifier la chaine d'escalade ce groupe de soutien</b>. Confirmez vous ces informations ?
								</div>

								<div class="modal-footer">
									<button data-dismiss="modal" id="modifier_chainesc_groupe_de_sout" class="btn" >Oui</button>
									<button  data-dismiss="modal" id="" class="btn" >non</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		

		<!-- Modal window for extended escalation chain -->
		<div class="modal fade" id="extended_chain">

			<div class="modal-dialog modal-lg">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title">Ajout de chaine d'escalade</h4>
					</div>

					<div class="modal-body">
						
						<div class="chaine_escalade esc_nouvelle_chaine_pane">

							<h4><img src="<?= $root_path ?>/img/content/escalade.png" alt="escalade_img" style="float: none; margin-left: 1px;"/> Chaine d'escalade du groupe</h4>
							
							<br>
							<div>
								<p>Description de la chaine <span class="caret"></span></p>
								<input type="text" id="Ext_desc_chainesc" name="Ext_desc_chainesc" class="form-control" style="width: 35%;">
							</div>

							<br>
							<!-- Liens de creation des membres de la chaine d'escalade du groupe -->
							<br>
							
							<!-- boutons de variation des niveaux d'escalades -->
							<br />
							<span class="btn btn-default glyphicon glyphicon-minus disabled" id="sup_col_esc" style="color: #ff6501;"></span>
							
							<label>Niveaux </label> 
							
							<span class="btn btn-default glyphicon glyphicon-plus" id="Ext_ajoute_col_esc" style="color: #ff6501;"></span>
							<br />
							<br />
							

							<!-- TABLEAU DE LA CHAINE D'ESCALADE -->
							<div class="table-responsive">

								<table class="nouvelle_chaine_table table-striped">

									<thead>
										<tr>
											<th id="1">Niveau 1 <span class="required_field" title="champ obligatoire">*</span></th>
										</tr>
									</thead>

									<tbody class="list_respsbl_input esc">
										<tr>
											<td >
												<br>
												<input autocomplete="off" type="text" id="Ext_responsable_esc1" name="Ext_responsable_esc1" class="form-control respnble_input" ><!-- onkeyUp="autocomplet()" -->
												 
											</td>
										</tr>

										<tr>
											<td><div id="Ext_responsable_list1"></div>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="Ext_chaine_esc_termine" class="btn" >Terminer</button>
					</div>
				</div>
			</div>
		</div>



		<!-- Boite modale de dialogue, ajouter une chaine d'escalade ou pas? -->
		<div class="modal fade" id="nouvelle_chainesc_modal_dialog_window">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Chaine d'escalade crée avec succès.</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							Voulez-vous ajouter une nouvelle chaine de contacts à ce groupe ?
						</p>
					</div>

					<div class="modal-footer">
						<button  data-dismiss="modal" id="create_new_chainesc_ok" class="btn btn-success" value="" class="btn" >Oui</button>
						<button  data-dismiss="modal" id="discard_create_new_chainesc" class="btn btn-danger" value="" class="btn" >non</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Boite modale de dialogue, message d'erreur -->
		<div class="modal fade" id="error_dialog_window">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>ERROR</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							Une erreur est survenue lors <span class="error_event"></span>.<br><span class="erro_message"></span>
						</p>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="Ext_chaine_esc_termine" class="btn" >Terminer</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Boite modale de dialogue, message de succes de modification des informations sur le groupe -->
		<div class="modal fade" id="success_operation">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Opération réussie</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							Groupe de soutien modifié avec succès.
						</p>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="" class="btn" >Ok</button>
					</div>
				</div>
			</div>
		</div>





		<!-- Modal window for deleting escalation chain -->
		<div class="modal fade" id="delete_chain">

			<div class="modal-dialog modal-lg">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title">Suppression de chaine d'escalade</h4>
					</div>

					<div class="modal-body">
							
						<p>
							Voulez-vous vraiment <b>supprimer</b> cette chaine de contacts ?
						</p>
					</div>

					<div class="modal-footer">
						<button  data-dismiss="modal" id="delete_chainesc_ok" class="btn btn-success" value="" class="btn" >Oui</button>
						<button  data-dismiss="modal" id="discard_delete_chainesc" class="btn btn-danger" value="" class="btn" >non</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="successul_deletion">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Suppression réussie</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							L'opération de suppression de chaine d'escalade s'est déroulée avec succès.
						</p>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="" class="btn" >Ok</button>
					</div>
				</div>
			</div>
		</div>



		<!-- Modal window for adding escalation chain -->
		<div class="modal fade" id="successul_adding">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Ajout réussi</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							L'opération d'ajout d'une nouvelle chaine d'escalade s'est déroulée avec succès.
						</p>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="" class="btn" >Ok</button>
					</div>
				</div>
			</div>
		</div>
		<!-- ==================== NOUVEAU MEMBRE D'ESCALADE ==================== -->
		<!-- <div>
			<div class="new_membre_escalade service_info">
				
				en tête du bloc d'info du service
				<div class="page-header">
					<p class="info_title"><b>Créer un nouveau membre du groupe</b> <img src="<= $root_path ?>/img/administration/resp_title.png" alt="resp_title_img" /></p>
				</div>
		
				<div class="service_info_content">
		
					<h4><img src="<= $root_path ?>/img/content/profile.png" alt="profile_img" style="float: none; margin-left: 1px;"/> <b>Informations sur le membre</b></h4>
					<br>
		
					<div class="membre_escalade" style="width:80%;margin:0 auto;">
						
		
						<div class="responsable_info" style="/*display: inline-block; float: left;">
						  	<label for=""> - Nom & prenom du membre <span class="caret"></span></label>
							<input id="membre_nom_prenom" type="text" required="required" value="" class=" form-control">
						</div>
		
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Fonction <span class="caret"></span></label>
							<input id="membre_fonction" type="text" value="" class=" form-control">
						</div>
						
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Email <span class="caret"></span></label>
							<input id="membre_email" type="mail" value="" class=" form-control">
						</div>
		
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Téléphone 1<span class="caret"></span></label>
							<input type="text" value="" class=" form-control">
							<input id="membre_tel1" name="" class=" form-control">
						</div>
		
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Téléphone 2 <span class="caret"></span></label>
							<input type="text" value="" class=" form-control">
							<input id="membre_tel2" name="" class=" form-control">
						</div>
		
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - EDS <span class="caret"></span></label>
							<input type="text" value="" class=" form-control">
							<input type="number" id="membre_eds" name="" class=" form-control">
						</div>
		
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Disponibilité <span class="caret"></span></label>
							<input type="text" value="" class=" form-control">
							<input id="membre_disponibility" name="" class=" form-control">
						</div>
		
					</div>
				</div>
		
				<br>
				<br>
		
				<span id="bouton_confirmtn_creation_responsable" data-toggle="modal" href="#safe_service_validation_creation_responsable" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez ce membre ?">
				
					<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
					Enregistrer 
				</span>
			</div>
		
			
		
			<div class="modal fade" id="safe_service_validation_creation_responsable">
		
				<div class="modal-dialog">
		
					<div class="modal-content">
		
						<div class="modal-header">
		
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>
		
						<div class="modal-body">
							Vous allez créer un <b>nouveau membre pour ce groupe</b>. Confirmez vous ces informations ?
						</div>
		
						<div class="modal-footer">
							<button data-dismiss="modal" id="creer_responsable" class="btn" >Oui</button>
						</div>
					</div>
				</div>
			</div>
		</div>	 -->
	</div>
</div>
