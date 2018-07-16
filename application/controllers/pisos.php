<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$path = "/servicios/samba/silos/silo1/aplicaciones/ebayuva/img_pisos";
//$path = "/httdocs/ipa/img_pisos";

class Pisos extends CI_Controller {


	public function __construct() {
		parent::__construct();

		// Carga de librerias y demas
		// Helpers
		$this -> load -> helper("url");
		$this -> load -> helper("file");

		// Modelos
		/*
		$this -> load -> model("barrios_model");
		$this -> load -> model("comentarios_model");
		$this -> load -> model("localizaciones_model");
		$this -> load -> model("pisos_model");
		$this -> load -> model("admin_model");
		$this -> load -> model("precios_model");
		*/

		// Librerias
		$this -> load -> library("sesiones_usuarios");
		$this -> load -> library("SSOUVa");
		$this -> load -> library("LDAP");
		$this -> load -> library("mail_uva");
		$this -> load -> library("upload");

		// Libreria para cambiar las imagenes
		$this -> load -> library("imagenes");
	}

	public function index() {
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function producto_piso($ws = null) {
		// Controlador / Funcion, como quieras llamarlo que saca la información de la base
		// de datos de un piso seleccionado (incluyendo las imagenes) y la planta en la pagina

		// Con esto comprobamos si esta logeado o no
		if ($this -> sesiones_usuarios -> esta_logeado() == true) {
			//if (isset($_COOKIE["isotrol_sso_cookie"])) {
			if ($this -> sesiones_usuarios -> es_uva() == true) {
				// Discriminamos si se ha logeado via SSO
				$datos["usuario"] = $this -> ssouva -> login();
			} else {
				// O si ha entrado por el sistema de autentificacion local
				$datos["usuario"] = $_SESSION["idu"];
			}
			$datos["logeado"] = true;
		} else {
			// O no esta autentificado
			header("location:".base_url()."index.php/principal/haz_login");
		}

		// Luego los datos que pasa por get, tampoco es grave ya que es solo de consulta
		$id_piso = $this -> input -> get("id");

		// Ahora si el tio es IPA que solo vea su piso
		if ($this -> sesiones_usuarios -> es_uva() == false) {
			$pisos_pollo = $this -> pisos_model -> show_pisos_pollo($datos["usuario"]);
			foreach ($pisos_pollo as $row) {
				if ($id_piso == $row -> id_piso) {
					// El piso el del pollo
					$datos["idpiso"] = $id_piso;
				}
			}
		} elseif ($this -> sesiones_usuarios -> es_uva() == true) {
			$datos["idpiso"] = $id_piso;
		}


		if (isset($datos["idpiso"])) {
			// Si ha ido todo correcto

			// Primero los datos "de texto"
			$datos["piso"] = $this -> pisos_model -> show_piso($datos["idpiso"]);

			// Los precios
			$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
			$datos["cant_precios_piso"] = count($datos["precios_piso"]);

			//$datos["barrio"] = $this -> barrios_model -> devuelve_barrio($id_piso);
			$datos["ciudad"] = $this -> localizaciones_model -> devuelve_ciudad($id_piso);

			// Luego las fotos
			$datos["imagenes"] = $this -> pisos_model -> show_imagenes_piso($id_piso);
			// Y finalmente los comentarios
			// Por cierto, los comentarios no tienen puntuaciones... por ahora
			$datos["comentarios"] = $this -> comentarios_model -> show_comentario_objeto($id_piso, $datos["usuario"]);

			// Y ahora mostrar la paginita

			if ($ws == "json") {
				// Cambiamos la cabecera a JSON de respuesta
				header('Content-Type: application/json');
				// Escupimos la respuesta
				echo json_encode($datos);
				log_message("debug", $datos);
			} else {
				$this -> load -> view("cabecera", $datos);
				$this -> load -> view("producto", $datos);
				$this -> load -> view("footer", $datos);
			}

		} else {

			if ($ws == "json") {
				// Cambiamos la cabecera a JSON de respuesta
				header('Content-Type: application/json');
				// Escupimos la respuesta
				log_message("debug", $datos);
				echo json_encode($datos);
			} else {
				// Sino a la pagina de error
				$this -> load -> view("cabecera", $datos);
				$this -> load -> view("error_permisos");
				$this -> load -> view("footer", $datos);
			}
		}
	}

	public function spam() {
		// Funcion que marca un comentario como spam
		// Funcion por AJAX AUN NO

		// Lo primero el SSO de la UVa... ¡siempre!
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		$id_spam = $this -> input -> get("idspam");

		// Metemos el spam en spam
		$this -> comentarios_model -> add_denuncia($id_spam, $usuario);

		// Creamos el correo a insertar
		$comentario = $this -> comentarios_model -> show_comentario($id_spam);
		$texto = "Ha sido denunciado un comentario con texto:\n\r";
		foreach ($comentario as $row) {
			$texto = $texto.$row -> comentario;
			$usuario_denunciado = $this -> ldap -> sacar_datos_ldap($row -> idusuario);
			$texto = $texto."\n\rRealizado por el usuario: ".$row -> idusuario." - ".$usuario_denunciado["nombre"];
		}

		$texto = $texto."\r\n\r\nEntre en su panel de administacion para realizar la accion necesaria.";
		$this -> mail_uva -> envia_mail("ipa.asuntos.sociales@uva.es ", "Nueva denuncia", $texto);

		// Luego los datos que pasa por get, tampoco es grave ya que es solo de consulta
		$id_piso = $this -> input -> get("id");
		$datos["idpiso"] = $id_piso;
		// Primero los datos "de texto"
		$datos["piso"] = $this -> pisos_model -> show_piso($id_piso);
		// Los precios
		$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
		$datos["cant_precios_piso"] = count($datos["precios_piso"]);

		//$datos["barrio"] = $this -> barrios_model -> devuelve_barrio($id_piso);
		$datos["ciudad"] = $this -> localizaciones_model -> devuelve_ciudad($id_piso);

		// Luego las fotos
		$datos["imagenes"] = $this -> pisos_model -> show_imagenes_piso($id_piso);
		// Y finalmente los comentarios
		// Por cierto, los comentarios no tienen puntuaciones... por ahora
		$datos["comentarios"] = $this -> comentarios_model -> show_comentario_objeto($id_piso, $usuario);

		// Y ahora mostrar la paginita
		$this -> load -> view("cabecera", $datos);
		$this -> load -> view("producto", $datos);
		$this -> load -> view("footer", $datos);
	}

	public function showaddpiso1() {
		// Funcion que mandare al peo para ver añadir un piso

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

		$datos["localidades"] = $this -> localizaciones_model -> show_localizaciones("nombre");
		//$datos["barrios"] = $this -> barrios_model -> show_barrios("sin preferencia");
		$datos["barrios"] = $this -> barrios_model -> show_barrios("nombre");

		$this -> load -> view("cabecera", $datos);
		$this -> load -> view("mis/addpaso1", $datos);
		$this -> load -> view("footer", $datos);
	}

	public function addpiso1() {
		// Funcion para añadir pisos
		// Recordemos que tiene dos partes, esta añadira los datos del piso, saca el ID y pasa al paso 2

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

		// Primero recogemos los datos
		if (count($this -> input -> post("contenido"))>1) {
			// Si ha elegido opciones
			$contenido = implode("|",$this -> input -> post("contenido"));
		} else {
			// Si no ha elegido ninguna
			$contenido = "";
		}
		$descripcion = $this -> input -> post("descripcion");

		$calle = $this -> input -> post("calle");
		$numero = $this -> input -> post("numero");
		$piso = $this -> input -> post("piso");
		$letra = $this -> input -> post("letra");
		$cp = $this -> input -> post("cp");

		$idbarrio = $this -> input -> post("barrio");

		$idlocalidad = $this -> input -> post("localidad");
		$tlf = $this -> input -> post("tlf");

		$libre = $this -> input -> post("libre");

		// Por si edita
		$edicion = $this -> input -> post("edicion");

		// Antes de subir el piso revisamos si esta, y en caso de estar le enviamos al que estaba para que toque las imagenes
		// que sino se nos llena la BD de mierda
		if ($edicion == 0) {
			if ($this -> pisos_model -> existe_piso($calle, $numero, $piso, $letra, $cp, $idlocalidad)!=0) {
				$datos["idpiso"] = $this -> pisos_model -> existe_piso($calle, $numero, $piso, $letra, $cp, $idlocalidad);
			} else {
				// Al añadir un piso usamos SESSION["uva"] para ponerlo como verificado o no (true o false)
				//$datos["idpiso"] = $this -> pisos_model -> add_piso_nobarrio($descripcion, $calle, $numero, $piso, $letra, $cp, $localidad, $contenido, $tlf, $libre);
				if ($datos["logeado"]==true){ // Comprobamos si no viene de la calle
					// Comentado que los de la UVa se autoverifiquen
					//$datos["idpiso"] = $this -> pisos_model -> add_piso($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalidad, $idbarrio, $contenido, $tlf, $libre, $datos["usuario"], $_SESSION["uva"]);
					// Ponemos el verificado a 0 siempre para que sea revisado
					$datos["idpiso"] = $this -> pisos_model -> add_piso($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalidad, $idbarrio, $contenido, $tlf, $libre, $datos["usuario"], 0);
				}
			}
		} elseif ($edicion == 1) {
			// Lo esta editando
			$idpiso = $this -> input -> post("idpiso");
			$datos["idpiso"] = $idpiso;
			if ($datos["logeado"]==true) { // Comprobamos si no viene de la calle
				$this -> pisos_model -> cambiar_piso ($idpiso, $descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalidad, $idbarrio, $contenido, $tlf, $libre);
			}
		}

		$datos["error"] = "";
		$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
		$datos["cant_precios_piso"] = count($datos["precios_piso"]);

		$this -> load -> view("cabecera", $datos);
		$this -> load -> view("mis/addpaso1_1", $datos);
		$this -> load -> view("footer", $datos);
	}

	public function addpiso2($ws = null) {
		// Funcion para añadir precios

		// Esto hay que migrarlo a AJAX si o si

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

		$idpiso = $this -> input -> post_get("idpiso");
		$precio = $this -> input -> post_get("precio");
		$descripcion = $this -> input -> post_get("descripcion");

		if ($precio<>0 && $descripcion!="") {
			$this -> precios_model -> add_precio($idpiso, $precio, $descripcion);
		} else {
			$datos["error"] = "El precio o la descripcion estan vacios";
		}

		$datos["idpiso"] = $idpiso;
		$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
		$datos["cant_precios_piso"] = $this -> precios_model -> cant_show_precios($datos["idpiso"]);

		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("mis/addpaso1_1", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

	public function borra_precio($ws = null) {
		// Funcion para borrar precios

		// Lo primero el SSO de la UVa... ¡siempre!
		//$usuario = $this -> ssouva -> login();
		//$datos["usuario"] = $usuario;

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

		$usuario = $datos["usuario"];

		$idpiso = $this -> input -> get("idpiso");
		$precio = $this -> input -> get("precio");
		$descripcion = $this -> input -> get("desc");

		// Comprobamos que es un admin o es el usuario al que le pertenece el piso
		if ($this -> pisos_model -> es_piso_usuario($usuario, $idpiso)==true || $this -> admin_model -> es_admin($usuario)>0) {
			// Si es el pollo o el admin, mostramos los datos
			$this -> precios_model -> del_precio($idpiso, $precio, $descripcion);
		}

		$datos["idpiso"] = $idpiso;
		$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
		$datos["cant_precios_piso"] = $this -> precios_model -> cant_show_precios($datos["idpiso"]);

		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("mis/addpaso1_1", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

	public function addpiso2_fin() {
		// Funcion para pasar al ultimo paso

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

		// Imprescindible
		$datos["idpiso"] = $this -> input -> post_get("idpiso");
		$datos["imagenes_piso"] = $this -> pisos_model -> show_imagenes_piso($datos["idpiso"]);
		$datos["hay_error"] = false;
		$datos["error"] = "";

		$this -> load -> view("cabecera", $datos);
		$this -> load -> view("mis/addpaso2", $datos);
		$this -> load -> view("footer", $datos);
	}

	public function addpiso3($ws = null) {
		// Funcion para añadir imagen a un piso dado

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

		// Primero cogemos el ID del piso
		$idpiso = $this -> input -> post_get("idpiso");
		$descripcion = $this -> input -> post_get("descripcion");
		$field_name = "upload";
		$ws = $this -> input -> post_get("ws");

		//$config["upload_path"] = $path;

		//log_message('debug', '===== path ='.$path);

		if (!$this -> upload -> do_upload($field_name)) {
			// Si falla mandamos por ajax el error y se lo mostramos al pollo
			$datos = array("error" => $this -> upload -> display_errors());
			$datos["hay_error"] = true;
			$datos["idpiso"] = $idpiso;
			//$datos["imagenes_piso"] = array();
			//$this -> load -> view("mis/addpaso2", $datos);
		} else {
			// Pillamos los datos de la subida
			$datos = array("upload_data" => $this -> upload -> data());
			$datos["hay_error"] = false;
			$datos["idpiso"] = $idpiso;

			// Cambiamos la imagen de tamaño
			/*
			***********************************************************************************************************************

			Hay que cambiar el path y poner el del application/config/upload.php

			***********************************************************************************************************************
			*/
			//$path = "/Volumes/320Gb/httpdocs/ebayuva2/img_pisos";
			//$path = "/servicios/samba/silos/silo1/aplicaciones/ebayuva/img_pisos";
			//$path = $this -> config -> item("upload_path");
			//$path = $this -> upload -> item("upload_path");
			//echo "-----".$path."-----";

			//$path = "/servicios/samba/silos/silo1/aplicaciones/ebayuva/img_pisos";
			$path = "/httdocs/ipa/img_pisos";

			/*
			***********************************************************************************************************************
			*/

			if ($this -> pisos_model -> cantidad_show_imagenes_piso($datos["idpiso"]) <= 5) {

				//$this -> imagenes -> load($path."/".$idpiso."/".$datos["upload_data"]["file_name"]);
				$this -> imagenes -> load($path."/".$datos["upload_data"]["file_name"]);
				$this -> imagenes -> resizeToWidth(800);
				if (!is_dir($path."/".$idpiso)) {
					// Creamos el directorio
					mkdir($path."/".$idpiso, 0777);
				}

				$this -> imagenes -> save($path."/".$idpiso."/".$datos["upload_data"]["file_name"]);
				unlink ($path."/".$datos["upload_data"]["file_name"]);

				// Metemos los datos en la bd
				$this -> pisos_model -> add_imagen_piso($datos["upload_data"]["file_name"], $descripcion, $idpiso);
				// Cargamos todas las imagenes para pasarlas
			}
		}
		$datos["imagenes_piso"] = $this -> pisos_model -> show_imagenes_piso($idpiso);

		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("mis/addpaso2", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

	public function del_img($ws = null) {
		// Esta funcion borra una imagen subida
		// Lo hacemos a traves de un formulario porque asi los pollos no ven que es una url e intentan inyectar algo que se me haya pasado

		$path = "/httdocs/ipa/img_pisos";

		// Lo primero el SSO de la UVa... ¡siempre!
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

		$usuario = $datos["usuario"];

		$idpiso = $this -> input -> post_get("idpiso");
		$imagen_borrar = $this -> input -> post("imagen_borrar");
		$ws = $this -> input -> post("ws");
		$descripcion_borrar = $this -> input -> post("descripcion_borrar");

		// Borramos la imagen
		if ($this -> pisos_model -> es_piso_usuario($usuario, $idpiso)==true || $this -> admin_model -> es_admin($usuario)>0) {
			// Si es el usuario le borramos la imagen (o el admin)
			// Primero de la base de datos
			$this -> pisos_model -> del_imagen_piso($imagen_borrar, $descripcion_borrar, $idpiso);
			// Luego del sistema de ficheros
			unlink($path."/".$idpiso."/".$imagen_borrar);
		}

		// Inyectamos los datos para mostrar la vista que sino queda fatal
		$datos["idpiso"] = $idpiso;
		$datos["hay_error"] = false;
		$datos["error"] = "";
		$datos["imagenes_piso"] = $this -> pisos_model -> show_imagenes_piso($idpiso);

		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("mis/addpaso2", $datos);
			$this -> load -> view("footer", $datos);
		}


	}

	public function cambiarorden($ws = null) {
		// Esta funcion sirve para mover el orden de las imagenes
		// Primero sacamos los datos
		// Hacemos un post_get para comernoslo entero
		$idpiso = $this -> input -> post_get("idpiso");
		$nuevo = $this -> input -> post_get("nuevo");
		$actual = $this -> input -> post_get("actual");
		$fichero = $this -> input -> post_get("imagen");
		$ws = $this -> input -> post_get("ws");

		$total_imagenes = $this -> pisos_model -> total_imagenes_piso($idpiso);

		if ($nuevo<=0 || $nuevo>$total_imagenes) {
			// Antes que la primera o despues que la ultima, no
		} else {
			// Lo coloca bien
			$this -> pisos_model -> cambia_orden_imagen($fichero, $actual, $nuevo, $idpiso);
		}

		// Inyectamos los datos para mostrar la vista que sino queda fatal
		$datos["idpiso"] = $idpiso;
		$datos["hay_error"] = false;
		$datos["error"] = "";
		$datos["imagenes_piso"] = $this -> pisos_model -> show_imagenes_piso($idpiso);

		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("mis/addpaso2", $datos);
			$this -> load -> view("footer", $datos);
		}

	}

	public function editpiso1() {
		// Funcion para editar el primer paso de los pisos cuando se pulsa el boton de retroceder
		if ($this -> input -> post("idpiso")) {
			$idpiso = $this -> input -> post("idpiso");
		} else {
			$idpiso = $this -> input -> get("idpiso");
		}

		//echo $config["upload_path"];

		// Lo primero el SSO de la UVa... ¡siempre!
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

		$usuario = $datos["usuario"];

		// Comprobamos que es un admin o es el usuario al que le pertenece el piso
		if ($this -> pisos_model -> es_piso_usuario($usuario, $idpiso)==true || $this -> admin_model -> es_admin($usuario)>0) {
			// Si es el pollo o el admin, mostramos los datos
			$datos["edicion"] = 1;
			$datos["datos_piso"] = $this -> pisos_model -> show_piso($idpiso);
			$datos["idpiso"] = $idpiso;
		}
			// Sino le saldra vacio, pero le saldra que narices (ademas vale para completar)
			$datos["localidades"] = $this -> localizaciones_model -> show_localizaciones("nombre");
			$datos["barrios"] = $this -> barrios_model -> show_barrios("sin preferencia");

		$this -> load -> view("cabecera", $datos);
		$this -> load -> view("mis/addpaso1", $datos);
		$this -> load -> view("footer", $datos);
	}

	public function comentarios($ws = null) {
		// Funcion que envia un comentario
		// Por ahora no esta en AJAX... pero mas adelante....
		// SSO SIEMPRE
		$usuario = $this -> ssouva -> login();
		$datos["usuario"] = $usuario;

		$comentario = $this -> input -> post("comentario");
		$id_piso = $this -> input -> post("idpiso");
		$idpiso = $id_piso; // Asi arreglamos esto temporalmente pero hay que unificarlo porque sino, es una verguencita
		// La puntuacion esta a 0 de forma temporal
		$puntuacion = 0;
		// Y metemos el comentario matarile rile rile
		$this -> comentarios_model -> add_comentario ($usuario, $comentario, $puntuacion, $id_piso);
		// Enviamos un correo al admin
		// Para ello sacamos los datos del pollo pera
		$datos_pollo = $this -> ldap -> sacar_datos_ldap($datos["usuario"]);

		$asunto = "IPA: Nuevo comentario";
		$texto = "Se ha recibido un nuevo comentario:\r\n\r\nUsuario: ".$datos_pollo["nombre"]." - ".$datos_pollo["mail"]."\r\nComentario: ".$comentario."\r\nURL del piso: http://ipa.uva.es/index.php/pisos/producto_piso/?id=".$idpiso."\r\n\r\nEntre en el administrador para realizar las acciones adecuadas.";
		$texto_comentario ="Su piso en la plataforma IPA ha recibido un comentario.\r\n\r\n";
		$this -> mail_uva -> envia_mail("ipa.asuntos.sociales@uva.es,jesusangel.hernandez@uva.es", $asunto, $texto);
		$this -> mail_uva -> envia_mail($datos_pollo["mail"],"Tu piso en IPA ha recibido un comentario",$texto_comentario);

		// Y ahora cargamos el piso
		// Primero los datos "de texto"
		$datos["idpiso"] = $idpiso;
		$datos["piso"] = $this -> pisos_model -> show_piso($id_piso);
		//$datos["barrio"] = $this -> barrios_model -> devuelve_barrio($id_piso);
		$datos["ciudad"] = $this -> localizaciones_model -> devuelve_ciudad($id_piso);

		// Luego las fotos
		$datos["imagenes"] = $this -> pisos_model -> show_imagenes_piso($id_piso);
		// Y finalmente los comentarios
		// Por cierto, los comentarios no tienen puntuaciones... por ahora
		$datos["comentarios"] = $this -> comentarios_model -> show_comentario_objeto($id_piso, $usuario);

		// Precio y demas zarandajas
		$datos["precios_piso"] = $this -> precios_model -> show_precios($datos["idpiso"]);
		$datos["cant_precios_piso"] = count($datos["precios_piso"]);

		// Y ahora mostrar la paginita
		if ($ws == "json") {
			header('Content-Type: application/json');
			// Escupimos la respuesta
			echo json_encode($datos);
		} else {
			$this -> load -> view("cabecera", $datos);
			$this -> load -> view("producto", $datos);
			$this -> load -> view("footer", $datos);
		}
	}

} // Fin de la clase
?>
