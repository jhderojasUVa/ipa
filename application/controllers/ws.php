<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WS extends CI_Controller {

	public function __construct() {
		 parent::__construct();
		 
		 // Carga de librerias y demas
		 // Helpers
		 //$this -> load -> helper("url");
		 
		 // Modelos
		 $this -> load -> model("webservice_model");
	}
	
	public function gps_pisos() {
		// El burubullo qu geolocaliza todo
		echo "<h1>Comenzando el proceso...</h1>";
		$ids = $this -> webservice_model -> ids_pisos();
		foreach ($ids as $row) {
			// Recorremos las ids
			if ($this -> webservice_model -> piso_tiene_gps($row -> id_piso) == false) {
				$this -> webservice_model -> consulta_google($row -> id_piso);
				echo "<br>Piso con geolocalizacion a&ntilde;adida.";
			}
		}
		echo "<h1>Realizado con exito...</h1>";
	}

}
?>