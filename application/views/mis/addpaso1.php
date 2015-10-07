<? $this -> load -> helper("url"); ?>
<?
	$calle = $numero = $piso = $cp = $letra = $tlf = "";
	$descripcion = "[Datos del inmueble]\r\n\r\n[Número habitaciones]\r\n\r\n[Plazas ofertadas]\r\n\r\n[Tipo de calefacción]\r\n\r\n[Comunidad incluida]\r\n\r\n[Mobiliario]\r\n\r\n[Otros]\r\n\r\n[Preguntar por]\r\nNombre y Apellidos\r\n\r\n[Email]\r\n";
	$libre = true;
	$idlocalidad = $idbarrio = 0;
	$extras = array();
	if (isset($datos_piso)) {
		foreach ($datos_piso as $paso) {
			$descripcion = $paso -> descripcion;
			$extras = explode("|", $paso -> extras);
			$calle = $paso -> calle;
			$numero = $paso -> numero;
			$piso = $paso -> piso;
			$letra = $paso -> letra;
			$cp = $paso -> cp;
			$idlocalidad = $paso -> idlocalizacion;
			$idbarrio = $paso -> idbarrio;
			$tlf = $paso -> tlf;
			$libre = $paso -> libre;
		}
	}
	
	if (!isset($edicion)) {
		// No lo tamos editando cansinos
		$edicion = 0;
	}
