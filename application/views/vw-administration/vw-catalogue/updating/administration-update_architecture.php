 
<style>
	.architecture_name{

		display: inline-block;
	    vertical-align: middle;
	    margin-right: 7%;
	    margin-left: 8%;
	    width: 41%;
	}

	.architecture_description{
		display: inline-block;
    	vertical-align: middle;
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

		<img src="<?= $root_path ?>/img/content/architecture.png" alt="architecture_img" style="width: 2%;vertical-align: top;" />
			
		<span class="admin_module_title" >Modificication d'architecture </span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">
		
		<!-- Entête de la page de creation d'un nouveau service -->
		<br>
		<p><b>Sélectionnez l'architecture à modifier</b> <span class="caret"></span></p>
		<select name="list_of_architectures_to_update" id="list_of_architectures_to_update" class="form-control" style="width:30%;">
			<option value=""></option>
			<?php foreach ($all_architectures as $architecture_service): ?>

				<option name="<?= $architecture_service->architectur_nom_srvc ?>" id="<?= $architecture_service->architectur_id ?>" architecture_desc="<?= $architecture_service->architecture_desc ?>" architecture_jsonfile="<?= $architecture_service->file_path ?>">
					<?= $architecture_service->architectur_nom_srvc ?>
				</option>
				
			<?php endforeach; ?>
			
		</select>

		<br>
		<br>
		
		<!-- form validation -->
		
		<?= validation_errors(); ?>

		<?= form_open("Architectures/architectures_update_saving"); ?>
			<!-- ARCHITECTURE ==================== -->
			<div class="architecture service_info" style="display: block;">
				
				<div id="architecture_info" style="margin-bottom:2%;">

					<input type="text" id="architecture_name" name="architecture_name" value="" placeholder="Nouveau nom de l'architecture" class="architecture_name form-control" /><!-- </em> -->
				
					<em><textarea id="architecture_description" class="architecture_description form-control" name="architecture_desc" id="architecture_desc" placeholder="Description de l'architecture" cols="30" rows="3"></textarea></em>
				</div>

				<div class="outils page-header">
					<p class="info_title">Architecture <img src="<?= $root_path ?>/img/content/architecture.png" alt="architecture_img" /></p>
				</div>	

				<div class="service_info_content" style="margin: 0px 60px;">
					
					<!-- <div id="full_palette" class="palette up_block">
							
								
							</div>	 -->		

					<div class="low_block">

						<div id="custom_palette" class="palette">
							<span id="data_array" style="display: none;">

							</span>
						</div>
						
						<input id="id_architecture" type="hidden" value="" />

						<div id="workplace" style="width: 805px; height: 500px;"></div>

						<br>
						<input id="architecture_jsonfile" type="hidden" value="<?= $architecture_service->file_path; ?>">
					</div>
				</div>
			</div>
			

			<!-- Sauvegarde du model du diagramme de l'architecture -->
			<span data-toggle="modal" id="bouton_confirmtn_modification_architecture" 
				href="#safe_service_validation_architecture" 
				class="btn fin_de_creation" 
				title="Enregistrer les modifications effectuées sur cette configuration" 
				style=" /*margin-left: 17%;*/">
					<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
					Terminer
			</span>

			<div class="modal fade" id="safe_service_validation_architecture">
			
				<div class="modal-dialog">
			
					<div class="modal-content">
			
						<div class="modal-header">
			
							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>
			
						<div class="modal-body">
							Vous allez enregistrer les modifications sur cette <b>Architecture</b>. Confirmez-vous cette configuration ?
						</div>
			
						<div class="modal-footer">
							<button data-dismiss="modal" id="save" class="btn" value="Sauvegarder_model">Oui</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
