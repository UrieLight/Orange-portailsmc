
<style>
	
	td p{

		padding: 1% 3%;
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

		<img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" style="width: initial; height: initial;" />
			
		<span class="admin_module_title" ><b>Modifier une chaine de soutien de service</b></span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">
		
		<!-- DETAILS SUR LE SERVICE ==================== -->
		<!-- CHAINE DE SOUTIEN ==================== -->

			

		<br>

		<div class="chaine_sout service_info">
			
			<!-- sélection de la chaine de soutien et affichage de celle- ci -->
			<br>
			<div>
				<p>Sélectionnez la chaine de soutien à modifier <span class="caret"></span></p>
				<select id="select_chaine_sout" name="select_chaine_sout" class="form-control" style="width: 50%;" >
					<option value=""></option>
					<?php 

						foreach ($all_chaines_soutien as $chaine_soutien) {
					
							echo '<option id="'.$chaine_soutien->chainesout_id.'" value="'.$chaine_soutien->chainesout_nom.'" >'.$chaine_soutien->chainesout_nom.'</option>';
						}
					?>
				</select>

				<!-- ici, s'affichera le tableau (hidden by default) de la chaine de soutien qui sera choisie -->
				<div id="selected_chainsout" style="overflow: auto;"></div>
			</div>


			<br>
			<div class="page-header">
				<p class="info_title">Modifiez la chaine de soutien <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
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
							}
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
					</span>bouton_confirmtn_modification_chainesout -->
					<span id="bouton_confirmtn_modification_chainesout" data-toggle="modal" href="#safe_service_validation_chainesout" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez les modifications sur cette chaine de soutien">
					
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
									Vous allez <b>modifier cette chainde de soutien</b>. Confirmez vous ces informations ?
								</div>

								<div class="modal-footer">
									<button data-dismiss="modal" id="update_chaine_sout" class="btn" >Oui</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				
				<!-- Bouton radio pour choisir la selection d'une chaine existante -->
				<!-- <br>
				<hr>
				<br>
				<input class="radiobtn_chaine" type="radio" name="chaine_sout_radiobtn" id="selection_chaine" value="selection_chaine" > 
				
				<label for="selection_chaine" style="background-color:#eee;">Sélectionnez une chaine de soutien existante</label> -->

				<!-- </form> -->
			</div>
		</div>
		
	</div>
</div>
