<? $this -> load -> helper("url"); ?>
<? $fallo = $this -> input -> get("userpass") ?>
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
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="../js/jquery.jcarousel.js"></script>
<script>
$(document).ready(function() {
	$("#mycarousel").jcarousel({
		//size: 2,
		scroll: 2,
		visible: 2,
		animation: 1400,
		auto: 8,
		wrap: "circular"
	});
});

function show_modal(direccion) {
	direccion=direccion+"+españa";
	$.modal("<iframe width=\"700\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;aq=&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp;&amp;output=embed\"></iframe><br /><p><a href=\"http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp\" style=\"color:#0000FF;text-align:left\"><font face=\"Arial\" size=\"2\">Ver mapa más grande</font></a></p>", {
		autoresize: false,
		close: true
	});
}
</script>
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
    <? if (isset($fallo) && $fallo==1) { ?>
    <h2>Error Usuario/Contrase&ntilde;a incorrecto</h2>
	<p><strong>Usuario o contrase&ntilde;a incorrectos</strong>.</p>
    <p>Ha intentado ingresar con un usuario/contrase&ntilde;a incorrectos. Pulse <a class="error" href="<?=base_url()?>index.php/principal/haz_login">aqu&iacute; para volver a intentarlo</a>.</p>
    <ul>
    	<li>Compruebe que ha escrito bien tanto el usuario como la contrase&ntilde;a</li>
        <li>Revise que no tiene pulsado el <a href="http://es.wikipedia.org/wiki/Bloq_may%C3%BAs">bloqueo de mayusculas</a></li>
        <li>Recuerde que distingue entre mayusculas y minusculas</li>
    </ul>
    <p>Si usted piensa que essto es debido a un error, pongase en contacto con el <a href="mailto:asuntos.sociales@uva.es?subject=Problemas%20de%20entrada%20usuario">Secretariado de Asuntos Sociales</a> de la Universidad de Valladolid.</p>
	<? } else {?>
    <h2>Error de permisos</h2>
    <p><strong>Usted no tiene permisos para realizar esta acción</strong>.</p>
    <p>Esta intentando acceder a una página a la que no tiene permisos, esto puede suceder porque:</p>
    <ul>
    	<li>Ha intentado ingresar con un usuario/contrase&ntilde;a incorrectos. Pulse <a class="error" href="<?=base_url()?>index.php/principal/haz_login">aqu&iacute; para volver a intentarlo</a>.</li>
    	<li>Esta intentando realizar una busqueda sin estar identificado</li>
        <li>Es un usuario IPA y esta intentando acceder a un inmueble que no es de su propiedad</li>
        <li>Esta intentando acceder a los datos de un inmueble sin identificarse</li>
        <li>Esta intentando modificar los datos de un inmueble que no le corresponde</li>
	</ul>
    <? } ?>
</div>
<div id="ciudades_principal">
	<!-- luego el enlace para añadir un piso nuevo -->
	<div id="contenido">
    	<center><p><a href="<?=base_url()?>">Volver a la página principal de IPA</a> | <a href="<?=base_url()?>index.php/principal/haz_login">Autentificarse</a></p></center>
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
