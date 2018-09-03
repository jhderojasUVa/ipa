<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Clase de calendario que hace todas las funciones para un calendario

class Sesiones_usuarios {

	function __construct() {
		$this -> CI = &get_instance();
		session_start();
	}

	// Esta libreria requiere una refactorizacion como una casa

	function esta_logeado() {
		// Funcion que devuelve si esta logeado o no

		// Comprobamos si el usuario esta logeado, por la UVa con la cookie de isotrol, autentificado por la herramienta y si esta autentificado
		if (isset($_COOKIE["isotrol_sso_cookie"]) || (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"] == true)) {
			// Si las tiene, esta autentificado, logeado
			$_SESSION["logeado"] = true;
			if (isset($_COOKIE["isotrol_sso_cookie"])) {
				// Y ademas se ha autentificado por la UVa
				$_SESSION["uva"] = true;
			} else {
				// O no (lo dejamos asi para futuros cambios, por si acaso, vamos)
				$_SESSION["uva"] = false;
			}
			// Devolvemos que si esta logeado ya que la session controla el resto
			return true;
		} else {
			// No esta logeado y viene de la calle
			return false;
		}
	}

	function es_uva() {
		// Función que devuelve si es de la UVa y mete la sesion necesaria
		if (isset($_COOKIE["isotrol_sso_cookie"])) {
			// Si es de la uva
			$_SESSION["uva"] = true;
			return true;
		} else {
			// No es de la UVa, ponemos la session a falsa por si las moscas
			$_SESSION["uva"] = false;
			return false;
		}
	}

	function log_out() {
		// Logout generico, tanto para IPA como para UVa
		// Eliminamos la cookie de isotrol por si ha entrado por mi portal uva
		$pastdate = mktime(0,0,0,1,1,1970);
		//setcookie("isotrol_sso_cookie","",$pastdate);
		setcookie("isotrol_sso_cookie","",time()-3600);
		setcookie("JSESSIONID","",time()-3600);
		// Eliminamos (vaciamos, NUNCA hacer un unset) el array de la sesion
		session_destroy();
	}

	function que_es($admin, $usuario) {
		// Funcion para meter en sesiones si es administrador o usuario
		// Funciona con un si/no

		if ($admin=="si") {
			$_SESSION["es_admin"] = true;
			$_SESSION["fue_admin"] = true;
		} else {
			$_SESSION["es_admin"] = false;
			$_SESSION["fue_admin"] = false;
		}

		if ($usuario=="si") {
			$_SESSION["usuario_normal"] = true;
		} else {
			$_SESSION["usuario_normal"] = false;
		}

		return true;
	}

	function cambiar_tipo() {
		// Funcion que cambia de admin a user normal y viceversa
		// Esta funcion se usa para cambiar los privilegios de un admin y que pueda hacer reservas por el metodo normal

		// Lo comprobamos por si hay algun listo que entra y lo ejecuta a piñon... que nunca se sabe
		if ($_SESSION["es_admin"] == true) {
			$_SESSION["es_admin"] = false;
		} elseif ($_SESSION["es_admin"] == false) {
			$_SESSION["es_admin"] = true;
		}

		log_message("DEBUG", ">>>>>>>>>>>>>>>>>>>>>> ENTRO");
	}

	function es_admin() {
		// Funcion que responde si es admin o no
		if ($_SESSION["es_admin"] == true) {
			return true;
		} else {
			return false;
		}
	}

	function es_user() {
		// Funcion que devuelve si es un usuario o no (vamos, si esta identificado)
		if ($_SESSION["usuario_normal"] == true) {
			return true;
		} else {
			return false;
		}
	}

	// es_admin y fue_admin seguro que se pueden refactorizar!
	function fue_admin() {
		// Funcion que devuelve si fue admin o no
		if ($_SESSION["fue_admin"] == true) {
			return true;
		} else {
			return false;
		}
	}
}
