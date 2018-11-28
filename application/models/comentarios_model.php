<?
/*

	Modelo para Comentarios y Denuncias a comentarios

*/

class Comentarios_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		// Cargamos la base de datos
		$this -> load -> database();
		$this -> load -> library("LDAP");
    }

	/*
			FUNCIONES PARA LOS COMENTARIOS
	*/

	function add_comentario ($persona, $comentario, $puntuacion, $idobjeto) {
		// Funcion que añade un comentario
		$fecha = date("Y-m-d");
		$sql = "INSERT INTO comentarios (idusuario, comentario, puntuacion, idobjeto, fecha) VALUES ('".$persona."', '".$comentario."', ".$puntuacion.", ".$idobjeto.", '".$fecha."')";
		$resultado = $this -> db -> query($sql);
	}

	function show_comentario($idcomentario) {
		// Funcion que devuelve un comentario, ponemos un * que nunca se sabe
		$sql = "SELECT * FROM comentarios WHERE idcomentario=".$idcomentario;
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function show_comentario_objeto($idobjeto, $usuario) {
		// Funcion que devuelve los comentarios ordenados por fecha
		// Revisamos si el usuario ha denunciado como spam para quitarlo
		$array_vuelta = array();
		$sql = "SELECT idcomentario, idusuario, comentario, puntuacion FROM comentarios WHERE idobjeto=".$idobjeto." ORDER BY fecha";
		$resultado = $this -> db -> query($sql);

		foreach ($resultado -> result() as $row) {
			$sql2 = "SELECT idcomentario FROM denuncias WHERE idcomentario='".$row -> idcomentario."' AND iddenunciante='".$usuario."'";
			$resultado2 = $this -> db -> query($sql2);
			if ($resultado2 -> num_rows()>0) {
				// Si esta puesto como spam por esta persona
				$array_vuelta[] = array("idcomentario" => $row -> idcomentario, "comentario" => $row -> comentario, "idusuario" => $row -> idusuario, "spam" => true, "nombre"=> $this -> ldap -> sacar_datos_ldap($row->idusuario));
			} else {
				// Sino
				$array_vuelta[] = array("idcomentario" => $row -> idcomentario, "comentario" => $row -> comentario, "idusuario" => $row -> idusuario, "spam" => false, "nombre"=> $this -> ldap -> sacar_datos_ldap($row->idusuario));
			}
		}

		return $array_vuelta;
	}

	function editar_comentario($idcomentario, $texto) {
		// Funcion que cambia un comentario
		$sql = "UPDATE comentarios SET comentario='".$texto."' WHERE idcomentario=".$idcomentario;
		$resultado = $this -> db -> query($sql);
	}

	function show_comentario_usuario($idusuario) {
		// Funcion que devuelve los comentarios de un pollo determinado
		$sql = "SELECT comentario, puntuacion, idobjeto, fecha, idcomentario, idusuario, idobjeto FROM comentarios WHERE idusuario='".$idusuario."'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function show_cantidad_comentario_usuario($idusuario) {
		// Funcion que devuelve el numero de comentarios de un pollo
		$sql = "SELECT comentario, puntuacion, idobjeto, fecha, idcomentario, idusuario FROM comentarios WHERE idusuario='".$idusuario."'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> num_rows();
	}

	function q_show_comentario_usuario($q, $idusuario) {
		// Funcion que refina los comentarios encontrados
		$sql = "SELECT comentario, puntuacion, idobjeto, fecha, idcomentario, idusuario FROM comentarios WHERE idusuario='".$idusuario."' AND comentario like '%".$q."%'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function q_show_cantidad_comentario_usuario($q, $idusuario) {
		// Funcion que devuelve el numero de comentarios de un pollo
		$sql = "SELECT comentario, puntuacion, idobjeto, fecha, idcomentario, idusuario FROM comentarios WHERE idusuario='".$idusuario."' AND comentario like '%".$q."%'";
		$resultado = $this -> db -> query($sql);

		return $resultado -> num_rows();
	}

	function modificar_comentario($campo, $idcomentario, $nuevo) {
		// Funcion para modificar un campo de un comentario
		$sql = "UPDATE SET ".$campo."='".$nuevo."' FROM comentarios WHERE idcomentario=".$idcomentario;
		$resultado = $this -> db -> query($sql);

		return $resultado -> result();
	}

	function del_comentario($idcomentario) {
		// Funcion para borrar un comentario
		$sql = "DELETE FROM comentarios WHERE idcomentario=".$idcomentario;
		$resultado = $this -> db -> query($sql);
	}

	function q_comentario($texto) {
		// Funcion para buscar comentarios
		$array_vuelta = array();
		$sql = "SELECT * FROM comentarios WHERE comentario LIKE '%".$texto."%'";
		$resultado = $this -> db -> query($sql);

		foreach ($resultado -> result() as $row) {
			$array_vuelta[] = array("idcomentario" => $row -> idcomentario, "idusuario" => $row -> idusuario, "nombre"=> $this -> ldap -> sacar_datos_ldap($row->idusuario), "comentario" => $row->comentario, "puntuacion" => $row ->puntuacion, "idobjeto" => $row->idobjeto, "fecha" => $row->fecha);
		}

		return $array_vuelta;
		//return $resultado -> result();
	}

	/*
			FUNCIONES PARA LAS DENUNCIAS
	*/

	function add_denuncia($idcomentario, $denunciante) {
		// Funcion para añadir una denuncia a un comentario por SPAM
		$sql = "INSERT INTO denuncias (idcomentario, iddenunciante) VALUES ('".$idcomentario."', '".$denunciante."')";
		$resultado = $this -> db -> query($sql);
	}

	function del_denuncia($idcomentario, $denunciante) {
		// Funcion que borra una denuncia por SPAM
		$sql = "DELETE FROM denuncias WHERE idcomentario=".$idcomentario." AND iddenunciante='".$denunciante."'";
		$resultado = $this -> db -> query($sql);
	}

	function hay_denuncias() {
		// Funcion que devuelve las denuncias que hay
		$sql = "SELECT idcomentario, iddenunciante FROM denuncias";
		$resultado = $this -> db -> query($sql);
		$array_denuncias = array();
		if ($resultado -> num_rows()>0) {
			foreach ($resultado -> result() as $row) {
				$sql2 = "SELECT comentario FROM comentarios WHERE idcomentario=".$row -> idcomentario;
				$resultado2 = $this -> db -> query($sql2);
				foreach ($resultado2 -> result() as $row2) {
					$array_denuncias[] = array("idcomentario" => $row ->idcomentario, "comentario" => $row2 ->comentario, "iddenunciante" => $row ->iddenunciante, "datos_denunciante" => $this -> ldap -> sacar_datos_ldap($row -> iddenunciante));
				}
			}
			return $array_denuncias;
		} else {
			return false;
		}
	}

	/*
			FUNCIONES PARA LAS BUSQUEDAS
	*/

	function buscar_comentario($q) {
		// Funcion para buscar comentarios
		$sql = "SELECT idusuario, comentario FROM comentarios WHERE comentario like '%".$q."%'";
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}

	function cantidad_buscar_comentario($q) {
		// Funcion para buscar comentarios que devuelve la cantidad
		$sql = "SELECT idusuario, comentario FROM comentarios WHERE comentario like '%".$q."%'";
		$resultado = $this -> db -> query($sql);
		return $resultado -> num_rows();
	}

  /*
      FUNCIONES DE NO TOCAR MUCHO
  */

  function repara_add_id_denuncias() {
    // Funcion que pone un ID unico en la tabla, la arregla y la deja niquelada

    // Busqueda gorda
    $sqlGordo = "SELECT idcomentario, iddenunciante FROM denuncias ORDER BY idcomentario";
    $resultadoGordo = $this -> db -> query($sqlGordo);

    // Follada de la base de datos
    echo "<h2>Borrando la tabla</h2>";
    $sqlDelete = "DELETE FROM denuncias";
    $resultadoDelete = $this -> db -> query($sqlDelete);
    echo "<p>Tabla borrada... esperemos que hayas hecho copia de seguridad y hayas rezado a tu dios...</p>";

    // Alteramos la base de datos, la tabla vamos
    echo "<h2>Alterando la tabla añadiendo el ID</h2>";
    $sqlAlter = "ALTER TABLE denuncias ADD iddenuncias INT(11)";
    $resultadosqlAlter = $this -> db -> query($sqlAlter);
    echo "<p>Añadido el IDdenuncias a la tabla...: ".$resultadosqlAlter."</p>";
    $sqlAlter2 = "ALTER TABLE denuncias ADD PRIMARY KEY (iddenuncias)";
    $resultadosqlAlter = $this -> db -> query($sqlAlter2);
    echo "<p>Y ahora primary key...: ".$resultadosqlAlter."</p>";
    $sqlAlter3 = "ALTER TABLE denuncias MODIFY COLUMN iddenuncias INT auto_increment";
    $resultadosqlAlter = $this -> db -> query($sqlAlter3);
    echo "<p>Ahora es auto_increment...: ".$resultadosqlAlter."</p>";

    // Metemos las cosas en la base de datos...
    echo "<h2>Devolvemos a la vida esa tabla</h2>";
    foreach ($resultadoGordo -> result() as $rowGordo) {
      $sqlInsert = "INSERT INTO denuncias (idcomentario, iddenunciante) VALUES ('".$rowGordo -> idcomentario."', '".$rowGordo -> iddenunciante."')";
      $resultadoInsert = $this -> db -> query($sqlInsert);
      echo "Insertado: ".$sqlInsert;
    }

    return true;
  }

}
?>
