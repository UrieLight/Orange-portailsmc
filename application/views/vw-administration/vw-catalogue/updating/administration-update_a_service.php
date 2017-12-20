<style>
	
	/* grisage des boutons d'enregistrement des modifications */
	.button_save_update{

		border: 1px solid black;
		background-color: lightgrey;
		margin-left: 2%;
	}

</style>
<!-- ================ 	CONTENU DU FORMULAIRE DE MISE A JOUR D'UN SERVICE ================	-->

<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>


<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration" />
		</div>
		
		<div class="content_title"><h2> Administration</h2></div>
	</div>
	

	<!-- admin module header -->
	<div class="admin_module container-fluid">

		<img src="<?= $root_path ?>/img/content/service_default_ico.png" alt="admin_module_img" />
			
		<span class="admin_module_title" >Modifier un service</span>
	</div>

	<!-- admin module content -->
	<div class="service_form container">

		<!-- Entête de la page de modification d'un nouveau service -->
		<br>
		<p><b>Sélectionnez le service à modifier</b> <span class="caret"></span></p>
		<select name="list_of_services_to_update" id="list_of_services_to_update" class="form-control" style="width:30%;">
			<option value=""></option>
			<?php 

				foreach ($all_services as $service) {
					
					echo '<option id="'.$service->service_id.'" value="'.$service->service_nom.'" service_desc="'.$service->service_desc.'" id_chainesout="'.$service->service_chainesout_id.'">'.$service->service_nom.'</option>';
				}
			?>
			
		</select>

		<br>
		<br>
		
		<!-- update des identifiants du service -->
		<div style="/*margin:2% 4% 0 10%;" class="service_info">
		
			<div class="identifican_service page-header">
				<p class="info_title"><b>Modifier l'identifiant du service</b> <img src="<?= $root_path ?>/img/content/plateforme.png" alt="identifiant_img" /></p>
			</div>

			<div class="service_info_content" style="width: 80%;margin: 0 auto;">

				<div class="service_img ">

					<label>
						<img class="btn thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/new_img2.png" alt="img-service" />
						<!-- <input type="file" style="display:none;"> -->
					</label>
				</div>
				
				<div class="service_name">
					
					<!-- <input type="text" name="name_of_the_service_to_update" id="name_of_the_service_to_update" placeholder="Nom du service" class="form-control" /> -->
					<!-- Nouveau nom de service -->
					<span>
						<input type="text" name="service_name" id="service_name" placeholder="Nouveau nom du service" class="service_name form-control new_service_name" style="width:145%;"/>
					</span>
					
					<p style="margin-left:6%" id="service_list"></p>
				</div>
				
				<blockquote class="service_description">
					<!-- <textarea title="Description du service" id="service_desc" class="form-control" name="service_desc" placeholder="Description du service" cols="30" rows="3"><= $all_services[0]->service_desc; ?></textarea><!-- je met la description du premier service, puisque c'est le premier qui apparait dans la liste -->
					<textarea title="Description du service" id="service_desc" class="form-control" name="service_desc" placeholder="Description du service" cols="30" rows="3"></textarea><!-- je met la description du premier service, puisque c'est le premier qui apparait dans la liste -->
				</blockquote>
			</div>
			<br>
			<br>
			<br>
			<!-- bouton de sauvegarde des modifications sur les identifiants de la chaine de soutien -->
			<!-- <span id="save_service_identifiers_updates" class="button_save_update btn glyphicon glyphicon-ok title="Enregistrer ces modifications" disabled ></span> -->
		</div>
		
		<br />
		<br />
		<br />

		<!-- DETAILS SUR LE SERVICE ==================== -->
		<!-- CHAINE DE SOUTIEN ==================== -->
		<div class="chaine_sout service_info">

			<div class="page-header">
				<p class="info_title"><b>Modifier/chaine de soutien</b> <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
			</div>

			<div class="service_info_content">
				
				<br>
				<ul style="margin-left: -1em;">
					<li>Sélectionnez une chaine de soutien existante
					<span id="refresh_chainsout_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
					</li>
				</ul>

				
				<div class="chaine_select_pane" style="/*display: none;*/">

					<select id="select_chaine_sout" name="select_chaine_sout" class="form-control" style="width: 50%;margin: 0 2%;" >
						
						<!-- <option selected="selected" value="" disabled> Sélectionnez une chaine de soutien </option> -->
						<option selected="selected" value=""></option>
						
						<?php foreach ($all_chaines_soutien as $chaine_soutien): ?>

							<option value="<?= $chaine_soutien->chainesout_nom ?>" id="<?= $chaine_soutien->chainesout_id ?>" >

								<!-- id de la chaine de soutien selected -->
								<!-- <span style="display: none;"></span> -->

								<!-- nom de la chaine de soutien selected -->
								<?= $chaine_soutien->chainesout_nom ?>
							</option>
						<?php endforeach; ?>
					</select>

					<!-- ici, s'affichera le tableau (hidden by default) de la chaine de soutien qui sera choisie -->
					<div id="selected_chainsout" style="overflow: auto;"></div>
					
					<br>
					<em><a target="_blank" class="lien_externe_creation" href="<?= $site_url; ?>/Administration/nouvelle_chaine_soutien" style="float: right;">Créez une nouvelle chaine de soutien<span class="glyphicon glyphicon-triangle-right"></span></a></em>
				</div>
				<!-- </form> -->
			</div>
			
			<br>
			<br>
			<!-- bouton de modification de la chaine de soutien du service -->
			<!-- <span id="save_service_chainsout_update" class="button_save_update btn glyphicon glyphicon-ok title="Enregistrer cette modification" disabled ></span> -->
		</div>
		
		<br />
		<br />
		<br />


		<!-- Plates-formes ==================== -->
		<div class="plateformes service_info">

			<div class="plateformes page-header">
				<p class="info_title"><b>Modifier/Plates-formes</b> <img src="<?= $root_path ?>/img/content/plateforme.png" alt="plateforme_img" /></p>
			</div>

			<div class="service_info_content">

				<!-- <form action="" method="post">  already an open form at the begining-->

					<ul>
						<li>Sélectionnez une ou plusieurs Plates-formes 
							<span class="glyphicon glyphicon-info-sign" title="Maintennez la touche 'Ctrl' pour une sélection muliple"></span>
							<span id="refresh_platesformes_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
						</li>
					</ul>
					
					

					<select name="plateformes" id="plateformes" multiple class="form-control" style="width: 50%; margin-left: 2em;">
						
						<option value="" id="">Aucune</option>
						
						<?php foreach ($all_platesformes as $plateforme): ?>

							<option value="<?= $plateforme->plateforme_nom ?>" id="<?= $plateforme->plateforme_id ?>" >
								<?= $plateforme->plateforme_nom ?>
							</option>

						<?php endforeach; ?>
					</select>						
				<!-- <button type="button" class="btn btn-success" id="validated_pltform" value="Valider" title="Validez votre sélection" style="width: 10em; margin-left: 2em; font-style: helvetica;"> Valider <span class="glyphicon glyphicon-ok-sign"></span></button> -->
				<br>

				<em><a target="_blank" class="lien_externe_creation" href="<?= $site_url; ?>/Plateforme/new_plateforme" style="float: right;">Créez une nouvelle plate-forme<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
			
			<br>
			<br>
			<!-- bouton de modification des la liste des plates-formes du service -->
			<!-- <span id="save_service_platformlist_updates" class="button_save_update btn glyphicon glyphicon-ok title="Enregistrer ces modifications" disabled ></span> -->
		</div>
		<br />
		<br />
		<br />


		<!-- Outils ==================== -->
		<!-- <div class="outils service_info">
		
			<div class="outils page-header">
				<p class="info_title"><b>Modifier/Outils de supervision</b> <img src="<= $root_path ?>/img/content/outil.png" alt="outil_img" /></p>
			</div>
		
			<div  class="service_info_content">
		
				<ul>
					<li>Sélectionnez un ou plusieurs outils 
						<span class="glyphicon glyphicon-info-sign" title="Maintennez la touche 'Ctrl' pour une sélection muliple"></span>
						<span id="refresh_outils_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
					</li>
				</ul>
		
				code dynamique php, recuperation des outils dans la BD
				<select name="outil" id="outil" multiple size="5" class="form-control" style="width: 50%; margin-left: 2em;">
					<option value="" id="">Aucun</option>
					
					<php foreach ($all_outils as $outil): ?>
		
						<option value="<= $outil->outil_nom ?>" id="<= $outil->outil_id ?>" >
							<= $outil->outil_nom ?>
						</option>
						
					<php endforeach; ?>
				</select>
		
				<br>
		
				<em><a href="<= $site_url; ?>/Outil/new_outil_form" target="_blank" class="lien_externe_creation" style="float: right;">Créez un nouvel outil de supervision<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
			
			<br>
			<br>
			bouton de modification des outils de sup du service
			<span id="save_service_toolslist_updates" class="button_save_update btn glyphicon glyphicon-ok title="Enregistrer ces modifications" disabled ></span>
		</div> -->
		<br />
		<br />
		<br />

		<!-- Architecture ==================== -->
		<div class="architecture service_info">

			<div class="outils page-header">
				<p class="info_title"><b>Modifier/Architecture</b> <img src="<?= $root_path ?>/img/content/architecture.png" alt="architecture_img" /></p>
			</div>	

			<div class="service_info_content" style="margin: 0 2%;">
				
				
				<div>

					<ul>
						<li>
							Sélectionnez une architecture
						</li>
					</ul>
					
					<span id="refresh_architectur_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
				</div>

				<select name="architectur_select" id="architectur_select" class="form-control" style="width: 50%;margin: 0 2%;">
					<option selected="" value=""></option>

					<?php foreach ($all_architectures as $architecture): ?>

						<option value="<?= $architecture->architectur_nom_srvc ?>" id="<?= $architecture->architectur_id ?>" >
							<?= $architecture->architectur_nom_srvc ?>
						</option>

					<?php endforeach; ?>
				</select>

				<em><a target="_blank" href="<?= $site_url; ?>/Administration/create_new_architecture" class="lien_externe_creation" style="float: right;">Créez une nouvelle architecture<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
			
			<br>
			<br>
			<!-- bouton de modification de l'architecture du service -->
			<!-- <span id="save_service_architecture_updates" class="button_save_update btn glyphicon glyphicon-ok title="Enregistrer cette modification" disabled ></span> -->
		</div>
		
		<!-- Confirmation de création d'un service -->

		<span data-toggle="modal" id="bouton_confirmtn_modification_service" href="#safe_service_validation_creation" class="btn fin_de_creation" title="Enregistrer les modifications apportées à ce service"><span class="glyphicon glyphicon-save" style="color: black;"></span> Enregistrer</span>

		<div class="modal fade" id="safe_service_validation_creation">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title"><b>Confirmation</b></h4>
					</div>

					<div class="modal-body">
						Vous allez <b>modifier ce service</b>. Confirmez vous les nouvelles données ?
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="update_service" class="btn" >Oui</button>
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
					Service modifié avec succès.
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