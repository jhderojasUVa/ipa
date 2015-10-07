<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa</title>
<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
<link rel="apple-touch-startup-image" href="img/web_ios.png" />
<link href="css/principal.css" rel="stylesheet" type="text/css" />
<link href="css/slideshow.css" rel="stylesheet" type="text/css" />
<link href="css/ajax.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<style>
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.jcarousel.js"></script>
<!--
<script type="text/javascript" src="<?=base_url()?>js/gps.js"></script>
-->
<script>
$(document).ready(function() {
	$("#mycarousel").jcarousel({
		scroll: 2,
		visible: 2,
		animation: 1400,
		auto: 8,
		wrap: "circular"
	});
	
	var busqueda = $("#q");
	busqueda.keyup(function(e) {
		var tecla = this.value;
		$.post("<?=base_url()?>index.php/ajax/ajax/buscador_ajax", {
				"q" : tecla
			},
			function(e) {
				if (e) {
					$("#busqueda_ajax").css("visibility", "visible");
					$("#busqueda_ajax").html(e);
				} else {
					$("#busqueda_ajax").css("visibility", "hidden");
				}
		});
	});
});

function cerrar_popup() {
	$("#busqueda_ajax").css("visibility", "hidden");
}
</script>
<link rel="alternate" type="application/rss+xml" title="RSS" href="feed://127.0.0.1">
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
                <? if ($_SESSION["fue_admin"]==true) { ?><span class="botones"><a href="<?=base_url()?>index.php/doc/cambiartipo">ADMIN</a></span><? } ?>
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
                    <input type="text" name="q" id="q" placeholder="buscar...." class="buscar" size="50" /><input type="submit" value="Buscar" />
                </form>
            </td>
        </tr>
    </table>
    <? if ($_SESSION["logeado"] == true) { ?>
    <div id="busqueda_ajax"></div>
    <? } ?>
</div>
<div id="contenido"> 
	<center><img src="<?=base_url()?>img/logo.png" alt="IPA - Información de Pisos en Alquiler" height="45" />&nbsp;&nbsp;&nbsp;<a href="#barrios"><img src="<?=base_url()?>/img/barrios_oferta.png" alt="barrios con oferta" border="0" height="35"/></a>&nbsp;<a href="<?=base_url()?>css/IPA.pdf" target="_blank"><img src="<?=base_url()?>/img/manual.png" alt="manual de la herramienta" border="0" height="35"/></a></center>
	<div id="slideshow_portada">
        <ul id="mycarousel" class="jcarousel-skin-tango">
        	<? if (count($pisos)==1) { ?><li><a href="#"><img src="<?=base_url()?>css/sin_piso.png" alt="no existen pisos" width="315" height="315" /></a></li><li><a href="#"><img src="<?=base_url()?>css/sin_piso.png" alt="no existen pisos" width="315" height="315" /></a></li><? } else { ?>
			<? foreach ($pisos as $row) { ?>
                	<li><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["id_piso"]?>"><img src="<?=base_url()?>img_pisos/<?=$row["imagen"]?>" alt="<?=$row["descripcion"]?>" width="315" /></a></li>
            <? } ?>
            <? } // fin del if ?>
        </ul>
    </div>
	
</div>
<div id="ciudades_principal">
	<div id="contenido">
    	<div id="ciudades_columna">
            <h2><a name="ciudades"></a>Ciudades</h2>
            <? if (count($ciudades)>0) {?>
            <? for ($i=0;$i<count($ciudades);$i++) { ?>
            	<li><a href="<?=base_url()?>index.php/principal/ciudades?id=<?=$ciudades[$i]["idlocalizacion"]?>"><?=$ciudades[$i]["localizacion"]?></a></li>
            <? } ?>
            <? } else { ?>
            	<li>No existen pisos aun</li>
            <? } ?>
        </div>
        <div id="ciudades_columna">
            <h2><a name="barrios"></a>Barrios con oferta</h2>
            <? if ($barrios==false) { ?>
            	<li>No existen pisos aun</li>
            <? } else { ?>
            <? for ($i=0;$i<count($barrios);$i++) { ?>
            	<li><a href="<?=base_url()?>index.php/principal/barrios?id=<?=$barrios[$i]["idbarrio"]?>"><?=$barrios[$i]["barrio"]?> (<?=$barrios[$i]["ciudad"]?>)</a></li>
			<? } ?>
            <? } // fin del if ?>
        </div>
        <div id="menu_vertical">
        	<li>
            	<h3><a href="<?=base_url()?>index.php/buscar/busquedas">Buscar</a></h3>
                <p>busque un piso</p>
            </li>
            <li>
            	<h3><a href="<?=base_url()?>index.php/principal/geo" onclick="gelocalizacion()">geolocalizate</a></h3>
                <p>busca pisos por cercania</p>
            </li>
            <li>
            	<h3>Se social</h3>
                <p>Buscanos en las redes sociales</p>
                <p><a href="http://www.twitter.com/asuntossociales"><img src="<?=base_url()?>img/twitter.png" width="20" border="0" /></a> <a href="http://www.facebook.com/pages/Universidad-de-Valladolid/187763507920209"><img src="<?=base_url()?>img/facebook.png" width="20" border="0" /></a> <a type="application/rss+xml" href="<?=base_url()?>index.php/principal/rss"><img src="<?=base_url()?>img/rss.png" width="20" border="0" /></p>
            </li>
            <li>
            	<h3><a href="<?=base_url()?>css/IPA.pdf" target="_blank">Manual</a></h3>
                <p>Manual de usuario en PDF</p>
            </li>
        </div>
    </div>
    <!-- iconos sociales -->
    <!--
        <table width="500" align="left">
        	<tr>
            	<td>
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=base_url()?>" data-via="universidaddeva" data-lang="es" data-size="normal">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</td>
			<td>
            	<div id="fb-root"></div>
				<script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
				<fb:like href="<?=base_url()?>" show_faces="true" width="450" send="true">
				</fb:like>
			</td>
            </tr>
        </table>
        -->
        <div id="clear"></div>
</div>
<div id="pie">
    <div id="contenido">
    	<table width="600" align="center">
        	<tr>
           	  <td width="20"><img src="img/logo_azul.jpg" alt="Universidad de Valladolid" align="middle" /></td>
                <td align="left">Universidad de Valladolid - <a href="http://www.uva.es">www.uva.es</a> | STIC - <a href="http://www.uva.es/stic">www.uva.es/stic</a> | <img src="img/mail.png" alt="mail" width="10" /> <a href="mailto:ipa.asuntos.sociales@uva.es">administrador</a> | &copy; 2011</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
