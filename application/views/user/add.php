<? $this -> load -> helper ("url"); ?>
<script>
<?	if (strlen($bien)>0) { ?>
	alert('Su usuario ha sido añadido en el sistema.\n\r\n\rEn breve recibirá un correo con sus datos a la dirección proporcionada.\r\nCuando su usuario este aprobado recibirá otro correo con información más detallada.\r\n\r\n-------------------\r\nPor favor, compruebe su correo de spam en unos minutos si no ve el correo de ipa.asuntos.sociales@uva.es');
	location.href="<?=base_url()?>";
<? } ?>
$(document).ready(function() {

	$("#password2").keyup(function() {
		var pass1 = $("#password").val();
		var pass2 = $("#password2").val();

		if (pass1!=pass2) {
			$("#contra").html("<span class=\"rojo_ok\">no coinciden</span>");
		} else {
			$("#contra").html("<span class=\"verde_ok\">coinciden</span>");
		}
	})
});

function comprueba_usuario() {
	// Funcion para comprobar el usuario
	$.post("<?=base_url()?>index.php/ajax/ajax/comprueba_user", {
		usuario: $("input[name='login']").val()
	},
	function(data) {
		$("#respuesta_user").html(data);
	});
}

function comprueba_form() {
	// Funcion para comprobar el formulario
	//comprobar_clave();

	var hay_error = 0;
	var texto_err = "";

	if ($("input[name='nombre']").val()=="") {
		hay_error=1;
		texto_err="El nombre es necesario.\r\n";
	}

	if ($("input[name='apellidos']").val()=="") {
		hay_error=1;
		texto_err+="Los apellidos son necesarios.\r\n";
	}

	if ($("input[name='login']").val()=="") {
		hay_error=1;
		texto_err+="Es necesario un nombre de usuario.\r\n";
	}

	if ( $("input[name='login']").val().indexOf("@")>=0) {
		hay_error=1;
		texto_err+="El usuario no puede tener caracteres especiales.\r\n";
	}


	if ($("input[name='password']").val()=="" || $("input[name='password2']").val()=="") {
		hay_error=1;
		texto_err+="La contraseña no puede estar vacia.\r\n";
	}

	if ($("textarea[name='direccion']").val()=="") {
		hay_error=1;
		texto_err+="Es necesario una dirección postal.\r\n";
	}

	if ($("input[name='tel']").val()=="") {
		hay_error=1;
		texto_err+="Es necesario un telefono.\r\n";
	}

	if ($("input[name='email']").val()=="") {
		hay_error=1;
		texto_err+="Es necesario una dirección de correo electronico.\r\n";
	}

	if ($("input[name='dni']").val()=="") {
		hay_error=1;
		texto_err+="Es necesario un DNI.\r\n";
	}

	if ($("input[name='condiciones']").attr("checked")!="checked") {
		hay_error=1;
		texto_err+="\r\n------------------\r\nDebe de aceptar las condiciones del servicio para poder darse de alta\r\n------------------";
	}

	if (hay_error==1) {
		alert("Se encontraron los siguientes errores\r\n-------------\r\n"+texto_err);
		return false;
	} else {
		document.usuario.submit();
	}
}

