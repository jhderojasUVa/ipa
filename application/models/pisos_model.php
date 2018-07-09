<?
/*

	Modelo para Pisos

*/

class Pisos_model extends CI_Model {

    function __construct() {
      // Call the Model constructor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
    }

	function show_piso($idpiso) {
		// Muestra los datos de un piso
		// Ponemos un * en el select por si se amplia
		$sql = "SELECT * FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}

	function cantidad_pisos_usuario($usuario) {
		// Funcion que devuelve la cantidad de pisos que tiene un usuario
		$sql = "SELECT COUNT(id_piso) AS total FROM pisos WHERE idusuario='".$usuario."'";
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
		$total = $row -> total;
		}

		return $total;
	}

	function show_datos_pisos_usuario($usuario) {
		// Funcion muy similar a buscar que devuelve los pisos de un usuario concreto
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion, tlf FROM pisos WHERE verificado=true AND idusuario=".$usuario;
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen, "tlf" => $row ->tlf);
		}
		return $piso;
	}

	function show_piso_barrio($idbarrio, $total, $llego) {
		// Funcion que devuelve los pisos por barrio
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, idlocalizacion, extras, tlf FROM pisos WHERE verificado=true AND libre=1 AND idbarrio=".$idbarrio." ORDER BY id_piso LIMIT ".$total." OFFSET ".($llego*$total);
		log_message("debug",$sql);
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp, "extras" => $row -> extras, "imagen" => $imagen, "tlf" => $row -> tlf);
		}
		return $piso;
	}

	function show_piso_barrio_total($idbarrio) {
		// Funcion que devuelve los pisos por barrio
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, idlocalizacion, extras, tlf FROM pisos WHERE verificado=true AND libre=1 AND idbarrio=".$idbarrio;
		//$sql = "SELECT TOP ".$total." * FROM pisos WHERE verificado=true AND idbarrio=".$idbarrio." LIMIT ".$llego;
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp, "extras" => $row -> extras, "imagen" => $imagen, "tlf" => $row -> tlf);
		}

		return count($piso);
	}

	function show_piso_cuidad($idciudad, $total, $llego) {
		// Funcion que devuelve los pisos por barrio
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, idlocalizacion, extras, tlf FROM pisos WHERE verificado=true AND libre=1 AND idlocalizacion=".$idciudad." ORDER BY id_piso LIMIT ".$total." OFFSET ".($llego*$total);
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return $piso;
	}

	function show_piso_cuidad_total($idciudad) {
		// Funcion que devuelve los pisos por barrio
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, idlocalizacion, extras FROM pisos WHERE verificado=true AND libre=1 AND idlocalizacion=".$idciudad;
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return count($piso);
	}

	function show_imagenes_piso($idpiso) {
		// Funcion que devuelve las imagenes de un piso
		// Lo hemos limitado a 5
		$sql = "SELECT idpiso, imagen, descripcion, orden FROM imagenes_pisos WHERE idpiso=".$idpiso." ORDER BY orden LIMIT 5";
		$resultado = $this -> db -> query($sql);
		return $resultado -> result();
	}

	function show_pisos_pollo($usuario) {
		// Funcion que devuelve los pisos de un pollo
		$sql = "SELECT id_piso FROM pisos where idusuario = '".$usuario."'";
		$resultado = $this -> db ->query($sql);
		return $resultado -> result();
	}

	function cantidad_show_imagenes_piso($idpiso) {
		// Funcion que devuelve el numero de imagenes de un piso
		$sql = "SELECT imagen, descripcion FROM imagenes_pisos WHERE idpiso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		return $resultado -> num_rows();
	}

	function cambiar_campo_piso($campo, $nuevovalor, $idpiso) {
		// Funcion que cambia un campo determinado a un nuevo valor
		$sql = "UPDATE SET ".$campo."='".$nuevovalor."' FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
	}

	function cambiar_piso ($idpiso, $descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $idbarrio, $extras, $tlf, $libre) {
		// Funcion que cambia entero todo un piso
		$fecha = date("c");
		$sql = "UPDATE pisos SET descripcion='".$descripcion."', calle='".$calle."', numero='".$numero."', piso='".$piso."', letra='".$letra."', cp='".$cp."', idlocalizacion=".$idlocalizacion.", idbarrio=".$idbarrio.", extras='".$extras."', tlf='".$tlf."', libre='".$libre."', fecha='".$fecha."' WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
	}

	function cambiar_campo_imagen($viejo, $nuevo, $campo) {
		// Funcion que cambia un campo de las imagenes
		$sql = "UPDATE SET ".$campo."='".$nuevo."' FROM imagenes_pisos WHERE ".$campo."='".$viejo."'";
		$resultado = $this -> db -> query($sql);
	}

	function del_piso($idpiso) {
		// Funcion para borrar un piso y todo lo que conlleva

		// Primero borramos los comentarios
		$sql = "DELETE FROM comentarios WHERE idobjeto=".$idpiso;
		$resultado = $this -> db -> query($sql);

		// Luego borramos las imagenes
		// ATENCION: NO LAS BORRAMOS DEL HD
		$sql = "DELETE FROM imagenes_pisos WHERE idpiso=".$idpiso;
		$resultado = $this -> db -> query($sql);

		// Borramos el piso en cuestion
		$sql = "DELETE FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
	}

	function add_piso($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $idbarrio, $extras, $tlf, $libre, $usuario, $verificado) {
		// Funcion que añade un piso en el paso 1 y devuelve el id obtenido
		$fecha = date("c");
		$sql = "INSERT INTO pisos (descripcion, calle, numero, piso, letra, cp, idlocalizacion, idbarrio, extras, tlf, libre, idusuario, verificado, fecha) VALUE ('".$descripcion."', '".$calle."', '".$numero."', '".$piso."', '".$letra."', '".$cp."', ".$idlocalizacion.", ".$idbarrio.", '".$extras."', '".$tlf."' ,'".$libre."', '".$usuario."', '".$verificado."', '".$fecha."')";
		$resultado = $this -> db -> query($sql);
		// Recuperamos el ID
		$sql = "SELECT id_piso FROM pisos WHERE descripcion='".$descripcion."' AND calle='".$calle."' AND numero='".$numero."' AND piso='".$piso."' AND letra='".$letra."' AND cp='".$cp."' AND extras='".$extras."' AND idusuario='".$usuario."'";
		$resultado = $this -> db -> query($sql);
		foreach ($resultado->result() as $row) {
			$idpiso = $row -> id_piso;
		}
		return $idpiso;
	}

	function existe_piso($calle, $numero, $piso, $letra, $cp, $idlocalizacion) {
		// Funcion que revisa si exsite un piso
		// Devuelve true si existe y false... si no existe
		$sql = "SELECT id_piso FROM pisos WHERE calle='".$calle."' AND numero='".$numero."' AND piso='".$piso."' AND letra='".$letra."' AND cp='".$cp."'";
		$resultado = $this -> db -> query($sql);

		if ($resultado -> num_rows()>0) {
			foreach ($resultado -> result() as $row) {
				return $row -> id_piso;
			}
		} else {
			return 0;
		}
	}

	function add_piso_nobarrio($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $extras, $verificado) {
		// Funcion que añade un piso en el paso 1 y devuelve el id obtenido
		$sql = "INSERT INTO pisos (descripcion, calle, numero, piso, letra, cp, idlocalizacion, extras, verificado) VALUE ('".$descripcion."', '".$calle."','".$numero."', '".$piso."', '".$letra."', '".$cp."', ".$idlocalizacion.", '".$extras."','".$verificado."')";
		$resultado = $this -> db -> query($sql);
		// Recuperamos el ID
		$sql = "SELECT id_piso FROM pisos WHERE descripcion='".$descripcion."' AND calle='".$calle."' AND piso='".$piso."' AND letra='".$letra."' AND cp='".$cp."' AND extras='".$extras."'";
		$resultado = $this -> db -> query($sql);
		foreach ($resultado->result() as $row) {
			$idpiso = $row -> id_piso;
		}
		return $idpiso;
	}

	function add_imagen_piso($imagen, $descripcion, $idpiso) {
		// Funcion que añade una imagen a un piso subida

		// Primero vemos el numero de imagenes que tiene, para el orden
		$sql = "SELECT COUNT(idpiso) AS total FROM imagenes_pisos WHERE idpiso=".$idpiso;
		$resultado0 = $this -> db -> query($sql);
		foreach ($resultado0 -> result() as $row) {
			$total = $row -> total;
		}
		// Añadimos uno al total
		$total++;
		// Metemos la imagen
		$sql = "INSERT INTO imagenes_pisos (idpiso, imagen, descripcion, orden) VALUES ('".$idpiso."', '".$imagen."', '".$descripcion."', '".$total."')";
		$resultado = $this -> db -> query($sql);
	}

	function del_imagen_piso($imagen, $descripcion, $idpiso) {
		// Funcion que borra una imagen de un piso
		$sql = "DELETE FROM imagenes_pisos WHERE idpiso='".$idpiso."' AND imagen='".$imagen."' AND descripcion='".$descripcion."'";
		$resultado = $this -> db -> query($sql);
	}

  function del_imagen_piso_burro($imagen, $idpiso) {
    // Funcion que borra el piso sin pedir tantas cosas... usar con cuidado
    $sql = "DELETE FROM imagenes_pisos WHERE idpiso='".$idpiso."' AND imagen='".$imagen."'";
    $resultado = $this -> db -> query($sql);
  }

	function cambia_orden_imagen($fichero, $actual, $nuevo, $idpiso) {
		// Funcion que cambia el orden de una imagen
		// Primero ponemos la vieja al orden de la nueva
		$sql = "UPDATE imagenes_pisos SET orden='".$actual."' WHERE idpiso='".$idpiso."' AND orden='".$nuevo."'";
		$resultado = $this -> db -> query($sql);

		// Ahora ponemos el viejo en el nuevo
		$sql = "UPDATE imagenes_pisos SET orden='".$nuevo."' WHERE idpiso='".$idpiso."' AND orden='".$actual."' AND imagen='".$fichero."'";
		$resultado = $this -> db -> query($sql);
	}

	function total_imagenes_piso($idpiso) {
		// Funcion que devuelve el total de imagenes que tiene el piso
		$sql = "SELECT COUNT(idpiso) AS total FROM imagenes_pisos WHERE idpiso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
			$total = $row -> total;
		}

		return $total;
	}

	function muestra_5_imagenes_piso() {
		// Funcion que devuelve 5 imagenes de los ultimos pisos añadidos y en caso de que no, la imagen estandar
//<<<<<<< HEAD
		//$sql = "SELECT DISTINCT (imagenes_pisos.idpiso), imagenes_pisos.imagen, imagenes_pisos.descripcion FROM imagenes_pisos, pisos WHERE imagenes_pisos.idpiso=pisos.id_piso AND pisos.verificado=true ORDER BY idpiso DESC LIMIT 10";
		//$sql = "SELECT DISTINCT imagenes_pisos.idpiso FROM imagenes_pisos, pisos WHERE imagenes_pisos.idpiso=pisos.id_piso AND pisos.verificado=true AND pisos.libre=1 ORDER BY idpiso DESC, orden LIMIT 10";
		//$sql = "SELECT DISTINCT imagenes_pisos.idpiso FROM imagenes_pisos, pisos WHERE imagenes_pisos.idpiso = pisos.id_piso AND pisos.verificado=TRUE AND pisos.libre=1 ORDER BY imagenes_pisos.idpiso LIMIT 10";
//=======
		$sql = "SELECT DISTINCT imagenes_pisos.idpiso FROM imagenes_pisos, pisos WHERE imagenes_pisos.idpiso = pisos.id_piso AND pisos.verificado=TRUE AND pisos.libre=1 ORDER BY imagenes_pisos.idpiso LIMIT 10";
//>>>>>>> origin/master
		$resultado = $this -> db -> query($sql);
		// Devolvemos las imagenes o la imagen vacia en caso de que no haya datos
		if ($resultado -> num_rows()>0) {
			foreach ($resultado->result() as $row) {
				$sql2 = "SELECT imagen, descripcion FROM imagenes_pisos WHERE idpiso=".$row->idpiso." LIMIT 1";
				$resultado2 = $this -> db -> query($sql2);
				foreach ($resultado2->result() as $row2) {
					$array_devolver[] = array("id_piso" => $row->idpiso, "imagen" => $row2->imagen, "descripcion" => $row2->descripcion);
				}
			}
			return $array_devolver;
			//return $resultado -> result();
		} else {
			$array_devolver[] = array("id_piso" => 0, "imagen" => "sin_piso.png", "descripcion" => "no existen pisos aun");
			return $array_devolver;
		}
	}

	function muestra_10_pisos() {
		// Funcion que muestra los 10 ultimos pisos creados
		$array_devolver = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, piso, letra, cp, idlocalizacion FROM pisos WHERE verificado=true AND libre=1 ORDER BY id_piso DESC LIMIT 10";
		$resultado_1 = $this -> db -> query($sql);
		if ($resultado_1->num_rows()>0) {
			// Hay sugus continuo para sacar la ciudad y tal
			foreach ($resultado_1->result() as $row) {
				$sql2 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row ->idlocalizacion;

				$resultado_2 = $this -> db -> query($sql2);
				foreach ($resultado_2->result() as $row2) {
					$array_devolver[] = array ("idpiso" => $row->id_piso, "descripcion" =>$row->descripcion, "direccion" => $row->calle.", ".$row->piso." (".$row2->localizacion.")");
				}
			}

			return $array_devolver;
		} else {
			// No hay sugus devuelvo falso
			return false;
		}
	}

  function muestra_ultimos_pisos($numero) {
    // Funcion que muestra los 10 ultimos pisos creados
		$array_devolver = array();
		//sql = "SELECT id_piso, descripcion, calle, numero, piso, letra, cp, idlocalizacion FROM pisos WHERE verificado=true AND libre=1 ORDER BY id_piso DESC LIMIT ".$numero;
    $sql = "SELECT id_piso, descripcion, calle, numero, piso, letra, cp, extras, localizacion FROM pisos INNER JOIN localizaciones ON pisos.idlocalizacion = localizaciones.idlocalizacion WHERE pisos.verificado=true AND pisos.libre=1 ORDER BY pisos.id_piso LIMIT ".$numero;
    $resultado_1 = $this -> db -> query($sql);
		if ($resultado_1->num_rows()>0) {
			// Hay sugus continuo para sacar la ciudad y tal
			foreach ($resultado_1->result() as $row) {
				$sql2 = "SELECT imagen FROM imagenes_pisos WHERE idpiso=".$row -> id_piso." LIMIT 1";

				$resultado_2 = $this -> db -> query($sql2);
				foreach ($resultado_2->result() as $row2) {
					$array_devolver[] = array ("idpiso" => $row->id_piso, "descripcion" =>$row->descripcion, "extras" => $row->extras, "direccion" => $row->calle.", ".$row->piso." (".$row->localizacion.")", "imagen" => $row2->imagen);
				}
			}

			return $array_devolver;
		} else {
			// No hay sugus devuelvo falso
			return false;
		}
  }

	function pisos_usuario($usuario) {
		// Funcion que devuelve los pisos y una de sus imagenes (si tiene) de un pollo
		// Pimero definimos lo que devolvemos
		$piso = array();
		// Sacamos los ids, direccion, extras
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, idlocalizacion, extras, verificado, libre FROM pisos WHERE idusuario='".$usuario."'";
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso." ORDER BY orden";
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp, "extras" => $row -> extras, "imagen" => $imagen, "verificado" => $row -> verificado, "libre" => $row -> libre);
		}
		return $piso;
	}

	function es_piso_usuario($usuario, $idpiso) {
		// Por seguridad comprueba que es el usuario del piso
		// Devuelve true si es el dueño y false si no lo es
		$sql = "SELECT id_piso FROM pisos WHERE idusuario='".$usuario."' AND id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	function buscar_piso($q , $total, $llego) {
		// Funcion que devuelve un array de busqueda de pisos
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion, libre FROM pisos WHERE verificado=true AND libre=1 AND (descripcion like '%".$q."%' OR calle like '%".$q."%') ORDER BY fecha LIMIT ".$total." OFFSET ".($total*$llego);
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen, "libre" => $row -> libre);
		}
		return $piso;
	}

	function buscar_piso_2($q) {
		// Funcion que devuelve un array de busqueda de pisos
		// SOLO LIBRES ADMIN

		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion FROM pisos WHERE verificado=true AND libre=1 AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return $piso;
	}

	function buscar_piso_3($q) {
		// Funcion que devuelve un array de busqueda de pisos
		// SOLO OCUPADOS ADMIN

		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion FROM pisos WHERE verificado=true AND libre=0 AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return $piso;
	}

	function buscar_piso_4($q) {
		// Funcion que devuelve un array de busqueda de pisos
		// BUSCA EN LIBRES Y OCUPADOS ADMIN

		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion FROM pisos WHERE verificado=true AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return $piso;
	}

	function mostar_pisos_no_validados() {
		// Funcion que muestra los pisos no validados
    // FUNCION PARA ADMIN
		$piso = array();
		$sql = "SELECT * FROM pisos WHERE verificado=false";
		$resultado_1 = $this -> db -> query($sql);
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}

			$sql2 = "SELECT email FROM usuarios WHERE idu='".$row -> idusuario."'";
			$resultado_2 = $this -> db -> query($sql2);
			foreach ($resultado_2 -> result() as $row4) {
				$email = $row4 -> email;
			}

			if (isset($email)==false) {
				// No tiene email
				$email="";
			}

			$sql3 = "SELECT COUNT(id_piso) AS total FROM pisos WHERE idusuario='".$row -> idusuario."'";
			$resultado3 = $this -> db -> query($sql3);
			foreach ($resultado3 -> result() as $row3) {
				$total_usuario = $row3 -> total;
			}

			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "email" => $email, "idu" => $row -> idusuario, "total" => $total_usuario);
		}
		return $piso;
	}

	function buscar_piso_total($q) {
		// Funcion que devuelve un array de busqueda de pisos
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion FROM pisos WHERE verificado=true AND libre=1 AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";
		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		foreach ($resultado_1 -> result() as $row) {
			// Poblacion
			$sql1 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
			$resultado_11 = $this -> db -> query($sql1);
			foreach ($resultado_11->result() as $row3) {
				$ciudad = $row3 -> localizacion;
			}
			// Imagenes
			$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
			$resultado_2 = $this -> db -> query($sql2);
			if ($resultado_2 -> num_rows()>0) {
				foreach ($resultado_2 -> result() as $row2) {
					// Tiene fotico
					$imagen = $row2 -> imagen;
				}
			} else {
					// No tiene fotico
					$imagen = "sin_imagen.png";
			}
			$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen);
		}
		return count($piso);
	}

	function cantidad_buscar_piso($q) {
		// Funcion que devuelve la cantidad de resultados redinados
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras FROM pisos WHERE verificado=true AND libre=1  AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";
		$resultado = $this -> db -> query($sql);
		return $resultado -> num_rows();
	}

	function refinar_cantidad_buscar_piso($q, $cp, $loc, $rango) {
		// Funcion que devuelve un array de busqueda de pisos
		// ATENCION esto tiene un apaño tan sumamente malo que me da verguenza a mi mismo solo de verlo
		// necesita una optimizacion urgente
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion FROM pisos WHERE verificado=true AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";

		if ($loc<>0) {
			$sql = $sql." AND idlocalizacion=".$loc."";
		}

		if ($cp<>"") {
			$sql = $sql." AND cp='".$cp."'";
		}

    // Esto es una autentica mierda para solucionar si no envian el $rango
    if ($rango == null) {
      $rango = "0-100000";
    }

		// Ahora hacemos bujeritos el rango para meterlo en la secuencia
		$minmax = explode("-", $rango);

		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		// Esto es una autentica chapuza de verguenza
		// hay que revisarlo porque solo por escribir este codigo he hecho llorar al niño jesus
		foreach ($resultado_1 -> result() as $row) {
			$sql3 = "SELECT idpiso FROM pisos_precio WHERE precio>=".$minmax[0]." AND precio<=".$minmax[1];

			$resultado3 = $this -> db -> query($sql3);
			$valepalrango = false;
			foreach ($resultado3 -> result() as $row3) {
				if ($row3 -> idpiso == $row -> id_piso) {
					// Si vale lo que tiene que valer
					$valepalrango = true;
					break;
				} else {
					// Si se pasa del rango
					$valepalrango = false;
				}
			}
			// Si vale
			if ($valepalrango == true) {
				$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
				$resultado_2 = $this -> db -> query($sql2);
				if ($resultado_2 -> num_rows()>0) {
					foreach ($resultado_2 -> result() as $row2) {
						// Tiene fotico
						$imagen = $row2 -> imagen;
					}
				} else {
						// No tiene fotico
						$imagen = "sin_imagen.png";
				}
				$sql4 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
				$resultado4 = $this -> db -> query($sql4);
				foreach ($resultado4 -> result() as $row4) {
					$ciudad = $row4 -> localizacion;
				}
				$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen);
			}
		}
		return count($piso);
	}

	function refinar_buscar_piso($q, $cp, $loc, $rango, $total, $llego) {
		// Funcion que devuelve un array de busqueda de pisos
		// ATENCION esto tiene un apaño tan sumamente malo que me da verguenza a mi mismo solo de verlo
		// necesita una optimizacion urgente
		$piso = array();
		$sql = "SELECT id_piso, descripcion, calle, numero, cp, extras, idlocalizacion, libre FROM pisos WHERE verificado=true AND libre=1 AND (descripcion like '%".$q."%' OR calle like '%".$q."%')";

		if ($loc<>0) {
			$sql = $sql." AND idlocalizacion=".$loc."";
		}

		if ($cp<>"") {
			$sql = $sql." AND cp='".$cp."'";
		}

		$sql.= " LIMIT ".$total." OFFSET ".($total*$llego);

    // Esto es una autentica mierda para arreglar si no envian el $rango
    if ($rango == null) {
      $rango = "0-100000";
    }

		// Ahora hacemos bujeritos el rango para meterlo en la secuencia
		$minmax = explode("-", $rango);

		$resultado_1 = $this -> db -> query($sql);
		// Ahora lo recorremos para sacar las imagenes y tal y pascual y lo metemos en el array y tal y pascual
		// Esto es una autentica chapuza de verguenza
		// hay que revisarlo porque solo por escribir este codigo he hecho llorar al niño jesus
		foreach ($resultado_1 -> result() as $row) {
			$sql3 = "SELECT idpiso FROM pisos_precio WHERE precio>=".$minmax[0]." AND precio<=".$minmax[1];

			$resultado3 = $this -> db -> query($sql3);
			$valepalrango = false;
			foreach ($resultado3 -> result() as $row3) {
				if ($row3 -> idpiso == $row -> id_piso) {
					// Si vale lo que tiene que valer
					$valepalrango = true;
					break;
				} else {
					// Si se pasa del rango
					$valepalrango = false;
				}
			}
			// Si vale
			if ($valepalrango == true) {
				$sql2 = "SELECT imagen from imagenes_pisos WHERE idpiso = ".$row ->id_piso;
				$resultado_2 = $this -> db -> query($sql2);
				if ($resultado_2 -> num_rows()>0) {
					foreach ($resultado_2 -> result() as $row2) {
						// Tiene fotico
						$imagen = $row2 -> imagen;
					}
				} else {
						// No tiene fotico
						$imagen = "sin_imagen.png";
				}
				$sql4 = "SELECT localizacion FROM localizaciones WHERE idlocalizacion=".$row -> idlocalizacion;
				$resultado4 = $this -> db -> query($sql4);
				foreach ($resultado4 -> result() as $row4) {
					$ciudad = $row4 -> localizacion;
				}
				$piso[] = array ("idpiso" => $row -> id_piso, "descripcion" => $row -> descripcion, "direccion" => $row -> calle . ", ".$row -> numero, "poblacion" => $row -> cp." ".$ciudad, "extras" => $row -> extras, "imagen" => $imagen, "libre" => $row -> libre);
			}
		}
		return $piso;
	}

	function buscar_piso_ajax($q) {
    // Funcion que busca ousis que esten verificados
		$sql = "SELECT id_piso, calle, numero, piso FROM pisos WHERE calle like '%".$q."%' AND verificado = true ORDER BY fecha DESC LIMIT 5";
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows() >0) {
			return $resultado -> result();
		} else {
			return false;
		}
	}

	function validar_piso($idpiso) {
		// Funcion 	que valida un piso
    // PARA ADMIN
		$sql = "UPDATE pisos SET verificado=true WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
	}

	function devuelve_usuario_piso($idpiso) {
		// Funcion que devuelve el usuario de un piso
		$sql = "SELECT idusuario FROM pisos WHERE id_piso=".$idpiso;
		$resultado = $this -> db -> query($sql);
		if ($resultado -> num_rows()>0) {
			foreach ($resultado -> result() as $row) {
				return $row -> idusuario;
			}
		} else {
			return 0;
		}
	}

	function cambia_ocupado_piso($idpiso) {
		// Cambia un piso de libre a ocupado y viceversa, vamos que cambia el estado
		// Primero pillamos el estado asi porque tal y pascual
		$sql = "SELECT libre FROM pisos WHERE id_piso=".$idpiso;
		log_message("DEBUG",$sql);
		$resultado = $this -> db -> query($sql);
		foreach ($resultado -> result() as $row) {
			$estado = $row -> libre;
		}

		if ($estado == 0) {
			// Si esta libre, lo ponemos en ocupado y devolvemos true
			$sql2 = "UPDATE pisos SET libre=1  WHERE id_piso=".$idpiso;
			$resultado2 = $this -> db -> query($sql2);
			return true;
		} else {
			// Si esta ocupado, lo ponemos en libre y devolvemos false
			$sql2 = "UPDATE pisos SET libre=0 WHERE id_piso=".$idpiso;
			$resultado2 = $this -> db -> query($sql2);
			return false;
		}
	}

  function devuelve_todas_imagenes_idpiso() {
    // Funcion que devuelve todas las imagenes y el id al que pertencen
    $sql = "SELECT idpiso, imagen FROM imagenes_pisos ORDER BY idpiso";
    $resultado = $this -> db -> query($sql);
    return $resultado -> result();
  }

  function piso_existe($idpiso) {
    // Funcion que comprueba la existencia de un piso
    $sql = "SELECT idpiso FROM pisos WHERE idpiso=".$idpiso;
    $resultado = $this -> db -> query($sql);
    if ($resultado -> num_rows()>0) {
      return true;
    } else {
      return false;
    }
  }

  function show_pisos_usuario_uva() {
    // Funcion que devuelve la cantidad de pisos que tienen los usuarios UVa
    //$sql = "SELECT * FROM pisos WHERE idusuario like 'e%'";
    $sql = "SELECT idusuario, count(id_piso) AS pisos_totales FROM pisos WHERE idusuario LIKE 'e%' GROUP BY idusuario";
    $resultado = $this -> db -> query($sql);
    if ($resultado -> num_rows()>0) {
      return $resultado -> result();
    } else {
      return false;
    }
  }
}
?>
