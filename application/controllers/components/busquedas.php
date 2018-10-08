<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this->load->helper("file");

		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");

		$config["upload_path"] = "/Volumes/320Gb/httpdocs/ebayuva2/img_pisos";
		$config["allowed_types"] = "gif|jpg|png";
		$config["max_size"]	= "20000";

		// Y la libreria
		$this -> load -> library("upload", $config);
		$this -> load -> library("pagination");
	}

	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function busqueda() {
		// Funcion que realiza la busqueda y devuelve un JSON
		
		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}


}
