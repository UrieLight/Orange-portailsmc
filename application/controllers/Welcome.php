<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public $root_path = '../..';

	function __construct(){
			
		parent::__construct();
		// $this->load->model('Administration_Model', 'admin_model');
		$this->load->helper('url_helper');
		$this->load->helper('form_helper');
	}


	public function index()	{

		// $data['base_url'] = base_url();

		$this->load->view('welcome_message');
	}


	public function authentify(){

		$data['title'] = 'Portail SMC - Authentification';
		$data['base_url'] = base_url();
		$data['site_url'] = site_url();
		$data['root_path'] = $this->root_path;


		$this->load_head_page($data);
		$this->load->view('login_page', $data);
		$this->load_foot_page($data);
	}

	public function authentify_log_out(){
		session_destroy();
		
		$data['title'] = 'Portail SMC - Authentification';
		$data['base_url'] = base_url();
		$data['site_url'] = site_url();
		$data['root_path'] = $this->root_path;


		$this->load_head_page($data);
		$this->load->view('login_page', $data);
		$this->load_foot_page($data);
	}


	public function verify_user_credentials(){

		$cuid = $this->input->post('cuid');
		$password = $this->input->post('password');
		$key = '6834026871de5083fabeb366693a6ec2';

		$url = 'http://sit/uaconsole/index.php/UserAccessConsole/authentify?cuid='.$cuid.'&password='.$password.'&key='.$key;
		// $url = 'www.google.com/';
		// echo 'url: '.$url;
		// $url = str_replace($_SERVER["SERVER_NAME"], $_SERVER["LOCAL_ADDR"], $url);
		
		if ($cuid == "uadmin" && $password == "le_penseur") {
			# code...
			$valeur_authentification = 1;
		} else {
			# code...
			$native_response = file_get_contents($url);
			$json_response = json_decode($native_response, true);

			$valeur_authentification = $json_response['AUTH'];
		}
		
		
		echo $valeur_authentification;

	}
	

	public function get_user_credentials()	{
		
		# code...
		$cuid = $this->input->post('cuid_good');
		$key = '6834026871de5083fabeb366693a6ec2';

		$url = 'http://sit/uaconsole/index.php/UserAccessConsole/search?cuid='.$cuid.'&key='.$key;
		// echo 'url: '.$url;


		if ($cuid == "uadmin") {
			# code...
			$nom = 'Admin';

			$_SESSION['sess_user_name'] = $nom;
			$_SESSION['sess_cuid'] = $cuid;

			$this->input->set_cookie('cook_sess_user_name', $nom, time() + 24*3600, null, null, false, true);
			$this->input->set_cookie('cook_cuid', $cuid, time() + 24*3600, null, null, false, true);

		} else {

			$native_response = file_get_contents($url);
			$json_response = json_decode($native_response, true);

			// var_dump($json_response);

			$user_service = $json_response['SERVICE'];
			$user_departement = $json_response['DEPARTEMENT'];
			$user_matricule = $json_response['MATRICULE'];
			$user_direction = $json_response['DIRECTION'];
			$user_region = $json_response['REGION'];
			$user_email = $json_response['EMAIL'];

			//echo 'email: '.$user_email.' region: '.$user_region.' direction: '.$user_direction.' matricule: '.$user_matricule.'departement: '.$user_departement.'service: '.$user_service;
			
			$nom = 'User';
			if (isset($json_response['NOM']))
				$nom = $json_response['NOM'];
			

			$_SESSION['sess_user_name'] = $nom;
			$_SESSION['sess_cuid'] = $cuid;

			$this->input->set_cookie('cook_sess_user_name', $nom, time() + 24*3600, null, null, false, true);
			$this->input->set_cookie('cook_cuid', $cuid, time() + 24*3600, null, null, false, true);
		}

		/*echo "sess: ";
		print_r($_SESSION);
		echo "cook: ";
		print_r($_COOKIE);*/
								
		/*echo "scandir search ";	
		$dir = "/wamp//www//portailsmc//connexions_log.txt";
		$dir = scandir($dir);
		echo "scandir: ";
		print_r($dir);*/
		/*
			$file_path = '/wamp//www//portailsmc//connexions_log.txt';
			$file = fopen($file_path, "a+");
			$message = '****User: '.$nom.' le '.date("Y-m-d").' à '.date("H:i:s").'****';
			$message = $message. PHP_EOL .'';
			fwrite($file, $message);

			fclose($file);


			$to = 'urielfeuatsap@gmail.com';
			$object = 'New connection to the SMC Portail';
			$mail_message = 'Somebody get connected to the portal: \n'.$message;
			$from = 'from: Portail_SMC Admin';

		*/

		// mail($to, $object, $message, "From: ".$from);
		 //mail($to, $object, $mail_message);
		// var_dump('message sent');

		echo $nom;
		
	}


	/*==========  								========== *\
								COMON DATA 
	\*==========								========== */

		//fonction de load des hauts de pages
		public function load_head_page($data){
			$this->load->view('vw-templates/page_head', $data);
			$this->load->view('includings/connexion_style', $data);
			// $this->load->view('vw-templates/body_header', $data);
		}

		//fonction de load des bas de pages
		public function load_foot_page($data){
			// $this->load->view('vw-templates/body_footer');
			$this->load->view('includings/connexion_script', $data);
			$this->load->view('vw-templates/page_foot');
		}
}
