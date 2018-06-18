<? $this -> load -> helper("url"); ?>
<script>
function cambia_estado(idpiso) {
	$.post("<?=base_url()?>index.php/ajax/ajax/cambia_estado", {
		id: idpiso
		},function (data){
			$("#cambia_estado_"+idpiso).html(data);
		});
}

function show_modal(direccion) {
	direccion=direccion+"+españa";
	$.modal("<iframe width=\"700\" height=\"420\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;aq=&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp;&amp;output=embed\"></iframe><br /><p><a href=\"http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q="+direccion+"&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear="+direccion+"&amp;t=m&amp;z=50&amp\" style=\"color:#0000FF;text-align:left\"><font face=\"Arial\" size=\"2\">Ver mapa más grande</font></a></p>", {
		autoresize: false,
		close: true
	});
}
</script>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h2>Mis pisos</h2>
			<? if (count($pisos_usuario)>0) { // Si tiene pisos ?>
				<? foreach ($pisos_usuario as $row) { // Recorremos los pisos?>
					<div class="grid-x grid-margin-x">
						<!-- imagen -->
						<div class="small-12 medium-3 cell">
							<div style="width: 100%; height: 100%; background: url('<?=base_url()?>img_pisos/<?=$row["idpiso"]?>/<?=$row["imagen"]?>') no-repeat center center; background-size: 100%;"><a href="#" role="link"><div style="width: 100%; height: 100%"></div></a></div>
						</div>
						<!-- contenido -->
						<div class="medium-8 cell">
							<a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$row["idpiso"]?>" role="link">
							<? if (strlen($row["descripcion"])>350) {
								echo str_replace("]",":",str_replace("[","",substr($row["descripcion"], 0, 250)))." [...]";
							} else {
								echo str_replace("]",":",str_replace("[","",$row["descripcion"]));
							}	?></a>
							<!-- extras -->
							<p class="text-right"><i class="extras fi-telephone"></i>&nbsp;&nbsp;<i class="extras fi-video"></i>&nbsp;&nbsp;<i class="extras fi-telephone"></i>&nbsp;&nbsp;<i class="extras fi-wheelchair"></i></p>
							<p><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>" role="link" class="button">Vealo como un usuario IPA</a></p>
							<p>Estado: <? if ($row["verificado"] == true) { ?>
		            <strong>Este piso se muestra en IPA</strong>
		            <? } else { ?>
		            <strong>A la espera de ser verificado por IPA</strong>
		            <? } ?>
	            </p>
							<!-- localizacion -->
							<div class="grid-x grid-margin-x">
		            <div class="small-8 cell vertical-align">
									<p><small><?=$row["direccion"]?> <?=$row["poblacion"]?></small></p>
								</div>
								<div class="small-4 cell text-right">
									<p><a href="http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=<?=$row["direccion"]?>,España&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?=$row["direccion"]?>,España&amp;t=m&amp;z=50&amp" class="button small" role="link" target="_blank"><i class="fi-marker"></i>&nbsp;&nbsp;Google maps</a></p>
								</div>
							</div>
						</div>
						<div class="medium-1 cell">
							<div id="cambia_estado_<?=$row["idpiso"]?>">
									<? if ($row["libre"] == true) { ?>
											<a href="#" onclick="javascript:cambia_estado(<?=$row["idpiso"]?>)"><span class="verde">Libre</span></a>
										<? } else {?>
											<a href="#" onclick="javascript:cambia_estado(<?=$row["idpiso"]?>)"><span class="rojo">Ocupado</span></a>
										<? } ?>
								</div>
						</div>
					</div>
				<? } // Fin de recorrer pisos ?>
			<? } else { // Si no tiene pisos ?>
				<p>Lo sentimos, <strong>no tiene ningun piso a su nombre</strong>. Use el bot&oacute;n de a&ntilde;adir pisos para insertar un piso en la plataforma.</p>
			<? } // Fin de si tiene o no tiene pisos ?>
		</div>
	</div>
</div>

<!-- botones -->
<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<center><a href="<?=base_url()?>index.php/pisos/showaddpiso1" class="button">A&ntilde;adir nuevo piso</a></center>
		</div>
	</div>
</div>

<!-- instrucciones -->
<div class="grid-container" style="margin-top: 20px; margin-botton: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h3>Vea el inmueble como un usuario IPA</h3>
			<p>Con este bot&oacute;n usted podr&aacute; ver el inmueble como lo ven los usuarios de la plataforma. As&iacute; podr&aacute; ajustarlo a sus intereses.</p>
			<h3>Estado</h3>
			<p>El tip de estado le indicar&aacute; en que proceso se encuentra su inmueble dentro de la herramienta.<br /><strong>Este piso se muestra en IPA</strong> significa que cualquier usuario perteneciente a la Universidad de Valladolid que entre en la plataforma podr&aacute; ver su inmueble.<br /><strong>A la espera de ser verificado por IPA</strong> indica que su inmueble ha sido insertado en nuestra base de datos y esta a la espera de que un administrador revise los datos y confime que todo es correcto.</p>
			<h3>Libre/Ocupado</h3>
			<p>Puede cambiar si el piso <strong>dispone de plazas o no</strong> sin tener que acceder al piso pulsando sobre <span class="verde">Libre</span> para ponerlo en <span class="ocupado">Ocupado</span> o viceversa.</p>
			<h2 style="margin-top: 20px;">Recuerde</h2>
			<p style="margin-bottom: 20px;">Recuerde que usted es el m&aacute;ximo responsable de los datos de su inmueble y de indicar cuando ha sido alquilado. Procure no tener datos erroneos o no actualizados ya que repercute en su propio inmueble.</p>
		</div>
	</div>
</div>
