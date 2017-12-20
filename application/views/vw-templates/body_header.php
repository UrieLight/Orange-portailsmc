<?php session_start(); ?>

</head><!-- fermeture du head -->

<body>

	<div class="se-pre-con"></div>

	<div class="container-fluid">

		<!-- Header de la page, avec la navigation -->
		<header>

			<nav class="navbar navbar-inverse">
				
				<div class="main_header container-fluid">

					<div class="navbar-header">

						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<!-- <span class="icon-bar"></span> -->
						</button>

						<div class="logo"><img id="body_logo" class="img-responsive" src="<?= $root_path ?>/img/logo.png" alt="logo_orange" style="width: 50px; height: 50px;" /></div>
						<p class="logo_label navbar-brand"><strong>Portail SMC</strong></p>
					</div>

					<!-- <div class="nav"> -->
					<div class="nav collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<ul class="list-inline list-unstyled">

							<li class="navs_items"><a href="<?= $site_url ?>/portail_info/info_display" id="info_nav"><img class="module_icon hidden-xs" src="<?= $root_path ?>/img/header/accueil.png" alt="accueil_img" /></a><br /><a href="<?= $site_url ?>/portail_info/info_display" id="info_nav">Portail de l'info</a>
								<span class="sr-only"></span>
							</li>
							<li class="navs_items"><a href="<?= $site_url ?>/Services/services_homepage" ><img class="module_icon hidden-xs" src="<?= $root_path ?>/img/header/catalog.png" alt="catalog_img" /></a><br /><a href="<?= $site_url ?>/Services/services_homepage" id="service_nav">Services</a></li>
							<li class="navs_items"><a href="<?= $site_url ?>/Astreintes/display_astreintes"><img class="module_icon hidden-xs" src="<?= $root_path ?>/img/header/astreintes.png" alt="astreintes_img" /></a><br /><a href="<?= $site_url ?>/Astreintes/display_astreintes" id="astreintes_nav">Astreintes</a></li>
							<!-- <li class="navs_items"><a target="_blank" href="http://sit/selfportail"><img class="module_icon hidden-xs" src="<= $root_path ?>/img/header/clients_internes.png" alt="clients_internes_img" /></a><br /><a target="_blank" href="http://sit/selfportail">Tickets internes</a></li> -->
						</ul>
					</div>
				</div>
				
			</nav>
			
			<div class="under_nav ">

				<div class="user_data" style="margin-bottom: 5px;">

					<img class="img-circle usr_pic navs_items" style="background: lightgrey;" src="<?= $root_path ?>/img/header/user_pic.png" alt="user_pic" /><!-- navs_items i've just put it to hide it within the login page-->
					<span class="navs_items" style="font-weight: bold; color: #3cf;">
						<a href="#" id="username">
						<?php 
							// var_dump($_SESSION['sess_user_name']);

							if(isset($_SESSION['sess_user_name'])){

								if ($_SESSION['sess_user_name'] == '' && $_SESSION['sess_cuid'] == 'WJMJ3790')
									echo 'Uriel FEUATSAP';
								else
									echo $_SESSION['sess_user_name'];
							}
							elseif (isset($_COOKIE['cook_sess_user_name']))
								echo $_COOKIE['cook_sess_user_name'];
							else{
								
								header('location:'.$site_url.'/welcome/authentify');
								// echo 'User';
							}

							// if (')
							// 	
							
						?>
						</a>
					</span>

					<div class="btn-group navs_items">

						<button class="btn btn-link dropdwn-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-expanded="true">

							<span class="caret" style="cursor: pointer;"></span>
						</button>

						<ul class="dropdown-menu pull-right" style="z-index: 50;">
							<?php 
								// echo "session: ".$_SESSION['sess_cuid'].'<br> cook: '.$_COOKIE['cook_cuid'].'<br>';
								/*echo "sess: ";
								print_r($_SESSION);
								echo "cook: ";
								print_r($_COOKIE);*/

								if(isset($_SESSION['sess_cuid'])){
									// echo $_SESSION['sess_user_name'];
									if ($_SESSION['sess_cuid'] == 'WJMJ3790' || $_SESSION['sess_cuid'] == 'uadmin') {

										echo '
											<li><a href="'.$site_url.'/'.$administration_page_url.'"><span class="glyphicon glyphicon-wrench"></span> Administration</a></li>
											<!-- <li><a href=""><span class="glyphicon glyphicon-user"></span> Compte</a></li> -->
											<li class="divider"></li>
										';
									}
								}/*
								elseif (isset($_COOKIE['cook_cuid'])){
									// echo $_COOKIE['cook_sess_user_name'];
									if ($_COOKIE['cook_cuid'] = 'WJMJ3790') {
										echo '
											<li><a href="'.$site_url.'/'.$administration_page_url.'"><span class="glyphicon glyphicon-wrench"></span> Administration</a></li>
											<!-- <li><a href=""><span class="glyphicon glyphicon-user"></span> Compte</a></li> -->
											<li class="divider"></li>
										';
									}
								}*/
							?>
							
							<li >
								<a href=""><span class="glyphicon glyphicon-log-out"></span> 

									<!-- fenêtre modale de déconnexion -->
									<span data-toggle="modal" id="bouton_confirmtn_deconnexion" href="#safe_validation_deconnexion" class="" title=""><!-- <span class="glyphicon glyphicon-save" style="color: black;"> -->
										Deconnexion
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="modal fade" id="safe_validation_deconnexion">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<button type="button" class="close" data-dismiss="modal">x</button>
							<h4 class="modal-title"><b>Déconnexion</b></h4>
						</div>

						<div class="modal-body">
							Voulez-vous fermer votre session ?
						</div>

						<div class="modal-footer">
							<button  data-dismiss="modal" id="log_out" class="btn btn-success" value="" class="btn" >Oui</button>
							<button  data-dismiss="modal" id="discard_log_out" class="btn btn-danger" value="" class="btn" >non</button>
						</div>
					</div>
				</div>
			</div>
		</header>
