<!-- DETAILS SUR LE SERVICE ==================== -->
<!-- CHAINE DE SOUTIEN ==================== -->
<div class="chaine_sout service_info">

	<div class="page-header">
		<p class="info_title"><b>Chaine de soutien</b> <img src="<?= $root_path ?>/img/content/soutien.png" alt="soutien_img" /></p>
	</div>

	<div class="service_info_content">
		
		<br>
		<ul style="margin-left: -1em;">
			<li>Sélectionnez une chaine de soutien existante
			<span id="refresh_chainsout_list" class="btn btn-primary glyphicon glyphicon-refresh" title="Rafraichir la liste" style="float: right;"></span>
			</li>
		</ul>

		
		<div class="chaine_select_pane" style="/*display: none;*/">

			<select id="select_chaine_sout" name="select_chaine_sout" class="form-control" style="width: 50%;margin: 0 2%;" >
				
				<!-- <option selected="selected" value="" disabled> Sélectionnez une chaine de soutien </option> -->
				<option selected="selected" value=""></option>
				
				<?php foreach ($all_chaines_soutien as $chaine_soutien): ?>

					<option value="<?= $chaine_soutien->chainesout_nom ?>" id="<?= $chaine_soutien->chainesout_id ?>" >

						<!-- id de la chaine de soutien selected -->
						<!-- <span style="display: none;"></span> -->

						<!-- nom de la chaine de soutien selected -->
						<?= $chaine_soutien->chainesout_nom ?>
					</option>
				<?php endforeach; ?>
			</select>

			<!-- ici, s'affichera le tableau (hidden by default) de la chaine de soutien qui sera choisie -->
			<div id="selected_chainsout" style="overflow: auto;"></div>
			
			<br>
			<br>
			<em><a target="_blank" class="lien_externe_creation" href="<?= $site_url; ?>/Administration/nouvelle_chaine_soutien" style="float: right;">Créez une nouvelle chaine de soutien<span class="glyphicon glyphicon-triangle-right"></span></a></em>
		</div>
		<!-- </form> -->
	</div>
</div>
