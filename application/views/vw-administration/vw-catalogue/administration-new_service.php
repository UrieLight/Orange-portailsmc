
<!-- ================ 	CONTENU DU FORMULAIRE DE CREATION D'UN NOUVEAU SERVICE ================	-->

<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>


<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration" />
		</div>
		
		<div class="content_title"><h2> Administration</h2></div>
	</div>
	

	<!--formulaire de service vide -->
	<!-- admin module header -->
	<div class="admin_module container-fluid">

		<img src="<?= $root_path ?>/img/content/service_default_ico.png" alt="admin_module_img" />
			
		<span class="admin_module_title" >Nouveau service</span>
	</div>

	<!-- admin module content -->
	<div class="service_form container">

		<!-- Entête de la page de creation d'un nouveau service -->
		<div style="margin:2% 4% 0 10%;">
		
			<div class="service_img ">

				<label>
					<img class="btn thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/new_img2.png" alt="img-service" />
					<input type="file" style="display:none;">
				</label>

			</div>
			
			<span style="/*display: inline-block;">
				<!-- <label for="" style="/*display: inline-block;">Nom du service <sup class="required_field" title="champ obligatoire">*</sup></label> -->
				<input style="/*display: inline-block;" type="text" name="service_name" id="service_name" placeholder="Nom du service" class="service_name form-control" /> <sup class="required_field" title="champ obligatoire">*</sup>
			</span>
			
			<blockquote class="service_description">
				<textarea class="form-control" name="service_desc" placeholder="Description du service" cols="30" rows="3"></textarea>
			</blockquote>
		</div>
		
		<br />
		<br />
		<br />

		<?php include('include-chaines_soutien_et_escalade.php'); ?>
		
		<br />
		<br />
		<br />


		<!-- Plates-formes ==================== -->
		<div class="plateformes service_info">

			<div class="plateformes page-header">
				<p class="info_title"><b>Plates-formes</b> <img src="<?= $root_path ?>/img/content/plateforme.png" alt="plateforme_img" /></p>
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
						
						<option value=""></option>
						
						<?php foreach ($all_platesformes as $plateforme): ?>

							<option value="<?= $plateforme->plateforme_nom ?>" id="<?= $plateforme->plateforme_id ?>"  title=""><!-- <= $architecture->groupe_de_soutien_details ?> -->
								<?= $plateforme->plateforme_nom ?>
							</option>

						<?php endforeach; ?>
					</select>						
				<!-- <button type="button" class="btn btn-success" id="validated_pltform" value="Valider" title="Validez votre sélection" style="width: 10em; margin-left: 2em; font-style: helvetica;"> Valider <span class="glyphicon glyphicon-ok-sign"></span></button> -->
				<br>

				<em><a target="_blank" class="lien_externe_creation" href="<?= $site_url; ?>/Plateforme/new_plateforme" style="float: right;">Créez une nouvelle plate-forme<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
		</div>
		<br />
		<br />
		<br />


		<!-- Outils ==================== -->
		<!-- <div class="outils service_info">
		
			<div class="outils page-header">
				<p class="info_title"><b>Outils de supervision</b> <img src="<= $root_path ?>/img/content/outil.png" alt="outil_img" /></p>
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
					<option value="" ></option>
					
					<php foreach ($all_outils as $outil): ?>
		
						<option value="<= $outil->outil_nom ?>" id="<= $outil->outil_id ?>" title="<= $outil->outil_desc ?>">
							<= $outil->outil_nom ?>
						</option>
						
					<php endforeach; ?>
				</select>
		
				<br>
		
				<em><a href="<?= $site_url; ?>/Outil/new_outil_form" target="_blank" class="lien_externe_creation" style="float: right;">Créez un nouvel outil de supervision<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
		</div> -->
		<br />
		<br />
		<br />

		<!-- Architecture ==================== -->
		<div class="architecture service_info">

			<div class="outils page-header">
				<p class="info_title"><b>Architecture</b> <img src="<?= $root_path ?>/img/content/architecture.png" alt="architecture_img" /></p>
			</div>	

			<div class="service_info_content" style="margin: 0 2%;">
				
				
				<div>

					<ul><li>Sélectionnez une architecture</li></ul>
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
				
				<br>
				<br>
				<em><a target="_blank" href="<?= $site_url; ?>/Administration/create_new_architecture" class="lien_externe_creation" style="float: right;">Créez une nouvelle architecture<span class="glyphicon glyphicon-triangle-right"></span></a></em>
			</div>
		</div>
		
		<!-- Confirmation de création d'un service -->

		<span data-toggle="modal" id="bouton_confirmtn_creation_service" href="#safe_service_validation_creation" class="btn fin_de_creation" title="Enregistrer ce service"><span class="glyphicon glyphicon-save" style="color: black;"></span> Terminer</span>

		<div class="modal fade" id="safe_service_validation_creation">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">x</button>
						<h4 class="modal-title">Confirmation</h4>
					</div>

					<div class="modal-body">
						Vous allez créer un <b>nouveau service</b>. Confirmez vous ces informations ?
					</div>

					<div class="modal-footer">
						<button data-dismiss="modal" id="save_service" class="btn" >Oui</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

