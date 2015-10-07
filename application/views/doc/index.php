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
<? if (count($denuncias)>1) { ?>
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
    <hr />
    <? } // Fin de si hay denuncias ?>
    <h1>Usuarios no activados</h1>
    <center>
    	<table width="850">
        	<tr>
            	<th>Nombre de usuario</th>
                <th>Direccion de email</th>
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
                <td width="150"><center><a href="<?=base_url()?>index.php/doc/activar_user/?id=<?=$row -> idu?>">Activar</a> | <a href="<?=base_url()?>index.php/doc/editar_user/?id=<?=$row -> idu?>">Editar | <a href="<?=base_url()?>index.php/doc/borrar_user/?id=<?=$row -> idu?>">Borrar</a></center></td>
            </tr>
            <? } ?>
    </center>
    </table>
    <p>Si elimina/borra un usuario <strong>sus pisos se desvalidaran, sus comentarios se borraran y sus denuncias tambien</strong>.</p>
    <hr />
    <h1>Pisos no activados</h1>
    <center>
    	<table width="850">
        	<tr>
                <th>Texto piso</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>
             <? $aux = 0?>
			<? foreach ($pisos_no as $row) { ?>
            <? if ($aux==0) { ?>
            <tr>
            <? $aux++?>
            <? } else { ?>
            <tr class="color">
            <? $aux = 0?>
            <? } ?>
                    <td><?=$row["descripcion"]?></td>
                    <td valign="top"><?=$row["direccion"]?></td>
                    <td width="175" valign="top"><center><a href="<?=base_url()?>index.php/pisos/producto_piso/?id=<?=$row["idpiso"]?>" target="_blank">Ver</a> | <a href="<?=base_url()?>index.php/pisos/editpiso1/?idpiso=<?=$row["idpiso"]?>" target="_blank">Editar</a> | <a href="<?=base_url()?>index.php/doc/validar_piso/?id=<?=$row["idpiso"]?>">Validar</a> | <a href="<?=base_url()?>index.php/doc/borrapiso/?id=<?=$row["idpiso"]?>&ok=1">Borrar</a><hr /><a href="mailto:<?=$row["email"]?>">Mail</a> | <a href="<?=base_url()?>index.php/doc/editar_user/?id=<?=$row["idu"]?>">Editar usuario</a><br /><a href="<?=base_url()?>index.php/doc/mostrar_pisos_usuario/?idusuario=<?=$row["idu"]?>">Total <?=$row["total"]?></a></center></td>
            </tr>
            <? } ?>
        </table>
    </center>
    <h1>Busca un piso para editarlo</h1>
    <p>Se busca en la <strong>descripci&oacute;n</strong> y la <strong>direcci&oacute;n</strong> si se busca un piso y en la <strong>descripci&oacute;n</strong> si se busca en una imagen.</p>
    <form action="<?=base_url()?>index.php/doc/buscar" method="post">
    	<input type="text" name="q" placeholder="buscar ..." size="90" class="caja"/>
        <input type="submit" value="realizar busqueda" class="boton"/>
        <!-- 
        <br />
        <input type="radio" name="imagen" value="1" /> buscar imagen <input type="radio" name="imagen" value="2" /> buscar piso
        -->
    </form>
    <h1>A&ntilde;adir nuevo piso</h1>
    <form action="<?=base_url()?>index.php/doc/addpiso" method="post">
    <input type="submit" value="añadir piso" class="boton"/>
    </form>
</div>
</body>
</html>
