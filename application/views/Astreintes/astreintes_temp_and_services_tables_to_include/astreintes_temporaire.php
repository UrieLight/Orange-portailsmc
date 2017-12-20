<style>
	
	#astreintes_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}
</style>


<span id="site_url" style="visibility:hidden;"><?= $site_url; ?></span>
<!-- ================ 	CONTENU DU MODULE D'ASTREINTES ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><img class="img-responsive" src="<?= $root_path ?>/img/content/astreintes.png" alt="astreintes"/></div>
		
		<div class="content_title"><h2> Plannings des Astreintes automatique</h2></div>

		<!-- <div class="search_field" style="float: right;">
		
			<input type="text" style="width:150px; margin-top: 1.7em; font-style: italic; display: inline-block;  vertical-align: middle;" class="input-sm form-control" placeholder="Rechercher un service">
			
			<button type="submit" class="btn btn-primary btn_recherche"><span class=" glyphicon glyphicon-search"></span></button>
		</div> -->
	</div>
	
	<div class="plannings_astreintes" style="margin:1% 2%;">
		
		<div class="astreintes_header" style="">

			<h2 style="float: left;">
				<span class="glyphicon glyphicon-asterisk"  style="vertical-align:top; color:#ff6501;"></span>
				Mois :
				<!-- <span class="glyphicon glyphicon-triangle-left"></span> -->

				<!-- <script>document.write(mois_annee);</script> -->
				<span class="glyphicon glyphicon-triangle-left"></span>
				<span id="mois_annee"></span>
				<!-- <span class="glyphicon glyphicon-triangle-right"></span> -->
				<!-- j'enleve le calendrier pour mettre les touches de navigation entre les mois -->
				<!-- <input id="calendar_select" class="form-control" type="hidden" placeholder="Date" name="calendar_select" style="display:inline-block;"> -->
				
				<span class="glyphicon glyphicon-triangle-right"></span>
			</h2>

			<!-- <h3 style="display:inline-block;">Semaine</h3> -->
			<div class="semaine_date" style="margin-bottom:;">
				

				<!-- <h3>du <span id="date_debut"><b></b></span> au <span id="date_fin"><b></b></span></h3> -->
				<h3>
					<!-- <span id="semaine_prec" class="btn btn-primary glyphicon glyphicon-triangle-left" title="semaine précédente"></span> -->
					du <span id="date_debut"><b></b></span> au <span id="date_fin"><b></b></span>
					<!-- <span id="semaine_suiv" class="btn btn-primary  glyphicon glyphicon-triangle-right" title="semaine suivante"></span> -->
				</h3>
				<!-- <input id="rang_semaine" type="number" min="1" max="52" name="rang_semaine" class="form-control" style="display:inline-block;width:30%;"> -->
				<!-- <span id="calendar_icon"><img src="/img/b_calendar.png" alt="b_calendar"></span> -->
			</div>
		</div>


		<!-- SELECTION DE PLANNING DE CHAQUE SERVICE -->
		<div class="astreintes_box">

			<div class="list_services_astreintes" style="clear:both;">
				<hr>
				<br>
				<?php
				/* 

					$picked_date = echo '';
					$weeknumber = date('w', $picked_date); 

					echo 'Week '.$weeknumber;*/
				?>

				<!-- 
					j'comptais afficher le rang de la semaine, mais ici dans le planning temporaire c'est pas necessaire, 
					car la granularite est mensuelle
				 -->

				<!-- <span>W</span><span style="/*display: none;" id="picked_date"></span><br>	 -->

				<!-- <label style="font-size:16px;font-weight:normal;">Service : <span class="" id="nom_service"> 
				<!-- nom du service, dynamique from correspondant controller </span></label> -->
				
				<!-- Liste de selection des services, pour affichage de leurs plannings d'astreintes respectives -->
				<!-- 
					<select id="service_name" class="form-control" style="width:50%;" name="service_name">

						<option class="smc_maintenance" value="SMC - Maintenance">SMC - Maintenance</option>
						<option class="smc_management" value="SMC - Management">SMC - Management</option>
						<option class="tmc_evt" value="TMC - Environnement technique">TMC - EVT</option>
						<option class="sassbd" value="SASSBD">SASSBD</option>
						<option class="osi_bss" value="OSI BSS">OSI BSS</option>
					</select> 
				-->
			</div>

			<br>

			<!-- EN-TÊTE DU BOX D'AFFICHAGE DES PLANNINGS D'ASTREINTES -->
			<div class="planning_box_header page-header" style="margin-bottom:2%;">
				<p class="info_planning">
					<span id="info_planning_title" style="font-weight:bold;" title="Service"><?= $nom_service; ?></span>
					<span class="glyphicon glyphicon-pushpin" style="float:right;"></span>
				</p>
			</div>

			<!-- AFFICHAGE DES PLANNINGS D'ASTREINTES -->
			<div class="planning_box">
				
				
				<?php //include_once($service_table); ?>
				<?php $this->load->view('Astreintes/astreintes_temp_and_services_tables_to_include/'.$service_table); ?>

			</div>
		</div>
	</div>
</div>