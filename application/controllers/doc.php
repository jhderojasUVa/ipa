<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc extends CI_Controller {

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
		$this -> load -> model("admin_model");
		$this -> load -> model("usuarios_model");
		$this -> load -> model("estadisticas_model");
		*/

		// Librerias
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("mail_uva");
		//$this -> load -> library("funccalendario");
	}

	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function delspam() {
		// Borra un comentario y punto
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Es admin
			$id = $this -> input -> get("idspam");
			$us = $this -> input -> get("an");
			$this -> comentarios_model -> del_comentario($id);

			//Cargamos la principal
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$this -> load -> view("doc/index", $datos);
		}
	}

	public function del_comentario() {
		// Borra un comentario y punto pelota 2.0
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Es admin
			$id = $this -> input -> get("id");
			$this -> comentarios_model -> del_comentario($id);
			$datos["q"] = $this -> input -> get("q");

			//Cargamos la principal
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$this -> load -> view("doc/comentarios", $datos);
		}
	}

	public function edit_comentario() {
		// Edita un comentario
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;
		$datos["mensaje_vuelta"]="";

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Es admin
			if ($this -> input -> get("id")) {
				$id = $this -> input -> get("id");
			} else {
				$id = $this -> input -> post("id");
			}

			if ($this -> input -> post("cambiar")==1) {
				$datos["datos_comentario"] = $this -> comentarios_model -> show_comentario($id);
				$datos["q"] = $this -> input -> post("q");
				$comentario = $this -> input -> post("textocomentario");
				// Cambiamos el comentario
				$this -> comentarios_model -> editar_comentario($id, $comentario);
			} else {
				$datos["datos_comentario"] = $this -> comentarios_model -> show_comentario($id);
				$datos["q"]= $this -> input -> get("q");
			}
			$this -> load -> view("doc/editar_comentario", $datos);
		}
	}

	public function noespam() {
		// Desmarca un comentario como spam, vamos que lo quita de la bd de spam
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Es admin
			$id = $this -> input -> get("idspam");
			$us = $this -> input -> get("an");
			$this -> comentarios_model -> del_denuncia($id, $us);

			//Cargamos la principal
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$this -> load -> view("doc/comentarios", $datos);
		}
	}

	public function borrapiso() {
		// Borra un piso
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Es admin
			$id = $this -> input -> get("id");
			$ok = $this -> input -> get("ok");

			if ($ok==1) {
				$this -> pisos_model -> del_piso($id);
			}

			//Cargamos la principal
			//$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			//$this -> load -> view("doc/index", $datos);
			header("location: ".base_url());
		}
	}

	public function buscar() {
		// Funcion que busca y tal
		// SOLO BUSCA EN LOS LIBRES
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$q = $this -> input -> post("q");
			$datos["q"] = $q;

			if ($q=="") {
				$datos["busqueda"]=array();
			} else {
				// Si buscamos un piso
				// SOLO EN PISOS LIBRES
				$datos["busqueda"] = $this -> pisos_model -> buscar_piso_2($q);
			}

			//Cargamos la principal
			//$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();      <---- Esto sobra ahora y tal y pascual
			//echo "<br><br><br>SOLO LIBRES<br><br><br>";
			$this -> load -> view("doc/buscar", $datos);
		}
	}

	public function buscar_todos() {
		// Funcion que busca en libres y ocupados
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$q = $this -> input -> post("q");
			$datos["q"] = $q;

			if ($q=="") {
				$datos["busqueda"]=array();
			} else {
				// Si buscamos un piso
				$datos["busqueda"] = $this -> pisos_model -> buscar_piso_4($q);
			}

			//Cargamos la principal
			//$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();      <---- Esto sobra ahora y tal y pascual
			//echo "<br><br><br>TODOS<br><br><br>";
			$this -> load -> view("doc/buscar", $datos);
		}
	}

	public function buscar_ocupados() {
		// Funcion como buscar que solo busca en los ocupados
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$q = $this -> input -> post("q");
			$datos["q"] = $q;

			if ($q=="") {
				$datos["busqueda"]=array();
			} else {
				// Si buscamos un piso
				$datos["busqueda"] = $this -> pisos_model -> buscar_piso_3($q);
			}

			//Cargamos la principal
			//$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();      <---- Esto sobra ahora y tal y pascual
			//echo "<br><br><br>SOLO OCUPADOS<br><br><br>";
			$this -> load -> view("doc/buscar", $datos);
		}
	}

	public function borrar_imagen() {
		// Funcion que borra una imagen (no hace falta ya que edita las cosas)
	}

	/* Usuarios */

	public function activar_user() {
		// Funcion que activa y tal
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$idu = $this -> input -> get("id");

			$this -> usuarios_model -> activar_user($idu);

			// Ahora le enviamos un correo con la instrucciones de despues
			$datos_usuario = $this -> usuarios_model -> devuelve_datos_usuario_id($idu);
			foreach ($datos_usuario as $row) {
				$asunto = "Su usuario en IPA UVa ha sido activado";
				$texto = "Hola,\r\nEl administrador de IPA ha activado su usuario. Ya puede entrar en el portal de Información de Pisos en Alquiler a traves de la URL ".base_url()." pulsar sobre el botón autentificarse y hacerlo a traves del sistema IPA.\r\n\r\nPodra añadir al sistema los pisos que desee y ver los comentarios realizados hacia sus inmuebles.\r\n\r\nRecuerde que, los pisos tras ser añadidos en el sistema pasan por un sistema de verificación.\r\n\r\nReciba un cordial saludo por parte del equipo de Asuntos Sociales.";
				$this -> mail_uva -> envia_mail($row->email, $asunto, $texto);
			}

			// Y recargamos los datos
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$datos["pisos_no"] = $this -> pisos_model -> mostar_pisos_no_validados();
			$this -> load -> view("doc/index", $datos);
		}
	}

	public function borrar_user() {
		// Borra usuario y tal
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$idu = $this -> input -> get("id");

			$this -> usuarios_model -> borra_user($idu);

			// Y recargamos los datos
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$datos["pisos_no"] = $this -> pisos_model -> mostar_pisos_no_validados();
			$this -> load -> view("doc/index", $datos);
		}
	}

	public function editar_user() {
		// Funcion para mostar los datos del usuario a cambiar
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$idu = $this -> input -> get("id");
			$datos["datos_usuarios"] = $this -> usuarios_model -> devuelve_datos_usuario_id($idu);
			$this -> load -> view("doc/datos_usuario", $datos);
		}
	}

	public function cambia_datos_usuario() {
		// Funcion que cambia los datos de un usuario IPA
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$idu = $this -> input -> post("idu");
			$nombre = $this -> input -> post("nombre");
			$apellidos = $this -> input -> post("apellidos");
			$login = $this -> input -> post("login");
			$password = $this -> input -> post("password");
			$direccion = $this -> input -> post("direccion");
			$tlf = $this -> input -> post("tlf");
			$email = $this -> input -> post("email");
			$verificado = $this -> input -> post("verificado");

			$this -> usuarios_model -> updatea_user($idu, $nombre, $apellidos, $login, $password, $direccion, $tlf, $email, $verificado);
			// Y recargamos los datos
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$datos["pisos_no"] = $this -> pisos_model -> mostar_pisos_no_validados();
			$this -> load -> view("doc/index", $datos);
		}
	}

	public function validar_piso() {
		// Funcion que valida un piso subido por un usuario IPA
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$idpiso = $this -> input -> get("id");
			$this -> pisos_model -> validar_piso($idpiso);


			// Envio de correo de validacion
			$idu = $this -> pisos_model -> devuelve_usuario_piso($idpiso);
			$datos_usuario = $this -> usuarios_model -> devuelve_datos_usuario_id($idu);

			foreach ($datos_usuario as $row) {
				$asunto = "Su inmueble en IPA UVa ha sido activado";
				$texto = "Hola,\r\nEl administrador de IPA ha activado su inmueble y ya puede ser consultado y encontrado en la lista de inmuebles por los usuarios de la Universidad de Valladolid. Recuerde que usted puede modificar y verlo entrando con su usuario IPA en ".base_url()." y pulsando sobre el menu 'mis pisos'.\r\nLe recordamos que es muy recomendable tener los datos de su inmueble actualizados para que las personas que buscan un alquiler sepan cuando ya esta alquilado o no.";
				$this -> mail_uva -> envia_mail($row->email, $asunto, $texto);
			}
			// Y recargamos los datos
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$datos["pisos_no"] = $this -> pisos_model -> mostar_pisos_no_validados();
			$this -> load -> view("doc/index", $datos);
		}
	}

	public function usuarios() {
		// Funcion para mostrar toda la parte de usuarios y tal y pascual
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			$datos["q"] = "";
			$buscar = $this -> input -> post("buscar");
			if ($buscar==1) {
				// Ha entrado a hacer una busqueda
				$datos["q"] = $this -> input -> post("q");
				$datos["resultados"] = $this -> usuarios_model -> buscar_usuario($datos["q"]);
			}
			$datos["usuarios_no"] = $this -> usuarios_model -> usuarios_no_activados();
			$this -> load -> view("doc/usuarios", $datos);
		}
	}

	public function addpiso() {
		// Funcion para añadir un piso como admin
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Pues le mandamos a la pagina de añadir pisos y punto redondo
			header ("Location: ".base_url()."index.php/pisos/showaddpiso1");
		}
	}

	public function estadisticas() {
		// Funcion para mostrar las estadisticas básicas
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {

			$fechainicio = $this -> input -> post("anoi")."-".$this -> input -> post("mesi")."-".$this -> input -> post("diai");
			$fechafin = $this -> input -> post("anof")."-".$this -> input -> post("mesf")."-".$this -> input -> post("diaf");

			if ($fechainicio=="--" || $fechainicio == NULL) {
				// Cogemos "ayer"
				$fechainicio = date("Y")."-".date("m")."-".(date("d")-1);
			}
			if ($fechafin=="--" || $fechafin == NULL) {
				// Cogemos "hoy"
				$fechafin = date("Y")."-".date("m")."-".date("d");
			}

			if (date("d")-1 <=0 ) {
				if (date("m")-1 <10) {
					$mes_tmp = "0".(date("m")-1);
					$ayer = date("Y")."-".$mes_tmp."-31";
				} else {
					$ayer = date("Y")."-".(date("m")-1)."-31";
				}
			} else {
				$ayer = date("Y")."-".date("m")."-".(date("d")-1);
			}
			$hoy = date("Y")."-".date("m")."-".date("d");

			$datos["ayer"] = $ayer;
			$datos["hoy"] = $hoy;

			log_message("DEBUG","ayer = ".$ayer." | hoy = ".$hoy);

			//$datos["totales_usuarios_hoy"] = $this -> estadisticas_model -> cantidad_usuarios($fechainicio, $fechafin);
			//$datos["totales_pisos_hoy"] = $this -> estadisticas_model -> cantidad_pisos($fechainicio, $fechafin);

			$datos["totales_usuarios_hoy"] = $this -> estadisticas_model -> cantidad_usuarios($ayer, $hoy);
			$datos["totales_pisos_hoy"] = $this -> estadisticas_model -> cantidad_pisos($ayer, $hoy);

			$datos["totales_usuarios_siempre"] = $this -> estadisticas_model -> cantidad_usuarios("0000-00-00", $hoy);
			$datos["totales_pisos_siempre"] = $this -> estadisticas_model -> cantidad_pisos("0000-00-00", $hoy);

			$datos["totales_pisos_uva_hoy"] = $this -> estadisticas_model -> cantidad_pisos_uva($ayer, $hoy);
			$datos["totales_pisos_uva_siempre"] = $this -> estadisticas_model -> cantidad_pisos_uva("0000-00-00", $hoy);

			$datos["totales_pisos_nouva_hoy"] = $this -> estadisticas_model -> cantidad_pisos_nouva($ayer, $hoy);
			$datos["totales_pisos_nouva_siempre"] = $this -> estadisticas_model -> cantidad_pisos_nouva("0000-00-00", $hoy);

			// Pisos por mes en el año actual totales
			for ($i=1; $i<=12; $i++) {
				$pisos_mes = $this -> estadisticas_model -> cantidad_pisos_mes($i, date("Y"));
				$datos["pisos_mes_actual"][] = array($i, $pisos_mes);
			}

			// Pisos por mes en el año actual totales uva
			for ($i=1; $i<=12; $i++) {
				$pisos_mes = $this -> estadisticas_model -> cantidad_pisos_mes_uva($i, date("Y"));
				$datos["pisos_mes_actual_uva"][] = array($i, $pisos_mes);
			}

			// Pisos por mes en el año actual totales nouva
			for ($i=1; $i<=12; $i++) {
				$pisos_mes = $this -> estadisticas_model -> cantidad_pisos_mes_nouva($i, date("Y"));
				$datos["pisos_mes_actual_nouva"][] = array($i, $pisos_mes);
			}

			// Pisos por mes en los meses de ayer a hoy
			// Primero sacamos el numero de meses de diferencia
			$meses_diferencia = 0;
			$anodiff = $this -> input -> post("anof") - $this -> input -> post("anoi");
			for ($aux = 0 ; $aux<=$anodiff; $aux++) {
				if ($aux == 0 && $this -> input -> post("anoi") != $this -> input -> post("anof")) {
					for ($aux2 = $this -> input -> post("mesi"); $aux2<12; $aux2++) {
						$meses_diferencia++;
					}
				} elseif($aux == 0 && $this -> input -> post("anoi") == $this -> input -> post("anof")) {
					for ($aux2 = $this -> input -> post("mesi"); $aux2<$this -> input -> post("mesf"); $aux2++) {
						$meses_diferencia++;
					}
				} elseif ($aux == $anodiff) {
					for ($aux2 = 1; $aux2<$this -> input -> post("mesf"); $aux2++) {
						$meses_diferencia++;
					}
				} else {
					for ($aux2 = 1; $aux2<12; $aux2++) {
						$meses_diferencia++;
					}
				}
			}
			/*for ($i= $this -> input -> post("mesi")) {
			}*/
			//log_message("DEBUG", "meses diferencia = ".$meses_diferencia);

			// Seguimos y buscamos dias y meses
			for ($aux = 0; $aux<=$mes_diferencia; $aux++) {
			}

			$this -> load -> view("doc/estadisticas", $datos);
		}
	}

	public function mostrar_pisos_usuario() {
		// Funcion que muestra los pisos de un profesor y se lo enviamos a las busquedas
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Cogemos el usuario
			$idabuscar = $this -> input -> get("idusuario");
			$datos["busqueda"] = $this -> pisos_model -> pisos_usuario($idabuscar);
			$datos["q"] = "";


			$this -> load -> view("doc/buscar", $datos);
		}
	}

	public function comentarios() {
		// Funcion que busca un comentario
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		// Cosas de sesiones y si es admin o no
		if ($this -> admin_model -> es_admin($usuario)>0) {
			// Cogemos el query si lo mete
			if ($this -> input -> post("q")) {
				$q = $this -> input -> post("q");
				$datos["q"] = $q;
				$datos["resultados"] = $this -> comentarios_model -> q_comentario($q);
				print_r($datos["resultados"]);
			} else {
				$datos["q"] = "";
				$datos["resultados"]=array();
			}

			// Buscamos los comentarios con SPAM
			$datos["denuncias"] = $this -> comentarios_model -> hay_denuncias();

			$this -> load -> view("doc/comentarios", $datos);
		}
	}

	public function cambiartipo() {
		// Funcion que cambia a un administrador de administrador a pollo temporalmente

		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		if ($this -> admin_model -> es_admin($usuario)>0) {

			$this -> sesiones_usuarios -> cambiar_tipo();
		}
		header("Location: ".base_url());
	}

	public function correomasivo() {
		// Funcion para mandar un correo masivo a todos o a un grupo de personas con un contenido determinado

		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		if ($this -> admin_model -> es_admin($usuario)>0) {

			// Vemos si ha escrito un algo, sino le enviamos a la pagina
			$datos["mensaje"] = "No se ha completado el paso 1.";
			$datos["paso"] = 1;
			$si_ha_enviado = $this -> input -> post("enviado");


			if ($si_ha_enviado == 1) {
				// Paso 1, seleccion de la gente
				$gente = $this -> input -> post("gente");
				$forma_de_buscar = $this -> input -> post("forma_buscar");
				$asunto_del_correo = $this -> input -> post("asunto");
				$texto_del_correo = $this -> input -> post("texto");
				$verificado = $this -> input -> post("verificado");

				if ($verificado<>1) {
					$verificado=0;
				}

				if ($forma_de_buscar == "1") {
					// Por correo
					$encontrada_gente = $this -> usuarios_model -> buscar_correo($gente, $verificado);
				} elseif ($forma_de_buscar == "2") {
					// Por nombre y demas
					$encontrada_gente = $this -> usuarios_model -> buscar_usuario($gente, $verificado);
				} elseif ($forma_de_buscar == "3") {
					// A cascoporro
					$encontrada_gente = $this -> usuarios_model -> enviar_a_todos($verificado);
				}
				$datos["gente"] = $encontrada_gente;
				$datos["paso"] = 2;
				$si_ha_enviado = 2;
			}


			if (($this -> input -> post("gente") && $si_ha_enviado == 2) || ($si_ha_enviado == 2 && $forma_de_buscar == "3")) {
				// Gente seleccionada envio de correos
				$problemas = "";

				//Comprobamos que se ha creado la variable para poder enviar el mail
				if (count($encontrada_gente)>0) {
					foreach ($encontrada_gente as $row) {
						// A enviar correos
						$fallo = 0;
						try {
							$fallo = 0;
							$this -> mail_uva -> envia_mail($row -> email, $asunto_del_correo, $texto_del_correo);
							//echo "ENNNi<br>";
						} catch (Exception $e) {
							$fallo = 1;
							$problemas = $problemas."<br />Problema encontrado -> ".$e -> getMessage();
						}
					}

					if ($fallo == 0) {
						$datos["mensaje"] = "<strong>Correos enviados con exito.</strong>";
					} elseif ($fallo == 1) {
						$datos["mensaje"] = "<strong>Ha ocurrido uno o varios problema:</strong>".$problemas;
					}
				} else {
					$datos["mensaje"] = "No se han encontrado usuarios que sigan la norma: ".$gente;
				}
			}

			$this -> load -> view("doc/correo", $datos);
		}

	}
}
?>
