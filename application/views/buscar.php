<? $this -> load -> helper ("url"); ?>
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
<link href="<?=base_url()?>css/smoothness/jquery-ui-1.7.3.custom.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/flotante.js"></script>
<script>

$(function(){
	
	$("#precio").slider({
		range: true,
		min: 0,
		max: 800,
		<?
			if (strlen($rango)>0) {
			$minmax = explode("-",$rango);
		?>values: [<?=trim($minmax[0])?>, <?=trim($minmax[1])?>],<? } else { ?>
		values: [150, 500],
		<? } ?>
		step: 10,
		slide: function (event, ui) {
			$("#cantidad").val(+ ui.values[ 0 ] + " - " + ui.values[ 1 ]);
		}
	});
	$("#cantidad").val($("#precio").slider("values", 0) + " - " + $("#precio").slider("values", 1));
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
<div id="flotante"></div>
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
                <span class="botones"><a href="<?=base_url()?>index.php/principal/haz_login">Acesso</a></span>
            </td>
            <? } ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
            	 <form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
                    <input type="text" name="q" placeholder="buscar...." class="buscar" size="50" value="<?=$q?>" />&nbsp;<input type="submit" value="Buscar" />
                </form>
            </td>
        </tr>
    </table>
	
   
</div>
<div id="contenido">
	<h2>Resultado de la busqueda</h2>
    <? if ($buscar_pisos_numrows>0) { ?>
    <table align="center" width="800" cellpadding="0" cellspacing="0" class="buscar">
    <? $aux = 0 ?>
    <? foreach ($buscar_pisos as $row) {?>
		<? if ($aux==0) { ?>
    	<tr>
        <? } else { ?>
        <tr class="salteado">
        <? } ?>
        	
            	<? if ($row["libre"] == true) { ?>
                <td width="65" onmouseover="showdiv(event,'<span class=verde>Libre</span>');" onMouseOut="hiddenDiv()">
                <? } else { ?>
                <td width="65" class="ocupado" onmouseover="showdiv(event,'<span class=rojo>Ocupado</span>');" onMouseOut="hiddenDiv()">
                <? } ?>
            	<a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>"><img src="<?=base_url()?>img_pisos/<?=$row["imagen"]?>" width="60" alt="foto" class="foto"/></a>
            
            </td>
            <td>
            <? if ($_SESSION["logeado"] == true) { ?>
            <? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
				
                    <a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>"><?
                    if (strlen($row["descripcion"])>350) {
                        echo str_replace("]",":",str_replace("[","",substr($row["descripcion"], 0, 250)))." [...]";
                    } else {
                        echo str_replace("]",":",str_replace("[","",$row["descripcion"]));
                    }
                    
                    ?></a>
                <? } else { ?>
                    <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
                <? } ?>
            <?	} else { ?>
                    <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
            <?	} ?> 
            </td>
            <td width="180">
            	<? if ($_SESSION["logeado"] == true) { ?>
				<? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
                        <a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>"><?=$row["direccion"]?><br /><?=$row["poblacion"]?></a>
                    <? } else { ?>
                        <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
                    <? } ?>
                <?	} else { ?>
                        <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
                <?	} ?>
            </td>
            <td width="140">
            <? if ($_SESSION["logeado"] == true) { ?>
            <? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
                    <span class="extras_casa"><a href="#"><?=str_replace("|",", ", str_replace("Bano", "Baño", $row["extras"]))?></a></span></td>
                <? } else { ?>
                    <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
                <? } ?>
            <?	} else { ?>
                    <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
            <?	} ?>
            </td>
            <td widh="20">
            <? if ($_SESSION["logeado"] == true) { ?>
            <? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
                <a href="#" onclick="show_modal('<?=str_replace(" ", "+", $row["direccion"])?>,+<?=str_replace(" ", "+", $row["poblacion"])?>');"><img src="<?=base_url()?>css/gmaps.png" width="40" alt="direccion" border="0" class="boton" />
                </a>
                <? } ?>
            <?	} else { ?>
                    <p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
            <?	} ?>
            </td>
        </tr>
    <? } ?>
    </table>
    <? } else { // Si no se encuentra nada ?>
    <div id="resultados">
        <p>No se han encontrado resultados de su busqueda. Por favor, <strong>pruebe a refinar su busqueda</strong> con menos palabras o refine su busqueda con el menu inferior.</p>
        <li>Si ha escrito una frase compleja, pruebe a reducir el n&uacute;mero de terminos: "piso grande" &gt; "grande".</li>
        <li>No incorpore las particulas "calle", "avenida", "paseo" o sus abreviaturas.</li>
        <li>Busque por otro rango de precios.</li>
        <li>Deje el codigo postal vacio.</li>
    </div>
    <? } ?>
    <!--
    <div id="botones_pasos">
    <center>
    	<span class="boton_pasos">anterior</span> <span class="boton_pasos"><a href="#"><strong>1</strong></a></span> <span class="boton_pasos"><a href="#">2</a></span> <span class="boton_pasos"><a href="#">3</a></span> <span class="boton_pasos"><a href="#">siguiente</a></span>
    </center>
    </div>
    -->
    <div id="botones_pasos">
    	<center><?=$this -> pagination -> create_links();?></center>
    </div>
