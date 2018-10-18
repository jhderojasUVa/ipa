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
    header("Content-Type: application/json");
    // Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelveCiudades() {
			// Funcion que devuelve las ciudades en JSON
			$datos["ciudades"] = $this -> barrios_model -> showCiudades();
			// Cambiamos la cabecera a JSON de respuesta
	    header("Content-Type: application/json");
	    // Escupimos la respuesta
	    echo json_encode($datos);
	}

	public function addPiso() {
		// Añade un piso

		// Lo primero el SSO de la UVa... ¡siempre!
		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			$datos["logeado"] = true;
		} else {
			// O no esta autentificado
			$datos["usuario"] = 0;
			$datos["logeado"] = false;
		}

		// Toma de datos
		$inputData = json_decode(trim(file_get_contents("php://input")), true);
		// Repartimos los datos en su sitio
		$descripcion = $inputData["inmueble"]["descripcion"];
		$calle = $inputData["inmueble"]["calle"];
		$numero = $inputData["inmueble"]["numero"];
		$piso = $inputData["inmueble"]["piso"];
		$letra = $inputData["inmueble"]["letra"];
		$cp = $inputData["inmueble"]["codigoPostal"];
		$contenido = implode("|", $inputData["inmueble"]["extras"]);
		$idlocalidad = $inputData["inmueble"]["ciudad"];
		$idbarrio = $inputData["inmueble"]["barrio"];
		$tlf = $inputData["inmueble"]["tlfContacto"];
		$libre = $inputData["libre"];

		if ($datos["logeado"] == true) {
			$datos["idpiso"] = $this -> pisos_model -> add_piso($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalidad, $idbarrio, $contenido, $tlf, $libre, $datos["usuario"], 0);
		}

		// Respuesta
		// Cambiamos la cabecera a JSON porque el mundo es un JSON continuo e inmutable
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
    header("Content-Type: application/json");
    // Escupimos la respuesta
    echo json_encode($datos);
  }

	public function devuelveDatosPiso() {

		// Sacamos las cosas que nos interesan del POST
    $idpiso = $this -> input -> post_get("id");

		$datos["inmueble"] = $this -> pisos_model -> show_piso($idpiso);

		// Cambiamos la cabecera a JSON de respuesta
    header("Content-Type: application/json");
    // Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelvePrecio() {

		// Sacamos las cosas que nos interesan del POST
    $idpiso = $this -> input -> post_get("id");

		$datos["precios"] = $this -> precios_model -> show_precios($idpiso);

		// Cambiamos la cabecera a JSON de respuesta
    header("Content-Type: application/json");
    // Escupimos la respuesta
    echo json_encode($datos);
	}

}
