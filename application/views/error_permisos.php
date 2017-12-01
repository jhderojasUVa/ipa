<? $this -> load -> helper("url"); ?>
<? $fallo = $this -> input -> get("userpass") ?>

<div class="grid-container" style="margin-top:20px; margin-bottom:20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<? if (isset($fallo) && $fallo==1) { ?>
	    <h2>Error Usuario/Contrase&ntilde;a incorrecto</h2>
			<p><strong>Usuario o contrase&ntilde;a incorrectos</strong>.</p>
	    <p>Ha intentado ingresar con un usuario/contrase&ntilde;a incorrectos. Pulse <a class="error" href="<?=base_url()?>index.php/principal/haz_login" role="link">aqu&iacute; para volver a intentarlo</a>.</p>
	    <ul>
	    	<li>Compruebe que ha escrito bien tanto el usuario como la contrase&ntilde;a</li>
	      <li>Revise que no tiene pulsado el <a href="http://es.wikipedia.org/wiki/Bloq_may%C3%BAs">bloqueo de mayusculas</a></li>
	      <li>Recuerde que distingue entre mayusculas y minusculas</li>
	    </ul>
	    <p>Si usted piensa que essto es debido a un error, pongase en contacto con el <a href="mailto:asuntos.sociales@uva.es?subject=Problemas%20de%20entrada%20usuario">Secretariado de Asuntos Sociales</a> de la Universidad de Valladolid.</p>
		<? } else {?>
	    <h2>Error de permisos</h2>
	    <p><strong>Usted no tiene permisos para realizar esta acción</strong>.</p>
	    <p>Esta intentando acceder a una página a la que no tiene permisos, esto puede suceder porque:</p>
	    <ul>
	    	<li>Ha intentado ingresar con un usuario/contrase&ntilde;a incorrectos. Pulse <a class="error" href="<?=base_url()?>index.php/principal/haz_login" role="link">aqu&iacute; para volver a intentarlo</a>.</li>
	    	<li>Esta intentando realizar una busqueda sin estar identificado</li>
	      <li>Es un usuario IPA y esta intentando acceder a un inmueble que no es de su propiedad</li>
	      <li>Esta intentando acceder a los datos de un inmueble sin identificarse</li>
	      <li>Esta intentando modificar los datos de un inmueble que no le corresponde</li>
			</ul>
	    <? } ?>
		</div>
		<div class="smaill-12 cell">
			<center><p><a href="<?=base_url()?>" role="link" class="button">Volver a la página principal de IPA</a> <a href="<?=base_url()?>index.php/principal/haz_login" role="link" class="button">Autentificarse</a></p></center>
		</div>
	</div>
</div>
