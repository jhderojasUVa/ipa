<? $this -> load -> helper ("url"); ?>
<? $this -> load -> library("LDAP"); ?>
<?
// Sacamos las cosas
foreach ($datos_comentario as $row) {
	$idcomentario = $row -> idcomentario;
	$idusuario = $row -> idusuario;
	$comentario = $row -> comentario;
	$puntuacion = $row -> puntuacion;
	$idobjeto = $row -> idobjeto;
	$fehca = $row -> fecha;
	$nombre_usuario = $this -> ldap -> sacar_datos_ldap($row->idusuario);
}
?>
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

    <form action="<?=base_url()?>index.php/doc/edit_comentario" method="post">
    	<input type="hidden" name="id" value="<?=$idcomentario?>" /><input type="hidden" name="q" value="<?=$q?>" /><input type="hidden" name="cambiar" value="1" />
        <table width="800">
        	<tr>
            	<td width="100" align="left">Usuario</td>
                <td width="700" align="left"><?=$nombre_usuario["nombre"]?></td>
            </tr>
            <tr>
            	<td align="left">Comentario</td>
                <td align="left"><textarea name="textocomentario" rows="5" cols="55"><?=$comentario?></textarea></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="submit" value="cambiar" class="boton"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="cancelar" onclick="javascript:history.back(-1);" class="boton"/></td>
            </tr>
        </table>
    </form>
	<?=$mensaje_vuelta?>
    <!--
    <hr />
    <h1>Busca un usuario para editarlo</h1>
    <p>Se busca en el nombre, apellido, direccion, nombre de usuario. Dejar vacio para mostrar <strong>toda la lista de usuarios</strong> (esto puede llevar tiempo).</p>
    <form action="<?=base_url()?>index.php/doc/usuarios" method="post">
    	<input type="hidden" name="buscar" value="1" />
    	<input type="text" name="q" placeholder="buscar un suaurio..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
    -->
</div>
</body>
</html>
