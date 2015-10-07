<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administracion</title>
<link href="<?=base_url()?>css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="menu_sup">
	<p>Usuario <strong><?=$usuario?></strong> | <a href="<?=base_url()?>index.php/principal/logout">Salir</a> | <a href="<?=base_url()?>">Principal</a> | <a href="<?=base_url()?>index.php/doc/comentarios">Comentarios</a> | <a href="<?=base_url()?>index.php/doc/usuarios">Usuarios</a> | <a href="<?=base_url()?>index.php/doc/estadisticas">Estadisticas</a> | <a href="<?=base_url()?>index.php/doc/buscar">Buscar</a> | <a href="<?=base_url()?>index.php/doc/correomasivo">Correos Masivos</a> | <a href="<?=base_url()?>index.php/doc/cambiartipo">Cambiar tipo</a></p>
</div>
<div id="contenido">
<center>Este proceso consta de 2 pasos :</center>
<h2>Paso 1: Componer correo</h2>
<form action="<?=base_url()?>index.php/doc/correomasivo" method="post">
<input type="hidden" name="enviado" value="1" />
<table align="center" width="800">
	<tr>
    	<td>Asunto</td>
        <td align="left"><input type="text" size="40" name="asunto" /></td>
    </tr>
    <tr>
    	<td>Texto del correo</td>
        <td align="left"><textarea name="texto" cols="35" rows="10"></textarea></td>
    </tr>
    <tr>
    	<td>Tipo de usuario a enviar</td>
        <td align="left">
        	<select name="forma_buscar">
            	<option value="1">Por correo electronico</option>
                <option value="2">Por nombre, apellido, direccion o nombre de usuario</option>
		<option value="3">Enviar a todo el mundo sin distinguir</option>
            </select><br />
            <input type="text" size="20" name="gente" placeholder="filtro a aplicar"/><br />
            <input type="checkbox" value="1" name="verificado" /> <strong>Solo a usuarios verificados</strong>
        </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" name="enviar" value="enviar correo" class="boton" /></td>
    </tr>
</table>
</form>
	<h2>Paso 2: Mensaje de respuesta del servidor</h2>
    <p><?=$mensaje?></p>

</div>
</body>
</html>
