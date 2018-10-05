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

  function borrar_usuarios_fecha($fecha) {
    // Funcion que borra usuarios de una fecha hacia atras
    // FUNCION PARA ADMIN

    $path = $this -> config -> item("upload_path"); // En beta necesario poner el path, en guay lo leemos del config

    // Lo primero seria eliminar los pisos del usuario
    $sql_idu = "SELECT idu FROM usuarios WHERE fechaalta <='".$fecha."'";
    $resultado = $this -> db -> query($sql_idu);
    if ($resultado -> num_rows()>0) {
      foreach ($resultado -> result() as $row) {
        // Comentarios y amigos
        $sql_comentarios = "DELETE FROM comentarios WHERE idusuario=".$row -> idu;
        $resultado_comentario = $this -> db -> query($sql_comentarios);
        $sql_denuncias = "DELETE FROM denuncias WHERE iddenunciante=".$row -> idu;
        $resultado_denuncias = $this -> db -> query($sql_denuncias);
        // Eliminamos las imagenes
        // Primero los ficheros
        $sql_pisos = "SELECT id_piso FROM pisos WHERE idusuario=".$row -> idu;
        $resultado_pisos = $this -> db -> query($sql_pisos);
        if ($resultado_pisos -> num_rows()>0) {
          // Si hay pisos, necesitamos las imagenes
          foreach ($resultado_pisos -> result() as $row_pisos) {
            $sql_imagenes = "SELECT imagen FROM imagenes_piso WHERE idpiso=".$row_pisos -> id_piso;
            $resultado_imagenes = $this -> db -> query($sql_imagenes);
            if ($resultado_imagenes -> num_rows()>0) {
              foreach ($resultado_imagenes -> result() as $row_imagenes) {
                  unlink($path."/".$row -> idu."/".$row_imagenes -> imagen);
              }
            }
            // Lo eliminamos de la BD
            $sql_elimina_imagenes = "DELETE FROM imagenes_piso WHERE idpiso=".$row_pisos -> id_piso;
            $resultado_borrado = $this -> db -> query($sql_elimina_imagenes);
          } // Fin de borrar las imagenes y dejarlo como una patena
        }
        // Eliminamos los pisos que tenga
        $sql_elimina_pisos = "DELETE FROM pisos WHERE idusuario=".$row -> idu;
        $resultado_elimina_pisos = $this -> db -> query($sql_elimina_pisos);
      }
    }
  }

  public function ver_usuarios_no_ipa() {
    // Funcion que muestra los usuarios que no son IPA, vamos los de la uva
    // FUNCION PARA ADMIN

    $sql = "SELECT * FROM usuarios WHERE idu like 'e%'";
    $resultado = $this -> db -> query($sql);
    if ($resultado -> num_rows()>0) {
      return $resultado -> result();
    } else {
      return false;
    }
  }
}
?>