</div>
<div id="producto_principal">
	<div id="contenido">
    	<div id="refinador">
        	<form action="<?=base_url()?>index.php/buscar/refinar" method="post">
            <input type="hidden" name="q" value="<?=$q?>" />
            	<div id="trozo">
                	<p>Foto</p><br />
                    <select name="foto" disabled="disabled">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <!--
                <div id="trozo">
                	<p>Barrio</p>
                     <select name="barrio">
                        <option value="1">Delicias (Valladolid)</option>
                        <option value="2">La Oberuela (Valladolid)</option>
                        <option value="3">Rondilla (Valladolid)</option>
                        <option value="4">Belen (Valladolid)</option>
                        <option value="5">Centro (Palencia)</option>
                        <option value="6">El Carmen (Palencia)</option>
                        <option value="7">Las Casas (Soria)</option>
                        <option value="8">Los Pajaritos (Soria)</option>
                        <option value="9">San Lorenzo (Segovia)</option>
                        <option value="10">El Salvador (Segovia)</option>
                    </select>
                </div>
                -->
                <div id="trozo">
                	<p>CP</p><br />
                    <input name="cp" type="text" size="5" maxlength="5" value="<?=$cp?>"/>
                </div>
                <div id="trozo">
                	<p>Ciudad</p><br />
                    <select name="ciudad">
                    	<option value="0" selected="selected">Cualquiera</option>
                        <? foreach ($ciudades as $row) { ?>
                        	<? if ($loc == $row ->idlocalizacion) { ?>
                            <option value="<?=$row ->idlocalizacion?>" selected="selected"><?=$row -> localizacion?></option>
                            <? } else { ?>
                            <option value="<?=$row ->idlocalizacion?>"><?=$row -> localizacion?></option>
                            <? } ?>
                        	
                        <? } ?>
                    </select>
                </div>
                <div id="clear"></div>
                <div id="trozo">
                	<p>Precio: <input type="text" name="cantidad" id="cantidad" style="border:0; color:#f6931f; font-weight:bold; background: #d7d8d9;" value="<?=$rango?>" /></p>
                    <div id="precio"></div>
                </div>                
              	<div id="trozo_boton">
                	<br /><br /><br />
                	<right><input type="submit" value="Refinar busqueda" class="boton"/></right>
                </div>
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
                <td align="left">Universidad de Valladolid - <a href="http://www.uva.es">www.uva.es</a> | STIC - <a href="http://www.uva.es/stic">www.uva.es/stic</a> | <img src="<?=base_url()?>img/mail.png" alt="mail" width="10" /> <a href="maito://soporteweb@uva.es">administrador</a> | &copy; 2011</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
