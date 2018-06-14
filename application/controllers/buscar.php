<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscar extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this->load->helper("file");

		// Modelos
		/*
		$this -> load -> model("barrios_model");
		$this -> load -> model("comentarios_model");
		$this -> load -> model("localizaciones_model");
		$this -> load -> model("pisos_model");
		*/

		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");

		$config["upload_path"] = "/Volumes/320Gb/httpdocs/ebayuva2/img_pisos";
		$config["allowed_types"] = "gif|jpg|png";
		$config["max_size"]	= "20000";

		// Y la libreria
		$this -> load -> library("upload", $config);
		$this -> load -> library("pagination");
	}

	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function busquedas($ws = null) {
		// Funcion para buscar

		echo ($ws);

		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			$datos["logeado"] = true;
		} else {
			// O no esta autentificado
			$datos["usuario"] = 0;
			$datos["logeado"] = false;
		}

		if ($this -> input -> post("q")) {
			$q = $this -> input -> post("q");
		} else {
			$q = $this -> input -> get("q");
		}
		//$q = $this -> input -> post("q");
		$datos["q"] = $q;
		$datos["cp"]="";
		$datos["rango"]="";
		$datos["loc"]=0;

		// Para el contador
		if ($this -> input -> get("per_page") && $this -> input -> get("per_page")!="") {
			$datos["pagina_llego"] = $this -> input -> get("per_page");
		} else {
			$datos["pagina_llego"] = 1;
		}

		$datos["buscar_pisos_numrows"]= $this -> pisos_model -> buscar_piso_total($datos["q"]);
		$datos["buscar_pisos_paginas"] = intdiv($datos["buscar_pisos_numrows"], 8);
		$datos["buscar_pisos"] = $this -> pisos_model -> buscar_piso($datos["q"], 8, ($datos["pagina_llego"]-1));

		// Configuracion de la paginacion
		$config["base_url"] = base_url()."index.php/buscar/busquedas/?q=".$q;
		$config["use_page_numbers"] = true;
		$config["page_query_string"] = true;
		$config["per_page"] = 8;

		$config["first_link"] = "&laquo; primero";
		$config["first_tag_open"] = "<span class=\"boton_pasos\">";
		$config["first_tag_close"] = "</span>";

		$config["last_link"] = "ultimo &raquo;";
		$config["last_tag_open"] = "<span class=\"boton_pasos\">";
		$config["last_tag_close"] = "</span>";

		$config["next_link"] = "siguiente &gt;";
		$config["next_tag_open"] = "<span class=\"boton_pasos\">";
		$config["next_tag_close"] = "</span>";

		$config["prev_link"] = " &lt; anterior";
		$config["prev_tag_open"] = "<span class=\"boton_pasos\">";
		$config["prev_tag_close"] = "</span>";

		$config["cur_tag_open"] = "<span class=\"boton_pasos\"><strong>";
		$config["cur_tag_close"] = "</strong></span>";
		$config["num_tag_open"] = "<span class=\"boton_pasos\">";
		$config["num_tag_close"] = "</span>";

		$config["total_rows"] = $datos["buscar_pisos_numrows"];


		$this -> pagination -> initialize($config);

		//$datos["buscar_comentarios"] = $this -> comentarios_model -> buscar_comentario($q);
		//$datos["buscar_comentarios_numrows"] = $this -> comentarios_model -> cantidad_buscar_comentario($q);

		$datos["ciudades"] = $this -> localizaciones_model -> show_localizaciones("cualquiera");

		if ($ws == "json") {
			// Cambiamos la cabecera a JSON de respuesta
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("buscar", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

	public function refinar($ws = null) {
		// Funcion de refinamiento de busqueda
		// Lo primero el SSO
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			$datos["logeado"] = true;
		} else {
			// O no esta autentificado
			$datos["usuario"] = 0;
			$datos["logeado"] = false;
		}

		// Pillamos las variables en get o en post
		if ($this -> input -> post("q")) {
			$q = $this -> input -> post("q");
		} else {
			$q = $this -> input -> get("q");
		}
		$datos["q"] = $q;

		if ($this -> input -> post("cp")) {
			$cp = $this -> input -> post("cp");
		} else {
			$cp = $this -> input -> get("cp");
		}
		$datos["cp"] = $cp;

		if ($this -> input -> post("ciudad")) {
			$loc = $this -> input -> post("ciudad");
		} else {
			$loc = $this -> input -> get("ciudad");
		}
		$datos["loc"] = $loc;

		if ($this -> input -> post("cantidad")) {
			$rango = $this -> input -> post("cantidad");
		} else {
			$rango = $this -> input -> get("cantidad");
		}
		$datos["rango"] = $rango;

		// Para el contador
		if ($this -> input -> get("per_page") && $this -> input -> get("per_page")!="") {
			$datos["pagina_llego"] = $this -> input -> get("per_page");
		} else {
			$datos["pagina_llego"] = 1;
		}

		$datos["buscar_pisos_paginas"] = intdiv($datos["buscar_pisos_numrows"], 8);
		$datos["buscar_pisos_numrows"]= $this -> pisos_model -> refinar_cantidad_buscar_piso($q, $cp, $loc, $rango);
		$datos["buscar_pisos"] = $this -> pisos_model -> refinar_buscar_piso($q, $cp, $loc, $rango, 8 , $datos["pagina_llego"]-1);

		// Configuracion de la paginacion
		$config["base_url"] = base_url()."index.php/buscar/refinar/?id=0&q=".$q."&cp=".$cp."&loc=".$loc."&cantidad=".$rango;
		$config["use_page_numbers"] = true;
		$config["page_query_string"] = true;
		$config["per_page"] = 8;

		$config["first_link"] = "&laquo; primero";
		$config["first_tag_open"] = "<span class=\"boton_pasos\">";
		$config["first_tag_close"] = "</span>";

		$config["last_link"] = "ultimo &raquo;";
		$config["last_tag_open"] = "<span class=\"boton_pasos\">";
		$config["last_tag_close"] = "</span>";

		$config["next_link"] = "siguiente &gt;";
		$config["next_tag_open"] = "<span class=\"boton_pasos\">";
		$config["next_tag_close"] = "</span>";

		$config["prev_link"] = " &lt; anterior";
		$config["prev_tag_open"] = "<span class=\"boton_pasos\">";
		$config["prev_tag_close"] = "</span>";

		$config["cur_tag_open"] = "<span class=\"boton_pasos\"><strong>";
		$config["cur_tag_close"] = "</strong></span>";
		$config["num_tag_open"] = "<span class=\"boton_pasos\">";
		$config["num_tag_close"] = "</span>";

		$config["total_rows"] = $datos["buscar_pisos_numrows"];

		$this -> pagination -> initialize($config);

		$datos["ciudades"] = $this -> localizaciones_model -> show_localizaciones("cualquiera");

		if ($ws == "json") {
			// Cambiamos la cabecera a JSON de respuesta
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("buscar", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

}
