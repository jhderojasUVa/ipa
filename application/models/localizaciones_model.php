<?
/*

	Modelo para Ciudades/Localizaciones

*/

class Localizaciones_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

	function show_localizaciones($forma) {
		// Muestra las localizaciones
		switch ($forma) {
			case "nombre":
				$sql = "SELECT idlocalizacion, localizacion FROM localizaciones ORDER BY localizacion";
			case "nombre_invertido":
				$sql = "SELECT idlocalizacion, localizacion FROM localizaciones ORDER BY localizacion DESC";
			default:
				$sql = "SELECT idlocalizacion, localizacion FROM localizaciones";
		}
		$resultado = $this -> db -> query($sql);
		return $resultado->result();
	}

	function add_localizacion($ciudad) {
		// Añade una ciudad nueva
		$sql = "INSERT INTO localizaciones (localizacion) VALUES ('".$ciudad."')";
		$resultado = $this -> db -> query($sql);
	}

	function update_localizacion($idciudad, $ciudad) {
		//Modifica el nombre de una ciudad
		$sql = "UPDATE SET localizacion='".$ciudad."' FROM localizaciones WHERE idlocalizacion=".$idciudad;
		$resultado = $this -> db -> query($sql);
	}

	function mostrar_localizaciones_pisos() {
		// Funcion que muestra las ciudades con cosas
		$array_devolver = array();
		$sql = "SELECT DISTINCT idlocalizacion FROM pisos WHERE verificado=1";
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			foreach ($resultado -> result() as $row) {
				$sql2 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion = ".$row -> idlocalizacion;
				$resultado2 = $this -> db -> query($sql2);
				foreach ($resultado2 -> result() as $row2) {
					$array_devolver[] = array("idlocalizacion" => $row -> idlocalizacion, "localizacion" => $row2 -> localizacion);
				}
			}
		} else {
			//$array_devolver[] = array("idlocalizacion"=>0, "localizacion" => "Sin pisos");
		}
		return $array_devolver;
	}

	function devuelve_ciudad($idpiso) {
		// Función que devuelve la ciudad a traves de un id
		$sql = "SELECT idlocalizacion FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
    if ($resultado -> num_rows()>0) {
  		foreach ($resultado -> result() as $row) {
  			$idlocalizacion = $row -> idlocalizacion;
  		}

  		$sql = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$idlocalizacion;
  		$resultado = $this -> db -> query($sql);
  		foreach ($resultado -> result() as $row) {
  			$localizacion = $row -> localizacion;
  		}
    } else {
      $localizacion = "";
    }

		return $localizacion;
	}

	function saca_pisos_gps($idlocalizacion) {
		// Funcion que saca lt, ln y descripcion por localizacion
		$sql = "SELECT id_piso, descripcion, lt, ln FROM pisos WHERE idlocalizacion=".$idlocalizacion;
		$resultado = $this -> db -> query($sql);

		$array = array();
		foreach ($resultado -> result() as $row) {
			$array[] = array ("idpiso" => $row ->id_piso, "descripcion" =>$row ->descripcion, "lt" => $row ->lt, "ln" => $row ->ln);
		}

		return $array;
	}

	function cantidad_saca_pisos_gps($idlocalizacion) {
		// Funcion que saca lt, ln y descripcion por localizacion
		$sql = "SELECT id_piso, descripcion, lt, ln FROM pisos WHERE idlocalizacion=".$idlocalizacion;
		$resultado = $this -> db -> query($sql);

		return $resultado -> num_rows();
	}
}
?>
