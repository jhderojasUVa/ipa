<?
/*

	Modelo para Barrios

*/

class Usuarios_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
    }

	function logear($usuario, $password) {
		// Revisa dentro de la bd si existe el usuario
		$sql = "SELECT idu, nombre, apellidos FROM usuarios WHERE usuario='".$usuario."' AND password='".$password."' AND verificado=true";
		$resultado = $this -> db -> query($sql);

		if ($resultado -> num_rows()>0) {
			foreach ($resultado -> result() as $row) {
				$_SESSION["idu"] = $row -> idu;
				$_SESSION["nombre"] = $row -> nombre;
				$_SESSION["apellidos"] = $row -> apellidos;
				$_SESSION["autentificado"] = true;
				$_SESSION["uva"] = 0;
				$_SESSION["logeado"] = true;
				$_SESSION["es_admin"] = 0;
				return true;
			}
		} else {
				return false;
		}
	}

	function comprueba($usuario) {
		// Funcion que comprueba si el usuario existe
		// Devuelve true si existe y false si no
		$sql = "SELECT usuario FROM usuarios WHERE usuario='".$usuario."'";
		$resultado = $this -> db -> query($sql);

		if ($resultado -> num_rows()>0) {
			// Existe
			return true;
		} else {
			// No existe
			return false;
		}
	}

  function variantes_usuario($usuario, $variaciones) {
    // Funcion que devuelve un array con las posibles variantes del login
    // $usuario = base de usuario
    // $variaciones = el numero de variaciones a mostrar
    $nombres_usuario = [];
    for ($i=0; $i<=$variaciones; $i++) {
      if (comprueba($usuario."_".$i)) {
        $nombres_usuario[] = $usuario."_".$i;
      } elseif (comprueba($usuario.$i)) {
        $nombres_usuario[] = $usuario.$i;
      } elseif (comprueba("_".$usuario."_".$i)) {
        $nombres_usuario[] = "_".$usuario."_".$i;
      }
    }

    return $nombres_usuario;
  }

	function comprueba_mail($email) {
		// Funcion que comprueba si el correo ya se esta usando
		$sql = "SELECT usuario FROM usuarios WHERE email='".$email."'";
		$resultado = $this -> db -> query($sql);

		if ($resultado -> num_rows()>0) {
			// Existe
			return true;
		} else {
			// No existe
			return false;
		}
	}

	function add_usuario($nombre, $apellidos, $login, $password, $direccion, $tlf, $email, $dni) {
		// Funcion que añade un usuario
		$sql = "INSERT INTO usuarios (nombre, apellidos, usuario, password, direccion, tlf, email, dni) VALUES ('".$nombre."', '".$apellidos."', '".$login."', '".$password."', '".$direccion."', '".$tlf."', '".$email."', '".$dni."')";
		$resultado = $this -> db -> query($sql);
	}

	function devuelve_datos_usuario($correo) {
		// Funcion que devuelve el resto de datos del usuario
		$sql = "SELECT * FROM usuarios WHERE email='".$correo."'";
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			return $resultado -> result();
		} else {
			return false;
		}
	}

	function devuelve_datos_usuario_id($id) {
		// Funcion que devuelve el resto de datos del usuario
		$sql = "SELECT * FROM usuarios WHERE idu='".$id."'";
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			return $resultado -> result();
		} else {
			return false;
		}
	}

	function borra_user($id) {
		// Funcion que borra un usuario y tal

		// Borramos el usaurio
		$sql = "DELETE FROM usuarios WHERE idu=".$id;
		$resultado = $this -> db -> query($sql);

		// Ponemos sus pisos en barbecho (osea desvalidamos, que nunca se sabe)
		$sql = "UPDATE pisos SET verificado=false WHERE idusuario=".$id;
		$resultado = $this -> db -> query($sql);

		// Y ahora eliminamos comentarios y denuncias
		$sql = "DELETE FROM comentarios WHERE idusuario=".$id;
		$resultado = $this -> db -> query($sql);

		// Y ahora las denuncias
		$sql = "DELETE FROM denuncias WHERE iddenunciante=".$id;
		$resultado = $this -> db -> query($sql);
	}

	/* Funciones de administracion */

	function usuarios_no_activados () {
		// Funcion que devuelve los usuarios que no han sido activados
    // FUNCION PARA ADMIN
		$sql = "SELECT * FROM usuarios WHERE verificado=false";
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function activar_user($idu) {
		// Funcion que activa/valida un usuario
    // FUNCION PARA ADMIN
		$sql = "UPDATE usuarios SET verificado=1 WHERE idu=".$idu;
		$resultado = $this -> db -> query($sql);
	}

	function cambia_campo($campo, $nuevovalor, $idu) {
		// Funcion que cambia un nuevo valor de un campo
		$sql = "UPDATE usuarios SET ".$campo."='".$nuevovalor."' WHERE idu=".$idu;
		$resultado = $this -> db -> query($sql);
	}

	function updatea_user($idu, $nombre, $apellidos, $login, $password, $direccion, $tlf, $email, $verificado) {
		// Funcion que updatea los datos de un usuario
		$sql = "UPDATE usuarios set nombre='".$nombre."', apellidos='".$apellidos."', usuario='".$login."', password='".$password."', direccion='".$direccion."', tlf='".$tlf."', email='".$email."', verificado='".$verificado."' WHERE idu=".$idu;
		$resultado = $this -> db -> query($sql);
	}

	function buscar_usuario($q) {
		// Funcion que devuelve los datos de uno o varios usuarios por nombre, apellido, direccion o nombre de usuario
    // FUNCION PARA ADMIN
		$sql = "SELECT * FROM usuarios WHERE nombre like '%".$q."%' OR apellidos like '%".$q."%' OR direccion like '%".$q."%' OR usuario like '%".$q."%'";
		/*echo $sql;*/
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function buscar_correo($q, $verificado) {
		// Funcion que devuelve los datos de uno o varios usuarios por el correo
    // FUNCION PARA ADMIN
		$sql = "SELECT * FROM usuarios WHERE email like '%".$q."%' AND verificado='".$verificado."'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function enviar_a_todos($verificado) {
		// Funcion que busca todos los usuarios y los devuelve si estan verificados o no
    // FUNCION PARA ADMIN
		$sql = "SELECT * FROM usuarios WHERE verificado='".$verificado."'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}
}
?>
