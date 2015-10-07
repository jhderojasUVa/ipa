<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscador extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this->load->helper("file");
		
		// Modelos
		$this -> load -> model("barrios_model");
		$this -> load -> model("comentarios_model");
		$this -> load -> model("localizaciones_model");
		$this -> load -> model("pisos_model");
		
		// Librerias
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
		
		// Configuracion del upload
		//$config["upload_path"] = "../../img_pisos/";
		$config["upload_path"] = "/Volumes/320Gb/httpdocs/ebayuva2/img_pisos";
		$config["allowed_types"] = "gif|jpg|png";
		$config["max_size"]	= "20000";
		//$config["max_width"]  = "1024";
		//$config["max_height"]  = "768";
		
		// Y la libreria
		$this -> load -> library("upload", $config);
	}
	
	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function buscar() {
		// Funcion para buscar
		
		// Lo primero el SSO
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;
		
		$q = $this -> input -> post("q");
		$datos["buscar_pisos"] = $this -> pisos_model -> buscar_piso($q);
		$datos["buscar_comentarios"] = $this -> comentarios_model -> buscar_comentario($q);
	}

}