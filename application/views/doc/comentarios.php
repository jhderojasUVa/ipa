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
	<? if (count($denuncias)>1) { // Si hay denuncias?>
    <h1>Comentarios marcados como SPAM</h1>
    <center>
    <table width="850">
    	<tr>
        	<th>Comentario</th>
            <th>Denunciante</th>
            <th>Acciones</th>
        </tr>
        <? if (count($denuncias)>1) {?>
        <? $aux = 0?>
        <? foreach ($denuncias as $row) { ?>
        <? if ($aux==0) { ?>
        <tr>
        <? $aux++?>
        <? } else { ?>
        <tr class="color">
        <? $aux = 0?>
        <? } ?>
        	<td valign="top"><?=$row["comentario"]?></td>
            <td valign="top" width="200"><a href="mailto:<?=$row["datos_denunciante"]["mail"]?>"><img src="<?=base_url()?>img/mail.png" alt="mail" width="10" /></a> <a href="mailto:<?=$row["datos_denunciante"]["mail"]?>"><span class="nombre"><?=$row["iddenunciante"]?></span></a><br /><span class="nombre_enano"><?=$row["datos_denunciante"]["nombre"]?></span></td>
            <td width="175"><a href="<?=base_url()?>index.php/doc/delspam/?idspam=<?=$row["idcomentario"]?>&an=<?=$row["iddenunciante"]?>">Borr. Comentario</a> | <a href="<?=base_url()?>index.php/doc/noespam/?idspam=<?=$row["idcomentario"]?>&an=<?=$row["iddenunciante"]?>">No es SPAM</a></td>
        </tr>
		<? } ?>
        <? } //Fin de si hay denuncias ?>
    </table>
    </center>
    <? } // Fin de mostrar todo ?>
    <? if (isset($resultados)) { ?>
    <hr />
    <h1>Resultados de la busqueda</h1>
    <? if (count($resultados)>0) { ?>
	 <center>
    	<table width="850">
        	<tr>
            	<th>Comentario</th>
                <th>Persona</th>
                <th>Piso</th>
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
            	<td valign="top" width="450"><?=$row["comentario"]?></td>
                <td valign="top"><? if ($row["nombre"]["mail"]<>"") { ?><a href="mailto:<?=$row["nombre"]["mail"]?>"><?=$row["nombre"]["nombre"]?></a><? } else { ?><?=$row["nombre"]["nombre"]?> <br /><small>Profesor - no tiene correo en el LDAP</small><? } ?></td>
                <td align="center" valign="top"><a href="<?=base_url()?>index.php/pisos/producto_piso/?id=<?=$row["idobjeto"]?>" target="_blank">ver</a></td>
                <td width="150" align="center" valign="top"><a href="<?=base_url()?>index.php/doc/edit_comentario/?id=<?=$row["idcomentario"]?>">Editar</a> - <a href="<?=base_url()?>index.php/doc/del_comentario/?id=<?=$row["idcomentario"]?>">Borrar</a></td>
            </tr>
            <? } ?>
    </table>
    </center>
    <? } else { ?>
    	<p><strong>No se han encontrado resultados de su busqueda!</strong></p>
    <? } ?>
    <? } // Fin de mostrar resultados?>
    <hr />
    <h1>Busca un comentario</h1>
    <form action="<?=base_url()?>index.php/doc/comentarios" method="post">
    	<input type="hidden" name="buscar" value="1" />
    	<input type="text" name="q" placeholder="buscar un comentario..." value="<?=$q?>" size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
    </form>
</div>
</body>
</html>
