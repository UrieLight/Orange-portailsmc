<?php  
	


	echo '
		<td>
			<p name="info_responsable">
				<span class="nom_responsable"><b>';
				// .implode('\\n', explode('/', trim($resp->responsable_nomprenom))).
				/*foreach ($exploded_names as $one_name) {
					# code...
					echo $one_name;
					echo "<br>";
				}*/
				echo $resp->responsable_nomprenom.'</b></span><br /><br />';
				//affichage de la fonction si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				if ($resp->responsable_fonct != '.' && $resp->responsable_fonct != null && $resp->responsable_fonct != '*' && strlen($resp->responsable_fonct) >=2 ) {
					# code...
					echo '<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br /><br />';															
				}

				//affichage de responsable_tel1 si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				if ($resp->responsable_tel1 != '.' && $resp->responsable_tel1 != null && $resp->responsable_tel1 != '*' && strlen($resp->responsable_tel1) >=2 ) {
					# code...
					echo '<span class="tel1">'.$resp->responsable_tel1.'</span><br /><br />';															
				}

				//affichage de responsable_tel2 si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				if ($resp->responsable_tel2 != '.' && $resp->responsable_tel2 != 'N/A' && $resp->responsable_tel2 != null && strlen($resp->responsable_tel2) >=2 ) {
					# code...
					echo '<span class="tel2">'.$resp->responsable_tel2.'</span><br /><br />';															
				}

				
				// echo '<span class="email">';

				//affichage de responsable_email si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				if ($resp->responsable_email != '.' && $resp->responsable_email != 'N/A' && $resp->responsable_email != null) {
					# code...
					echo '<span class="mail">'.$resp->responsable_email.'</span><br /><br />';															
				}

				// echo implode('', explode(' ', trim($resp->responsable_email)));
				/*foreach ($exploded_mail as $one_mail) {
					# code...
					echo $one_mail;
					echo "<br>";
				}*/

				// echo $resp->responsable_email.'</span>';

				//affichage de la dispo si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				if ($resp->responsable_disponibilite != '.' && $resp->responsable_disponibilite != null && strlen($resp->responsable_disponibilite) >=2 ) {
					# code...
					echo '<span class="disponibility">'.$resp->responsable_disponibilite.'</span><br />';
				}

				//affichage de la EDS si ce n'est pas vide, pour ne pas 
				//inserer des <br> inutilement
				// echo 'eds: ';
				// var_dump($resp->responsable_eds);
				if ($resp->responsable_eds != '.' && strlen($resp->responsable_eds) >=2 && strlen($resp->responsable_eds) != null) {
					# code...
					echo '<span class="eds"> EDS: '.$resp->responsable_eds.'</span>';
				}

				echo '
			</p>
		</td>
		';
	/*echo '
		<td>
			<p name="info_responsable">
				<span class="nom_responsable"><b>'.$resp->responsable_nomprenom.'</b></span><br /><br />
				<span class="fonction_responsable">'.$resp->responsable_fonct.'</span><br />
				<span class="tel1">'.$resp->responsable_tel1.'</span><br />
				<span class="tel2">'.$resp->responsable_tel2.'</span><br />
				<span class="email">'.implode('\n', explode('\n', trim($resp->responsable_email))).'</span><br />
				<span class="eds">'.$resp->responsable_eds.'</span><br />
				<span class="disponibility">'.$resp->responsable_disponibilite.'</span>
			</p>
		</td>
		';*/

?>