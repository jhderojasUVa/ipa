<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mis extends CI_Controller {

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

  public function devuelveCiudadesBarrios() {
		// Funcion que devuelte todos los barrios y ciudades a las que corresponden en JSON

    $datos["barriosCiudades"] = $this -> barrios_model -> showBarriosLocalizaciones();
		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelveCiudades() {
			// Funcion que devuelve las ciudades en JSON
			$datos["ciudades"] = $this -> barrios_model -> showCiudades();
			// Cambiamos la cabecera a JSON de respuesta
	    header('Content-Type: application/json');
	    // Escupimos la respuesta
	    echo json_encode($datos);
	}

  public function datosPiso() {
    // Devuelve todos los datos de un inmueble

    // Primero comprobamos si esta autorizado

    // Sacamos las cosas que nos interesan del POST
    $idpiso = $this -> input -> post_get("id");

    $datos["inmueble"] = $this -> pisos_model -> show_piso($idpiso);
    $datos["imagenes"] = $this -> pisos_model -> show_imagenes_piso($idpiso);
    $datos["precios"] = $this -> precios_model -> show_precios($idpiso);

    // Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
  }

}
