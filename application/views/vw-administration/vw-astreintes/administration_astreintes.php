<style>
	
	/* #astreintes_nav{
		color: #FF6501;
	  		text-decoration: none;
	  		border-bottom: 2px solid #FF6501;
	} */
</style>


<span id="site_url" style="visibility:hidden;"><?= $site_url; ?></span>
<!-- ================ 	CONTENU DU MODULE D'ASTREINTES ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><img class="img-responsive" src="<?= $root_path ?>/img/content/astreintes.png" alt="astreintes"/></div>
		
		<div class="content_title"><h2> Administration - Plannings des Astreintes </h2></div>

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
				<span id="mois_annee"></span>
				<!-- <input id="calendar_select" class="form-control" type="hidden" placeholder="Date" name="calendar_select" style="display:inline-block;"> --> <!-- pas besoin ici, vu qu'on affiche par mois -->
			</h2>

			<!-- <h3 style="display:inline-block;">Semaine</h3> -->
			<div class="semaine_date" style="margin-bottom:;">
				
				

				<h3>
					<!-- <span class="btn btn-primary glyphicon glyphicon-triangle-left"></span> -->
					<!-- du <span id="date_debut"><b></b></span> au <span id="date_fin"><b></b></span> -->  <!-- pas besoin ici, vu qu'on affiche par mois -->
					<!-- <span class="btn btn-primary  glyphicon glyphicon-triangle-right"></span> -->
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
				<label style="font-size:16px;font-weight:normal;">Services <span class="caret"></span></label>
				<!-- Liste de selection des services, pour affichage de leurs plannings d'astreintes respectives -->
				<select id="service_name" class="form-control" style="width:50%;" name="service_name">
					
					<optgroup>
						<option class="smc_maintenance" value="SMC - Maintenance">SMC - Maintenance</option>
						<option class="smc_management" value="SMC - Management">SMC - Management</option>					
					</optgroup>

					<optgroup>
						<option class="tmc_evt" value="TMC - Environnement technique">TMC - EVT</option>
					</optgroup>

					<optgroup>
						<option class="sassbd" value="SASSBD">SASSBD</option>
					</optgroup>

					<optgroup>
						<option class="osi_bss" value="OSI BSS">OSI BSS</option>
					</optgroup>
					
				</select>
			</div>

			<br>
			<br>

			<!-- EN-TÊTE DU BOX D'AFFICHAGE DES PLANNINGS D'ASTREINTES -->
			<div class="planning_box_header page-header" style="margin-bottom:2%;">
				<p class="info_planning">
					<span id="info_planning_title" style="font-weight:bold;"></span>
					<span class="glyphicon glyphicon-pushpin" style="float:right;"></span>
				</p>
			</div>

			<!-- AFFICHAGE DES PLANNINGS D'ASTREINTES -->
			<div class="planning_box">
				
				<!-- PLANNINGS DU SERVICE SMC MAINTENANCE-->
				<div class="service_planning active" id="smc_maintenance" style="padding: 1% 2%;">

					<!-- astreintes reseau -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Réseau</h4>
							</li>
						</ul>
							 
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th></th>
									<th colspan="2" class="table_title">Pilote de service</th>
								</tr>
								<tr>
									<th>Période</th>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
							
							<tbody style="">
								<tr>
									<td>
										<input id="calendar_select_semaine1_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
									<td rowspan="6" class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
									<td rowspan="6" class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
								</tr>
								<tr>
									<td>
										<input id="calendar_select_semaine2_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
								</tr>
								<tr>
									<td>
										<input id="calendar_select_semaine3_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
								</tr>
								<tr>
									<td>
										<input id="calendar_select_semaine4_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
								</tr>
								<tr>
									<td>
										<input id="calendar_select_semaine5_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
								</tr>
								<tr>
									<td>
										<input id="calendar_select_semaine6_du_mois" class="form-control" type="text" placeholder="Date" name="calendar_select" style="display:inline-block;">
									</td>
								</tr><!-- 
								<tr>
									<td>Dimanche</td>
								</tr> -->
							</tbody>
						</table>
						<br><br>
					</div>

					<!-- astreintes de rotation -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Rotation</h4>
							</li>
						</ul>
							 
						<table class="table table-bordered table-striped">
							
							<thead>
								<tr>
									<th></th>
									<th colspan="2" class="table_title">Support client niveau 3</th>
								</tr>
								<tr>
									<th>Jours</th>
									<th>8h00-15h00</th>
									<th>15h00-22h00</th>
								</tr>
							</thead>
					
							<tbody>
								<tr>
									<td>Lundi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Mardi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Mercredi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Jeudi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Vendredi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Samedi</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
								<tr>
									<td>Dimanche</td>
									<td><input type="text"></td>
									<td><input type="text"></td>
								</tr>
							</tbody>
						</table>
						<br><br>
					</div>
			
					<!-- astreintes de permanence -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Permanence</h4>
							</li>
						</ul>
							 
						<table class="table table-bordered table-striped">
					
							<thead>
								<tr>
									<th></th>
									<th colspan="2" class="table_title">Support client niveau 3</th>
								</tr>
								<tr>
									<th>Jours</th>
									<th colspan="2">8h30-12h30 & 15h00-18h00</th>
									<!-- <th></th> -->
								</tr>
							</thead>
					
							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
									<!-- <td rowspan="7" class="responsable_cell" style="vertical-align:middle;"><input type="text"></td> -->
								</tr>
								<tr>
									<td>Mardi</td>
								</tr>
								<tr>
									<td>Mercredi</td>
								</tr>
								<tr>
									<td>Jeudi</td>
								</tr>
								<tr>
									<td>Vendredi</td>
								</tr>
							</tbody>
						</table>
						<br><br>	
					</div>
				</div>

				<!-- PLANNINGS DU SERVICE SMC MANAGEMENT-->
				<div class="service_planning " id="smc_management" style="padding: 1% 2%;">
				
					<!-- astreintes management -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Management</h4>
							</li>
						</ul>
						 
						<!-- administration robots -->	
						<table class="table table-bordered table-striped">
									
							<thead>
								<tr>
									<th></th>
									<th colspan="3" class="table_title">Administration Robots</th>
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Niveau 2</th>
									<th>Escalade</th>
								</tr>
							</thead>
									
							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
									<td class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
									<td class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
								</tr>
							</tbody>
						</table>
						<br><br>
					 	
						<!-- administration SAV2000 -->
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Administration SAV2000</h4>
							</li>
						</ul>

						<table class="table table-bordered table-striped">
									
							<thead>
								<tr>
									<th></th>
									<th colspan="3"  class="table_title">Administration SAV2000 <br><span>(OCEANE, SWAN...)</span></th>
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
									
							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
									<td class="responsable_cell" style="vertical-align:middle;"><input type="text"></td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
				
				<!-- PLANNINGS DU SERVICE TMC ET ENVIRONNEMENT TECHNIQUE -->
				<div class="service_planning" id="tmc_evt" style="padding: 1% 2%;">
					
				</div>
				
				<!-- PLANNINGS DU SERVICE SASSBD -->
				<div class="service_planning" id="sassbd" style="padding: 1% 2%;">
					
				</div>
				
				<!-- PLANNINGS DU SERVICE OSI ET BSS -->
				<div class="service_planning" id="osi_bss" style="padding: 1% 2%;">
					
				</div>
			</div>
		</div>
	</div>
</div>