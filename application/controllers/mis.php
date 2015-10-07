<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mis extends CI_Controller {

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
		$this -> load -> model("usuarios_model");
		
		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
		
		// Y la libreria
		$this -> load -> library("upload");
	}
	
	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}
	
	public function mispisos() {
		// Funcion que muestra los pisos que ha añadido una persona
		// Lo primero el SSO de la UVa... ¡siempre!
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
		
		// Los datos del usuario del LDAP (por si acaso)
		//$datos["datos_yo"] = $this -> ldap -> sacar_datos_ldap($datos["usuario"]);
		
		$datos["pisos_usuario"] = $this -> pisos_model -> pisos_usuario($datos["usuario"]);
		
		$this -> load -> view("mis/mispisos", $datos);
	}
	
	public function miscomentarios() {
		// Funcion que muestra los comentarios realizados por una persona
		
		// Esta caracteristica tengo que darla una vuelta... porque ahora no me cuadra lo que ando programando y si vale realmente para algo
		
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
				// Los datos del usuario del LDAP por si hacen falta para algo
				$datos["datos_yo"] = $this -> ldap -> sacar_datos_ldap($datos["usuario"]);
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
				$datos["datos_yo"] = array ("nombre"=>$_SESSION["nombre"]." ".$_SESSION["apellidos"]);
			}
			$datos["logeado"] = true;
		} else {
			// O no esta autentificado
			$datos["usuario"] = 0;
			$datos["logeado"] = false;
		}
		
		$datos["q"] = "";
		$datos["mis_comentarios"] = $this -> comentarios_model -> show_comentario_usuario($datos["usuario"]);
		//$datos["cantidad_mis_comentarios"] = $this -> comentarios_model -> show_cantidad_comentario_usuario($datos["usuario"]);
		$datos["cantidad_mis_comentarios"] = count($datos["mis_comentarios"]);
		
		$this -> load -> view("mis/miscomentarios", $datos);
	}
	
	public function buscar() {
		// Funcion para buscar en los comentarios
		
		// SSO always
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;
		
		// Los datos del usuario del LDAP por si hacen falta para algo
		$datos["datos_yo"] = $this -> ldap -> sacar_datos_ldap($datos["usuario"]);
		
		$q = $this -> input -> post("q");
		
		$datos["q"] = $q;
		$datos["mis_comentarios"] = $this -> comentarios_model -> q_show_comentario_usuario($q, $datos["usuario"]);
		$datos["cantidad_mis_comentarios"] = $this -> comentarios_model -> q_show_cantidad_comentario_usuario($q, $datos["usuario"]);
		
		$this -> load -> view("mis/miscomentarios", $datos);
	}
	
	public function misdatos_usuario() {
		// Funcion para modificar los datos del usuario y/o el password
		
		$espass = $this -> input -> post("change_pass");
		$esuser = $this -> input -> post("change_user");
		
		$idu = $_SESSION["idu"];
		
		if ($_SESSION["uva"] == 1 || $_SESSION["uva"] == 0) {
			// Si quiere cambiar el password
			if ($espass==1) {
				$password = $this -> input -> post("password");
				$this -> usuarios_model -> cambia_campo("password", $password, $idu);
				$this -> load -> view("mis/misdatos_ok");
			}	
			
			// Si quiere cambiar datos del usuarios
			if ($esuser==1) {
				$nombre = $this -> input -> post("nombre");
				$this -> usuarios_model -> cambia_campo("nombre", $nombre, $idu);				
				$apellidos = $this -> input -> post("apellidos");
				$this -> usuarios_model -> cambia_campo("apellidos", $apellidos, $idu);
				$direccion = $this -> input -> post("direccion");
				$this -> usuarios_model -> cambia_campo("direccion", $direccion, $idu);
				$tlf = $this -> input -> post("tel");
				$this -> usuarios_model -> cambia_campo("tlf", $tlf, $idu);
				$email = $this -> input -> post("email");
				$this -> usuarios_model -> cambia_campo("email", $email, $idu);
				$dni = strtoupper($this -> input -> post("dni"));
				$this -> usuarios_model -> cambia_campo("dni", $dni, $idu);
				
				$this -> load -> view("mis/misdatos_ok");
			}
			
		} else {
			// Error
			header("location:".base_url()."index.php/principal/error");
		}
	}
	
}
?>