function comprobar_clave() {
	clave1 = document.usuario.password.value;
	clave2 = document.usuario.password2.value;
	if (clave1!=clave2) {
		alert("Atencion:\n\rLas contraseñas no coinciden");
	}
}
</script>
<style>
label {
	text-align: left;
}
.rojo {
	border: none;
}
</style>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h2>Alta de nuevo usuario</h2>
			<p>Por favor, rellene el siguiente formulario para darse de alta en la plataforma IPA. Le recordamos que si es usted miembro de la comunidad universitaria (UVa) puede acceder sin darse de alta con sus contrase&ntilde;as de <a href="https://miportal.uva.es">Mi Portal UVa</a>.</p>
			<form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
				<div class="grid-x grid-padding-x">
					<div class="small-6 cell">
						<label>Nombre
							<input name="nombre" type="text" id="nombre" placeholder="nombre" max="20" maxlength="20" value="<?=$datos_del_usuario["nombre"]?>"/>
						</label>
					</div>
					<div class="small-6 cell">
						<label>Apellidos
							<input name="apellidos" type="text" id="apellidos" placeholder="apellidos" max="40" maxlength="40" value="<?=$datos_del_usuario["apellidos"]?>"/>
						</label>
					</div>
					<div class="small-12 cell">
						<label>Usuario
							<input name="login" type="text" id="login" placeholder="login" max="20" maxlength="20" value="<?=$datos_del_usuario["login"]?>" />
							<div id="respuesta_user"><input type="button" class="button" value="comprueba si esta ocupado" onclick="javascript:comprueba_usuario()"></div>
						</label>
					</div>
					<div class="small-12 cell">
						<label>Contrase&ntilde;a
							<input name="password" type="password" id="password" max="20" maxlength="20" />
						</label>
						<label>Repetir Contrase&ntilde;a
							<input name="password2" type="password" id="password2" max="20" maxlength="20" /><br/>
							<div id="contra"></div>
						</label>
					</div>
					<div class="small-12 cell">
						<label>Direcci&oacute;n del propietario/a<br />Direcci&oacute;n para contacto
							<textarea name="direccion" cols="16" rows="3" id="direccion" placeholder="C/Falsa 12, 2A 47002 (Valladolid)"><?=$datos_del_usuario["direccion"]?></textarea>
						</label>
					</div>
					<div class="small-6 cell">
						<label>Tel&eacute;fono de contacto
							<input name="tel" type="text" id="tel" placeholder="983423000" max="20" maxlength="20" value="<?=$datos_del_usuario["tlf"]?>"/>
						</label>
					</div>
					<div class="small-6 cell">
						<label>Email de contacto
							<input type="text" max="100" name="email" id="email"  maxlength="100" size="20" value="<?=$datos_del_usuario["email"]?>"/>
						</label>
					</div>
					<div class="small-6 cell">
						<label>DNI
							<input tyoe="text" name="dni" id="dni" maxlenght="9" size="9" placeholder="098765432F" value="<?=$datos_del_usuario["dni"]?>"/>
						</label>
					</div>
					<div class="small-12 cell">
						<input type="checkbox" name="condiciones" style="margin-right: 0.3em;" value="1" />He leido <a href="<?=base_url()?>/NotaLegal.pdf" target="_blank">las condiciones de servicio</a> <span class="rojo">*</span>
					</div>
					<div class="small-12 cell">
						<input type="submit" value="enviar" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<p>
				<span class="rojo">Todos los campos son necesarios.</span><br />
				<span class="rojo">* Es necesario activar el checkbox de las condiciones de servicio.</span><br />
			</p>
		</div>
	</div>
</div>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h3>Atenci&oacute;n</h3>
    	<p>La validación de su usuario estara pendiente por los administradores de <a href="mailto:ipa.asuntos.sociales@uva.es">ipa.uva.es</a>. Cuando su usuario este aprobado recibira un correo de confirmación indic&aacute;ndoselo.</p>
      <p>De acuerdo con lo dispuesto en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, y el Reglamento 1720/2007, de 21 de diciembre, de desarrollo de la misma, se informa de que los datos personales que proporcionen los usuarios de este sitio Web quedarán archivados en un fichero automatizado de datos de carácter personal de titularidad de la Universidad de Valladolid.</p>
      <p>El usuario consiente expresamente en recibir información de nuestro Secretariado de Asuntos Sociales o informaciones relacionadas con el mismo. La aceptación del usuario para que puedan ser tratados sus datos en la forma establecida en este párrafo, tiene siempre carácter revocable, sin efectos retroactivos, conforme a lo que disponen los artículos 6 y 11 de la Ley Orgánica 15/1999 de 13 de Diciembre.</p>
      <p>Para darse de baja pongase en contacto con los <a href="mailto:ipa.asuntos.sociales@uva.es">Asuntos Sociales</a>.</p>
		</div>
	</div>
</div>
