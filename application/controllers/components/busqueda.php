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

		$datos["q"] = $this -> input -> post_get('q');

		// Sacamos las ciudades y los barrios
		$datos["separadoOriginalCiudadesBarrios"] = $this -> analizadorsintactico -> troceador($datos["q"]);
		// Sacamos la busqueda, los elementos
		$datos["palabrasQuery"] = $this -> analizadorsintactico -> queryTexto($datos["q"]);

		// Analizamos sintacticamente la consulta para encontrar fallos de escritura
		// Primero sacamos las palabras de la BD
		$palabrasBD = $this -> palabras_model -> devuelvePalabras();
		// Pasamos el analizador a las palabras de la consulta y las de la BD
		$datos["palabrasQueryQuisoDecir"] = $this -> analizadorsintactico -> similitudes_palabras($datos["palabrasQuery"], $palabrasBD);

		// Query de los barrios y pisos (es un array lo que se devuelve)
		$datos["idBarriosCiudades"] = array();

		if (empty($datos["separadoOriginalCiudadesBarrios"]) == false) {
			// Si hay ciudades y barrios generamos las SQL a lo burro
			$query_busqueda_barrios_pisos = $this -> pisos_model -> devuelveSqlBarrioCiudad($datos["separadoOriginalCiudadesBarrios"]);
			// Ejecutamos las SQL y lo metemos en el array
			foreach ($query_busqueda_barrios_pisos as $row) {
				array_push($datos["idBarriosCiudades"], $this -> pisos_model -> ejecutaQueryRaw($row));
			}
		}

		// Query de la busqueda
		$query_busqueda = $this -> analizadorsintactico -> devuelveSQLWheredeArray($datos["palabrasQuery"]);

		// Pasamos la query al modelo
		$datos["resultados"] = $this -> pisos_model -> buscar_piso_query($query_busqueda, $datos["idBarriosCiudades"]);

		// Total de datos
		if ($datos["resultados"] == false) {
			// Si devuelve false, no hay
			$datos["total"] = 0;
		} else {
			// Sino sacamos la cantidad
			$datos["total"] = sizeof($datos["resultados"]);
		}

		// Vamos a la autentificacion, si es UVa tendra todo, asi que discriminamos
		// y si no es, limpiamos todo para que reciba nada
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] != true) {
				// Si NO es UVa
				$datos["resultados"][$i]["descripcion"] = "Lo sentimos. Solo los usuarios autentificados de la UVa pueden ver toda la informacion.";
				$datos["resultados"][$i]["direccion"] = "Lo sentimos. Solo los usuarios autentificados de la UVa pueden ver toda la informacion.";
				$datos["resultados"][$i]["cp"] = "";
			}
		} else {
			// O no esta autentificado
			//$datos["resultados"] = false;
			for ($i = 0; $i < sizeof($datos["resultados"]); $i++) {
				$datos["resultados"][$i]["descripcion"] = "Lo sentimos. Solo los usuarios autentificados de la UVa pueden ver toda la informacion.";
				$datos["resultados"][$i]["direccion"] = "Lo sentimos. Solo los usuarios autentificados de la UVa pueden ver toda la informacion.";
				$datos["resultados"][$i]["cp"] = "";
			}
		}

		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelveBarrios() {
		// Funcion que devuelve los barrios
		// La informacion no es "privada", luego no hace falta que veamos si es usuario IPA o no

		$datos["barriosCiudades"] = $this -> barrios_model -> devuelveBarriosLocalizaciones();

		// Cambiamos la cabecera a JSON de respuesta
    header('Content-Type: application/json');
    // Escupimos la respuesta
    echo json_encode($datos);
	}

}
