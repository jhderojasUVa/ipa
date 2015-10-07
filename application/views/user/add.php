<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='UTF-8" />
<title>Información sobre pisos en alquiler UVa - Alta usuario</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<style>
#simplemodal-container {
	background-color: #ebebeb;
	border: 1px solid #9b9b9b;
	box-shadow: 0px 0px 5px #888;
	-moz-box-shadow: 0px 0px 5px #888;
	-webkit-box-shadow: 0px 0px 5px #888;
	padding: 5px;
}

#simplemodal-container a.modalCloseImg {
	background: url(<?=base_url()?>img/x.png) no-repeat; 
	width :25px; 
	height: 29px; 
	display: inline; 
	z-index: 3200; 
	position: absolute; 
	top: -15px; 
	right: -16px; 
	cursor: pointer;
}
</style>
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
</head>

<body>
<div id="beta"></div>
<div id="menu_sup">
	<table align="center">
    	<tr>
        	<td width="350">
            	Usuario <strong>no identificado</strong>&nbsp;
                <span class="botones"><img src="<?=base_url()?>img/home2.png" align="absbottom" width="20" alt="home" border="0"/><a href="<?=base_url()?>">&nbsp;Principal</a></span>
            </td>
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
	<!-- formulario de darse de alta -->
    <h2>Alta de nuevo usuario</h2>
    <!--
    <div id="errores">Alta temporalmente deshabilitada:<br />Las altas de usuario IPA han sido temporalmetne deshabilitadas. <strong>Disculpen las molestias</strong></div>
    -->
    <? if ($errores!="") { ?><div id="errores"><span class="rojo"><strong>¡Wops!, ha habido un problema con su solicitud</strong>:</span><p><?=$errores?></p></div><? } ?>
    <form action="<?=base_url()?>index.php/principal/alta_nueva" name="usuario" method="post" onsubmit="comprueba_form();return false;">
    <input type="hidden" name="ok" value="1" />
    <table width="550" align="center" id="alta_usuario">
    	<tr>
        	<td width="150">Nombre</td>
            <td><input name="nombre" type="text" id="nombre" placeholder="nombre" max="20" size="20" maxlength="20" value="<?=$datos_del_usuario["nombre"]?>"/></td>
        </tr>
        <tr>
        	<td>Apellidos</td>
            <td><input name="apellidos" type="text" id="apellidos" placeholder="apellidos" max="40" size="20" maxlength="40" value="<?=$datos_del_usuario["apellidos"]?>"/></td>
        </tr>
        <tr>
        	<td>Usuario</td>
            <td><input name="login" type="text" id="login" placeholder="login" max="20" size="20" maxlength="20" value="<?=$datos_del_usuario["login"]?>" />&nbsp;&nbsp;<div id="respuesta_user"><input type="button" value="comprobar" onclick="javascript:comprueba_usuario()"></div></td>
        </tr>
        <tr>
        	<td>Contraseña</td>
            <td><input name="password" type="password" id="password" max="20" size="20" maxlength="20" /></td>
        </tr>
        <tr>
        	<td>Repetir contraseña</td>
            <td><input name="password2" type="password" id="password2" max="20" size="20" maxlength="20" />&nbsp;&nbsp;<div id="contra"></div></td>
        </tr>
        <tr>
        	<td valign="top">Direcci&oacute;n del propietario/a<br />Direcci&oacute;n para contacto</td>
            <td><textarea name="direccion" cols="16" rows="3" id="direccion" placeholder="C/Falsa 12, 2A 47002 (Valladolid)"><?=$datos_del_usuario["direccion"]?></textarea></td>
        </tr>
        <tr>
        	<td>Telefono de contacto</td>
            <td><input name="tel" type="text" id="tel" placeholder="983423000" max="20" size="20" maxlength="20" value="<?=$datos_del_usuario["tlf"]?>"/></td>
        </tr>
        <tr>
        	<td>Email de contacto</td>
            <td><input type="text" max="100" name="email" id="email"  maxlength="100" size="20" value="<?=$datos_del_usuario["email"]?>"/></td>
        </tr>
        <tr>
        	<td>DNI</td>
            <td><input tyoe="text" name="dni" id="dni" maxlenght="9" size="9" placeholder="098765432F" value="<?=$datos_del_usuario["dni"]?>"/></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="checkbox" name="condiciones" value="1" />He leido <a href="<?=base_url()?>/NotaLegal.pdf" target="_blank">las condiciones de servicio</a> <span class="rojo">*</span></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" value="enviar" /></td>
        </tr>
    </table>
    <span class="rojo">Todos los campos son necesarios.</span><br />
    <span class="rojo">* Es necesario activar el checkbox de las condiciones de servicio.</span><br />
    </form>
</div>
<div id="producto_principal">
	<div id="contenido">
    	<h3>Atenci&oacute;n</h3>
    	<p>La validación de su usuario estara pendiente por los administradores de <a href="mailto:ipa.asuntos.sociales@uva.es">ipa.uva.es</a>. Cuando su usuario este aprobado recibira un correo de confirmación indic&aacute;ndoselo.</p>
        <p>De acuerdo con lo dispuesto en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, y el Reglamento 1720/2007, de 21 de diciembre, de desarrollo de la misma, se informa de que los datos personales que proporcionen los usuarios de este sitio Web quedarán archivados en un fichero automatizado de datos de carácter personal de titularidad de la Universidad de Valladolid.</p>
        <p>El usuario consiente expresamente en recibir información de nuestro Secretariado de Asuntos Sociales o informaciones relacionadas con el mismo. La aceptación del usuario para que puedan ser tratados sus datos en la forma establecida en este párrafo, tiene siempre carácter revocable, sin efectos retroactivos, conforme a lo que disponen los artículos 6 y 11 de la Ley Orgánica 15/1999 de 13 de Diciembre.</p>
        <p>Para darse de baja pongase en contacto con los <a href="mailto:ipa.asuntos.sociales@uva.es">Asuntos Sociales</a>.</p>
    </div>
    <div id="clear"></div>
</div>
<div id="pie">
    <div id="contenido">
    	<table width="600" align="center">
        	<tr>
           	  <td width="20"><img src="<?=base_url()?>img/logo_azul.jpg" alt="Universidad de Valladolid" align="middle" /></td>
                <td align="left">Universidad de Valladolid - <a href="http://www.uva.es">www.uva.es</a> | STIC - <a href="http://www.uva.es/stic">www.uva.es/stic</a> | <img src="<?=base_url()?>img/mail.png" alt="mail" width="10" /> <a href="mailto:ipa.asuntos.sociales@uva.es">administrador</a> | &copy; 2011</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
