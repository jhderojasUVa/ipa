<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this->load->helper("file");
		
		// Modelos
		$this -> load -> model("barrios_model");
		$this -> load -> model("comentarios_model");
		$this -> load -> model("localizaciones_model");
		$this -> load -> model("pisos_model");
		$this -> load -> model("admin_model");
		$this -> load -> model("usuarios_model");
		
		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
	}
	
	public function index() {
		echo "Esta pagina no se puede cargar directamente";
	}
	
	public function comprueba_user() {
		$usuario_comprobar = $this -> input -> post("usuario");
		
		if ($usuario_comprobar =="") {
			// Usuario vacio va a ser que no
			$datos["respuesta"] = "<span class='rojo_ok'>Vacio</span>";
		} else {
			// Usuario con cosas
			if ($this -> usuarios_model -> comprueba($usuario_comprobar) == true) {
				$datos["respuesta"] = "<span class=\"rojo_ok\">Ocupado</span>";
			} else {
				$datos["respuesta"] = "<span class=\"verde_ok\">Libre</span>";
			}
		}
		
		$this -> load -> view("ajax/usuario", $datos);
	}
	
	public function buscador_ajax() {
		// Funcion para el buscador en ajax principal
		$q = $this -> input -> post("q");
		
		if ($q<>"") {
		
			$resultados = $this -> pisos_model -> buscar_piso_ajax($q);
			if ($resultados <> false) {
				// Mostamos la caja con los resultados
				echo "<h1>Resultados r&aacute;pidos</h1>";
				foreach ($resultados as $row) {
					echo "<a href=\"".base_url()."index.php/pisos/producto_piso?id=".$row -> id_piso."\">".$row -> calle." ".$row -> numero."</a><br>";
				}
				//echo "<hr><a onclick=\"javascript:cerrar_popup()\">cerrar</a>";
			} else {
				// Borramos la caja de resultados y tal
			}
		}
	}
}
?>