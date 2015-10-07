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
	<h1>Pisos encontrados</h1>
    <? if (count($busqueda)>0) { ?>
    <center>
    <table width="850">
    	<tr>
        	<th>Texto piso</th>
            <th>Direccion</th>
            <th>Acciones</th>
        </tr>
        <? $aux = 0?>
        <? foreach ($busqueda as $row) { ?>
        <? if ($aux==0) { ?>
        <tr>
        <? $aux++?>
        <? } else { ?>
        <tr class="color">
        <? $aux = 0?>
        <? } ?>
        	<td><?=$row["descripcion"]?></td>
            <td valign="top"><?=$row["direccion"]?></td>
            <td width="175" valign="top"><a href="<?=base_url()?>index.php/pisos/producto_piso/?id=<?=$row["idpiso"]?>" target="_blank">Ver</a> | <a href="<?=base_url()?>index.php/pisos/editpiso1/?idpiso=<?=$row["idpiso"]?>" target="_blank">Editar</a> | <a href="<?=base_url()?>index.php/doc/borrapiso/?id=<?=$row["idpiso"]?>&ok=1">Borrar</a></td>
        </tr>
		<? } ?>
    </table>
    </center>
    <? } else { ?>
    <p>No se han encontrado resultados para la busqueda.</p>
    <? } ?>
    <hr />
    <h1>Busca un piso para editarlo (<strong>tanto libres como ocupados</strong>)</h1>
    <p>Se busca en la descripci&oacute;n y la direcci&oacute;n</p>
    <form action="<?=base_url()?>index.php/doc/buscar_todos" method="post">
    	<input type="text" name="q" placeholder="buscar piso..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
    <hr />
    <h1>Busca un piso para editarlo (<strong>solo libres</strong>)</h1>
    <p>Se busca en la descripci&oacute;n y la direcci&oacute;n</p>
    <form action="<?=base_url()?>index.php/doc/buscar" method="post">
    	<input type="text" name="q" placeholder="buscar piso..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
    <hr />
    <h1>Busca un piso para editarlo (<strong>solo ocupados</strong>)</h1>
    <p>Se busca en la descripci&oacute;n y la direcci&oacute;n</p>
    <form action="<?=base_url()?>index.php/doc/buscar_ocupados" method="post">
    	<input type="text" name="q" placeholder="buscar piso..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
</div>
</body>
</html>
