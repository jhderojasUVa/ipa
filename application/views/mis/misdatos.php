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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/busquedas.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/comentarios.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/modal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/login.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.simplemodal.js"></script>
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
</head>

<body>
<div id="beta"></div>
<div id="menu_sup">
	<table align="center">
    	<tr>
        	<? if ($_SESSION["logeado"] == true) { ?>
            <td width="400">
            	<span class="botones"><img src="<?=base_url()?>img/home2.png" align="absbottom" width="20" alt="home" border="0"/><a href="<?=base_url()?>">&nbsp;Principal</a></span>
            	<span class="botones"><a href="<?=base_url()?>index.php/mis/mispisos">Mis pisos</a></span>
                <span class="botones"><a href="<?=base_url()?>index.php/mis/miscomentarios">Mis comentarios</a></span>            
                <? if ($_SESSION["uva"]==0) { ?><span class="botones"><a href="<?=base_url()?>index.php/principal/vermisdatos">Mis datos</a></span><? } ?>
                <span class="botones"><a href="<?=base_url()?>index.php/principal/logout">Salir</a></span>
            </td>
            </td>
            <? } else { ?>
            <td width="350">
            	Usuario <strong>no identificado</strong>&nbsp;
                <span class="botones"><img src="<?=base_url()?>img/home2.png" align="absbottom" width="20" alt="home" border="0"/><a href="<?=base_url()?>">&nbsp;Principal</a></span>
		<span class="botones"><a href="<?=base_url()?>index.php/principal/haz_login">Acceso</a></span>
            </td>
            <? } ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
            	 <form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
                    <input type="text" name="q" placeholder="buscar...." class="buscar" size="50" />&nbsp;<input type="submit" value="Buscar" />
                </form>
            </td>
        </tr>
    </table>
</div>
<div id="contenido">
	<!-- primero los pisos metidos en modo buscador -->
    <h2>Mis datos</h2>
    <p>A continuaci&oacute;n puede revisar sus datos de usuario IPA:</p>
    <form action="#" method="post" name="usuario" onsubmit="comprueba_form();return false" >
    <input type="hidden" name="change_user" value="1" />
    <table width="550" align="center" id="alta_usuario">
    	<tr>
        	<td width="150">Nombre</td>
            <td><input name="nombre" type="text" id="nombre" placeholder="nombre" max="20" size="20" maxlength="20" value="<?=$nombre?>"/></td>
        </tr>
        <tr>
        	<td>Apellidos</td>
            <td><input name="apellidos" type="text" id="apellidos" placeholder="apellidos" max="40" size="20" maxlength="40" value="<?=$apellidos?>"/></td>
        </tr>
        <tr>
        	<td>Usuario</td>
            <td><strong><?=$usuario?> (No se puede cambiar)</strong></td>
        </tr>
        <tr>
        	<td valign="top">Direcci&oacute;n</td>
            <td><textarea name="direccion" cols="16" rows="3" id="direccion"><?=$direccion?></textarea></td>
        </tr>
        <tr>
        	<td>Telefono de contacto</td>
            <td><input name="tel" type="text" id="tel" placeholder="983423000" max="20" size="20" maxlength="20" value="<?=$tlf?>"/></td>
        </tr>
        <tr>
        	<td>Email de contacto</td>
            <td><input type="text" max="100" name="email" id="email"  maxlength="100" size="20" value="<?=$email?>"/></td>
        </tr>
        <tr>
        	<td>DNI</td>
            <td><input tyoe="text" name="dni" id="dni" maxlenght="9" size="9" value="<?=$dni?>" /></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" value="modificar" disabled="disabled"/></td>
        </tr>
    </table>
	</form>
    <hr />
    <h2>Cambiar la contrase&ntilde;a</h2>
    <form action="<?=base_url()?>index.php/mis/misdatos_usuario" method="post" name="formpass" onsubmit="compruebapass();return false">
    <input type="hidden" name="change_pass" value="1" />
    <table align="center" width="550">
    	<tr>
        	<td width="150">Contraseña</td>
            <td><input name="password" type="password" id="password" max="20" size="20" maxlength="20" /></td>
        </tr>
        <tr>
        	<td>Repetir contraseña</td>
            <td><input name="password2" type="password" id="password2" max="20" size="20" maxlength="20" />&nbsp;&nbsp;<div id="contra"></div></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" value="cambar password" /></td>
        </tr>
    </table>
    </form>
</div>
<div id="ciudades_principal">
	<!-- luego el enlace para añadir un piso nuevo -->
	<div id="contenido">
    	<center>
    	<span class="boton"><a href="<?=base_url()?>index.php/pisos/showaddpiso1"><img src="<?=base_url()?>img/53-house.png" width="12" alt="añadir nuevo piso" /> A&ntilde;adir nuevo piso</a></span>
        </center>
    </div>
    <div id="clear"></div>
</div>
<div id="pie">
    <div id="contenido">
    	<table width="600" align="center">
        	<tr>
           	  <td width="20"><img src="<?=base_url()?>img/logo_azul.jpg" alt="Universidad de Valladolid" align="middle" /></td>
                <td align="left">Universidad de Valladolid - <a href="http://www.uva.es">www.uva.es</a> | STIC - <a href="http://www.uva.es/stic">www.uva.es/stic</a> | <img src="<?=base_url()?>img/mail.png" alt="mail" width="10" /> <a href="maito:ipa.asuntos.sociales@uva.es">administrador</a> | &copy; 2011</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
