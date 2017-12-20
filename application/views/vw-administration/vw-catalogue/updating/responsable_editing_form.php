
<style>
	
	td p{

		padding: 1% 3%;
	}	

</style>

<?php 
	
	//variables post, init
	/*$responsable_nomprenom;
	$responsable_fonct;
	$responsable_tel1;
	$responsable_tel2;
	$responsable_email;
	$responsable_eds;
	$responsable_disponibilite;
	$responsable_id;*/

	/*foreach ($_POST as $post) {
		# code...
		echo "post: ".$post;
	}*/
	
	//test si les valeurs ont été reçues
	if (isset($_POST['responsable_nomprenom'])) {
		# code...
		$responsable_nomprenom = $_POST['responsable_nomprenom'];
		// var_dump('nom receuilli: '.$responsable_nomprenom);

		echo '<input type="hidden" id="responsable_nomprenom" value="'.$responsable_nomprenom.'">';
	}else
		var_dump('no data received !!');
	
	if (isset($_POST['responsable_fonct'])) {
		# code...
		$responsable_fonct = $_POST['responsable_fonct'];
		// var_dump('fonct receuillie: '.$responsable_fonct);

		echo '<input type="hidden" id="responsable_fonct" value="'.$responsable_fonct.'">';
	}else
		echo '<input type="hidden" id="responsable_fonct" value="*">';

	
	if (isset($_POST['responsable_tel1'])) {
		# code...
		$responsable_tel1 = $_POST['responsable_tel1'];
		// var_dump('tel1 receuilli: '.$responsable_tel1);

		echo '<input type="hidden" id="responsable_tel1" value="'.$responsable_tel1.'">';
	}
	
	if (isset($_POST['responsable_tel2'])) {
		# code...
		$responsable_tel2 = $_POST['responsable_tel2'];
		// var_dump('tel2 receuilli: '.$responsable_tel2);

		echo '<input type="hidden" id="responsable_tel2" value="'.$responsable_tel2.'">';
	}
	
	if (isset($_POST['responsable_email'])) {
		# code...
		$responsable_email = $_POST['responsable_email'];
		// var_dump('email receuilli: '.$responsable_email);

		echo '<input type="hidden" id="responsable_email" value="'.$responsable_email.'">';
	}
	
	if (isset($_POST['responsable_eds'])) {
		# code...
		$responsable_eds = $_POST['responsable_eds'];
		// var_dump('eds receuilli: '.$responsable_eds);

		echo '<input type="hidden" id="responsable_eds" value="'.$responsable_eds.'">';
	}
	
	if (isset($_POST['responsable_disponibilite'])) {
		# code...
		$responsable_disponibilite = $_POST['responsable_disponibilite'];
		// var_dump('disponibilite receuilli: '.$responsable_disponibilite);

		echo '<input type="hidden" id="responsable_disponibilite" value="'.$responsable_disponibilite.'">';
	}
	
	if (isset($_POST['responsable_id'])) {
		# code...
		$responsable_id = $_POST['responsable_id'];
		// var_dump('disponibilite receuilli: '.$responsable_id);

		echo '<input type="hidden" id="responsable_id" value="'.$responsable_id.'">';
	}
	

?>

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

		<img src="<?= $root_path ?>/img/administration/resp.png" alt="responsable_img" style="width: 4em; /*height: initial;" />
			
		<span class="admin_module_title" ><b>Modifier un membre</b></span>
			<?php /*echo "<b>".$module_name."</b>" ;*/ ?>		
	</div>

	<!-- admin module content -->
	<div class="service_form container">

		<br>
		<!-- ==================== FORMULAIRE DE MODIFICATION D'UN MEMBRE D'ESCALADE ==================== -->
		<div>
			<div class="new_membre_escalade service_info">
				
				<!-- en tête du bloc d'info du service -->
				<div class="page-header">
					<p class="info_title"><b>Modifications des informations</b> <!-- <img src="<= $root_path ?>/img/administration/resp_title.png" alt="resp_title_img" /> --></p>
				</div>

				<div class="service_info_content">

					<!-- <h4><img src="<= $root_path ?>/img/content/profile.png" alt="profile_img" style="float: none; margin-left: 1px;"/> <b>Informations sur le membre</b></h4> -->
					<br>

					<div class="membre_escalade" style="width:80%;margin:0 auto;">
						

						<div class="responsable_info" style="/*display: inline-block; float: left;">
						  	<label for=""> - Nom & prenom du membre <sup class="required_field" title="champ obligatoire">*</sup> <span class="caret"></span></label>
							<input id="membre_nom_prenom" type="text" required="required" value="" class=" form-control">
						</div>

						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Fonction <sup class="required_field" title="champ obligatoire">*</sup> <span class="caret"></span></label>
							<input id="membre_fonction" type="text" value="" class=" form-control">
						</div>
						
						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Email <sup class="required_field" title="champ obligatoire">*</sup> <span class="caret"></span></label>
							<input id="membre_email" type="mail" value="" class=" form-control">
						</div>

						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Téléphone 1 <sup class="required_field" title="champ obligatoire">*</sup> <span class="caret"></span></label>
							<!-- <input type="text" value="" class=" form-control"> -->
							<input id="membre_tel1" name="" class=" form-control">
						</div>

						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Téléphone 2 <span class="caret"></span></label>
							<!-- <input type="text" value="" class=" form-control"> -->
							<input id="membre_tel2" name="" class=" form-control">
						</div>

						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - EDS <span class="caret"></span></label>
							<!-- <input type="text" value="" class=" form-control"> -->
							<!-- <input type="number" id="membre_eds" name="" class=" form-control"> -->
							<input type="text" id="membre_eds" name="" class=" form-control">
						</div>

						<br>
						<div class="responsable_info" style="/*display: inline-block; float: left;">
							<label for=""> - Disponibilité <span class="caret"></span></label>
							<!-- <input type="text" value="" class=" form-control"> -->
							<input id="membre_disponibility" name="" class=" form-control">
						</div>

					</div>
				</div>

				<br>
				<br>
				<br>
				<br>

				<span id="bouton_confirmtn_modification_responsable" data-toggle="modal" href="#safe_service_validation_modification_responsable" class="btn btn-success" style="font-size: small; float:right;" title="Enregistrez les modifications sur ce membre ?">
				
					<span class="glyphicon glyphicon-ok" style="color: black;"></span> 
					Enregistrer 
				</span>
			</div>

			

			<div class="modal fade" id="safe_service_validation_modification_responsable">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title">Confirmation</h4>
						</div>

						<div class="modal-body">
							Vous allez créer <b>modifier les informations sur ce membre</b>. Confirmez vous ces informations ?
						</div>

						<div class="modal-footer">
							<button data-dismiss="modal" id="modifier_responsable" class="btn" >Oui</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
