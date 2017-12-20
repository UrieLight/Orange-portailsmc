<?php  
	
	echo '
		<td>
			<span data-toggle="modal" id="" href="#chainesc_of_this_level'.$indice_groupesout_ids_array.'_support'.$rang_service.'" class="" title="">
				<p name="info_responsable" title="Cliquez pour afficher la chaine d\'escalade de ce groupe">
					<span class="nom_responsable"><b>'.$groupe_sout->groupe_de_soutien_nom.'</b></span><br /><br />
					<span class="tel1">'.$groupe_sout->groupe_de_soutien_pays.'</span><br />
					<span class="email">'.$groupe_sout->groupe_de_soutien_details.'</span><br />
					<span class="eds">'.$groupe_sout->groupe_de_soutien_disponibility.'</span><br />
				</p>
			</span>
		</td>
		';

?>
