<?
/*

	Modelo para Palabras del analizador sintactico

*/

class Palabras_model extends CI_Model {

    function __construct() {
      // Call the Model constructor
      parent::__construct();
  		// Cargamos la base de datos
  		$this -> load -> database();
    }

    function devuelvePalabras() {
      // Funcion que devuelve las palabras

      $sql = "SELECT palabra FROM palabras ORDER BY palabra";
      $resultado = $this -> db -> query($sql);

      $tmp = array();
      foreach ($resultado -> result() as $row) {
        array_push($tmp, $row -> palabra);
      }

      return $tmp;
    }

  }
