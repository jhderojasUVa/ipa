<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this -> load -> helper("file");

		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
		$this -> load -> library("analizadorsintactico");

		// Y la libreria
		//$this -> load -> library("upload", $config);
		//$this -> load -> library("pagination");
	}

	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function busqueda() {
		// Funcion que realiza la busqueda y devuelve un JSON

		// Usaremos el metodo spotify para los generos para buscar por ciudades y barrios
		// es decir barrio:ID o barrio:nombre

		// Por ahora la limpia de barios y ciudades... mas adelante
		// step by step

		$datos["q"] = $this -> input -> post_get('q');

		// Sacamos las ciudades y los barrios
		$datos["ciudad_barrio"] = $this -> analizadorsintactico -> troceador($datos["q"]);
		// Sacamos la busqueda, los elementos
		$datos["palabrasQuery"] = $this -> analizadorsintactico -> queryTexto($datos["q"]);

		// Query de la busqueda
		$query_busqueda = $this -> analizadorsintactico -> devuelveSQLWheredeArray($datos["palabrasQuery"]);
		// Pasamos la query al modelo
		$datos["resultados"] = $this -> pisos_model -> buscar_piso_query($query_busqueda);

		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}


}
