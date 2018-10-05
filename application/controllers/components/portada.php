<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portada extends CI_Controller {

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

  public function slideshow() {
    // Funcion que devuelve el JSON necesario para el componente del slideshow

    $datos["slideshow"] = $this -> pisos_model -> muestra_5_imagenes_piso(6);

    // Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);

  }

	public function ultimos_6() {
		// Funcion que debuelve el JSON necesario para los ultimos 6 pisos

		$datos["ultimos_6"] = $this -> pisos_model -> muestra_ultimos_pisos(6);

		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}

	public function barriosciudades() {
		// Funcion que devuelve todas las ciudades y barrios de las ciudades

		$datos["barrios"] = $this -> barrios_model -> barrios_con_pisos();
		$datos["ciudades"] = $this -> barrios_model -> ciudades_con_pisos();

		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}

}
