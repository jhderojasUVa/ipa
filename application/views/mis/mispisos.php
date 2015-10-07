<? $this -> load -> helper("url"); ?>
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
<script type="text/javascript" src="<?=base_url()?>js/jquery.jcarousel.js"></script>
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

function cambia_estado(idpiso) {
	$.post("<?=base_url()?>index.php/ajax/ajax/cambia_ocupacion", {
		id: idpiso
		},function (data){
			$("#cambia_estado_"+idpiso).html(data);
		});
}

function show_modal(direccion) {
	direccion=direccion+"+españa";
	$.modal("<iframe width=\"700\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;aq=&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp;&amp;output=embed\"></iframe><br /><p><a href=\"http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp\" style=\"color:#0000FF;text-align:left\"><font face=\"Arial\" size=\"2\">Ver mapa más grande</font></a></p>", {
		autoresize: false,
		close: true
	});
}

</script>
<style>
.verde {
	color: #35a02e;
}

.rojo {
	color: #a32e24;
}

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
    <h2>Mis pisos</h2>
   
    <? if (count($pisos_usuario)>0) { // Si tiene pisos ?>
    <table align="center" width="900" cellpadding="0" cellspacing="0" class="buscar">
    <? $aux=0 ?>
    <? foreach ($pisos_usuario as $row) { ?>
    	<tr>
        	<td width="65"><a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$row["idpiso"]?>"><img src="<?=base_url()?>img_pisos/<?=$row["imagen"]?>" width="60" alt="foto" class="foto"/></a></td>
            <td><a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$row["idpiso"]?>">
				<?
				if (strlen($row["descripcion"])>350) {
					echo str_replace("]",":",str_replace("[","",substr($row["descripcion"], 0, 250)))." [...]";
				} else {
					echo str_replace("]",":",str_replace("[","",$row["descripcion"]));
				}
				
				?></a>
                <p><span class="botones"><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>">Ver inmueble como un usuario UVa</a></span></p>
                <p>Estado: <? if ($row["verificado"] == true) { ?>
                <strong>Este piso se muestra en IPA</strong>
                <? } else { ?>
                <strong>A la espera de ser verificado por IPA</strong>
                <? } ?>
                </p>
                </td>
            <td width="180"><a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$row["idpiso"]?>"><?=$row["direccion"]?><br /><?=$row["poblacion"]?></a></td>
            <td width="140"><span class="extras_casa"><a href="#"><?=str_replace("|",", ", str_replace("Bano", "Baño", $row["extras"]))?></a></span></td>
            <td widh="20"><a href="#" onclick="show_modal('<?=str_replace(" ", "+", $row["direccion"])?>,+<?=$row["poblacion"]?>');"><img src="<?=base_url()?>css/gmaps.png" width="40" alt="direccion" border="0" class="boton" /></a></td>
            <td width="100" align="center">
            	<div id="cambia_estado_<?=$row["idpiso"]?>">
                	<? if ($row["libre"] == true) { ?>
                    	<a href="#" onclick="javascript:cambia_estado(<?=$row["idpiso"]?>)"><span class="verde">Libre</span></a>
                    <? } else {?>
                    	<a href="#" onclick="javascript:cambia_estado(<?=$row["idpiso"]?>)"><span class="rojo">Ocupado</span></a>
                    <? } ?>
                </div>
            </td>
        </tr>
    <? } ?>
    <? } else { // Si no tiene pisos ?>
    	<p>No tiene ningun piso a su nombre.</p>
    <? } ?>
    </table>
    <!-- not implemented yet, vamos que no esta
    <div id="botones_pasos">
    <center>
    	<span class="boton_pasos">anterior</span> <span class="boton_pasos"><a href="#"><strong>1</strong></a></span> <span class="boton_pasos"><a href="#">2</a></span> <span class="boton_pasos"><a href="#">3</a></span> <span class="boton_pasos"><a href="#">siguiente</a></span>
    </center>
    </div>
    -->
	
</div>
<div id="ciudades_principal">
	<!-- luego el enlace para añadir un piso nuevo -->
	<div id="contenido">
    	<center>
    	<span class="boton"><a href="<?=base_url()?>index.php/pisos/showaddpiso1"><img src="<?=base_url()?>img/53-house.png" width="12" alt="añadir nuevo piso" /> A&ntilde;adir nuevo piso</a></span>
        <br /><br /><br />
        <hr />
        <table width="800" align="center">
        	<tr>
            	<td width="250"><span class="boton">Ver inmueble como un usuario UVa</span></td>
                <td>Con este bot&oacute;n usted podr&aacute; ver el inmueble como lo ven los usuarios de la plataforma. As&iacute; podr&aacute; ajustarlo a sus intereses.</td>
            </tr>
            <tr>
            	<td>Estado: Este piso se muestra en IPA<br />Estado: A la espera de ser verificado por IPA</td>
                <td>El tip de estado le indicar&aacute; en que proceso se encuentra su inmueble dentro de la herramienta.<br /><strong>Este piso se muestra en IPA</strong> significa que cualquier usuario perteneciente a la Universidad de Valladolid que entre en la plataforma podr&aacute; ver su inmueble.<br /><strong>A la espera de ser verificado por IPA</strong> indica que su inmueble ha sido insertado en nuestra base de datos y esta a la espera de que un administrador revise los datos y confime que todo es correcto.</td>
            </tr>
        </table>
        </center>
        <p>Puede cambiar si el piso <strong>dispone de plazas o no</strong> sin tener que acceder al piso pulsando sobre <span class="verde">Libre</span> para ponerlo en <span class="ocupado">Ocupado</span> o viceversa.</p>
        <p>Recuerde que usted es el m&aacute;ximo responsable de los datos de su inmueble y de indicar cuando ha sido alquilado. Procure no tener datos erroneos o no actualizados ya que repercute en su propio inmueble.</p> 
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
