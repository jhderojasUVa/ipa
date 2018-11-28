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
    </form>
    <h1>A&ntilde;adir nuevo piso</h1>
    <form action="<?=base_url()?>index.php/doc/addpiso" method="post">
    <input type="submit" value="añadir piso" class="boton"/>
    </form>
		<hr/>
		<div style="border: 1px solid red; padding: 20px;">
			<h1>Utilidades de mantenimiento extras y paso de v1 a v2 de IPA</h1>
			<p>¡Cuidado al usar estas utilidades!. El resultado es una pagina con el resultado a chorron, te tocara retroceder a las bravas en el navegador. Estan puesto en el orden que seria conveniente usarlas.</p>
			<p><strong>¡Asegurate de que antes hay copia de seguridad de todo esto porque no hay vuelta atras!</strong></p>
			<ul style="padding: 30px; text-align: left;">
				<li>1. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/coloca_en_directorio">Coloca las imagenes del raiz en directorio del piso correspondiente</a></li>
				<li>2. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/imagen_sin_id">Elimina imagenes sin piso</a></li>
				<li>3. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/borra_imagenes_sin_duenyo">Elimina las imagenes que no tienen dueño. Diferencia del anterior es que son las que estan en bruto en el directorio donde se almacenan todas</a></li>
			</ul>
		</div>
		<div style="border: 1px solid red; padding: 20px;">
			<h1>Utilidades de mantenimiento extras y de paso de la v2 a la v2.5 IPA</h1>
			<p>¡Ciudado al usar estas utilidades!. Si las otras eran peligrosas estas lo son mas, asi que cuidado con tocarlas.</p>
			<p>En esta ocasion <strong>asegurate que hay una copia de la base de datos</strong>.</p>
			<ul style="padding: 30px; text-align: left;">
				<li>1. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/repara_order_imagenes">Repara el orden de las imagenes y arregla la base de datos, los primary keys</a></li>
				<li>2. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/add_id_precios">Tabla pisos_precio le pone ID y primary key</a></li>
				<li>3. <a style="cursor: not-allowed;" aria-disabled="true" onclick="return false;" href="<?=base_url()?>index.php/doc/repara_add_id_denuncias">Tabla denuncias le pone ID y primary key</a></li>
			</ul>
		</div>
</div>
</body>
</html>
