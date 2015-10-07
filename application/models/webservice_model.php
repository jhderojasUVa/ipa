<?
/*

	Modelo para WebService

*/

class Webservice_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }
	
	function consulta_google($idpiso) {
		// Devuelve la latitud y longuitud de un piso
		// Esto hay que innerjoinearlo
		$sql = "SELECT calle, numero, cp, idlocalizacion FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
			// Sacamos las cosas
			$direccion = utf8_encode($row -> calle)."+".utf8_encode($row -> numero).",".utf8_encode($row->cp);
			$sql2 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion = ".$row ->idlocalizacion;
			$resultado_1 = $this -> db -> query($sql2);
			foreach ($resultado_1 -> result() as $row2) {
				$direccion = $direccion."+".utf8_encode($row2->localizacion);
			}
		}
		// Ahora le consultamos al google a ver
		$url = "http://maps.google.com/maps/geo?f=q&source=s_q&hl=es&geocode=&q=".urlencode($direccion)."&output=csv";
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$raw = curl_exec($ch);
		curl_close($ch);
		$datos = explode(",", $raw);
		
		// Destrozamos los datos y lo insertamos en la BD
		if ($datos[0] == "200") {
			// No peto
			$latitud = $datos[2];
			$longitud = $datos[3];
			
			$sql = "UPDATE pisos SET lt='".$latitud."', ln='".$longitud."' WHERE id_piso=".$idpiso;
			$this -> db -> query($sql);
		} else {
			// Peto
			echo "ERROR para $id: $domicilio,$ciudad con datos $datos\n";
		}
	}
	
	function piso_tiene_gps($idpiso) {
		// Revisa si el piso tiene ya puesto la geolocalizacion y pasamos de el... o no
		$sql = "SELECT lt, ln FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			// Ya tiene
			return false;
		} else {
			// No tiene
			return true;
		}
	}
	
	
	function ids_pisos() {
		// Funcion que devuelve todas las IDs de pisos
		$sql = "SELECT id_piso FROM pisos ORDER BY id_piso";
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}
	
}