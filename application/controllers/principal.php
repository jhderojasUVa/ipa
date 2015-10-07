<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct() {
		 parent::__construct();
		 
		 // Carga de librerias y demas
		 // Helpers
		 $this -> load -> helper("url");
		 
		 // Modelos
		 $this -> load -> model("barrios_model");
		 $this -> load -> model("comentarios_model");
		 $this -> load -> model("localizaciones_model");
		 $this -> load -> model("pisos_model");
		 $this -> load -> model("admin_model");
		 $this -> load -> model("usuarios_model");
		 
		 // Librerias
		 //$this -> load -> library("session");
		 $this -> load -> library("sesiones_usuarios");
		 $this -> load -> library("mail_uva");
		 $this -> load -> library("SSOUVa");
		 $this -> load -> library("LDAP");
		 $this -> load -> library("DNI");
		 
		 $this -> load -> library("pagination");
		
	}

	public function index() {
		// Funcion principal que muestra el home
		
		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			$this -> sesiones_usuarios -> es_uva();
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			//$datos["logeado"] = true;
			$_SESSION["logeado"] = true;
		} else {
			// O no esta autentificado
			$datos["usuario"] = 0;
			//$datos["logeado"] = false;
			$_SESSION["uva"] = false;
			$_SESSION["logeado"] = false;
		}
		
		//log_message("DEBUG", ">>>>>>>>>>>>>>>> usuario: ".$datos["usuario"]." | DATOS DEV:".$this -> admin_model -> es_admin($datos["usuario"]));
		
		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($datos["usuario"])>0) {
			// Es admin
			//$_SESSION["es_admin"] = true;
			$_SESSION["logeado"] = true;
		} else {
			// No es admin
			$_SESSION["es_admin"] = false;
			if (!isset($_SESSION["fue_admin"])) {
				$_SESSION["fue_admin"] = false;
			}
		}
		
		if ($_SESSION["es_admin"]==true) {
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$datos["pisos_no"] = $this -> pisos_model -> mostar_pisos_no_validados();
			$this -> load -> view("doc/index", $datos);
		} else {
			// Si no es admin
			// Pintamos la pagina de arriba a abajo
			// Primero la oferta de pisos con imagenes, que son 5
			$datos["pisos"] = $this -> pisos_model -> muestra_5_imagenes_piso();
			$datos["barrios"] = $this -> barrios_model -> barrios_con_pisos();
			$datos["ciudades"] = $this -> localizaciones_model -> mostrar_localizaciones_pisos();
			
			$this -> load -> view("index", $datos);
		}
	}
	
	public function barrios() {
		// Funcion que saca por barrios (REVISAR)
		
		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			//$datos["logeado"] = true;
			$_SESSION["logeado"] = true;
		} else {
			// O no esta autentificado
			header("location:".base_url()."index.php/principal/error");
			$datos["usuario"] = 0;
			//$datos["logeado"] = false;
			$_SESSION["logeado"] = false;
		}
		
		$idbarrio = $this -> input -> get("id");
		// Para el contador
		if ($this -> input -> get("per_page") && $this -> input -> get("per_page")!="") {
			$datos["pagina_llego"] = $this -> input -> get("per_page");
		} else {
			$datos["pagina_llego"] = 1;
		}
		
		$datos["pisos_usuario_total"] = $this -> pisos_model -> show_piso_barrio_total($idbarrio);
		$datos["pisos_usuario"] = $this -> pisos_model -> show_piso_barrio($idbarrio, 8, ($datos["pagina_llego"]-1));
		$datos["cosa"] = "Pisos encontrados en el barrio";
		
		// Configuracion de la paginacion
		$config["base_url"] = base_url()."index.php/principal/barrios/?id=".$idbarrio;
		$config["use_page_numbers"] = true;
		$config["page_query_string"] = true;
		$config["per_page"] = 8;
		
		//$config['display_pages'] = FALSE;
		
		$config['num_links'] = 2;
		
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

		$config["total_rows"] = $datos["pisos_usuario_total"];
		
		$this -> pagination -> initialize($config);
		
		$datos["barrios"] = $this -> barrios_model -> barrios_con_pisos();
		$datos["ciudades"] = $this -> localizaciones_model -> mostrar_localizaciones_pisos();
		
		$this -> load -> view("encontrados", $datos);
	}
	
	public function ciudades() {
		// Funcion que saca por ciudades (REVISAR)
		
		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			//$datos["logeado"] = true;
			$_SESSION["logeado"] = true;
		} else {
			// O no esta autentificado
			header("location:".base_url()."index.php/principal/error");
			$datos["usuario"] = 0;
			$_SESSION["logeado"] = false;
			//$datos["logeado"] = false;
		}
		
		$idciudad = $this -> input -> get("id");
		// Para el contador
		if ($this -> input -> get("per_page") && $this -> input -> get("per_page")!="") {
			$datos["pagina_llego"] = $this -> input -> get("per_page");
		} else {
			$datos["pagina_llego"] = 1;
		}
		
		$datos["pisos_usuario"] = $this -> pisos_model -> show_piso_cuidad($idciudad, 8, ($datos["pagina_llego"]-1));
		$datos["pisos_usuario_total"] = $this -> pisos_model -> show_piso_cuidad_total($idciudad);
		$datos["cosa"] = "Pisos encontrados en la ciudad";
		
		// Configuracion de la paginacion
		$config["base_url"] = base_url()."index.php/principal/ciudades/?id=".$idciudad;
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

		$config["total_rows"] = $datos["pisos_usuario_total"];
		
		$this -> pagination -> initialize($config);
		
		$datos["barrios"] = $this -> barrios_model -> barrios_con_pisos();
		$datos["ciudades"] = $this -> localizaciones_model -> mostrar_localizaciones_pisos();
		
		$this -> load -> view("encontrados", $datos);
		
	}
	
	public function rss() {
		// Funcion que hace el RSS
		// Enviara los ultimos 10 pisos existentes y tal
		$datos["pisos"] = $this -> pisos_model -> muestra_10_pisos();
		//$this -> load -> view("rss", $datos);
	}
	
	public function geo() {
		// Funcion que abre la ventana geolocalizada y los pisos cercanos
		// Para no saturar el google maps ponemos los de la ciudad, por eso los cogemos del string
		if ($this -> input -> get("idciudad")) {
			$idciudad = $this -> input -> get("idciudad");
		} else {
			// Si viene con los de defecto
			// Sino pucela
			$idciudad = 1;
		}
		$datos["pisos"] = $this -> localizaciones_model -> saca_pisos_gps($idciudad);
		$datos["cantidad"] = $this -> localizaciones_model -> cantidad_saca_pisos_gps($idciudad);
		$datos["ciudades"] = $this -> localizaciones_model -> mostrar_localizaciones_pisos();
		$this -> load -> view("gps", $datos);
	}
	
	/* Login de usuarios */
	
	public function haz_login() {
		$this -> load -> view("user/login");
	}
	
	public function login() {
		// Login de usuarios discriminados
		$uva = $this -> input -> post("uva");
		
		if ($uva == 1) {
			// Si entra por el SSO
			$_SESSION["uva"] = true;
			$usuario = $this -> ssouva -> login();
		} elseif ($uva == 0) {
			// Si entra por la parte de IPA
			$usuario = $this -> input -> post("login");
			$password = $this -> input -> post("password");
			if( $this -> usuarios_model -> logear($usuario, $password) == true) {
				// Login OK
				header("Location: ".site_url());
			} else {
				// Login Error
				header("Location: ".site_url()."/principal/error?userpass=1");
			}
			
			//header("Location: ".site_url());
		}
	}
	
	public function alta_nueva() {
		// Muestra el formulario de altas vacio o mete un usuario
	
		
		// Mensaje de respuesta
		$datos["bien"] = "";
		
		// Cogemos los datos del post
		$nombre = $this -> input -> post("nombre");
		$apellidos = $this -> input -> post("apellidos");
		$login = $this -> input -> post("login");
		$password = $this -> input -> post("password");
		$direccion = $this -> input -> post("direccion");
		$tlf = $this -> input -> post("tel");
		$email = $this -> input -> post("email");
		$dni = strtoupper($this -> input -> post("dni"));
		
		$datos["datos_del_usuario"] = array ("nombre" => $nombre, 
											 "apellidos" => $apellidos, 
											 "login" => $login,
											 "direccion" => $direccion,
											 "tlf" => $tlf,
											 "email" => $email,
											 "dni" => $dni );
											 
		$datos["errores"] = "";
		
		// Comprobaciones anteriores a todo, antes en JS ahora en PHP
		$ok = 1;
		
		if ($email!="" && $login!="") {
			// Comprobamos que no nos la quiere meter doblada en el correo
			if ($this -> usuarios_model -> comprueba_mail($email) == true) {
				$ok = 0;
				$datos["errores"] = "<li>La dirección de correo ya se esta en uso.</li>";
			}
		
			// Doblada en el login del usuario
			if ($this -> usuarios_model -> comprueba($login) == true) {
				$ok = 0;
				$datos["errores"] .= "<li>El nombre de usuario ya esta en uso.</li>";
			}
		
		}
		
		// Comprobamos el DNI
		if ($dni && $this -> dni -> comprobar_nif($dni)==false) {
			$ok = 0;
			$datos["errores"] .="<li>El DNI introducido no es correcto</li>";
		}
		
		
		if ($this -> input -> post("ok")==1 && $ok == 1) {
			
			// Ahora lo metemos en la bd
			$this -> usuarios_model -> add_usuario($nombre, $apellidos, $login, $password, $direccion, $tlf, $email, $dni);
			
			// Configuramos el mensaje
			$asunto = "Datos de usuario ".$login." en IPA UVa";
			$texto = "Estimado/a ".$nombre."\r\nHemos recibido su petición de alta en el sistema IPA (ipa.uva.es) con los siguientes datos:\r\nUsuario: ".$login."\r\nContraseña: ".$password."\r\n\r\nPor favor, para agilizar el proceso de su alta DEBE RESPONDER A ESTE MENSAJE indicando si es la primera vez que esta usando nuestro servicio, o si por el contrario, dispone de algun inmueble ofertado anteriormente (valido desde mayo de 2011).\r\nUna vez recibida su respuesta, verificaremos los datos y activaremos su usuario para que pueda incorporar o modificar (si dispone de alguna oferta como antes hemos indicado) sus inmuebles.\r\nLe adjuntamos un enlace al manual de usuario IPA de forma que le ayude a gestionar su oferta: http://ipa.uva.es/css/IPA.pdf\r\n\r\nRecuerde que su usuario aun no esta activo, ya que los administradores tienen que confirmar su alta. Cuando su alta este completada recibirá un correo electrónico indicándole los pasos que podrá realizar.\r\n\r\nComo se indica en las condiciones del servicio, Asuntos Sociales de la Universidad de Valladolid se reserva el derecho a eliminar las ofertas que sean denunciadas por los usuarios de forma reiterada o se trata de inmobiliarias que hacen uso abusivo del sistema.";
			
			$this -> mail_uva -> envia_mail($email, $asunto, $texto);
			$datos["bien"] = "Su usuario ha sido creado con exito. En breve recibirá un correo electrónico con los datos que ha enviado.<br />Recuerde que los usuarios <strong>IPA</strong> estan pensados para que los propietarios de inmuebles los anuncien.";
			
			// Mensaje a los administradores
			$asunto = "Alta de nuevo usuario en IPA";
			$texto = "Se ha enviado el alta de un nuevo usuario con los siguientes datos:\r\n\r\nNombre y Apellidos: ".$nombre." ".$apellidos."\r\nLogin: ".$login."\r\nPassword: ".$password."\r\nDireccion: ".$direccion."\r\nTelefono de contacto: ".$tlf."\r\nEmail: ".$email."\r\nDNI: ".$dni."\r\n\r\nPor favor, entre en el administrador para realizar la acción oportuna.";
			$this -> mail_uva -> envia_mail("ipa.asuntos.sociales@uva.es,jesusangel.hernandez@uva.es", $asunto, $texto);
		} else {
			// Sino mostramos la pagina de los errores
			//$this -> load -> view("user/add", $datos);
		}
		$this -> load -> view("user/add", $datos);
	}
	
	public function recordar_password() {
		// La tipica funcion que envia un mail al pollo en cuestion si se acuerda de su correo y tal y pascual
		
		// Mensaje de respuesta
		$datos["bien"] = "";
		
		if ($this -> input -> post("ok")==1) {
			$email = $this -> input -> post("email");
			$datos_usuario = $this -> usuarios_model -> devuelve_datos_usuario($email);
			if ($datos_usuario!=false) {
				// Hay cosicas
				foreach ($datos_usuario as $row) {
					$asunto = "Recuperacion de datos de usuario de IPA UVa"; 
					$texto = "Hemos recibido la petición de recuperación de sus datos de usuario desde nuestra página web. Los datos son los siguientes:\r\n\r\nUsuario: ".$row -> usuario."\r\nContraseña: ".$row -> password."\r\n\r\nEn caso de no haber solicitado los datos a traves de nuestra web obvie este correo.";
					$this -> mail_uva -> envia_mail($row -> email, $asunto, $texto);
				}
				$datos["bien"] = "<p>Los datos de su usuario han sido enviados a su dirección de correo electrónico. En breve recibirá un correo. Por favor, si no lo recibe <strong>verifique la carpeta de spam de su gestor de correo electronico</strong>.</p>";
			} else {
				// Envia un correo falso, juas
			}
		} else {
		}
		$this -> load -> view("user/recuperar", $datos);
	}
	
	public function logout() {
		// Funcion para deslogear a un usuario de mi portal uva y del sistema
		// Le largamos
		session_destroy();
		if ($_SESSION["uva"] == true) {
			// Si es de la uva por la uva
			//$this -> sesiones_usuarios -> log_out();
			$this -> ssouva -> logout();
		} else {
			// Si el mio por mi
			$this -> sesiones_usuarios -> log_out();
			header("Location: ".site_url());
		}
		
		// Pa la principal
		//header("Location: ".site_url());
	}
	
	public function vermisdatos() {
		
		// Funcion que muestra los datos de un usuario
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			if ($_SESSION["uva"] == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
				
				// Si es de la UVa le enviaremos a una pagina para que vaya al ldap
				header("Location: https://intranet.uva.es/ldap");
				
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
				
				$datos["datos_usuario"] = $this -> usuarios_model -> devuelve_datos_usuario_id($datos["usuario"]);
				$this -> load -> view("mis/misdatos", $datos);
			}
			$_SESSION["logeado"] = true;
		} else {
			// O no esta autentificado
			header("location:".base_url()."index.php/principal/error");
			$datos["usuario"] = 0;
			$_SESSION["logeado"] = false;
		}
	}
	
	public function error() {
		// Muestra la página de error
		$this -> load -> view("error_permisos");
	}
	
	/*************************************************************************************************
	
		Funciones privadas
	
	*************************************************************************************************/

	function letranif($dni) {
        $letras = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E','T');
        $resto = $dni % 23;
        $letra = $letras[$resto];
        return $letra;
	}


}
