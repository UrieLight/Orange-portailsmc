<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

</style>


<!-- ================ 	SERVICES FAMILY PAGE    ================	--> 

<span id="site_url" site_url="<?= $site_url; ?>" style="display: none;"></span>


<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<a href="<?= $site_url ?>/"></a>
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/home.png" alt="home_img" />
		</div>
		
		<div class="content_title"><h2> Familles des Services </h2></div>
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
					<a href="<?= $site_url ?>/Catalogue/services_display/all"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/services_family/all.svg" alt="img-famille_all_service" style="" /></a>
					<!-- <br> -->
					<div style="text-align:center;color:black;"><a class="family_caracter_class" famille="orange_money" href="<?= $site_url ?>/Catalogue/services_display/all"><b>Tous les Services</b></a></div>
				</div>
			</div>

			<!-- bloc service -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Catalogue/services_display/orange_money"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/services_family/orangemoney_img.jpg" alt="img-famille_service_orangemoney" style="" /></a>
					<!-- <br> -->
					<div style="text-align:center;color:black;"><a class="family_caracter_class" famille="orange_money" href="<?= $site_url ?>/Catalogue/services_display/orange_money"><b>Orange Money</b></a></div>
				</div>
			</div>

			<!-- bloc plate-forme -->
			<div class="bloc">

				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Catalogue/services_display/internet"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/services_family/internet_img.png" alt="img-internet" style="" /></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href="< $site_url ?>/Plateforme/plateformes_display"><b>Plate-formes</b></a></div> -->
					<div style="text-align:center;"><a class="family_caracter_class" famille="internet" href="<?= $site_url ?>/Catalogue/services_display/internet" style="/*color:black;cursor:not-allowed;*/"><b>Internet </b></a></div>
				</div>
			</div>

			<!-- bloc groupes/contacts de soutien -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Catalogue/services_display/interco" style="/*cursor:not-allowed;"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/services_family/interco_img.png" alt="img-interco" style=""/></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href=""><b>Contacts</b></a></div> -->
					<div style="text-align:center;"><a class="family_caracter_class" famille="interco" href="<?= $site_url ?>/Catalogue/services_display/interco" style="/*cursor:not-allowed;"><b>Interco</b></a></div>
				</div>
			</div>

			<!-- bloc Architectures -->
			<div class="bloc">
			
				<div class="admin_service_icon" style="display: inline-block;">
					<a href="<?= $site_url ?>/Catalogue/services_display/voix_data" style="/*cursor:not-allowed;"><img class="thumbnail img-responsive img_bloc" src="<?= $root_path ?>/img/services_family/voix_data_img.jpg" alt="img-voix_data" style=""/></a>
					<!-- <br> -->
					<!-- <div style="text-align:center;color:black;"><a href=""><b>Contacts</b></a></div> -->
					<div style="text-align:center;"><a class="family_caracter_class" famille="voix_data" href="<?= $site_url ?>/Catalogue/services_display/voix_data" style="/*cursor:not-allowed;"><b>Voix </b>&<b> Data </b></a></div>
				</div>
			</div>
		</div>
	</div>
</div>

