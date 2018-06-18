<?
/*

	Modelo para Precios

*/

class Precios_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

	function add_precio($idpiso, $precio, $descripcion) {
		// Funcion que añade un precio y descripcion a un piso
		$sql = "INSERT INTO pisos_precio (idpiso, precio, descripcion) VALUES ('".$idpiso."', '".$precio."', '".$descripcion."')";
		$resultado = $this -> db -> query($sql);
	}

	function del_precio($idpiso, $precio, $descripcion) {
		// Funcion que borra un precio de un piso determinado
		$sql = "DELETE FROM pisos_precio WHERE idpiso='".$idpiso."' AND precio='".$precio."'";
		$resultado = $this -> db -> query($sql);
	}

	function show_precios($idpiso) {
		// Funcion que muestra los precios y descripciones de un piso
		$sql = "SELECT precio, descripcion FROM pisos_precio WHERE idpiso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}

	function cant_show_precios($idpiso) {
		// Funcion que devuelve la cantidad de precios que hay para los pisos
		$sql = "SELECT precio, descripcion FROM pisos_precio WHERE idpiso=".$idpiso;
		$resultado = $this -> db -> query($sql);

		return $resultado -> num_rows();
	}
}
?>
