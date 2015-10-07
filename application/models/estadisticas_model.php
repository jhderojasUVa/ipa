<?
/*

	Modelo para Barrios

*/

class Estadisticas_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }
	
	function cantidad_pisos($fechainicio, $fechafin) {
		// Funcion que devuelve la cantidad de pisos dadas dos fechas en MySQL
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$fechainicio."' AND fecha<='".$fechafin."'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_pisos_uva($fechaincio, $fechafin) {
		// Funcion que devuelve la cantidad de pisos subida por gente de la uva
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$fechaincio."' AND fecha<='".$fechafin."' AND idusuario LIKE '%e%'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_pisos_nouva($fechaincio, $fechafin) {
		// Funcion que devuelve la cantidad de pisos subida por gente de IPA
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$fechaincio."' AND fecha<='".$fechafin."' AND idusuario NOT LIKE '%e%'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_usuarios($fechainicio, $fechafin) {
		// Funcion que devuelve la cantidad de usuarios dadas dos fechas en MySQL
		$sql = "SELECT COUNT(idu) AS total FROM usuarios WHERE fechaalta>='".$fechainicio."' AND fechaalta<='".$fechafin."'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_pisos_mes($mes, $ano) {
		// Funcion que devuelve la cantidad de pisos en un mes y año determinado
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$ano."-".$mes."-01' AND fecha<='".$ano."-".$mes."-31'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_pisos_mes_uva($mes, $ano) {
		// Funcion que devuelve la cantidad de pisos en un mes y año determinado
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$ano."-".$mes."-01' AND fecha<='".$ano."-".$mes."-31' AND idusuario LIKE '%e%'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_pisos_mes_nouva($mes, $ano) {
		// Funcion que devuelve la cantidad de pisos en un mes y año determinado
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE fecha>='".$ano."-".$mes."-01' AND fecha<='".$ano."-".$mes."-31' AND idusuario NOT LIKE '%e%'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
	
	function cantidad_comentarios_mes($mes, $ano) {
		// Función que devuelve la cantidad de comentarios que hay en un mes
		$sql = "SELECT COUNT(idcomentario) AS total FROM comentarios WHERE fecha>='".$ano."-".$mes."-01' AND fecha<='".$ano."-".$mes."-31'";
		$resultado = $this -> db -> query($sql);
		
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}
		
		return $total;
	}
}
?>