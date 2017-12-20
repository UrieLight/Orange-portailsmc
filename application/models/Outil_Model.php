<?php 

	
	/**
	* Model des outils, CRUD sur la BD
	*/
	class Outil_Model extends CI_Model{
		
		function __construct(){

			$this->load->database();
		}


		//sauvegarde des information du nouvel outil created
		public function save_new_outil($outil_data){

			$outil_query = $this->db->insert('Outil', $outil_data);

			echo 'Outil crée avec succès';
		}
	}
?>