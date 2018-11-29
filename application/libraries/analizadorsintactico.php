<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Clase de Analizadorsintactico que hace todas las funciones de analisis de las busquedas

class Analizadorsintactico {

	function __construct() {
		$this -> CI = &get_instance();
	}

  // Estas dos funciones se pueden unir, pero por ahora las separamos

  function buscaBarrio($string) {
    // Funcion que busca un barrio en un string gordo
    // retorna el texto del barrio o false si no hay
    $separacionEspacios = explode($string, " ");
    if (in_array($separacionEspacios, "barrio:")) {
      $indiceBarrio = array_search("barrio:", $separacionEspacios);
      if ($indiceBarrio !=0) {
        $trozos = explode($separacionEspacios[$indiceBarrio], ":");
        return $trozos[1];
      } else {
        return false;
      }
    }
  }

  function buscaCiudad($string) {
    // Funcion que busca una ciudad en un string gordo
    // retorna el texto de la ciudad o false si no hay
    $separacionEspacios = explode($string, " ");
    if (in_array($separacionEspacios, "barrio:")) {
      $indiceCiudad = array_search("ciudad:", $separacionEspacios);
      if ($indiceBarrio !=0) {
        $trozos = explode($separacionEspacios[$indiceCiudad], ":");
        return $trozos[1];
      } else {
        return false;
      }
    }
  }

  function eliminaPronombres($string) {
    // Funcion que elimina los pronombres
    // Devuelve el string sin eso
    if(!empty($string)) {
      return preg_replace("/(a)|(ante)|(bajo)|(cabe)|(con)|(contra)|(de)|(desde)|(en)|(entre)|(hacia)|(hasta)|(por)|(sin)|(so)|(sobre)|(tras)/", $string);
    }
  }

  function eliminaUnidores($string) {
    // Funcion que elimina cosas como "el", "la", "las"...
    // Devuelve el string sin eso
    if(!empty($string)) {
      return preg_replace("/(\bel)|(\bla.)|(\blo.)|(\by\b)|(\bo\b)/", $string);
    }
  }

  function devuelveArrayWhere($string) {
    // Funcion que devuelve el array montado para el SQL en el WHERE
    $arrayATrozos = explode($string, " ");
    $sql = " WHERE descripcion like '%".$string."%' ";
    foreach($arrayATrozos as $trozo) {
      $sql = $sql. " OR descripcion LIKE '%".$trozo."%' OR calle LIKE '%".$trozo."%' ";
    }
		// Devolvemos el string del SQL
    return $sql;
  }

	function devuelveSQLWheredeArray($array) {
		// Funcion que devuelve el SQL montado de un array de cosas que le enviamos
		// Esto se puede refactorizar, pero al final, las refactorizaciones hacen lo mismo

		// Primero vemos si viene barrio o ciudad para descartarlo

		//log_message("DEBUG", "EMPTY array devuelveSQLWheredeArray: ".empty($array) == false);
		//log_message("DEBUG", "SIZE: array devuelveSQLWheredeArray: ".sizeof($array));

		if (empty($array) == false && sizeof($array) > 0) {
			$sql = " WHERE 0 OR (";
			// Recorremos a la vieja usanza
			$i = 0;

			foreach ($array as $row) {
				$upperrow = strtoupper($row);

				//log_message("DEBUG", "COMPARANDO CON CIUDAD: ".strpos($upperrow, "CIUDAD:"));

				// Por como funciona el STRPOS hay que ver si es diferente de false para ver si esta dentro
				if (strpos($upperrow, "CIUDAD:") !== false || strpos($upperrow, "BARRIO:") !== false) {
					// Si contiene ciudad o barrio
					if ($i == 0) {
						$sql = $sql . " descripcion LIKE '%%' ";
						$i++;
					} else {
						$sql = $sql . " OR descripcion LIKE '%%' ";
					}
				} else {
					// Si no lo contiene
					if ($i == 0) {
						$sql = $sql . " descripcion LIKE '%".$row."%' OR calle LIKE '%".$row."%' ";
						$i++;
					} else {
						$sql = $sql . " OR descripcion LIKE '%".$row."%' OR calle LIKE '%".$row."%' ";
					}
				}
			}

			$sql = $sql .")";
		} else {
			$sql = " WHERE 1";
		}
		// Devolvemos el string del SQL
		return $sql;
	}

