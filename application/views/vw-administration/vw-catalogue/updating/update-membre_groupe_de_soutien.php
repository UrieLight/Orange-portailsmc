
<style>
	
	td p{

		padding: 1% 3%;
	}	

	table th {
    	
    	background-color: #74dcff;
	}

	/* couleurs des boutons oui et non de la boite modale de confirmation des actions */
	#annuler_modifier_responsable:hover{
										
		background-color: red;
		color: white;
	}

	#modifier_responsable:hover{

		background-color: green;
		color: white;
	}

	/* .entete{
		color: white;
	}
	
	.sorting{
		color: black;
	} */

	

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

		<img src="<?= $root_path ?>/img/administration/resp.png" alt="responsable_img" style="width: 4em;/* height: initial;" />
			
		<span class="admin_module_title" ><b>Modification d'un contact</b></span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">
			
		<!-- ==================== NOUVEAU MEMBRE D'ESCALADE ==================== -->
		<div class="liste_membres">
			<div class="new_membre_escalade service_info">
				
				<!-- en tête du bloc d'info du service -->
				<div class="page-header">
					<p class="info_title"><b>Liste des membres</b> <!-- <img src="<= $root_path ?>/img/administration/resp_title.png" alt="resp_title_img" /> --></p>
				</div>
		
				<div class="service_info_content">

					<table id="tab_list_membres" class="table table-striped">

						<thead>

						    <tr>
							    <th class="entete">#</th>
							    <th class="entete">Nom & prénom</th>
							    <th class="entete">Fonction</th>
							    <th class="entete">Téléphone</th>
							    <th class="center_data entete">email</th>
							    <th class="entete">EDS</th>
							    <th class="entete">Disponibilité</th>
							    <th></th>
						    </tr>
						</thead>

					  	<tbody>
							
							<?php 

								$rang = 1;
								foreach ($responsables as $responsable) {
									
									echo '
										<tr>

										    <td style="color:#ff6501;">'.$rang.'- </td>
										    <td class="responsable_nomprenom"><b>'.$responsable->responsable_nomprenom.'</b></td>
										    <td>'.$responsable->responsable_fonct.'</td>
										    <td>'.$responsable->responsable_tel1.'<br><br>'.$responsable->responsable_tel2.'</td>
										    <td>'.$responsable->responsable_email.'</td>
										    <td class="center_data">'.$responsable->responsable_eds.'</td>
										    <td class="center_data">'.$responsable->responsable_disponibilite.'</td>

								   
											<form  method="post" action="'.$site_url.'/administration/membre_groupe_soutien_editing">
												<input type="hidden" name="responsable_nomprenom" value="'.$responsable->responsable_nomprenom.'">
												<input type="hidden" name="responsable_fonct" value="'.$responsable->responsable_fonct.'">
												<input type="hidden" name="responsable_tel1" value="'.$responsable->responsable_tel1.'">
												<input type="hidden" name="responsable_tel2" value="'.$responsable->responsable_tel2.'">
												<input type="hidden" name="responsable_email" value="'.$responsable->responsable_email.'">
												<input type="hidden" name="responsable_eds" value="'.$responsable->responsable_eds.'">
												<input type="hidden" name="responsable_disponibilite" value="'.$responsable->responsable_disponibilite.'">
												<input type="hidden" name="responsable_id" value="'.$responsable->responsable_id.'">

											    <td class="managing_buttons">

											      	<button class="material-icons button edit center_data" title="Modifier"><span class="glyphicon glyphicon-pencil"></span></button>

											      	<button style="display:none" id="delete'.$rang.'" data-toggle="modal" href="#supprimer_responsable'.$rang.'" class="material-icons button delete center_data" title="Supprimer"><span class="glyphicon glyphicon-trash"></span></button>
													
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

							?>
						    
					  	</tbody>
					</table>
				</div>
		
				<br>
				<br>
		
				<!-- <span id="bouton_confirmtn_creation_responsable" data-toggle="modal" href="#safe_service_validation_creation_responsable" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez ce membre ?">
				
					<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
					Enregistrer 
				</span> -->
			</div>
		
			
		
			<div class="modal fade" id="safe_service_validation_creation_responsable">
		
				<div class="modal-dialog">
		
					<div class="modal-content">
		
						<div class="modal-header">
		
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>
		
						<div class="modal-body">
							Vous allez modifier les données d'un <b> membre de ce groupe</b>. Confirmez vous ces informations ?
						</div>
		
						<div class="modal-footer">
							<button data-dismiss="modal" id="creer_responsable" class="btn" >Oui</button>
						</div>
					</div>
				</div>
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
					Contact modifié avec succès.
				</p>
			</div>

			<div class="modal-footer">
				<button data-dismiss="modal" id="" class="btn" >Ok</button>
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
					Une erreur s'est produite lors <span class="error_event"></span>.<br><span class="erro_message"></span>
				</p>
			</div>

			<div class="modal-footer">
				<button data-dismiss="modal" id="Ext_chaine_esc_termine" class="btn" >Terminer</button>
			</div>
		</div>
	</div>
</div>
