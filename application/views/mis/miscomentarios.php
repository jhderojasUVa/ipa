<? $this -> load -> helper("url"); ?>
<? $this -> load -> database(); ?>



<!-- OLD FASHION WAY -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/busquedas.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/comentarios.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/miscomentarios.css" rel="stylesheet" type="text/css" />
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
<script>
function abrir_gmaps(url) {
	// http://maps.google.com/maps?q=Calle+del+Pel%C3%ADcano,+33,+Valladolid,+Espa%C3%B1a&hl=es&ie=UTF8&sll=37.0625,-95.677068&sspn=51.355924,88.681641&vpsrc=0&hnear=Calle+del+Pel%C3%ADcano,+33,+47012+Valladolid,+Castilla+y+Le%C3%B3n,+Espa%C3%B1a&t=h&z=16
	$.modal("<iframe src='http://maps.google.com/maps?q="+url+"' frameborder='0' width='750' height='550' scrolling='auto'></iframe>", {
		close: true,
		escClose: true,
		onClose: function() {
			window.location.reload(true);
		}
	});
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
	<? if (count($mis_comentarios)>0) { // Si hay comentarios?>
    <table align="center" width="800" cellpadding="0" cellspacing="0" class="buscar">
    <? $aux = 0;?>
	<? foreach ($mis_comentarios as $row) { ?>
    <?
    // Datos del comentario
    $piso = $this -> pisos_model -> cantidad_show_imagenes_piso($row ->idobjeto);

    if ($piso>0) {
		$imagen_piso = $this -> pisos_model -> show_imagenes_piso($row ->idobjeto);
        foreach ($imagen_piso as $row2) {
            $imagen = $row2 -> imagen;
        }
    } else {
        $imagen = "sin_piso.png";
    }
	if ($aux == 0) {
		?><tr><?
		$aux ++;
	} else {
		?> <tr class="salteado"><?
		$aux = 0;
	}
    ?>
        	<td width="165" valign="top"><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row->idobjeto?>"><img src="<?=base_url()?>img_pisos/<?=$imagen?>" width="160" alt="foto" class="foto"/></a></td>
            <td>
            	<div id="comentario">
                    <div id="comentario_texto">
                        <p><?=$row -> comentario?>.</p>
                    </div>
                    <div id="comentario_pico"></div>
                    <div id="comentario_autor">
                        <?=$row -> idusuario?> - <?=$datos_yo["nombre"]?>
                    </div>
                </div>
                <!--
                <div id="nuevoscomentarios">
                	<a href="#">Existen nuevos comentarios</a>
                </div>
                -->
            </td>
        </tr>
    <? } ?>
    </table>
    <? } else { // Si no hay comentarios ?>
    	<h2>No hay comentarios</h2>
    	<p>No existen comentarios. Usted no ha realizado ningun comentario a ninguno de los inmuebles.</p>
	<? } ?>
    <!--
    not implemented, no hecho
    <div id="botones_pasos">
    <center>
    	<span class="boton_pasos">anterior</span> <span class="boton_pasos"><a href="#"><strong>1</strong></a></span> <span class="boton_pasos"><a href="#">2</a></span> <span class="boton_pasos"><a href="#">3</a></span> <span class="boton_pasos"><a href="#">siguiente</a></span>
    </center>
    </div>
    -->
</div>
<div id="producto_principal">
	<div id="contenido">
    	<div id="refinador">
        	<form action="<?=base_url()?>index.php/mis/buscar" method="post">
            <table width="400" align="center">
            	<tr>
                	<td colspan="2"><strong>buscar en los comentarios</strong></td>
                </tr>
                <tr>
                	<td><input type="text" name="q" size="40" value="<?=$q?>"/></td>
                    <td><input type="submit" value="Refinar busqueda" class="boton"/></td>
                </tr>
            </table>
            </form>
            <div id="clear"></div>
        </div>
        <div id="clear"></div>

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
