<?
/*

	Modelo para Barrios

*/

class Barrios_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }
	
	function show_barrios($orden) {
		// Funcion que devuelve los barrios segun un orden
		
		switch ($orden) {
			case "nombre":
				$sql = "SELECT DISTINCT barrio, idbarrio, idlocalizacion FROM barrios ORDER BY barrio";
			case "nombre_invertido":
				$sql = "SELECT DISTINCT barrio, idbarrio, idlocalizacion FROM barrios ORDER BY barrio DESC";
			default:
				$sql = "SELECT DISTINCT barrio, idbarrio, idlocalizacion FROM barrios";
				$sql = "SELECT DISTINCT barrio, idbarrio, idlocalizacion FROM barrios ORDER BY barrio";
		}
		
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}
	
	function add_barrio($localizacion, $barrio) {
		// Funcion que añade un barrio nuevo si mete una localización
		
		$sql2 = "INSERT INTO barrios (idlocalizacion, barrio) VALUES (".$localizacion.", '".$barrio."')";
		$resultado = $this -> db -> query($sql);
	}
	
	function del_barrio($barrio) {
		// Funcion que borra un barrio y por lo tanto borrara todos los pisos
		
		// Primero borramos los pisos y por lo tanto, primero las imagenes de los pisos
		// No la borramos del HD por si acaso
		$sql = "SELECT idpiso FROM pisos WHERE idbarrio=".$barrio;
		$resultado = $this -> db -> query($sql);
		foreach ($resutado->result() as $row) {
			$sql_borra_piso = "DELETE FROM imagenes_pisos WHERE idpiso =".$row->idpiso;
			$resultado_borrado = $this -> db -> query($sql_borra_piso);
		}
		
		// Ahora borramos los pisos
		$sql = "DELETE FROM pisos WHERE idbarrio=".$barrio;
		$resultado = $this -> db -> query($sql);
		
		// Y por ultimo el barrio en si
		$sql = "DELETE FROM barrios WHERE idbarrio=".$barrio;
		$resultado = $this -> db -> query($sql);
	}
	
	function update_barrio($idbarrio, $barrio) {
		// Modificar el nombre de un barrio
		$sql = "UPDATE set barrio='".$barrio."' WHERE idbarrio=".$idbarrio;
		$resultado = $this -> db -> query($sql);
	}
	
	function barrios_con_pisos() {
		// Muestra los barrios que tienen pisos o false en caso de que no haya ninguno
		// Primero sacamos los pisos con barrios diferentes
		$sql = "SELECT DISTINCT idbarrio FROM pisos WHERE verificado=1";
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			// Ahora los recorremos y creamos un array donde metemos tambien la ciudad
			// Se que se podria hacer con un inner join, pero los odio, los odio y los sigo odiando
			$array_barrios_pisos = array();
			foreach ($resultado -> result() as $row) {
				$sql2 = "SELECT idlocalizacion, barrio FROM barrios WHERE idbarrio=".$row -> idbarrio;
				$resultado2 = $this -> db -> query($sql2);
				foreach ($resultado2 -> result() as $row2) {
					$sql3 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row2 -> idlocalizacion;
					$resultado3 = $this -> db -> query($sql3);
					foreach ($resultado3 -> result() as $row3) {
						// Y aqui ya tenemos todo lo que tenemos que hacer para arraydizarlo
						$array_barrios_pisos[] = array("idbarrio" => $row ->idbarrio, "barrio" => $row2 -> barrio, "ciudad" => $row3 ->localizacion);
					}
				}
			}
			return $array_barrios_pisos;
		} else {
			// Si no hay na de na, retornamos false
			return false;
		}
	}
	
	function devuelve_barrio($idpiso) {
		// Devuelve el nombre del barrio con el identifcador del piso
		$sql = "SELECT idbarrio FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
			$idbarrio = $row -> idbarrio;
		}
		
		$sql = "SELECT barrio FROM barrios WHERE idbarrio=".$idbarrio;
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
			$barrio = $row -> barrio;
		}
		
		return $barrio;
	}
}
?>