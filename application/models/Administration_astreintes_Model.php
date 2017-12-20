<?php 

	/**
	* Model de la page d'administration 
	* des astreintes
	*/
	class Administration_astreintes_Model extends CI_Model{
		
		public $db_astreintes = null;
		
		function __construct(){
			
			$this->db_astreintes = $this->load->database('astreintes_db', TRUE);

		}


	}
?>