<!-- THE OLD FASHION WAY -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa en <?=$calle?></title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/comentarios.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/slideshow.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />
<? if (strpos($_SERVER["HTTP_USER_AGENT"], "Chrome") !== false) {?>
<style>
/* Corrección del boton para Chrome */

@media screen and (-webkit-min-device-pixel-ratio:0) {
/* Reglas específicas para Safari 3.0 y Chrome aquí */

	#menu_sup form input[type="submit"] {
		float: right;
		margin-top: -33px;
		margin-left: 60px;
	}
}
</style>
<? } ?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.lightbox-0.5.js"></script>
<script>
$(document).ready(function() {
	//$("img[@rel*=lightbox]").lightBox();
	//$("#slideshow_portada>ul>li>img").lightBox();

	$("#mycarousel").jcarousel({
		//size: 2,
		scroll: 2,
		visible: 2,
		animation: 1400,
		auto: 8,
		wrap: "circular"
	});
	$("a[rel='lightbox']").lightBox({
		imageLoading: "<?=base_url()?>img/loading.gif",
		imageBtnClose: "<?=base_url()?>img/close.gif",
		imageBtnPrev: "<?=base_url()?>img/prev.gif",
		imageBtnNext: "<?=base_url()?>img/next.gif",
		txtImage: "Imagen",
		txtOf: "de"
	});
});

