<!-- 
	Page d'affichage de 
	modification des architectures des outils
 -->

<style>
	
	#service_nav{
		color: #FF6501;
  		text-decoration: none;
  		border-bottom: 2px solid #FF6501;
	}

	.img_architecture{
		/* width: 10%;
		height: 10%; */
		margin-top: 17%;
	}
	
	.service_info {
	  width: 95%;
	  margin: 0 7px;
	  /**//*box-shadow: 3px 2px 10px black;*//*padding: 0 1%;*/
	}

	/* .architecture_name:shover{
		color: #ff6501;
		cursor: pointer;
	} */

</style>

<span id="site_url" site_url="<?= $site_url; ?>" style="visibility: hidden;"></span>
<!-- ================ 	CONTENU DE LA PAGE DE MODIFICATION DES ARCHITECTURES DES OUTILS   ================	-->

<div class="content_bloc container-fluid">

	<!-- Header du contenu de la page -->
	<div class="content_header">

		<div class="content_img"><img class="img-responsive" src="<?= $root_path ?>/img/administration/arch_ico.png" alt="architecture_img" /></div>
		
		<div class="content_title"><h2> Architectures des Outils <span class="badge" title="<?= $nbr_architectures; ?> Architectures enregistrées">(<?= $nbr_architectures; ?>)</span></h2></div>

		<div class="search_field" style="float: right;">

			<input id="recherche_architecture" class="input-sm form-control recherche_architecture" type="text" style="width:150px; margin-top: 1.7em; font-style: italic; display: inline-block;  vertical-align: middle;" placeholder="Rechercher une architecture">

			<button  class="btn btn-primary btn_recherche recherche_architecture"><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>

	<span title="Remonter vers le haut"><img id="scroll" src="<?= $root_path ?>/img/content/top.png" alt="top"></span>
	<span id="nbr_total_architectures" hidden="true"><?= $nbr_architectures; ?></span>
	<!-- architectures -->

	<div id="bloc_service">

		<?php $rang_architecture = 1; ?><!-- Rang (pour le dénombrement des services) -->	

		<?php foreach ($all_architectures as $architecture_service): ?>
			
			<div class="architecture">

				<div class="service_head container-fluid "> 

					<div class="architecture_img ">	
						<img class="img-rounded img-responsive img_architecture" src="<?= $root_path ?>/img/administration/tools_architecture.png" alt="img-architecture" />
					</div>

					<span style="font-size: 20px;">
						<strong class="architecture_name"><?= $architecture_service->architectur_nom_srvc; ?></strong>
					</span>

					<blockquote class="service_description">
						<small><?= ucfirst($architecture_service->architecture_desc); ?></small>
					</blockquote>
				</div>

				

				<!-- INFORMATIONS SUR LE architecture: CHAINES DE SOUTIEN ET D'ESCALADE -->
				<br />
				<div class="service_info table-responsive" style="margin-bottom: 2em;">
					
					<div class="">								

						<!-- LISTE DES ARCHITECTURES DE SERVICES ENREGISTREES -->
										
						<div class="info_content" id="architecture" align="center"><!-- id="architecture" -->
														
							<hr />
							<span style="float: left;">
								<strong class="author">Edité par: </strong>
								<?= $architecture_service->architectur_author; ?>
							</span>
							
							<span style="float: right;">
								<i class="last_modified_date">Dernière mise à jour: </i>
								<i><?= $architecture_service->architectur_last_modif_date; ?></i>
							</span>
							
							<br>
							<br>
							<div class="diagramme" rang="<?= $rang_architecture; ?>" id="architecture<?= $rang_architecture; ?>" style="width: 895px; height: 500px;"></div><!-- style="margin:2% auto; width:500px; height:250px; background-color: #DAE4E4;" -->
							<!-- <p>Aucune architecture pour ce service !!</p> -->
							<br>
							<span class="btn btn-success" title="Générer l'image et Télécharger cette architecture" id="download_button<?= $rang_architecture; ?>">
								<span class="glyphicon glyphicon-download" style="color: black;"></span>
								Télécharger
							</span>
							
							<input id="architecture_jsonfile" type="hidden" value="<?= $architecture_service->file_path; ?>">
						</div>
						
					</div>
				</div>
			</div>
			
			<?php //$nbr_de_niveau_de_soutien = 0; ?>
			<?php $rang_architecture++; ?>
		<?php endforeach; ?>
	</div>
</div>

<?php

	/*function new_line_for_nw_rsp_info($resp_info){
		
		$trimmed_info1 = trim($resp_info);
		$exploded_info1 = explode(';', $trimmed_info1);
		$imploded_info = implode('#', $exploded_info1);
		$exploded_info2 = explode('#', $imploded_info);
		//$removed_slashes_names = implode('\n', $exploded_info);
		
		$info_arranged = ''; //initialisation de la chaine finale
		foreach($exploded_info2 as $resp_info){
			
			$info_arranged .= $resp_info.'<br>';
		}
		
		$info_arranged .= '</span><br /><br />';
		
		echo $info_arranged;
	}*/
?>