  function devuelveArrayBarrioCiudad($id, $tipo) {
    // Funcion que devuelve los datos necesarios de los barrios
    $sql = "SELECT idpiso, descripcion, calle, numero, piso, letra, cp FROM pisos ";
    if ($tipo == "barrio") {
      $sql = $sql . " WHERE idbarrio = '".$id."' INNER JOIN barrios on pisos.idbarrio = barrios.idbarrio";
    } elseif ($tipo == "ciudad") {
      $sql = $sql . " WHERE idlocalizacion = '".$id."' INNER JOIN localizaciones on pisos.idlocalizcion = localizaciones.idlocalizacion";
    } else {
      return false;
    }
  }

  function esUnNumero($string) {
    // Funcion que devuelve true si es un numero o false si no
    return is_numeric($string);
  }

	function queryTexto($string) {
    // Funcion que devuelve el texto que no es ciudad o barrio troceado
		// Devuelve el array de las cosas que no son ni barrios ni ciudades para el SQL
		// devuelve false si no hay nada

    $trozos = array();

		// Primero si hay ciudad o barrio
		if (strpos($string, "ciudad:") > 0) {
			// Si hay ciudad
			$trozostmp = explode("ciudad:", $string);
		} elseif (strpos($string, "barrio:") > 0) {
			// Si hay barrio
			$trozostmp = explode("barrio:", $string);
		} else {
			// Si solo hay texto
			$trozostmp = [$string];
		}

    if ($trozostmp[0]) {
			// Primero limpiamos el string
			$textoSinMierda = preg_replace("/(\b(a|e|o|u)\ )|(\ben\b)|(\bun\b)|(\bde(\b|l))|(\bqu(|é|e)\b)|(\b(a|e)l\b)|(\bell(o|a)(\b|s))|(\bla(\b|s))|(\blo(\b|s))|(\bante\b)|(\bo\b)|(\by\b)|(\bes\b)|(\bsu\b)|(\,|\.|\;)/", "", $trozostmp[0]);
			// Luego separamos las "palabras"
      $trozostmp2 = explode(" ", $textoSinMierda);
			// Para cada una (que no este vacia por dobles espaciados o similar)
      foreach ($trozostmp2 as $cacho) {
        if ($cacho != "") {
					// La metemos en el array
          array_push($trozos, $cacho);
        }
      }
			// Devolvemos el array
      return $trozos;
    } else {
			// Por si algo ha pasado, devolvemos false
      return false;
    }
  }

  function troceador($string) {
    // Funcion que devuelve un array troceado con los barrios y ciudades
		// Trocea el string por "ciudad" y por "barrio"

		// Por diseño, lo de ciudad y barrio tiene que ir al final... que esto hay que cambiarlo
		// Pasamos todo a mayusculas
		$stringMayusculas = strtoupper($string);
		// Sacamos si tiene ciudad o barrio
		$dondeEstaCiudad = strpos($stringMayusculas, "CIUDAD:");
		$dondeEstaBarrio = strpos($stringMayusculas, "BARRIO:");

		// Creamos el array de vuelta (empty)
		$arrayReturn = array();

		// Arrays de cada cosa vacios
		$arrayCiudades = array();
		$arrayBarrios = array();
		$arrayGenerico = array(); // Array mezcla

		// Si hay ciudad (y barrio o no)
		if ($dondeEstaCiudad !== false) {
			// Cortamos el string para quedar solo las ciudades y barrios (si hay)
			$string = substr($string, $dondeEstaCiudad, strlen($string));

			// Separamos todo en las partes de ciudades
	    $splitCiudades = explode("CIUDAD:", $stringMayusculas);

			if (sizeof($splitCiudades) > 1) {
				// Si hay ciudades en la query
				$implodeSplitCiudades = implode(" ", $splitCiudades);
				$haybarrios = strpos($implodeSplitCiudades, "BARRIO:");

				if ($haybarrios == true) {
					foreach ($splitCiudades as $trozo) {
						// Primero detectamos si hay barrios
						// Si hay llegado aqui es que hay ciudades y barrios
						// Hay barrios
						// Separamos los barrios
						$tmp = explode("BARRIO:", $trozo);
						foreach ($tmp as $trozotmp) {
							if ($trozotmp != "") {
								// Si no esta vacio, lo metemos en el array en gordo
								array_push($arrayGenerico, trim($trozotmp));
							}
						}
					}
					// Array de vuelta
					array_push($arrayReturn, ["generico" => $arrayGenerico]);
				} else {
					// Solo hay ciudades
					foreach ($splitCiudades as $trozoAlArray) {
						if ($trozoAlArray != "") {
							array_push($arrayCiudades, trim($trozoAlArray));
						}
					}
					// Array de vuelta
					array_push($arrayReturn, ["ciudades" => $arrayCiudades]);
		    }

			}
		} else if ($dondeEstaBarrio !== false) {
			// Si solo hay barrio
			// Cortamos el string para sacar solo los barrios
			$string = substr($stringMayusculas, $dondeEstaBarrio, strlen($stringMayusculas));

			// Separamos los barrios
			$splitBarrios = explode("BARRIO:", $string);

			foreach ($splitBarrios as $trozotmp) {
				if ($trozotmp != "") {
					// Los metemos en el array
					array_push($arrayBarrios, trim($trozotmp));
				}
			}
			// Array de vuelta
			array_push($arrayReturn, ["barrios" => $arrayBarrios]);
		}

		// Devolvemos el array
		if (sizeof($arrayReturn) > 0) {
			// Si no esta vacio
			return $arrayReturn;
		} else {
			// Si esta vacio vamos a false
			return false;
		}


  }

