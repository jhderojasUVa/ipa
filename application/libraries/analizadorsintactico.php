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
      return preg_replace("/(el)|(la.)|(lo.)|(y)|(o)/", $string);
    }
  }

  function eliminaBarrioyCiudad($string){
    // Funcion que elimina el barrio y a ciudad del string
    $textoUsar = $string;
    if(strstr("barrio:", $textoUsar) || strstr("ciudad:", $textoUsar)) {
      if (strstr("barrios:", $textoUsar)) {
        $arrayTmp = explode($textoUsar, "barrios:");
        $textoUsar = implode(" ", $arrayTmp);
      }
      if (strstr("ciudad:", $textoUsar)) {
        $arrayTmp = explode($textoUsar, "barrios:");
        $textoUsar = implode(" ", $arrayTmp);
      }
    }

    return $textoUsar;
  }

  function devuelveArrayWhere($string) {
    // Funcion que devuelve el array montado para el SQL en el WHERE
    $arrayATrozos = explode($string, " ");
    $sql = " WHERE descripcion like '%".$string."%' ";
    foreach($arrayATrozos as $trozo) {
      $sql = $sql + " OR descripcion LIKE '%".$trozo."%' OR calle LIKE '%".$trozo."%'";
    }

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
      $textoSinMierda = preg_replace("/(\ben)|(\blas)|(\blos)|(\bel)|(\bla)|(\blo)|(ante)/", "", $trozostmp[0]);
      $trozostmp2 = explode(" ", $textoSinMierda);
      foreach ($trozostmp2 as $cacho) {
        if ($cacho != "") {
          array_push($trozos, $cacho);
        }
      }
      return $trozos;
    } else {
      return false;
    }
  }

  function troceador($string) {
    // Funcion que devuelve un array troceado con los barrios y ciudades
		// Trocea el string por "ciudad" y por "barrio"

    $queryBusqueda = strtoupper($string);
    $arrayReturn = array();
    $splitCiudades = explode("CIUDAD:", $queryBusqueda);

    foreach ($splitCiudades as $trozo) {
      $tmp = explode("BARRIO:", $trozo);
      foreach ($tmp as $trozotmp) {
        if ($trozotmp != '') {
          array_push($arrayReturn, $trozotmp);
        }
      }
    }
    return $arrayReturn;
  }

  function similitudes($arrayDatos, $arrayConQuienComparar) {
    // Funcion que busca las similitudes
		// Devuelve un array con las similitudes
		// Necesita la funcion privada similitudes_sale

    $returnArray = array();

    foreach($arrayDatos as $rowCiudadesBusqueda) {
      if ($rowCiudadesBusqueda != '') {
        foreach($arrayConQuienComparar as $rowCiudadesArray) {

          $resulttmp = similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda);

          if ($resulttmp !='') {
            array_push($returnArray, similitudes_sale($rowCiudadesArray, $rowCiudadesBusqueda));
          }
        }
      }
    }
    return $returnArray;
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
