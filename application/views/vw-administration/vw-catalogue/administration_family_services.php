
<style>
	
	td p{

		padding: 1% 3%;
	}	

</style>

<span style="display: none;" id="site_url"><?= $site_url; ?></span>

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">

			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration_img" />
		</div>
		
		<div class="content_title"><h2> Administration - Famille des services</h2></div>
	</div>

	<!--formulaire de chaine vide -->
	<!-- admin module header -->
	<div class="admin_module container-fluid" style="margin-top: 2%; margin-left:3%;">

		<img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" style="width: initial; height: initial;" />
			
		<span class="admin_module_title" ><b>***</b></span>
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
					<p class="info_title">Familles des services <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
				</div>

				<div class="service_info_content">

				<!-- <form action="" method="post"> already an open form at the begining-->

					<!-- <input class="radiobtn_chaine" type="radio" name="chaine_sout_radiobtn" id="nouvelle_chaine" value="nouvelle_chaine" checked>  -->
					<!-- <label for="nouvelle_chaine"/ --> <h4 style="/*background-color:#eee;"><span class="glyphicon glyphicon-option-horizontal"></span> Nouvelle famille de services </h4><!-- </label> -->
					<br />
					
					<!-- CREATION D'UNE NOUVELLE FAMILLE DE SERVICES -->
					<div class="nouvelle_chaine_pane" style="margin-left:2%;">
						<br>
						<div>
							<p>Nom de la famille  <sup class="required_field" title="champ obligatoire">*</sup><span class="caret"></span></p>
							<input type="text" required="required" id="nom_famille" name="nom_famille" class="form-control" style="width: 35%;" />
							<span id="next"></span>
						</div>
						<br />

						<span id="btn_confirmtn_creation_famille_service" data-toggle="modal" class="btn btn-success" style="font-size: small; /*float:right;" title="Enregistrez cette famille de services">
						
							<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
							Enregistrer 
						</span>


						<div class="modal fade" id="safe_service_validation_famille_service">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header">

										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Confirmation</h4>
									</div>

									<div class="modal-body">
										Vous allez créer la famille de services <b id="id_nom_creation_famille_de_service_boite_dialog"> </b>. Confirmez vous ces informations ?
									</div>

									<div class="modal-footer">
										<button data-dismiss="modal" id="creer_famille_de_service" class="btn" >Oui</button>
									</div>
								</div>
							</div>
						</div>
						<br />
						<br />
						<br />
						
                    	<p>Selectionnez les services à regrouper</p>
						<style type="text/css">
							.dropdown-toggle{
								width: 25.6em;
								overflow-x: auto;
							}

							.multiselect-container{
								padding: 1em;
								width: 25.6em;
							    height: 18em;
							    overflow-y: auto;
							}
						</style>

                        <select id='select_liste_des_services' multiple='multiple' class="form-control" style="width: 5em; display: none;">
						   <?php foreach ($all_services as $service): ?>
							   <option id="<?= $service->service_id; ?>" value="<?= $service->service_id; ?>"><?= $service->service_nom; ?></option>
						   <?php endforeach; ?>
						</select>	
					
						<span id="liste_des_services" data-toggle="modal" href="#btn_for_modal_window_services_families_list" class="btn btn-primary">Associer à une famille</span>

						<div class="modal fade" id="btn_for_modal_window_services_families_list">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header">

										<button type="button" class="close" data-dismiss="modal">x</button>
										<h4 class="modal-title">Familles des services</h4>
									</div>

									<div class="modal-body">
										<div class="family_checkbox">
											<?php foreach ($all_families_services as $famille): ?>
											   <input type="checkbox" name="<?= $famille->famille_id; ?>" />
											   <label for="" style="margin-left: 1em;" famille_id="<?= $famille->famille_id; ?>"  family_caracter="<?= $famille->famille_caracter; ?>" > <?= $famille->famille_name; ?> </label>
											   <br/>

										   <?php endforeach; ?>
										</div>
									</div>

									<div class="modal-footer">
										<button data-dismiss="modal" id="btn_terminer_associer_services_familles" class="btn" >Terminer</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				
				</div>
			</div>
		</form>
		
		<!-- Boite modale de dialogue, message de succes de modification des informations sur la famille -->
		<div class="modal fade" id="success_operation">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Opération réussie</b> </h4>
					</div>

					<div class="modal-body">
						
						<p>
							Famille de services créée avec succès.
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
							Une erreur s'est produite lors <span class="error_event"></span>.<br><span class="error_message"></span>
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
