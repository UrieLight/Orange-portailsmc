
<!-- ================ 	ADMINISTRATION HOME PAGE    ================	--> 

<span id="site_url" class="<?= $site_url; ?>" style="display: none;"></span>


<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img">
			<img class="img-responsive" src="<?= $root_path ?>/img/administration/administration.png" alt="administration" />
		</div>
		
		<div class="content_title"><h2> Administration</h2></div>
	</div>
	
	<!-- entête du module -->
	<div class="admin_module container-fluid" style="margin-top: 2%; margin-left:3%;">

		<img src="<?= $root_path ?>/img/administration/home.png" alt="home_img" style="width: initial; height: initial;" />
			
		<span class="admin_module_title" style="vertical-align: middle;"><b></b></span>	
	</div>

	<!-- admin page module content -->
	<div class="service_form container">
		
		<table class="bloc_items">
			<thead>
				<tr>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<!-- bloc service -->
						<div class="blocs">
						
							<div class="admin_service_icon service_img" style="display: inline-block;width: 23%;">
								<img class="thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/administration/hompage_service_icon.jpg" alt="img-service" style="" />
								<!-- <br> -->
								<div style="text-align:center;color:black;"><b>Services</b></div>
							</div>
					
							<div class="admin_service_links" >
								<p title="Créer un nouveau service"><a href="<?= $site_url ?>/administration/new_service_creation"><span class="glyphicon glyphicon-plus" style="color:black;"></span> Nouveau</a></p>
								<p title="Modifier un service"><a href="<?= $site_url ?>/administration/service_updating"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier</a></p>
								<p title="Familles des services"><a href="<?= $site_url ?>/administration/family_services"><span class="glyphicon glyphicon-th" style="color:black;"></span> Familles de services</a></p>
							</div>
						</div>
					</td>

					<td>
						<!-- bloc chaine de soutien -->
						<div class="blocs">
						
							<div class="admin_service_icon service_img" style="display: inline-block;">
								<img class="thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/administration/chainsoutien.jpg" alt="img-chainsout" style=""/>
								<!-- <br> -->
								<div style="text-align:center;color:black;"><b>Chaines de soutien</b></div>
							</div>
					
							<div class="admin_service_links" >
								<p title="Créer une nouvelle chaine de soutien"><a href="<?= $site_url ?>/administration/nouvelle_chaine_soutien"><span class="glyphicon glyphicon-plus" style="color:black;"></span> Nouveau</a></p>
								<p title="Modifier une chaine de soutien"><a href="<?= $site_url ?>/administration/chain_support_updating"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier</a></p>
							</div>
						</div>
					</td>
				</tr>
				
				<tr>

					<td>
						<!-- bloc plate-forme -->
						<div class="blocs">

							<div class="admin_service_icon service_img" style="display: inline-block;">
								<img class="thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/administration/serveur_homepage.png" alt="img-plateforme" style="width:25em;" />
								<!-- <br> style="cursor: not-allowed;"-->
								<div style="text-align:center;color:black;"><b>Plates-formes </b><br>&<br><b>Outils</b></div>
							</div>

							<div class="admin_service_links" >
								<p title="Créer une nouvelle plate-forme"><a href="<?= $site_url ?>/Plateforme/new_plateforme"><span class="glyphicon glyphicon-plus" style="color:black;"></span> Nouveau</a></p>
								<p title="Modifier une plate-forme"><a href="<?= $site_url ?>/Plateforme/plateform_updating"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier</a></p>
								<!-- <p title="Modifier une plate-forme"><a href="#" style="color:grey; cursor:not-allowed;"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier</a></p> -->
							</div>
						</div>
					</td>

					<td>
						<!-- bloc groupes de soutien -->
						<div class="blocs">
						
							<div class="admin_service_icon service_img" style="display: inline-block;">
								<img class="thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/administration/groupe_sout.png" alt="img-groupesout" style=""/>
								<!-- <br> -->
								<div style="text-align:center;color:black;"><b>Groupes de soutien</b></div>
							</div>
					
							<div class="admin_service_links" >
								<p title="Créer un nouveau groupe de soutien"><a href="<?= $site_url ?>/administration/create_new_groupe_de_soutien"><span class="glyphicon glyphicon-plus" style="color:black;"></span> Nouveau</a></p>
								<p title="Modifier un groupe de soutien"><a href="<?= $site_url ?>/administration/groupe_de_soutien_updating"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier un groupe</a></p>
								<p title="Modifier un membre d'escalade"><a href="<?= $site_url ?>/administration/membre_groupe_soutien_updating" style="/*color:grey; cursor:not-allowed;"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier un responsable</a></p>
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<!-- bloc Architectures -->
						<div class="blocs">
						
							<div class="admin_service_icon service_img" style="display: inline-block;">
								<img class="thumbnail img-responsive img_service" name="service_img" src="<?= $root_path ?>/img/administration/architecture.png" alt="img-architecture" style=""/>
								<!-- <br> -->
								<div style="text-align:center;color:black;"><b>Architectures</b></div>
							</div>
					
							<div class="admin_service_links" >
								<p title="Créer une nouvelle architecture"><a href="<?= $site_url ?>/Administration/create_new_architecture"><span class="glyphicon glyphicon-plus" style="color:black;"></span> Nouvelle</a></p>
								<p title="Modifier une architecture"><a href="<?= $site_url ?>/Architectures/architectures_update_display"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Modifier une architecture</a></p>
								<!-- <p title="Modifier un membre d'escalade"><a href="<= $site_url ?>/administration/membre_groupe_soutien_updating" style="/*color:grey; cursor:not-allowed;"><span class="glyphicon glyphicon-edit" style="color:black;"></span> Supprimer une architecture</a></p> -->
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

