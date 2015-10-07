<? $this -> load -> helper("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/comentarios.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/slideshow.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.jcarousel.js"></script>
<script>
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Dha de ser una direccion de correo electronico.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe de ser un numero.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' debe de ser un numero entre '+min+' y '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
    } if (errors) alert('Existe el siguiente error:\n'+errors);
    document.MM_returnValue = (errors == '');
} }

function finalizar() {
	alert("La operacion se ha realizado con exito.");
	window.location = "<?=base_url()?>";
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
                <span class="botones"><a href="<?=base_url()?>index.php/principal/haz_login">Autentificarse</a></span>
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
<form action="<?=base_url()?>index.php/pisos/editpiso1" method="post">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
<div id="contenido">
	<table align="center" width="750">
    	<tr>
        	<td><span class="paso">1. Descripcion</span> <span class="paso">2. Precio</span> <span class="paso_estoy">3. Imagenes</span></td>
            <td width="100"><input type="submit" value="&laquo; primer paso" name="ir_anterior" /></td>
            <td width="100"><input type="button" value="finalizar" onclick="finalizar()"/></td>
        </tr>
    </table>
</div>
</form>
<form action="<?=base_url()?>index.php/pisos/addpiso3" method="post" enctype="multipart/form-data" onsubmit="MM_validateForm('descripcion','','R');return document.MM_returnValue">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
<div id="producto_principal">
	<div id="contenido">
    
    <div id="producto_columna_calle">
    
    	<div id="trozo">
    	<p><strong>a&ntilde;ada una imagen</strong></p>
    		<div class="upload">
                <!-- <label for="realupload">Seleccione la imagen: </label> -->
                <div class="fakeupload">
                    <input type="text" name="fakeupload" /> <!-- el boton esta en el fondo -->
                </div>
                <input type="file" name="upload" id="realupload" class="realupload" onchange="this.form.fakeupload.value = this.value;" />
            </div>
            <br />
        </div>
        <div id="clear"></div>
        <div id="trozo">
        	<p><strong>descripci&oacute;n de la im&aacute;gen</strong></p>
            <input name="descripcion" type="text" id="descripcion" size="30" />
        </div>
        <div id="trozo">
        	<p>&nbsp;</p>
            <input type="submit" value="subir imagen y añadir otra" />
        </div>
        </form>
<div id="clear"></div>
<p>Para subir una imagen, <strong>pulse sobre el bot&oacute;n de <em>la cámara</em></strong> y seleccione la imagen de su ordenador, luego pulse sobre el bot&oacute;n <strong><em>subir imagen y a&ntilde;adir otra</em></strong> para completar la carga.</p>
<p><strong>Recomendado</strong>: las imagenes han de ser de 1024x768 a 72 puntos en formato <a href="http://es.wikipedia.org/wiki/Jpg" target="_blank">JPG</a>, <a href="http://es.wikipedia.org/wiki/Gif" target="_blank">GIF</a> o <a href="http://es.wikipedia.org/wiki/Portable_Network_Graphics" target="_blank">PNG</a>. <strong>Las imagenes se cambiaran de tamaño automaticamente a 1024x768</strong>.</p>
<p><strong>Atenci&oacute;n:</strong> solo se permite un maximo de 5 imagenes.</p>
        <? // Si hay error lo mostramos aqui ?>
        <? if ($hay_error == true) { ?>
        <div id="errores_formulario"><div class="error_fichero"><h3>¡Algo ha salido mal!</h3>Parece ser que hemos hecho algo mal.<?=$error?><br />Intentaremos solventarlo lo antes posible.</div></div>
        <? } ?>
        <div id="producto_columna_calle">
        <!-- imagenes subidas -->
        <? $temp=0 ?>
        <? foreach ($imagenes_piso as $row) {?>
        	<div id="trozo" class="final">
            	<img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" alt="<?=$row -> descripcion?>" width="130" class="imagenes" /><br /><center><em><p><?=$row -> descripcion?></p></em><br /></center>
                <div id="formularios_img">
	                <form action="<?=base_url()?>index.php/pisos/cambiarorden" method="post" class="imagenes"><input type="hidden" name="imagen" value="<?=$row -> imagen?>" /><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><input type="hidden" name="nuevo" value="<?=($row -> orden)-1?>" /><input type="hidden" name="actual" value="<?=$row->orden?>" /><input type="submit" value="&lt;" class="movimiento"/></form>
                    <form action="<?=base_url()?>index.php/pisos/cambiarorden" method="post" class="imagenes"><input type="hidden" name="imagen" value="<?=$row -> imagen?>" /><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><input type="hidden" name="nuevo" value="<?=($row -> orden)+1?>" /><input type="hidden" name="actual" value="<?=$row->orden?>" /><input type="submit" value="&gt;" class="movimiento"/></form>
                    <form action="<?=base_url()?>index.php/pisos/del_img" method="post" class="imagenes"><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><input type="hidden" name="imagen_borrar" value="<?=$row -> imagen?>" /><input type="hidden" name="descripcion_borrar" value="<?=$row -> descripcion?>" /><input type="submit" value="X" class="cerrar"/></form>
                    <div id="clear"></div>
                </div>
            </div>
            <?
				$temp++;
				if ($temp>=3) { 
					$temp=0;
					?>
                    
					<div id="clear"></div>
				<? }
			?>
		<? } ?>

        </div>
        <table width="500" align="center">
        	<tr>
            	<td width="60" align="left"><img src="<?=base_url()?>img/mover_manual.jpg" alt="cambiar el orden" /></td>
                <td>Cambie el orden de la visualización de las imagenes con estos controles</td>
            </tr>
            <tr>
            	<td align="left"><img src="<?=base_url()?>img/eliminar_manual.png" alt="eliminar una imagen" /></td>
                <td>Elimine la imagen subida con este bot&oacute;n</td>
            </tr>
        </table>
    </div>
    
    <div id="clear"></div>
    	<!--
        <p><center><img src="<?=base_url()?>img/orden.png" /><br />Use los controles para cambiar el orden en que se muestran las imagenes de su inmueble.</center></p>
		-->
	</div>

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
