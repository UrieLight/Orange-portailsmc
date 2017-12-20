
<style>
	.outil_form{
		margin-left: 2%;
	    margin-top: 2%;
	    width: 25%;
	    display: inline-block;
	}
	
	.fin_de_creation{

		/* margin-top: 15px;
			    margin-left: 5%;
			    border: 1px solid #ff6501;
			    background-color: white;
			    color: black;
			    font-weight: bold; */
	}

</style>

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

		<img class="img-reponsive" src="<?= $root_path ?>/img/administration/sup.png" alt="supervision_admin_module_img" style="width: 2em;vertical-align: top;" />
		<span class="admin_module_title" style="/*font-size: 22px;"> Nouvel outil de supervision</span>

	</div>

	<div class="service_form container service_info">
			
			<div class="page-header"><p class="info_title"></p></div>
			<!-- formulaire d'entete du service -->
			<div style="margin-left: 25%;/*width: 80%;padding-left: 14%;">
				<!-- <form action="#"><fieldset> -->
				<div class="outil_form">

					<label for="outil_nom">Identifiant <span class="caret"></span></label>
					<input class="form-control" type="text" id="outil_nom" name="outil_nom" class="form-control" set_value="<?= 'outil_nom' ?>" required>
				</div>

				<div class="outil_form" style="vertical-align:top;">

					<label for="">Description <span class="caret"></span></label>
					
					<textarea id="outil_desc" class="form-control" name="outil_desc" cols="30" rows="10" ></textarea>
					<!-- <select name="pltfrm_equipmt_const" id="" class="form-control"></select/> -->
					<!-- <br> -->

				</div>
				<!-- </fieldset></form> -->
			</div>
		<!-- </form> -->
	</div>

	<span data-toggle="modal" id="bouton_confirmtn_creation" href="#safe_outil_validation_creation" class="btn fin_de_creation" title="Enregistrer cet outil">
		<span class="glyphicon glyphicon-save" style="color: black;"></span> 
		Terminer
	</span>
	
	<div class="modal fade" id="safe_outil_validation_creation">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal">x</button>
					<h4 class="modal-title">Confirmation</h4>
				</div>

				<div class="modal-body">
					Vous allez créer un <b>nouvel outil</b>. Confirmez vous ces informations ?
				</div>

				<div class="modal-footer">
					<button  data-dismiss="modal" id="save_outil" class="btn" value="Sauvegarder_outil" class="btn fin_de_creation" >Oui</button>
				</div>
			</div>
		</div>
	</div>
</div>
