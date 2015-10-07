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
    <div id="caja_login">
    	<h3>CONSULTAR LAS OFERTAS EXISTENTES</h3>
    	<h3>Entrada a traves de Mi Portal UVa</h3><br />
    	<p>Si usted dispone de cuenta en <a href="http://miportal.uva.es">Mi Portal UVa</a>.</p>
        <p>Destinado a <strong>estudiantes</strong>, <strong>PDI</strong> y <strong>PAS</strong> de la Universidad de Valladolid.</p>
        <center>
        <form action="<?=base_url()?>index.php/principal/login" method="post">
        <input type="hidden" name="uva" value="1" />
        <input type="submit" value="pulse aqu&iacute;" />
        </form>
        </center>
        <p>Los miembros de la comunidad Universitaria tambien pueden ofertar sus inmuebles entrando a traves de este botón.</p>
    </div>
    <div id="caja_login">
    	<h3>INCLUIR/GESTIONAR OFERTA</h3>
    	<h3>Entrada a traves de IPA</h3><br />
        <p>Si <strong>no perteneces a la UVa y quieres ofertar tu inmueble</strong>, entra a traves de este formulario.</p>
        <form action="<?=base_url()?>index.php/principal/login" method="post">
        <input type="hidden" name="uva" value="0" />
        	<table align="center" width="350">
            	<tr>
                	<td>usuario</td>
                    <td><input type="text" name="login" placeholder="usuario" maxlength="20" /></td>
                </tr>
                <tr>
                	<td>contrase&ntilde;a</td>
                    <td><input type="password" name="password" placeholder="password" maxlength="20" /></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td><input type="submit" value="entrar" /></td>
                </tr>
            </table>
        </form>
      	<p>Si no recuerda su usuario <a href="<?=base_url()?>index.php/principal/recordar_password">pulse aqu&iacute;</a>.</p>
        <p>Si no dispone de usuario o contrase&ntilde;a puede darse de alta <a href="<?=base_url()?>index.php/principal/alta_nueva">pulsando aqu&iacute;</a>.</p>
    </div>
    <div id="clear"></div>
    <br />
    <div style="width: 590px;
	border: 1px solid #763a3c;
	padding: 15px;
	margin-right: auto;
	margin-left: auto;
	background-color: #f4dada;
	color: #6a0c0a;
	-moz-box-shadow: inset 0 0 10px -3px #000;
-webkit-box-shadow: inset 0 0 10px -3px #000;
box-shadow: inset 0 0 10px -3px #000;">
    <center><h1>Atenci&oacute;n</h1><p>Para los alumnos de nueva matriculaci&oacute;n deberan entrar por <strong>Mi Portal UVa</strong> para poder consultar la oferta de pisos. Los <strong>usuarios IPA</strong> no pueden ver las ofertas de pisos.</p></center>
   </div> 
</div>
<div id="producto_principal">
	<div id="contenido">
    	<p><strong>Deberá estar identificado para poder ver los inmuebles</strong>: Solo los usuarios identificados (IPA o UVa) pueden ver los inmuebles. Los usuarios IPA solo podr&aacute;n ver su propio inmueble.</p>
    	<p>Acceda a IPA (<em>Información de Pisos en Alquiler</em>) ya sea miembro de la comunidad universitaria perteneciente a la <a href="http://www.uva.es" target="_blank">UVa</a> o no. Para ello utilice el formulario necesario (izquierda para usuarios IPA o derecha para usuario UVa).</p>
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
