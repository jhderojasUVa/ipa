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
    <h1>Usuarios no activados</h1>
    <center>
    	<table width="850">
        	<tr>
            	<th>Nombre de usuario</th>
                <th>Direccion de email</th>
                <th>Activado</th>
                <th>Acciones</th>
            </tr>
            <? $aux = 0?>
			<? foreach ($usuarios_no as $row) { ?>
            <? if ($aux==0) { ?>
            <tr>
            <? $aux++?>
            <? } else { ?>
            <tr class="color">
            <? $aux = 0?>
            <? } ?>
            	<td valign="top" width="450"><?=$row -> nombre?> <?=$row -> apellidos?></td>
                <td valign="top"><a href="mailto:<?=$row -> email?>"><?=$row -> email?></a></td>
                <td align="center"><? if ($row -> verificado==true) { ?>SI<? } else { ?>NO<? } ?></td>
                <td width="150"><center><a href="<?=base_url()?>index.php/doc/activar_user/?id=<?=$row -> idu?>">Activar</a> | <a href="<?=base_url()?>index.php/doc/editar_user/?id=<?=$row -> idu?>">Editar</a> | <a href="<?=base_url()?>index.php/doc/borrar_user/?id=<?=$row -> idu?>">Borrar</a></center></td>
            </tr>
            <? } ?>
    </table>
    </center>
    <? if (isset($resultados)) { ?>
    <hr />
    <h1>Resultados de la busqueda</h1>
    <? if (count($resultados)>0) { ?>
	 <center>
    	<table width="850">
        	<tr>
            	<th>Nombre de usuario</th>
                <th>Direccion de email</th>
                <th>Activado</th>
                <th>Acciones</th>
            </tr>
            <? $aux = 0?>
			<? foreach ($resultados as $row) { ?>
            <? if ($aux==0) { ?>
            <tr>
            <? $aux++?>
            <? } else { ?>
            <tr class="color">
            <? $aux = 0?>
            <? } ?>
            	<td valign="top" width="450"><?=$row -> nombre?> <?=$row -> apellidos?></td>
                <td valign="top"><a href="mailto:<?=$row -> email?>"><?=$row -> email?></a></td>
                <td align="center"><? if ($row -> verificado==true) { ?>SI<? } else { ?>NO<? } ?></td>
                <td width="150"><center><a href="<?=base_url()?>index.php/doc/activar_user/?id=<?=$row -> idu?>">Activar</a> | <a href="<?=base_url()?>index.php/doc/editar_user/?id=<?=$row -> idu?>">Editar | <a href="<?=base_url()?>index.php/doc/borrar_user/?id=<?=$row -> idu?>">Borrar</a></center></td>
            </tr>
            <? } ?>
    </table>
    </center>
    <? } else { ?>
    	<p><strong>No se han encontrado resultados de su busqueda!</strong></p>
    <? } ?>
    <? } // Fin de mostrar resultados?>
		<!-- usuario UVa -->
		<? if ($usuarios_uva) { ?>
		<div class="contenido">
			<h1>Usuarios UVa que tienen piso</h1>
			<p>Si todo va bien, aqui tienes una lista de los usuarios de la UVa con pisos por sus DNI</p>
			<table>
				<th>
					<td>Identificador</td>
					<td>Numero de pisos</td>
				</th>
				<? foreach ($usuarios_uva as $row) { ?>
					<tr>
						<td><a href="<?=base_url()?>doc/ver_pisos_usuarios_nouva" role="link"><?=$row -> idusuario?></a></td>
						<td><?=$row -> pisos_totales?></td>
					</tr>
				<? } ?>
			</table>
		</div>
		<? } ?>
    <hr />
    <h1>Busca un usuario para editarlo</h1>
    <p>Se busca en el nombre, apellido, direccion, nombre de usuario. Dejar vacio para mostrar <strong>toda la lista de usuarios</strong> (esto puede llevar tiempo).</p>
    <form action="<?=base_url()?>index.php/doc/usuarios" method="post">
    	<input type="hidden" name="buscar" value="1" />
    	<input type="text" name="q" placeholder="buscar un usuario..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
</div>
</body>
</html>
