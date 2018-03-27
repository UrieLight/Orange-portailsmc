<?php 

	/**
	*Modele du catalogue des services
	*/
	class Get_all_tables_Model extends CI_Model{
		
		function __construct(){

			$this->load->database();
		}

		//Récupération des infor sur un service
		public function getall_services_info($service_family){

			//$service_info_query = "null";
			// $this->db->order_by('service_nom', 'ASC');

			if ($service_family == "all") {
				# code...
				$this->db->order_by('service_nom', 'ASC');
				$service_info_query = $this->db->get('service');
			} 
			else if ($service_family == "sva") {
				# code...

		        $this->db->like('service_family', $service_family, 'both');
				$this->db->order_by('service_nom', 'ASC');
				$service_info_query = $this->db->get('service');
			} 
			else if ($service_family == "internet") {
				# code...

		        $this->db->like('service_family', $service_family, 'both');
				$this->db->order_by('service_nom', 'ASC');
				$service_info_query = $this->db->get('service');
			} 
			else if ($service_family == "interco") {
				# code...

		        $this->db->like('service_family', $service_family, 'both');
				$this->db->order_by('service_nom', 'ASC');
				$service_info_query = $this->db->get('service');

			} 
			else if ($service_family == "voix_data") {
				# code...

		        $this->db->like('service_family', $service_family, 'both');
				$this->db->order_by('service_nom', 'ASC');
				$service_info_query = $this->db->get('service');
			}


			return $service_info_query->result();
		}

		//Récupération de toutes les chaines de soutien
		public function getall_chains_support(){

			$chaine_sout_query = $this->db->get('chaine_soutien');

			return $chaine_sout_query->result();
		}

		//Récupération de toutes les chaines d'escalades
		public function getall_chains_escalation(){

			$chaine_esc_query = $this->db->get('chaine_escalade');

			return $chaine_esc_query->result();
		}

		//Récupération de toutes les plate-formes
		public function getall_platesformes(){

			$this->db->order_by('plateforme_nom', 'ASC');
			$plateforme_query = $this->db->get('plateforme');

			return $plateforme_query->result();
		}

		//Récupération de tous les outils
		public function getall_outils(){

			$outil_query = $this->db->get('outil');

			return $outil_query->result();
		}

		//Récupération de tous les responsables
		public function getall_responsables(){

			$this->db->order_by('responsable_nomprenom', 'ASC');
			$responsable_query = $this->db->get('responsable');

			return $responsable_query->result();
		}

		//Récupération de tous les groupes de soutiens
		public function getall_groupsoutien(){

			$this->db->order_by('groupe_de_soutien_nom', 'ASC');
			$groupesoutien_query = $this->db->get('groupes_de_soutien');

			return $groupesoutien_query->result();
		}

		//Récupération des relation entre les plates-formes et les services
		public function getall_service_plateformes(){

			$srv_pltfrm_query = $this->db->get('service-plateforme');

			return $srv_pltfrm_query->result();
		}

		//Récupération des relation entre les outils de supervision et les services
		public function getall_service_outils(){

			$srv_outil_query = $this->db->get('service-outil');

			return $srv_outil_query->result();
		}


		//affichage de la chaine d'escalade du niveau de soutien passed in parameters
		public function get_this_chainsout_level_escalation_chain($nom_responsable_niveau_sout){
			
			$this->db->select('groupe_de_soutien_id');
			$this->db->like('groupe_de_soutien_nom', $nom_responsable_niveau_sout, 'both');
			$chaine_sout_level_id = $this->db->get('groupes_de_soutien');
			
			$chaine_sout_level_id = $chaine_sout_level_id->result();
			$groupe_sout_id = $chaine_sout_level_id[0]->groupe_de_soutien_id;

		}
		


		//Récupération de toutes les architectures
		public function getall_architectures($type_architecture){
			
			if ($type_architecture != '') {
				# code...
				$this->db->like('architecture_type ', $type_architecture, 'both');
			}
			$this->db->order_by('architectur_nom_srvc', 'ASC');//DESC
			$architectur_query = $this->db->get('architecture');

			return $architectur_query->result();
		}


		//Récupération de toutes les liaisons architecture-service
		public function getall_services_architectures(){

			// $this->db->order_by('plateforme_nom', 'DESC');
			$service_archtctr_query = $this->db->get('service-arch');

			return $service_archtctr_query->result();
		}

	}
?>