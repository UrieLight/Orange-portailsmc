
<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration" />
		</div>

		<div class="content_title"><h2> Administration</h2></div>
	</div>

	<!--formulaire de plateforme vide -->
	<!-- admin module header -->
	<div class="admin_module container-fluid">

		<img class="img-reponsive" src="<?= $root_path ?>/img/administration/plateforme.png" alt="admin_module_img" style="width: 2em;vertical-align: top;" />
		<span class="admin_module_title" > Nouvelle plate-forme /Outils</span>

	</div>

	<div class="service_form container">

			<!-- formulaire d'entete du service -->
			<div style="padding-left: 14%;">

				<div class="platform_form">

					<label for="platform_name">Nom de la plate-forme <sup class="required_field" title="champ obligatoire">*</sup><span class="caret"></span></label>
					<input id="platform_nom" type="text" name="platform_nom" class="form-control" set_value="<?= 'platform_nom' ?>" required>
				</div>

				<div class="platform_form" style="vertical-align: top;">

					<label for="">Description<span class="caret"></span></label>
					<!-- <input type="text" id="platform_constructeur" name="pltfrm_const" class="form-control" set_value="<= 'pltfrm_const' ?>"> -->
					<!-- <blockquote class="service_description"> -->
					<textarea id="platform_desc" class="form-control" name="service_desc" placeholder="Description de la plate-forme" cols="25" rows="3"></textarea>
					<!-- </blockquote> -->
					<!-- <select name="pltfrm_equipmt_const" id="" class="form-control"></select/> -->
					<!-- <br> -->

				</div>

				<div class="platform_form" style="/*vertical-align: middle;">

					<label for="outils_supervision_plateforme">URL de connexion<span class="caret"></span></label>
					
					<input type="text" id="platform_adresse" name="pltfrm_const" class="form-control" set_value="<?= 'pltfrm_const' ?>">
				</div>
			<!-- </form> -->

			</div>
			<br />
			
			<?php //include('include-chaines_soutien_et_escalade.php'); ?>
			<div class="chaine_sout service_info">

				<div class="page-header">
					<p class="info_title">Chaine de soutien <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
				</div>

				<div class="service_info_content">

					<br>
					<ul style="margin-left: -1em;">
						<li>Sélectionnez une chaine de soutien existante
						<span id="refresh_chainsout_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
						</li>
					</ul>

					
					<div class="chaine_select_pane" style="/*display: none;*/">

						<select id="select_chaine_sout" name="select_chaine_sout" class="form-control" style="width: 50%;" >
							
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
						<div class="navs_content" id="selected_chainsout" style="overflow: auto;"></div>
						
						<br>
						<em><a target="_blank" class="lien_externe_creation" href="<?= $site_url; ?>/Administration/nouvelle_chaine_soutien" style="float: right;">Créez une nouvelle chaine de soutien<span class="glyphicon glyphicon-triangle-right"></span></a></em>
					</div>
				</div>
			</div>
			

			<span data-toggle="modal" id="bouton_confirmtn_creation_plateforme" href="#safe_plateforme_validation_creation" class="btn fin_de_creation" title="Enregistrer cette plate-forme"><span class="glyphicon glyphicon-save" style="color: black;"></span> Terminer</span>

			<div class="modal fade" id="safe_plateforme_validation_creation">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>

						<div class="modal-body">
							Vous allez créer une <b>nouvelle plate-forme</b>. Confirmez vous ces informations ?
						</div>

						<div class="modal-footer">
							<button  data-dismiss="modal" id="save_plateforme" class="btn" value="Sauvegarder_plateforme" class="btn" >Oui</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
