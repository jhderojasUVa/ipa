<? $this -> load -> helper("url"); ?>
<?
foreach ($datos_usuario as $row) {
	$usuario = $row -> usuario;
	$nombre = $row -> nombre;
	$apellidos = $row -> apellidos;
	$direccion = $row -> direccion;
	$tlf = $row -> tlf;
	$dni = $row -> dni;
	$email = $row -> email;
}

?>
<script>

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

function compruebapass() {
	clave1 = document.formpass.password.value;
	clave2 = document.formpass.password2.value;
	if (clave1!=clave2) {
		alert("Atencion:\n\rLas contraseñas no coinciden");
		return false;
	}
	document.formpass.submit();
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

	if ($("input[name='direccion']").val()=="") {
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

	if (hay_error==1) {
		alert("Se encontraron los siguientes errores\r\n-------------\r\n"+texto_err);
		return false;
	} else {
		document.usuario.submit();
	}
}

</script>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h2>Mis datos</h2>
			<p>A continuaci&oacute;n puede revisar sus datos de usuario IPA:</p>
			<form action="#" method="post" name="usuario" onsubmit="comprueba_form();return false;" >
	    	<input type="hidden" name="change_user" value="1" />
				<!-- nombre -->
				<div class="row">
					<div class="large-12 columns">
						<label>Nombre
							<input name="nombre" type="text" id="nombre" placeholder="nombre" max="20" maxlength="20" value="<?=$nombre?>"/>
						</label>
					</div>
				</div>
				<!-- apellidos -->
				<div class="row">
					<div class="large-12 columns">
						<label>Apellidos
							<input name="apellidos" type="text" id="apellidos" placeholder="apellidos" max="40" maxlength="40" value="<?=$apellidos?>"/>
						</label>
					</div>
				</div>
				<!-- apellidos -->
				<div class="row">
					<div class="large-12 columns">
						<label>Usuario
							<input name="apellidos" type="text" id="login" disabled laceholder="login" max="40" maxlength="40" value="<?=$usuario?>"/>
						</label>
					</div>
				</div>
				<!-- direccion -->
				<div class="row">
					<div class="large-12 columns">
						<label>Direccion
							<textarea name="direccion" cols="16" rows="3" id="direccion"><?=$direccion?></textarea>
						</label>
					</div>
				</div>
				<!-- dni -->
				<div class="row">
					<div class="large-12 columns">
						<label>DNI
							<input type="text" name="dni" id="dni" maxlenght="9" size="9" value="<?=$dni?>" />
						</label>
					</div>
				</div>
				<!-- telefono -->
				<div class="row">
					<div class="large-12 columns">
						<label>Telefono de contacto
							<input name="tel" type="text" id="tel" placeholder="983423000" max="20" size="20" maxlength="20" value="<?=$tlf?>"/>
						</label>
					</div>
				</div>
				<!-- email -->
				<div class="row">
					<div class="large-12 columns">
						<label>Email de contacto
							<input type="text" max="100" name="email" id="email"  maxlength="100" size="20" value="<?=$email?>"/>
						</label>
					</div>
				</div>
				<!-- submit -->
				<div class="row">
					<div class="large-12 columns">
						<center><input class="button" type="submit" value="Modificar los datos" disabled="disabled"/></center>
					</div>
				</div>
			</form> <!-- fin del form -->
	</div>
</div>

<!-- password -->
<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h2>Contrase&ntilde;a</h2>
			<p>Si no quiere cambiar la contraseña no modifique esta opción</p>
			<form action="<?=base_url()?>index.php/mis/misdatos_usuario" method="post" name="formpass" onsubmit="compruebapass();return false">
	    	<input type="hidden" name="change_pass" value="1" />
				<div class="row">
					<div class="large-12 columns">
						<label>Contrase&ntilde;a
							<input name="password" type="password" id="password" max="20" size="20" maxlength="20" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Repita la contrase&ntilde;a
							<input name="password2" type="password" id="password" max="20" size="20" maxlength="20" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<center><input class="button" type="submit" value="Cambiar la contrase&ntilde;a" /></center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</div>