  function similitudes($arrayDatos, $arrayConQuienComparar) {
    // Funcion que busca las similitudes
		// Devuelve un array con las similitudes
		// Necesita la funcion privada similitudes_sale
		// Pensado para ciudades y barrios de ahi los nombres de las variables

		// Primero el array de vuelta vacia
    $returnArray = array();

		// Recorremos el array
    foreach($arrayDatos as $rowCiudadesBusqueda) {
			// Siempre observamos si esta vacio o no, que nunca se sabe
      if ($rowCiudadesBusqueda != '') {
				// Para cada uno de ellos
        foreach($arrayConQuienComparar as $rowCiudadesArray) {
					// Hacemos la comparacion de Levenshtein a traves de nuestra otra funcion privada
          $resulttmp = $this -> similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda);
					// Por si escupe blanco (esto se puede hacer en origen y asi deberia ser)
          if ($resulttmp !='') {
						// Lo metemos en los resultados
            array_push($returnArray, $this -> similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda));
          }
        }
      }
    }

		// Retorno (esto se podria mejorar ya que el else sobra y con devolver por defecto el false valdria)
		if (empty($returnArray) == false) {
			// Si hay datos
			return $returnArray;
		} else {
			// Si no
			return false;
		}
  }

	function similitudes_palabras($arrayDatos, $arrayConQuienComparar) {
    // Funcion que busca las similitudes
		// Devuelve un array con las similitudes
		// Necesita la funcion privada similitudes_sale
		// Pensado para ciudades y barrios de ahi los nombres de las variables

		// Primero el array de vuelta vacia
    $returnArray = array();

		// Recorremos el array
    foreach($arrayDatos as $rowCiudadesBusqueda) {
			// Siempre observamos si esta vacio o no, que nunca se sabe
      if ($rowCiudadesBusqueda != '') {
				// Para cada uno de ellos
        foreach($arrayConQuienComparar as $rowCiudadesArray) {
					// Hacemos la comparacion de Levenshtein a traves de nuestra otra funcion privada
          $resulttmp = $this -> similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda);
					// Por si escupe blanco (esto se puede hacer en origen y asi deberia ser)
          if ($resulttmp !='') {
						// Lo metemos en los resultados
            array_push($returnArray, [$rowCiudadesBusqueda => $this -> similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda)]);
          }
        }
      }
    }

		// Retorno (esto se podria mejorar ya que el else sobra y con devolver por defecto el false valdria)
		if (empty($returnArray) == false) {
			// Si hay datos
			return $returnArray;
		} else {
			// Si no
			return false;
		}
  }

  function similitudes_sale($origen, $destino) {
    // Funcion que muestra aquellas con un 70% o mas de igualdad por Levenshtein
		// Devuelve el string si tiene un 70% de coincidencia o mas sino devuelve false
		// Bajado a un 65%

    $sim = similar_text(strtoupper($origen), strtoupper($destino), $perc);
    if ($perc > 65) {
      return $origen;
    } else {
      return false;
    }
  }

}
