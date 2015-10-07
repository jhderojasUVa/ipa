<?
/*

	Modelo para Barrios

*/

class Admin_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }
	
	function es_admin ($pollo) {
		// Funcion que devuelve el id de admin si es admin y 0 si no lo es
		
		// Revisamos si tiene las sesiones ok para sino crearselas o no
		if (isset($_SESSION["es_admin"]) == true && isset($_SESSION["fue_admin"]) == true) {
			// Si esta definido pues comprobamos (si, esta hecho un risto pero ya lo arreglare)
			if ($_SESSION["es_admin"] == false && $_SESSION["fue_admin"] == true) {
				return 1;
			} elseif ($_SESSION["es_admin"] == false && $_SESSION["fue_admin"] == false) {
				$sql = "SELECT idadmin FROM administradores WHERE admin='".$pollo."'";
				$resultado = $this -> db -> query($sql);
				if ($resultado -> num_rows()>0) {
					foreach ($resultado -> result() as $row) {
						$_SESSION["es_admin"] = true;
						$_SESSION["fue_admin"] = true;
						return $row -> idadmin;
						break;
					}
				} else {
					$_SESSION["es_admin"] = false;
					return 0;
				}
			
			} elseif ($_SESSION["es_admin"] == true && $_SESSION["fue_admin"] == true) {
				return 1;
			}
		} else {
			// Sino pues hacemos la comprobación estandar
			$sql = "SELECT idadmin FROM administradores WHERE admin='".$pollo."'";
				$resultado = $this -> db -> query($sql);
				if ($resultado -> num_rows()>0) {
					foreach ($resultado -> result() as $row) {
						$_SESSION["es_admin"] = true;
						$_SESSION["fue_admin"] = true;
						return $row -> idadmin;
						break;
					}
				} else {
					$_SESSION["es_admin"] = false;
					return 0;
				}
		}
	}
}
?>