?>
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
/*
// Carrusel comentado

$(document).ready(function() {
	$("#mycarousel").jcarousel({
		//size: 2,
		scroll: 2,
		visible: 2,
		animation: 1400,
		auto: 8,
		wrap: "circular"
	});
})
*/;
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Debe de ser un correo.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe de ser un numero.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' debe de ser un numero entre '+min+' t '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
    } if (errors) alert('Se han encontrado los siguientes errores:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
<form action="<?=base_url()?>index.php/pisos/addpiso1" method="post" onsubmit="MM_validateForm('calle','','R','numero','','RisNum','piso','','R','letra','','R','cp','','RisNum','tlf','','RisNum');return document.MM_returnValue">
<input type="hidden" name="edicion" value="<?=$edicion?>" />
<? if ($edicion == 1) {?><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><? } ?>
<div id="contenido">
	<table align="center" width="750">
    	<tr>
        	<td><span class="paso_estoy">1. Descripcion</span> <span class="paso">2. Precio</span> <span class="paso">3. Imagenes</span></td>
            <td width="50"><input type="submit" name="enviar" value="continuar &raquo;" /></td>
        </tr>
    </table>
</div>
<div id="producto_principal">

	<div id="contenido">
    	<div id="producto_columna">
            <h2>Contenido</h2>
            <? 
			$bano=$tv=$cocina=$telf=$wifi=$compartido=$lavadora=$frigo=$cama=$vajilla=$horno=$secadora=0;
			if (sizeof($extras)>0) {
			foreach ($extras as $row) { 
				// La chapu, seguramente los input se pueden meter aqui dentro...
				switch ($row) {
					case "Cocina":
						$cocina=1;
						break;
					case "Frigo":
						$frigo=1;
						break;
					case "Lavadora":
						$lavadora=1;
						break;
					case "Cama":
						$cama=1;
						break;
					case "Vajilla":
						$vajilla=1;
						break;
					case "Horno":
						$horno=1;
						break;
					case "Secadora":
						$secadora=1;
						break;
					case "Bano":
						$bano=1;
						break;
					case "TV":
						$tv=1;
						break;
					case "Tlf":
						$telf=1;
						break;
					case "WIFI":
						$wifi=1;
						break;
					case "Compartido":
						$compartido=1;
						break;
				}
				
			} // Fin del foreach
			} // Fin del if
			?>
            <? if ($cocina == 1) { ?>
                <input type="checkbox" name="contenido[]" value="Cocina" checked="checked"/>&nbsp;Cocina<br />
            <? } else { ?>
                <input type="checkbox" name="contenido[]" value="Cocina" />&nbsp;Cocina<br />
            <? } ?>
            
			<? if ($frigo==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Frigo" checked="checked"/>&nbsp;Frigorifico<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Frigo"/>&nbsp;Frigorifico<br />
			<? } ?>
            
            <? if ($lavadora==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Lavadora" checked="checked"/>&nbsp;Lavadora<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Lavadora"/>&nbsp;Lavadora<br />
			<? } ?>
            
            <? if ($vajilla==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Vajilla" checked="checked"/>&nbsp;Vajilla<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Vajilla"/>&nbsp;Vajilla<br />
			<? } ?>
            
            <? if ($cama==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Cama" checked="checked"/>&nbsp;Ropa de cama y mesa<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Cama"/>&nbsp;Ropa de cama y mesa<br />
			<? } ?>
			
            <? if ($horno==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Horno" checked="checked"/>&nbsp;Horno, Microondas<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Horno"/>&nbsp;Horno, Microondas<br />
			<? } ?>
            
            <? if ($secadora==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Secadora" checked="checked"/>&nbsp;Secadora<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Secadora"/>&nbsp;Secadora<br />
			<? } ?>
            
			<? if ($bano==1) {
			?>
				<input type="checkbox" name="contenido[]" value="Bano" checked="checked"/>&nbsp;Baño<br />
			<? } else { ?>
				<input type="checkbox" name="contenido[]" value="Bano"/>&nbsp;Baño<br />
			<? } ?>
            
			<? if ($tv == 1) { ?>
                <input type="checkbox" name="contenido[]" value="TV" checked="checked"/>&nbsp;TV<br />
            <? } else { ?>
                <input type="checkbox" name="contenido[]" value="TV"/>&nbsp;TV<br />
            <? } ?>

			<? if ($telf == 1) { ?>
                <input type="checkbox" name="contenido[]" value="Tlf" checked="checked"/>&nbsp;Telefono<br />
            <? } else { ?>
                <input type="checkbox" name="contenido[]" value="Tlf" />&nbsp;Telefono<br />
            <? } ?>

			<? if ($wifi == 1) { ?>
                <input type="checkbox" name="contenido[]" value="WIFI" checked="checked"/>&nbsp;Internet<br />
            <? } else { ?>
                <input type="checkbox" name="contenido[]" value="WIFI"/>&nbsp;Internet<br />
            <? } ?>
            
			<? if ($compartido == 1) { ?>
                <input type="checkbox" name="contenido[]" value="Compartido" checked="checked"/>&nbsp;Compartido<br />
            <? } else { ?>
                <input type="checkbox" name="contenido[]" value="Compartido"/>&nbsp;Compartido<br />
            <? } ?>
            <div id="libre">
            <? if ($libre == true) { ?>
            	<input type="checkbox" name="libre" value="1" checked="checked" />&nbsp;Existen plazas libres
            <? } else { ?>
            	<input type="checkbox" name="libre" value="1" />&nbsp;Existen plazas libres
            <? } ?>
            </div>
        </div>
        <div id="producto_columna">
            <h2>Descripci&oacute;n</h2>
            <textarea cols="45" rows="13" name="descripcion"><?=$descripcion?></textarea>
        </div>
        <div id="producto_columna_calle">
            <div id="trozo">
            	<p>&nbsp;</p><img src="<?=base_url()?>img/53-house.png" width="20" />
            </div>
            <div id="trozo">
            	<p><strong>calle</strong></p><input name="calle" type="text" class="form_boton" id="calle" placeholder="Falsa" value="<?=$calle?>" size="20"/>,
            </div>
            <div id="trozo">
            	<p><strong>n&uacute;mero</strong></p><input name="numero" type="text" class="form_boton" id="numero" placeholder="22" value="<?=$numero?>" size="3" maxlength="3"/>
            </div>
            <div id="trozo">
            	<p><strong>piso *</strong></p><input name="piso" type="text" class="form_boton" id="piso" placeholder="2" value="<?=$piso?>" size="2" maxlength="2"/>
            </div>
            <div id="trozo">
            	<p><strong>letra</strong></p><input name="letra" type="text" id="letra" placeholder="A" value="<?=$letra?>" size="2"/>
            </div>
            <div id="trozo">
            	<p><strong>CP</strong></p><input name="cp" type="text" id="cp" placeholder="00000" value="<?=$cp?>" size="5" maxlength="5" />
            </div>
            <div id="trozo">
            	<p><strong>localidad</strong></p>
                <select name="localidad" class="form_boton">
                	<? foreach ($localidades as $row) { ?>
						<? if ($idlocalidad == $row -> idlocalizacion) { ?>
                        	<option value="<?=$row -> idlocalizacion?>" selected="selected"><?=$row -> localizacion?></option>
                        <? } else { ?>
                       		<option value="<?=$row -> idlocalizacion?>"><?=$row -> localizacion?></option>
                        <? } ?>
					<? } ?>
                </select>
            </div>
            <div id="clear"></div>
            <div id="trozo">
            	<p>&nbsp;</p>
                <img src="<?=base_url()?>img/telephone.png" width="15" alt="telefono" />
            </div>
            <div id="trozo">
            	<p><strong>telefono con prefijo</strong></p>
                <input name="tlf" type="text" id="tlf" placeholder="983423000" value="<?=$tlf?>" size="10" maxlength="9" />
            </div>
            <div id="trozo">
            	<p><strong>barrio</strong></p>
                <select name="barrio" class="form_boton">
                	<? foreach ($barrios as $row) { ?>
                    	<? if ($idbarrio == $row -> idbarrio) { ?>
                        	<option value="<?=$row -> idbarrio?>" selected="selected"><?=$row -> barrio?></option>
                        <? } else { ?>
                        	<option value="<?=$row -> idbarrio?>"><?=$row -> barrio?></option>
                        <? } ?>
                    <? } ?>
                </select>
            </div>
            <div id="clear"></div>
            <p>* Escriba en el piso <strong>B</strong> para un bajo y <strong>A</strong> para un ático.</p>
        </div>
    </div>
    <div id="clear"></div>
</form>
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
