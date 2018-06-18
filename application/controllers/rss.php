<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RSS extends CI_Controller {
	// Aqui va todo lo de las RSS

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
		//$config["upload_path"] = "/Volumes/320Gb/httpdocs/ebayuva2/img_pisos";
		$config["allowed_types"] = "gif|jpg|png";
		$config["max_size"]	= "20000";

		// Y la libreria
		$this -> load -> library("upload", $config);
	}
}
?>
