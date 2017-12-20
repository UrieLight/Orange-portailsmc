<?php 

	/**
	* 
	*/
	class Astreintes_model extends CI_Model{
		
		public $db_astreintes = null;

		function __construct(){
			
			$this->db_astreintes = $this->load->database('astreintes_db', TRUE);
		}

		//récupération de tous le personnel d'astreintes enregistré
		public function getall_personnel(){
			
			$all_personnel_astreintes = $this->db_astreintes->get('personnel_astreinte');

			return $all_personnel_astreintes->result();
		}

		//récupération de la période correspondante à la date du lundi envoyée en paramètre
		public function get_corresponding_period($date_lundi){
			
			$this->db_astreintes->select('periode_id');
			$this->db_astreintes->like('periode_debut_semaine', $date_lundi, 'both');
			$periode = $this->db_astreintes->get('periode');

			return $periode->result();
		}


		//affichage des astreintes de rotation du service maintenance
		/*public function display_maintenance_rot($periode){
			
			$all_personnel = $this->getall_personnel();

			$this->db_astreintes->like('smc_maintce_rotation_periode_id', $periode, 'both');
			$personnel_astreinte_current_week = $this->db_astreintes->get('smc_maintce_rotation');
			$personnel_astreinte_current_week = $personnel_astreinte_current_week->result();

			print_r($personnel_astreinte_current_week);
		}*/



		//affichage des astreintes de rotation du service maintenance
		public function display_smc_management_planning($periode){
			
			$all_personnel = $this->getall_personnel();

			//info sur le planning des astreintes du service smc management/robots
			$this->db_astreintes->select('smc_management_niv1, smc_management_niv2, smc_management_escalade');
			$this->db_astreintes->like('smc_management_admin_robot_periode_id', $periode, 'both');
			$personnel_astreinte_manag_robt_current_week = $this->db_astreintes->get('smc_management_admin_robot');
			$personnel_astreinte_manag_robt_current_week = $personnel_astreinte_manag_robt_current_week->result();
			// var_dump($personnel_astreinte_manag_robt_current_week);

			//info sur le planning des astreintes du service smc management/sav200
			$this->db_astreintes->select('smc_management_admin_sav2000_niv1, smc_management_admin_sav2000_escalade');
			$this->db_astreintes->like('smc_management_admin_sav2000_periode_id', $periode, 'both');
			$personnel_astreinte_manag_sav_current_week = $this->db_astreintes->get('smc_management_admin_sav2000');
			$personnel_astreinte_manag_sav_current_week = $personnel_astreinte_manag_sav_current_week->result();

			$responsable_robt = null;
			$responsable_robt_contact = null;

			//data of admin robots responsable
			foreach ($all_personnel as $personnel) {
				
				if (!empty($personnel_astreinte_manag_robt_current_week) && ($personnel_astreinte_manag_robt_current_week[0]->smc_management_niv2 == $personnel->personnel_astreinte_id)) {
					
					$responsable_robt = $personnel->personnel_nom_prenom;
					$responsable_robt_contact = $personnel->personnel_contact;
				}
			}


			$responsable_sav2000 = null;
			$responsable_contact_sav2000 = null;

			//data of admin sav2000 responsable
			foreach ($all_personnel as $personnel) {
				
				if (!empty($personnel_astreinte_manag_sav_current_week) && ($personnel_astreinte_manag_sav_current_week[0]->smc_management_admin_sav2000_niv1 == $personnel->personnel_astreinte_id)) {
					
					$responsable_sav2000 = $personnel->personnel_nom_prenom;
					$responsable_contact_sav2000 = $personnel->personnel_contact;
				}
			}

			$smc_management_robt_niv1 = null;
			$smc_management_robt_escalade = null;

			if (!empty($personnel_astreinte_manag_robt_current_week)) {
				$smc_management_robt_niv1 = $personnel_astreinte_manag_robt_current_week[0]->smc_management_niv1; 
				$smc_management_robt_escalade = $personnel_astreinte_manag_robt_current_week[0]->smc_management_escalade; 
			}

			$smc_management_admin_sav2000_escalade = null;
			if (!empty($personnel_astreinte_manag_sav_current_week)) {
				// $smc_management_sav_niv1 = $personnel_astreinte_manag_sav_current_week[0]->smc_management_niv1; 
				$smc_management_admin_sav2000_escalade = $personnel_astreinte_manag_sav_current_week[0]->smc_management_admin_sav2000_escalade; 
			}

			// var_dump($personnel_astreinte_manag_sav_current_week);

			echo '
				<!-- astreintes management -->
				<div>
						<!--ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Management</h4>
							</li>
						</ul-->
		 
		 				<!-- administration robots -->
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3" class="table_title">Administration Robots</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Niveau 2</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">'.$smc_management_robt_niv1.'</td>
									<td class="responsable_cell" style="vertical-align:middle;">'.$responsable_robt.' <br><span class="tel">'.$responsable_robt_contact.'</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">'.$smc_management_robt_escalade.'</td>
								</tr>
							</tbody>
						</table>
						<br><br>
	 	
		 				<!-- administration SAV2000 -->
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3"  class="table_title">Administration SAV2000 <br><span>(OCEANE, SWAN...)</span></th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">'.$responsable_sav2000.'<br><span class="tel">'.$responsable_contact_sav2000.'</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">'.$smc_management_admin_sav2000_escalade.'</td>
								</tr>
							</tbody>
						</table>
				</div>	
			';

			// return $planning;
			// print_r($personnel_astreinte_current_week);
		}


		//affichage des astreintes de rotation du service maintenance
		public function display_smc_maintenance_planning($periode){
			
			$all_personnel = $this->getall_personnel();

			//info sur le planning des astreintes du service smc maintenance/reseau
			$this->db_astreintes->select('smc_maintenance_reseau_escalade, smc_maintenance_reseau_niveau1');
			$this->db_astreintes->like('smc_maintenance_reseau_periode_id', $periode, 'both');
			$personnel_astreinte_rzo_current_week = $this->db_astreintes->get('smc_maintenance_reseau');
			$personnel_astreinte_rzo_current_week = $personnel_astreinte_rzo_current_week->result();
			/*echo "'personnel_astreinte_rzo_current_week: ";
			var_dump($personnel_astreinte_rzo_current_week);*/

			//info sur le planning des astreintes du service smc maintenance/rotation
			$this->db_astreintes->select('lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche');
			$this->db_astreintes->like('smc_maintce_rotation_periode_id', $periode, 'both');
			$personnel_astreinte_rot_current_week = $this->db_astreintes->get('smc_maintce_rotation');
			$personnel_astreinte_rot_current_week = $personnel_astreinte_rot_current_week->result();
			/*echo "'personnel_astreinte_rot_current_week: ";
			var_dump($personnel_astreinte_rot_current_week);*/

			//info sur le planning des astreintes du service smc maintenance/permanence
			$this->db_astreintes->select('smc_maintce_permanence_responsable');
			$this->db_astreintes->like('smc_maintce_permanence_periode_id', $periode, 'both');
			$personnel_astreinte_perm_current_week = $this->db_astreintes->get('smc_maintce_permanence');
			$personnel_astreinte_perm_current_week = $personnel_astreinte_perm_current_week->result();
			/*echo "'personnel_astreinte_perm_current_week: ";
			var_dump($personnel_astreinte_perm_current_week);*/

			$responsable_rzo_niv1 = null;
			$responsable_rzo_niv1_contact = null;

			$responsable_rzo_esc = null;
			$responsable_rzo_esc_contact = null;

			//data of maintenance/reseau responsable
			foreach ($all_personnel as $personnel) {
				
				//niveau 1 astreinte reseau
				if (!empty($personnel_astreinte_rzo_current_week) && ($personnel_astreinte_rzo_current_week[0]->smc_maintenance_reseau_niveau1 == $personnel->personnel_astreinte_id)) {
					
					$responsable_rzo_niv1 = $personnel->personnel_nom_prenom;
					$responsable_rzo_niv1_contact = $personnel->personnel_contact;
				}

				//escalade astreinte reseau
				if (!empty($personnel_astreinte_rzo_current_week) && ($personnel_astreinte_rzo_current_week[0]->smc_maintenance_reseau_escalade == $personnel->personnel_astreinte_id)) {
					
					$responsable_rzo_esc = $personnel->personnel_nom_prenom;
					$responsable_rzo_esc_contact = $personnel->personnel_contact;
				}
			}

			//initialisation des variables
			$responsable_rot_lundi_matin = $responsable_rot_lundi_matin_contact = $responsable_rot_lundi_soir = null;
			$responsable_rot_lundi_soir_contact = null;

			$responsable_rot_mardi_matin = $responsable_rot_mardi_matin_contact = null;

			$responsable_rot_mardi_soir = $responsable_rot_mardi_soir_contact = null;

			$responsable_rot_mercredi_matin = $responsable_rot_mercredi_matin_contact = null;

			$responsable_rot_mercredi_soir = $responsable_rot_mercredi_soir_contact = null;

			$responsable_rot_jeudi_matin = $responsable_rot_jeudi_matin_contact = null;

			$responsable_rot_jeudi_soir = $responsable_rot_jeudi_soir_contact = null;

			$responsable_rot_vendredi_matin = $responsable_rot_vendredi_matin_contact = null;
			
			$responsable_rot_vendredi_soir = $responsable_rot_vendredi_soir_contact = null;
			
			$responsable_rot_samedi_matin = $responsable_rot_samedi_matin_contact = null;
			
			$responsable_rot_samedi_soir = $responsable_rot_samedi_soir_contact = null;
			
			$responsable_rot_dimanche_matin = $responsable_rot_dimanche_matin_contact = null;

			$responsable_rot_dimanche_soir = $responsable_rot_dimanche_soir_contact = null;
			//data of maintenance/rotation responsable
			foreach ($all_personnel as $personnel) {

				//rotation lundi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->lundi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_lundi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_lundi_matin_contact = $personnel->personnel_contact;
				}
				//rotation lundi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->lundi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_lundi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_lundi_soir_contact = $personnel->personnel_contact;
				}


				//rotation mardi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->mardi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_mardi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_mardi_matin_contact = $personnel->personnel_contact;
				}
				//rotation mardi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->mardi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_mardi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_mardi_soir_contact = $personnel->personnel_contact;
				}


				//rotation mercredi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->mercredi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_mercredi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_mercredi_matin_contact = $personnel->personnel_contact;
				}
				//rotation mercredi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->mercredi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_mercredi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_mercredi_soir_contact = $personnel->personnel_contact;
				}


				//rotation jeudi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->jeudi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_jeudi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_jeudi_matin_contact = $personnel->personnel_contact;
				}
				//rotation jeudi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->jeudi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_jeudi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_jeudi_soir_contact = $personnel->personnel_contact;
				}


				//rotation vendredi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->vendredi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_vendredi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_vendredi_matin_contact = $personnel->personnel_contact;
				}
				//rotation vendredi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->vendredi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_vendredi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_vendredi_soir_contact = $personnel->personnel_contact;
				}


				//rotation samedi matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->samedi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_samedi_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_samedi_matin_contact = $personnel->personnel_contact;
				}
				//rotation samedi soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->samedi == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_samedi_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_samedi_soir_contact = $personnel->personnel_contact;
				}


				//rotation dimanche matin
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[0]->dimanche == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_dimanche_matin = $personnel->personnel_nom_prenom;
					$responsable_rot_dimanche_matin_contact = $personnel->personnel_contact;
				}
				//rotation dimanche soir
				if (!empty($personnel_astreinte_rot_current_week) && ($personnel_astreinte_rot_current_week[1]->dimanche == $personnel->personnel_astreinte_id)) {
					
					$responsable_rot_dimanche_soir = $personnel->personnel_nom_prenom;
					$responsable_rot_dimanche_soir_contact = $personnel->personnel_contact;
				}
			}

			$responsable_perm = null;
			$responsable_perm_contact = null;

			//data of maintenance/permanence responsable
			foreach ($all_personnel as $personnel) {
				
				if (!empty($personnel_astreinte_perm_current_week) && ($personnel_astreinte_perm_current_week[0]->smc_maintce_permanence_responsable == $personnel->personnel_astreinte_id)) {
					
					$responsable_perm = $personnel->personnel_nom_prenom;
					$responsable_perm_contact = $personnel->personnel_contact;
				}
			}

			echo  '
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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Pilote de service</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
							
							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">'.$responsable_rzo_niv1.'<br><span class="tel">'.$responsable_rzo_niv1_contact.'</span></td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">'.$responsable_rzo_esc.'<br><span class="tel">'.$responsable_rzo_esc_contact.'</span></td>
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
							</tbody>
						</table>
						<br><br>
					</div>

					<!-- astreintes rotation -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Rotation</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">
							
							<thead>
								<tr>
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
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
									<td class="cell_responsables">'.$responsable_rot_lundi_matin.'<br><span>'.$responsable_rot_lundi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_lundi_soir.'<br><span>'.$responsable_rot_lundi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Mardi</td>
									<td class="cell_responsables">'.$responsable_rot_mardi_matin.'<br><span>'.$responsable_rot_mardi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_mardi_soir.'<br><span>'.$responsable_rot_mardi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Mercredi</td>
									<td class="cell_responsables">'.$responsable_rot_mercredi_matin.'<br><span>'.$responsable_rot_mercredi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_mercredi_soir.'<br><span>'.$responsable_rot_mercredi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Jeudi</td>
									<td class="cell_responsables">'.$responsable_rot_jeudi_matin.'<br><span>'.$responsable_rot_jeudi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_jeudi_soir.'<br><span>'.$responsable_rot_jeudi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Vendredi</td>
									<td class="cell_responsables">'.$responsable_rot_vendredi_matin.'<br><span>'.$responsable_rot_vendredi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_vendredi_soir.'<br><span>'.$responsable_rot_vendredi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Samedi</td>
									<td class="cell_responsables">'.$responsable_rot_samedi_matin.'<br><span>'.$responsable_rot_samedi_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_samedi_soir.'<br><span>'.$responsable_rot_samedi_soir_contact.'</span></td>
								</tr>
								<tr>
									<td>Dimanche</td>
									<td class="cell_responsables">'.$responsable_rot_dimanche_matin.'<br><span>'.$responsable_rot_dimanche_matin_contact.'</span></td>
									<td class="cell_responsables">'.$responsable_rot_dimanche_soir.'<br><span>'.$responsable_rot_dimanche_soir_contact.'</span></td>
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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>8h30-12h30 & 15h00-18h00</th>
									<!-- <th></th> -->
								</tr>
							</thead>

							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">'.$responsable_perm.'<br><span class="tel">'.$responsable_perm_contact.'</span></td>
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
			';

			// return $planning;
			// print_r($personnel_astreinte_current_week);
		}


		//affichage des astreintes de rotation du service maintenance
		public function display_tmc_evt_planning($periode){
			
			$all_personnel = $this->getall_personnel();

			//info sur le planning des astreintes du service smc maintenance/reseau
			$this->db_astreintes->select('smc_maintenance_reseau_escalade, smc_maintenance_reseau_niveau1');
			$this->db_astreintes->like('smc_maintenance_reseau_periode_id', $periode, 'both');
			$personnel_astreinte_rzo_current_week = $this->db_astreintes->get('smc_maintenance_reseau');
			$personnel_astreinte_rzo_current_week = $personnel_astreinte_rzo_current_week->result();
			// var_dump($personnel_astreinte_rzo_current_week);

			//info sur le planning des astreintes du service smc maintenance/rotation
			$this->db_astreintes->select('lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche');
			$this->db_astreintes->like('smc_maintce_rotation_periode_id', $periode, 'both');
			$personnel_astreinte_rot_current_week = $this->db_astreintes->get('smc_maintce_rotation');
			$personnel_astreinte_rot_current_week = $personnel_astreinte_rot_current_week->result();
			var_dump($personnel_astreinte_rot_current_week);

			//info sur le planning des astreintes du service smc maintenance/permanence
			$this->db_astreintes->select('smc_maintce_permanence_responsable');
			$this->db_astreintes->like('smc_maintce_permanence_periode_id', $periode, 'both');
			$personnel_astreinte_perm_current_week = $this->db_astreintes->get('smc_maintce_permanence');
			$personnel_astreinte_perm_current_week = $personnel_astreinte_perm_current_week->result();
			// var_dump($personnel_astreinte_perm_current_week);

			//info sur le planning des astreintes du service smc management/robots
			$this->db_astreintes->select('smc_management_niv1, smc_management_niv2, smc_management_escalade');
			$this->db_astreintes->like('smc_management_admin_robot_periode_id', $periode, 'both');
			$personnel_astreinte_manag_robt_current_week = $this->db_astreintes->get('smc_management_admin_robot');
			$personnel_astreinte_manag_robt_current_week = $personnel_astreinte_manag_robt_current_week->result();
			// var_dump($personnel_astreinte_manag_robt_current_week);

			//info sur le planning des astreintes du service smc management/sav200
			$this->db_astreintes->select('smc_management_admin_sav2000_niv1, smc_management_admin_sav2000_escalade');
			$this->db_astreintes->like('smc_management_admin_sav2000_periode_id', $periode, 'both');
			$personnel_astreinte_manag_sav_current_week = $this->db_astreintes->get('smc_management_admin_sav2000');
			$personnel_astreinte_manag_sav_current_week = $personnel_astreinte_manag_sav_current_week->result();
			// var_dump($personnel_astreinte_manag_sav_current_week);

			$planning =  '
				
				<!-- PLANNINGS DU SERVICE SMC MAINTENANCE-->
				<div class="service_planning active" id="smc_maintenance">

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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Pilote de service</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
							
							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">BIRROKI <br><span class="tel">699 94 98 94</span></td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td>
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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
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
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Permanence</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>8h30-12h30 & 15h00-18h00</th>
									<!-- <th></th> -->
								</tr>
							</thead>

							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">NDEBI Christian <br><span class="tel">699 94 98 94</span></td>
									<!-- <td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td> -->
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
				<div class="service_planning " id="smc_management">

					<!-- astreintes management -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Management</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3" class="table_title">Administration Robots</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Niveau 2</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Equipe FO Concernée</td>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila  <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
						<br><br>
	 	
		 				<!-- administration SAV2000 -->
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3"  class="table_title">Administration SAV2000 <br><span>(OCEANE, SWAN...)</span></th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			';

			return $planning;
			// print_r($personnel_astreinte_current_week);
		}


		//affichage des astreintes de rotation du service maintenance
		public function display_astreintes_sassbd($periode){
			
			$all_personnel = $this->getall_personnel();

			//info sur le planning des astreintes du service smc maintenance/reseau
			$this->db_astreintes->select('smc_maintenance_reseau_escalade, smc_maintenance_reseau_niveau1');
			$this->db_astreintes->like('smc_maintenance_reseau_periode_id', $periode, 'both');
			$personnel_astreinte_rzo_current_week = $this->db_astreintes->get('smc_maintenance_reseau');
			$personnel_astreinte_rzo_current_week = $personnel_astreinte_rzo_current_week->result();
			// var_dump($personnel_astreinte_rzo_current_week);

			echo  '
				
				<!-- PLANNINGS DU SERVICE SMC MAINTENANCE-->
				<div class="service_planning active" id="smc_maintenance">

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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Pilote de service</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
							
							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">BIRROKI <br><span class="tel">699 94 98 94</span></td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td>
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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
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
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Permanence</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>8h30-12h30 & 15h00-18h00</th>
									<!-- <th></th> -->
								</tr>
							</thead>

							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">NDEBI Christian <br><span class="tel">699 94 98 94</span></td>
									<!-- <td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td> -->
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
				<div class="service_planning " id="smc_management">

					<!-- astreintes management -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Management</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3" class="table_title">Administration Robots</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Niveau 2</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Equipe FO Concernée</td>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila  <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
						<br><br>
	 	
		 				<!-- administration SAV2000 -->
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3"  class="table_title">Administration SAV2000 <br><span>(OCEANE, SWAN...)</span></th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			';

			// return $planning;
			// print_r($personnel_astreinte_current_week);
		}


		//affichage des astreintes de rotation du service maintenance
		public function display_osi_bss_plannings($periode){
			
			$all_personnel = $this->getall_personnel();

			//info sur le planning des astreintes du service smc maintenance/reseau
			$this->db_astreintes->select('smc_maintenance_reseau_escalade, smc_maintenance_reseau_niveau1');
			$this->db_astreintes->like('smc_maintenance_reseau_periode_id', $periode, 'both');
			$personnel_astreinte_rzo_current_week = $this->db_astreintes->get('smc_maintenance_reseau');
			$personnel_astreinte_rzo_current_week = $personnel_astreinte_rzo_current_week->result();
			// var_dump($personnel_astreinte_rzo_current_week);

			echo  '
				
				<!-- PLANNINGS DU SERVICE SMC MAINTENANCE-->
				<div class="service_planning active" id="smc_maintenance">

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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Pilote de service</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>
							
							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">BIRROKI <br><span class="tel">699 94 98 94</span></td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td>
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
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
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
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Permanence</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<th></th><!-- Pôles -->
									<!-- <th></th>
									<th></th> -->
									<th colspan="2" class="table_title">Support client niveau 3</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Jours</th>
									<th>8h30-12h30 & 15h00-18h00</th>
									<!-- <th></th> -->
								</tr>
							</thead>

							<tbody style="">
								<tr>
									<td>Lundi</td>
									<td rowspan="7" class="responsable_cell" style="vertical-align:middle;">NDEBI Christian <br><span class="tel">699 94 98 94</span></td>
									<!-- <td rowspan="7" class="responsable_cell" style="vertical-align:middle;">KEMAYOU Anicet <br><span class="tel">699 94 98 94</span></td> -->
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
				<div class="service_planning " id="smc_management">

					<!-- astreintes management -->
					<div>
						<ul>
							<li>
								<h4 style="margin-left:2%;" class="service_branch">Astreintes Management</h4>
							</li>
						</ul>
		 
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3" class="table_title">Administration Robots</th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Niveau 2</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Equipe FO Concernée</td>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila  <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
						<br><br>
	 	
		 				<!-- administration SAV2000 -->
						<table class="table table-bordered table-striped">

							<thead>
								<tr>
									<!-- <th></th>
									<th></th> -->
									<th colspan="3"  class="table_title">Administration SAV2000 <br><span>(OCEANE, SWAN...)</span></th>
									<!-- <th ></th> -->
								</tr>
								<tr>
									<th>Niveau 1</th>
									<th>Escalade</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="responsable_cell" style="vertical-align:middle;">Rosalie Messila <br><span class="tel">699 94 98 94</span></td>
									<td class="responsable_cell" style="vertical-align:middle;">ASTREINTE MANAGERIALE SMC</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			';

			// return $planning;
			// print_r($personnel_astreinte_current_week);
		}
	}
?>