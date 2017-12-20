<!-- 
	fichier externe
	Tableau du service SMC MAINTENANCE
-->

<style>
	
	th{

		/* background-color: #f60; */
	}

	.vertical{

	    /* writing-mode:tb-rl;
	    -webkit-transform:rotate(270deg);
	    -moz-transform:rotate(90deg);
	    -o-transform: rotate(270deg);
	    -ms-transform:rotate(90deg);
	    transform: rotate(-90deg);
	    white-space:nowrap; 
	    width:20px;
    	height:30px; */
    }	

    .pilote_niv1_background_color{
    	background-color: #c4d79b;
    }	

    .pilote_esc_background_color{
    	background-color: white;
    }	

    .date_background_color{
    	background-color: #fc0;
    }

    .table_title{
    	background-color: #fc9;
    }

    .permanence_indiv{
    	background-color: #c4d79b;
    }
    
</style>

<!-- PLANNINGS DU SERVICE SMC MAINTENANCE-->
<div class="" id="smc_maintenance" style="padding: 1% 2%;">

	<!-- astreintes reseau -->
	<div id="astreintes_reseau">
		<ul>
			<li>
				<h4 style="margin-left:2%;" class="service_branch">Astreintes Réseau</h4>
			</li>
		</ul>
			 
		<table class="table table-bordered table-striped">

			<thead>

				<tr>
					<th colspan="2">Semaine</th>
					<th colspan="2" class="table_title">Pilote de service</th>
				</tr>

				<tr>
					<th></th>
					<th>Jours</th>
					<th>Niveau 1</th>
					<th>Escalade</th>
				</tr>
			</thead>
			
			<tbody style="">
				<tr>
					<td rowspan="7" class="date_background_color">Date(s)</td>
					<td>Lundi</td>
					<td rowspan="7" class="responsable_cell pilote_niv1_background_color" style="vertical-align:middle;">BIRROKI <br><span class="tel">699 94 98 94</span></td>
					<td rowspan="7" class="responsable_cell pilote_esc_background_color" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td>
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
				<tr>
					<td>Samedi</td>
				</tr>
				<tr>
					<td>Dimanche</td>
				</tr>
 				<tr></tr>
			</tbody>
		</table>
		<br><br>
	</div>

	<!-- astreintes de rotation -->
	<div id="astreintes_rotation">
		<ul>
			<li>
				<h4 style="margin-left:2%;" class="service_branch">Astreintes Rotation</h4>
			</li>
		</ul>
			 
		<table class="table table-bordered table-striped">
			
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th colspan="2" class="table_title">Support client niveau 3</th>
				</tr>
				<tr>
					<th></th>
					<th class="">Jours</th>
					<th>8h00-15h00</th>
					<th>15h00-22h00</th>
				</tr>
			</thead>
	
			<tbody>
				<tr>
					<th rowspan="7" class="date_background_color">Date(s)</th>
					<td>Lundi</td>
					<td></td>
					<td>kemayou anicet</td>
				</tr>
				<tr>
					<td>Mardi</td>
					<td>Alain m</td>
					<td>Achille</td>
				</tr>
				<tr>
					<td>Mercredi</td>
					<td></td>
					<td>charles z</td>
				</tr>
				<tr>
					<td>Jeudi</td>
					<td>fewf</td>
					<td>wefef</td>
				</tr>
				<tr>
					<td>Vendredi</td>
					<td>fwefwef</td>
					<td></td>
				</tr>
				<tr>
					<td>Samedi</td>
					<td>fwefwef</td>
					<td></td>
				</tr>
				<tr>
					<td>Dimanche</td>
					<td>fwefwef</td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<br><br>
	</div>

	<!-- astreintes de permanence -->
	<div id="astreintes_permanence">
		<ul>
			<li>
				<h4 style="margin-left:2%;" class="service_branch">Astreintes Permanence</h4>
			</li>
		</ul>
			 
		<table class="table table-bordered table-striped">
	
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th colspan="" class="table_title">Support client niveau 3</th>
				</tr>
				<tr>		
					<th></th>			
					<th class="">Jours</th>
					<th>8h30-12h30 & 15h00-18h00</th>
				</tr>
			</thead>
	
			<tbody style="">
				<tr>
					<th rowspan="7" class="date_background_color">Date(s)</th>
					<td>Lundi</td>
					<td rowspan="7" class="responsable_cell permanence_indiv" style="vertical-align:middle;">NDEBI Christian <br><span class="tel">699 94 98 94</span></td>
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