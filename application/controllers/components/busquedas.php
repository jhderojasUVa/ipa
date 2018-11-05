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

		// La forma de funcionamiento:
		// 1. Separamos el array de la busqueda por sus espacio (char(32))
		// 2. Buscamos si contiene la palabra "barrio:" o "ciudad:"
		// 2.1. Si tiene podemos buscar por el nombre del barrio o ciudad (ademas), parametro del WHERE
		// 2.2. Si no tiene buscamos solo en contenido y calle, parametro del WHERE
		// 3. Tenemos que 2.1 y 2.2 pueden darse a la vez
		// 4. Realizamos la busqueda

		// Usaremos el metodo spotify para los generos para buscar por ciudades y barrios
		// es decir barrio:ID o barrio:nombre

		/*$sqlBase = "SELECT ";
		$sqlFrom = " FROM pisos ";
		$sqlWhere = " WHERE ";*/

		$datos["q"] = $this -> input -> post_get('q');

		// Primero lo pasamos por la piedra
		$datos["qLimpio"] = $this -> Analizadorsintactico -> eliminaPronombres($datos["q"]);
		$datos["qLimpio"] = $this -> Analizadorsintactico -> eliminaUnidores($datos["qLimpio"]);

		$datos["barrio"] = $this -> Analizadorsintactico -> buscaBarrio($datos["qLimpio"]);
		$datos["ciudad"] = $this -> Analizadorsintactico -> buscaCiudad($datos["qLimpio"]);

		if ($this -> Analizadorsintactico -> esUnNumero($datos["barrio"]) || $this -> Analizadorsintactico -> esUnNumero($datos["ciudad"])) {
			// Si la busqueda viene del ID y tal del barrio o la ciudad
			if ($this -> Analizadorsintactico -> esUnNumero($datos["barrio"])) {
				// Olvidamos todo lo demas ya que viene de la principal y hacemos la busqueda por esto
				$datos["resultado"] = $this -> pisos_model -> buscarBarrioCiudad($datos["barrio"], "barrio");
			}
			if ($this -> Analizadorsintactico -> esUnNumero($datos["ciudad"])) {
				// Olvidamos todo lo demas ya que viene de la principal y hacemos la busqueda por esto
				$datos["resultado"] = $this -> pisos_model -> buscarBarrioCiudad($datos["barrio"], "ciudad");
			}
		} else {
			// Si es una busqueda de palabras y tal
		}



		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}


}
