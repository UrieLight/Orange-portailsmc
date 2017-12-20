
<style>
	
	td p{

		padding: 1% 3%;
	}	

</style>


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

		<img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" style="width: initial; height: initial;" />
			
		<span class="admin_module_title" ><b>Nouvelle chaine de soutien de service</b></span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">

		<!-- form validation -->
		<?= validation_errors(); ?>

		
		<form method="POST" action="">
			<!-- DETAILS SUR LE SERVICE ==================== -->
			<!-- CHAINE DE SOUTIEN ==================== -->
			<div class="chaine_sout service_info">

				<div class="page-header">
					<p class="info_title">Chaine de soutien <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
				</div>

				<div class="service_info_content">

				<!-- <form action="" method="post"> already an open form at the begining-->

					<!-- <input class="radiobtn_chaine" type="radio" name="chaine_sout_radiobtn" id="nouvelle_chaine" value="nouvelle_chaine" checked>  -->
					<!-- <label for="nouvelle_chaine"/ --> <h4 style="/*background-color:#eee;"><span class="glyphicon glyphicon-option-horizontal"></span> Nouvelle chaine de soutien </h4><!-- </label> -->
					<br />
					
					<!-- CREATION D'UNE NOUVELLE CHAINE DE SOUTIEN -->
					<div class="nouvelle_chaine_pane" style="margin-left:2%;">
						<br>
						<div>
							<p>Identifiant de la chaine  <sup class="required_field" title="champ obligatoire">*</sup><span class="caret"></span></p>
							<input type="text" required="required" id="nom_chaine" name="nom_chaine" class="form-control" title="De préférence le nom du service associé" style="width: 35%;">
						</div>
						

						<br />
						<span class="btn btn-default glyphicon glyphicon-minus disabled" id="sup_col" style="color: #ff6501;" title="Supprimez une colonne"></span>
						
						<label>Niveaux </label> 
						
						<span class="btn btn-default glyphicon glyphicon-plus" id="ajoute_col" style="color: #ff6501;" title="Ajoutez une colonne"></span>
						

						<br />
						<br>
						<div class="table-responsive" style="margin-bottom: 3%;">

							<!-- <script>
								function autocomplet () {
									 // body...  
								}vRve89
							</script> -->
							<table class="nouvelle_chaine_table table-striped">
								<thead>
									<tr>
										<th id="1">Niveau 1 <span class="required_field" title="champ obligatoire">*</span></th>
									</tr>
								</thead>

								<tbody class="list_respsbl_input">
									<tr>
										<td >
											<br>
											<input required="required" type="text" id="groupesout_sout1" name="groupesout_sout1" class="form-control groupesout_input" ><!-- onkeyUp="autocomplet()" -->
											 
										</td>
									</tr>

									<tr>
										<td><div id="groupesout_list1"></div><!-- style="z-index: 1000;"</td>-->
									</tr>
								</tbody>
							</table>
						</div>
						
						
						<!-- bouton "Enregistrez" de creation de la chaine de soutien -->
						<!-- <span id="creer_chaine_sout" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez la chaine de soutien">
						
							<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
							Enregistrer 
						</span> -->
						<span id="bouton_confirmtn_creation_chainesout" data-toggle="modal" href="#safe_service_validation_chainesout" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez cette chaine de soutien">
						
							<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
							Enregistrer 
						</span>



						<div class="modal fade" id="safe_service_validation_chainesout">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header">

										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Confirmation</h4>
									</div>

									<div class="modal-body">
										Vous allez créer une <b>nouvelle chainde de soutien</b>. Confirmez vous ces informations ?
									</div>

									<div class="modal-footer">
										<button data-dismiss="modal" id="creer_chaine_sout" class="btn" >Oui</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				
				</div>
			</div>
		</form>
		
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
							Chaine de soutien créée avec succès.
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

		<!-- Boite modale de dialogue, champ vides -->
		<div class="modal fade" id="champ_vides">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>WARING</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							Veuillez remplir tous les champs.
						</p>
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="Ext_chaine_esc_termine" class="btn" >Ok</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
