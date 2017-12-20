<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

</style>


<!-- ================ 	SERVICES HOME PAGE    ================	--> 

<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>


<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/home.png" alt="home_img" />
		</div>
		
		<div class="content_title"><h2> Services </h2></div>
	</div>
	
	<!-- entête du module -->
	<div class="admin_module container-fluid" style="margin-top: 2%; margin-left:3%;">

		<!-- <img src="<= $root_path ?>/img/administration/home.png" alt="home_img" style="width: initial; height: initial;" /> -->
			
		<span class="admin_module_title" style="vertical-align: middle;"><b></b></span>	
	</div>

	<!-- admin page module content -->
	<div class="service_form container">
	
		<div class="bloc_items">

			<!-- bloc service -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Services/services_family_page"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/administration/hompage_service_icon.jpg" alt="img-service" style="" /></a>
					<!-- <br> -->
					<div style="text-align:center;color:black;"><a href="<?= $site_url ?>/Services/services_family_page"><b>Catalogue des services</b></a></div>
				</div>
			</div>

			<!-- bloc plate-forme -->
			<div class="bloc">

				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Plateforme/platesformes_display"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/administration/serveur_homepage.png" alt="img-plateforme" style="" /></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href="< $site_url ?>/Plateforme/plateformes_display"><b>Plate-formes</b></a></div> -->
					<div style="text-align:center;"><a href="<?= $site_url ?>/Plateforme/platesformes_display" style="/*color:black;cursor:not-allowed;"><b>Plates-formes </b>&<b> Outils </b></a></div>
				</div>
			</div>

			<!-- bloc groupes/contacts de soutien -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Contacts/contacts_display" style="/*cursor:not-allowed;"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/administration/groupe_sout.png" alt="img-groupesout" style=""/></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href=""><b>Contacts</b></a></div> -->
					<div style="text-align:center;"><a href="<?= $site_url ?>/Contacts/contacts_display" style="/*cursor:not-allowed;"><b>Contacts des partenaires</b></a></div>
				</div>
			</div>

			<!-- bloc Architectures -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Architectures/architectures_display" style="/*cursor:not-allowed;"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/administration/architecture.png" alt="img-architecture" style=""/></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href=""><b>Contacts</b></a></div> -->
					<div style="text-align:center;"><a href="<?= $site_url ?>/Architectures/architectures_display" style="/*cursor:not-allowed;"><b>Architectures des services</b></a></div>
				</div>
			</div>
		</div>
	</div>
</div>

