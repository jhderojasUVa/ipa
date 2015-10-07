<? $this -> load -> helper("url"); ?>
<?
	$descripcion = $calle = $numero = $piso = $cp = $letra = $tlf = "";
	$libre = true;
	$idlocalidad = $idbarrio = 0;
	$extras = array();
	if (isset($datos_piso)) {
		foreach ($datos_piso as $paso) {
			$descripcion = $paso -> descripcion;
			if (strlen($paso -> extras)>0) {
				$extras = explode("|", $paso -> extras);
			}
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
<div id="contenido">
<form action="<?=base_url()?>index.php/pisos/addpiso2_fin" method="post">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
	<table align="center" width="750">
    	<tr>
        	<td><span class="paso">1. Descripcion</span> <span class="paso_estoy">2. Precio</span> <span class="paso">3. Imagenes</span></td>
            <td width="50">
            	<? if ($cant_precios_piso>0) { ?>
            	<input type="submit" name="enviar" value="continuar &raquo;" />
                <? } else {?>
                	<input type="submit" name="enviar" disabled value="continuar &raquo;" />
                <? } ?>
            </td>
        </tr>
    </table>
</form>
</div>
<form action="<?=base_url()?>index.php/pisos/addpiso2" method="post">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
<div id="producto_principal">
    <div id="contenido">
        <div id="producto_columna_calle">
        <h2>Precio</h2>
  		<p>A continuaci&oacute;n indique el precio y el porque del precio. Puede poner precio a diferentes habitaciones o poner un precio comun para todas o precio por el piso completo.</p>
        <p><strong>El precio es necesario hasta que no tenga un precio no podra continuar con el proceso</strong>.</p>
                <div id="trozo">
                    <p><strong>precio</strong></p>
                    <input type="number" name="precio" />
                </div>
                <div id="trozo">
                    <p><strong>referente a</strong></p>
                    <input type="text" name="descripcion" size="20" maxlength="50"placeholder="habitacion doble" />
                </div>
                <div id="trozo">
                    <p>&nbsp;</p>
                    <input type="submit" value="a&ntilde;adir" class="form_boton"/>
                </div>
        </div>
        <div id="clear"></div>
        <? if ($cant_precios_piso>0) { ?>
        <hr width="350" />
        <p>Precios anteriormente a&ntilde;adidos.</p>
        <table width="700" align="center">
        		<tr>
                	<th>precio</th>
                    <th>descripci&oacute;n</th>
                    <td></td>
                </tr>
        	<? foreach ($precios_piso as $row) { ?>
            	<tr>
                	<td width="90"><?=$row -> precio?> &euro;</td>
                    <td width="200"><?=$row -> descripcion?></td>
                    <td valign="middle"><a href="<?=base_url()?>index.php/pisos/borra_precio/?idpiso=<?=$idpiso?>&precio=<?=$row->precio?>&desc=<?=$row->descripcion?>&ok=1"><img src="<?=base_url()?>img/x.png" border="0" /></a></td>
                </tr>
			<? } ?>
        </table>
		<? } ?>
    </div>
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
