<!-- 
	fichier externe
	Tableau du service TMC et ENVT
-->

<!-- PLANNINGS DU SERVICE TMC ET ENVIRONNEMENT TECHNIQUE -->
<style>
	
	td{

		text-align: center;
		vertical-align: middle;
    	border: 1px solid #000;
	}	

	/* couleur de l'entete */
	th{

		background-color: #ff6600;
		color: white;
		/* padding: 0 0; */
		vertical-align: middle;
	}

	.nom_responsable{

		font-weight: bold;
	}

</style>

<div class="" id="tmc_evt" style="padding: 1% 2%;">

	<table class="table table-bordered">

		<thead>

			<tr>

				<th style="vertical-align: middle;" rowspan="2">Semaine</th>
				<th style="vertical-align: middle;" rowspan="2" colspan="3">Metiers</th>
				<th style="vertical-align: middle;" rowspan="2">Littoral</th>
				<th style="vertical-align: middle;" rowspan="2">Centre</th>
				<th style="vertical-align: middle;" rowspan="2">Est</th>
				<th style="vertical-align: middle;" rowspan="2">Ouest</th>
				<th style="vertical-align: middle;" rowspan="2">Nord / Extreme Nord</th>
				<th style="vertical-align: middle;" rowspan="2">Adamaoua</th>
				<th style="vertical-align: middle;" rowspan="2">Nord Ouest</th>
				<th colspan="2">TMC(POOL FO & TMC)</th>
			</tr>

			<tr>
				<th rowspan="">escalade 1</th>
				<th rowspan="">escalade 2</th>
			</tr>
		</thead>

		<tbody>

			<?php for ($i=0; $i < 3; $i++): ?>

				<tr>

					<td style="background-color: #ffff00;" rowspan="2"></td>
					<td style="background-color: #eee;vertical-align: middle;" rowspan="2"><b>POOL FO & TMC</b></td>
					<td style="background-color: #eee;vertical-align: middle;" rowspan="2"><b>Energie</b></td>
					<td style="background-color: #eee;"><b>Jour</b></td>
					<td></td>
					<td><span class="nom_responsable"> Serge NGOUFO </span> <span class="tel_responsable">699 94 92 40</span></td>

					<td style="vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Valery DJEUGMO </span> <span class="tel_responsable">699 94 90 57</span></td>
					<td style="vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Soffo Audrey </span> <span class="tel_responsable">693 24 54 55</span></td>
					<td style="vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Alexandre BISSOHONG </span> <span class="tel_responsable">699 94 97 83</span></td>
					<td style="vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Yannick BEYALA </span> <span class="tel_responsable">696 60 85 62</span></td>
					<td style="vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Onana Alphonse </span> <span class="tel_responsable">699 94 91 77</span></td>
					<td style="background-color: #f79646;vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Jérémie BAYIHA </span> <span class="tel_responsable">699 94 95 70 / 654 56 15 03</span></td>
					<td style="background-color: #f79646;vertical-align: middle;" rowspan="2"><span class="nom_responsable"> Elie BOUOPDA </span> <span class="tel_responsable">699 94 94 87 / 654 56 15 02</span></td>
				</tr>

				<tr>

					<td style="background-color: #eee;"><b>Nuit</b></td>
					<td><span class="nom_responsable"> Bidias GUEHODAS </span> <span class="tel_responsable">699 94 91 78</span></td>
					<td><span class="nom_responsable"> Bienvenu Mandounde </span> <span class="tel_responsable">699 94 91 79</span></td>
				</tr>

			<?php endfor; ?>
		</tbody>
	</table>
</div>