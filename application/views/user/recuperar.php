<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa - Entrada usuarios</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/productos.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/login.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe de ser una direccion de correo electronico.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
    } if (errors) alert('Se ha encontrado el siguiente error:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
	<!-- entrada de usuario -->
    <center>
  <div id="caja_recuperar">
    	<h3>Recuperar datos de IPA</h3>
    	<p>Si usted dispone de cuenta en <a href="http://miportal.uva.es">Mi Portal UVa</a> pero <strong>no recuerda ni su nombre de usuario o contaseña</strong>, rellene la direcci&oacute;n de correo con la que se dio de alta y le enviaremos por correo los datos de su usuario y contraseña.</p>
        <center>
        <form action="<?=base_url()?>index.php/principal/recordar_password" method="post" onsubmit="MM_validateForm('email','','RisEmail');return document.MM_returnValue">
        <input type="hidden" name="ok" value="1" />
        <input type="email" name="email" id="email" size="50" placeholder="direccion@correo.com"/><br /><br />
        <input type="submit" value="recuperar datos" />
        </form>
      </center>
    </div>
    </center>
    <div id="clear"></div>
    </center>
    </div>
    <? if (strlen($bien)>0) { ?>
    	<center><div id="caja_recuperar_ok"><?=$bien?></div></center>
    <? } ?>
    <div id="clear"></div>
</div>
<div id="producto_principal">
	<div id="contenido">
    	<p>En caso de no recordar la direcci&oacute;n de correo con la que se dio de alta en el sistema, por favor, pongase en contacto con el <a href="mailto:ipa.asuntos.sociales@uva.es">Area de Asuntos Sociales de la Universidad de Valladolid</a>.</p>
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
