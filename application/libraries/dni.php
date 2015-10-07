<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
// Clase de calendario que hace todas las funciones de correo

class DNI {
	
	function __construct() {
		$this -> CI = &get_instance();
	}
	
	function es_DNI_NIE_valido ($cadena) {
		//Comprobamos longitud
		if (strlen($cadena) != 9) return false;      
	  
		//Posibles valores para la letra final 
		$valoresLetra = array(
			0 => 'T', 1 => 'R', 2 => 'W', 3 => 'A', 4 => 'G', 5 => 'M',
			6 => 'Y', 7 => 'F', 8 => 'P', 9 => 'D', 10 => 'X', 11 => 'B',
			12 => 'N', 13 => 'J', 14 => 'Z', 15 => 'S', 16 => 'Q', 17 => 'V',
			18 => 'L', 19 => 'H', 20 => 'C', 21 => 'K',22 => 'E'
		);
	
		//Comprobar si es un DNI
		if (preg_match('/^[0-9]{8}[A-Z]$/i', $cadena)) {
			//Comprobar letra
			if (strtoupper($cadena[strlen($cadena) - 1]) !=
				$valoresLetra[((int) substr($cadena, 0, strlen($cadena) - 1)) % 23])
				return false;
	 
			//Todo fue bien 
			return true; 
		}
		//Comprobar si es un NIE
		else if (preg_match('/^[XYZ][0-9]{7}[A-Z]$/i', $cadena))
		{
			//Comprobar letra
			if (strtoupper($cadena[strlen($cadena) - 1]) !=
				$valoresLetra[((int) substr($cadena, 1, strlen($cadena) - 2)) % 23])
				return false;
	
			//Todo fue bien
			return true;
		}
		
		//Cadena no válida  
		return false; 
	}
	
	function comprobar_nif($nif){
	   $letras = explode(',','T,R,W,A,G,M,Y,F,P,D,X,B,N,J,Z,S,Q,V,H,L,C,K,E');
	   if (
		  (strlen($nif)!=9) ||
		  (!is_long($entero=intval(substr($nif,0,8)))) ||
		  (!in_array($letra=strtoupper(substr($nif,8,1)),$letras)) ||
		  ($letra!=$letras[$entero%23])
		  ){
			 return false;
		  }else{
			 return true;
		  }
	}
			
}