function show_modal(direccion) {
	$.modal("<iframe width=\"700\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;aq=&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp;&amp;output=embed\"></iframe><br /><p><a href=\"http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp\" style=\"color:#0000FF;text-align:left\" target=\"_blank\"><font face=\"Arial\" size=\"2\">Ver mapa más grande</font></a></p>", {
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
	<div id="slideshow_portada">
        <ul id="mycarousel" class="jcarousel-skin-tango">
        	<? if (count($imagenes)>0) { ?>
            	<? if (count($imagenes)<2) { ?>
                	<? foreach ($imagenes as $row) { ?>
                	<li><img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" width="315" alt="<?=$row -> descripcion?>" /></li>
                    <li><img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" width="315" alt="<?=$row -> descripcion?>" /></li>
                    <? } ?>
                <? } else { ?>
                	<? foreach ($imagenes as $row) { ?>
                    <li><a href="<?=base_url()?>img_pisos/<?=$row -> imagen?>" rel="lightbox"><img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" width="315" alt="<?=$row -> descripcion?>" /></a></li>
                    <? } ?>
                <? } ?>
            <? } else { ?>
            	<li><img src="<?=base_url()?>css/sin_piso.png" alt="el piso no tiene imagen" width="315" height="315" /></li>
                <li><img src="<?=base_url()?>css/sin_piso.png" alt="el piso no tiene imagen" width="315" height="315" /></li>
            <? } ?>
        </ul>
    </div>

</div>
<div id="producto_principal">
	<div id="contenido">
    	<div id="producto_columna">
            <h2>Contenido</h2>
            <? if ($_SESSION["logeado"] == true) { ?>
            	<? for ($i=0; $i<count($extras); $i++) { ?>
                <input type="checkbox" checked="checked" disabled="disabled" /><?
                if ($extras[$i]=="WIFI") {
					// Reemplazar WIFi por Internet
					echo "Internet";
				} elseif ($extras[$i]=="Bano") {
					// Poner BaÑo
					echo "Baño";
				} else {
					// Mostrar lo normal
					echo $extras[$i];
				}
				?><br />
                <? } ?>
            <? } else { ?>
            	<p>Solo los <a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a> pueden verlo.</p>
            <? } ?>
            <? if (count($precios_piso)>0) { ?>
            <h2>Precio</h2>
            <? if ($_SESSION["logeado"] == true) { ?>
            	<? foreach ($precios_piso as $row) { ?>
	            <strong><?=$row -> precio?> &euro;</strong> <?=$row -> descripcion?><br />
            <? } ?>
            <? } else { ?>
            	<p>Solo los <a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a> pueden verlo.</p>
            <? } ?>
            <? } // Fin de si hay precio o no ?>
            <div id="libre">
                <? if ($libre==true) { ?>
                	Existen plazas libres
                <? } else { ?>
	                No existen plazas libres
                <? } ?>
            </div>


            <h2>Direcci&oacute;n</h2>
            <? if ($_SESSION["logeado"] == true) { ?>
            	<p><?=$calle?>, <?=$numero?> <?
					if (strtoupper($piso)=="A") {
						echo "Atico ";
					} elseif (strtoupper($piso)=="0") {
						echo "Bajo ";
					} elseif (strtoupper($piso)=="B") {
						echo "Bajo ";;
					} else {
						echo $piso;
					}
				?><?=strtoupper($letra)?><br />
				<?=$cp?> (<?=$ciudad?>)</p>
                <p>Tlf <?=$telf?></p>
                <p><a href="#" onclick="show_modal('<?=str_replace(" ", "+", $calle)?>,+<?=$numero?>+<?=$cp?>+<?=$ciudad?>')"><img src="<?=base_url()?>img/gmaps_icon.png" width="50" border="0" alt="ver en Google Maps"></a></p>
            <? } else { ?>
            	<p>Solo los <a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a> pueden verlo.</p>
            <? } ?>
        </div>
        <div id="producto_columna">
            <h2>Descripci&oacute;n</h2>
            <? if ($_SESSION["logeado"] == true) { ?>
            	<p><?=str_replace("]","</h3>",str_replace("[","<h3>",$descripcion))?></p>
                <p><p>Tlf <?=$telf?></p>
                <br />
	            <p class="fecha_insercion"><span class="fecha_insercion">&Uacute;ltima modificaci&oacute;n <em><?=$dia?>/<?=$mes?>/<?=$ano?></em></span></p>
            <? } else { ?>
            	<p>Solo los <a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a> pueden verlo.</p>
            <? } ?>
        </div>
    </div>
    <div id="clear"></div>
    <div id="contenido">
    	<? foreach ($comentarios as $row) { ?>
        <div id="comentario">
            <div id="comentario_texto">
                <p><?=$row["comentario"]?></p>
            </div>
            <div id="comentario_pico"></div>
            <div id="comentario_autor">
            	<?=$row["nombre"]["nombre"]?> <? if ($row["spam"]==false) {?> <? if ($_SESSION["logeado"] == true && $_SESSION["uva"] == true) { // Solo la gente de la UVa logeada puede marcar los comentarios como SPAM?>| <a href="<?=base_url()?>index.php/pisos/spam?idspam=<?=$row["idcomentario"]?>&id=<?=$idpiso?>" class="spam">Informar de SPAM</a><? } ?><? } // fin del logeado?>
            </div>
        </div>
        <? } ?>
        <? if ($_SESSION["logeado"] == true && $_SESSION["uva"] == true) { // Si esta logeado y es de la UVa podra mandar comentarios, sino... pues no?>
        <br /><hr size="1"/>
        <table width="700" align="left">
        	<tr>
            	<td valign="top"><h3>Envia tu comentario</h3></td>
                <td>
                	<form action="<?=base_url()?>index.php/pisos/comentarios" method="post">
                    <input type="hidden" name="idpiso" value="<?=$idpiso?>" />
                    <textarea cols="50" name="comentario" rows="4"></textarea>
                    <p><input type="submit" class="botones" value="envia tu comentario" /></p>
                    <!-- <p><span class="botones">envia tu comentario</span></p> -->
                    </form>
                </td>
            </tr>
        </table>
        <? } ?>
        <br />
        <!-- iconos sociales -->
        <table width="500" align="left">
        	<tr>
            	<td>
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$idpiso?>" data-via="asuntossociales" data-lang="es" data-size="large">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</td>
			<td>
            	<div id="fb-root"></div>
				<script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
				<fb:like href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$idpiso?>" show_faces="true" width="450" send="true">
				</fb:like>
			</td>
            </tr>
        </table>
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
