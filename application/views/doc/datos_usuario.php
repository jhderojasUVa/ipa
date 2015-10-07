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
	<h1>Datos del usuario</h1>
    <center>
    <table width="550">
    <? foreach ($datos_usuarios as $row) { ?>
    <form action="<?=base_url()?>index.php/doc/cambia_datos_usuario" method="post">
    <input type="hidden" name="idu" value="<?=$row -> idu?>" />
		<tr>
        	<td>Nombre</td>
            <td><input type="text" size="40" name="nombre" value="<?=$row -> nombre?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Apellidos</td>
            <td><input type="text" size="40" name="apellidos" value="<?=$row -> apellidos?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Usuario</td>
            <td><input type="text" size="40" name="login" value="<?=$row -> usuario?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Contraseña</td>
            <td><input type="text" size="40" name="password" value="<?=$row -> password?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Direccion</td>
            <td><textarea name="direccion" rows="5" cols="50" class="caja"><?=$row -> direccion?></textarea></td>
        </tr>
        <tr>
        	<td>Telefono</td>
            <td><input type="text" size="40" name="tlf" value="<?=$row -> tlf?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Email</td>
            <td><input type="text" size="40" name="email" value="<?=$row -> email?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>DNI</td>
            <td><input type="text" size="40" name="dni" value="<?=$row -> dni?>" class="caja" /></td>
        </tr>
        <tr>
        	<td>Verificado</td>
            <td><input type="checkbox" name="verificado" <? if ($row -> verificado == true) {?> checked="checked"<? } ?> value="1"/></td>
        </tr>
        <tr>
        	<td>Fecha de modificacion<br />(Y-M-D H:M:S)</td>
            <td><?=$row -> fechaalta?></td>
        </tr>
        <tr>
        	<td></td>
            <td>>> <a href="<?=base_url()?>index.php/doc/mostrar_pisos_usuario/?idusuario=<?=$row -> idu?>">Ver pisos del usuario</a> <<</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" value="cambiar datos" class="boton"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancelar" onclick="javascript:history.back(-1);" class="boton"/></td>
        </tr>
    </form>
    <? } ?>
    </table>
    </center>
</div>
</body>
</html>
