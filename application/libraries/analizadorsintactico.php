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

		$sql = " WHERE 0 OR (";
		// Recorremos a la vieja usanza
		$i = 0;
		foreach ($array as $row) {
			if ($i == 0) {
				$sql = $sql . " descripcion LIKE '%".$row."%' OR calle LIKE '%".$row."%' ";
				$i++;
			} else {
				$sql = $sql . " OR descripcion LIKE '%".$row."%' OR calle LIKE '%".$row."%' ";
			}
		}

		$sql = $sql .")";

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
    $trozostmp = explode("ciudad:", $string);

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

		// Esto se puede refactorizar a algo mucho mas rapido

		// Primero lo pasamos todo a mayusculas
    $queryBusqueda = strtoupper($string);
		// Creamos el array de vuelta (empty)
    $arrayReturn = array();
		// Separamos todo en las partes de ciudades
    $splitCiudades = explode("CIUDAD:", $queryBusqueda);

		// Recorremos las ciudades para buscar los trozos de barrio
    foreach ($splitCiudades as $trozo) {
			// Separamos los barrios
      $tmp = explode("BARRIO:", $trozo);
      foreach ($tmp as $trozotmp) {
        if ($trozotmp != '') {
					// Si no esta vacio, lo metemos en el array
          array_push($arrayReturn, $trozotmp);
        }
      }
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
          $resulttmp = similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda);
					// Por si escupe blanco (esto se puede hacer en origen y asi deberia ser)
          if ($resulttmp !='') {
						// Lo metemos en los resultados
            array_push($returnArray, similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda));
          }
        }
      }
    }
		// Retorno (esto se podria mejorar ya que el else sobra y con devolver por defecto el false valdria)
		if (size_of($returnArray) > 0) {
			// Si hay datos
			return $returnArray;
		} else {
			// Si no
			return false;
		}

  }

  private function similitudes_sale($origen, $destino) {
    // Funcion que muestra aquellas con un 70% o mas de igualdad por Levenshtein
		// Devuelve el string si tiene un 70% de coincidencia o mas sino devuelve false
    $sim = similar_text(strtoupper($origen), strtoupper($destino), $perc);
    if ($perc > 70) {
      return $origen;
    } else {
      return false;
    }
  }

}
