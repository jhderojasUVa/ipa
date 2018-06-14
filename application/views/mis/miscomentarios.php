<? $this -> load -> helper("url"); ?>
<? $this -> load -> database(); ?>
<script type="text/javascript" src="<?=base_url()?>js/jquery.simplemodal.js"></script>
<script>
function abrir_gmaps(url) {
	// http://maps.google.com/maps?q=Calle+del+Pel%C3%ADcano,+33,+Valladolid,+Espa%C3%B1a&hl=es&ie=UTF8&sll=37.0625,-95.677068&sspn=51.355924,88.681641&vpsrc=0&hnear=Calle+del+Pel%C3%ADcano,+33,+47012+Valladolid,+Castilla+y+Le%C3%B3n,+Espa%C3%B1a&t=h&z=16
	$.modal("<iframe src='http://maps.google.com/maps?q="+url+"' frameborder='0' width='750' height='550' scrolling='auto'></iframe>", {
		close: true,
		escClose: true,
		onClose: function() {
			window.location.reload(true);
		}
	});
}
</script>

<div class="grid-container contenido">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<? if(count($mis_comentarios)>0) { ?>
				<table>
					<tbody>
						<? foreach ($mis_comentarios as $row) { ?>
							<?
					    // Datos del comentario
					    $piso = $this -> pisos_model -> cantidad_show_imagenes_piso($row ->idobjeto);

					    if ($piso>0) {
							$imagen_piso = $this -> pisos_model -> show_imagenes_piso($row ->idobjeto);
					        foreach ($imagen_piso as $row2) {
					            $imagen = $row2 -> imagen;
					        }
					    } else {
					        $imagen = "sin_piso.png";
					    }
					    ?>
							<tr>
								<td>
									<a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row->idobjeto?>"><img src="<?=base_url()?>img_pisos/<?=$imagen?>" width="160" alt="foto" class="foto"/></a>
								</td>
								<td>
									<div id="comentario">
	                    <div id="comentario_texto">
	                        <p><?=$row -> comentario?>.</p>
	                    </div>
	                    <div id="comentario_pico"></div>
	                    <div id="comentario_autor">
	                        <?=$row -> idusuario?> - <?=$datos_yo["nombre"]?>
	                    </div>
	                </div>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			<? } else { ?>
				<h2>No hay comentarios</h2>
				<p>No existen comentarios. Usted no ha realizado ningun comentario a ninguno de sus inmuebles.</p>
				<p>Le recordamos que si es usted due&nacute;o de algun inmueble recibir&aacute; un correo cada vez que se realice un comentario en su inmueble.</p>
			<? } ?>
		</div>
	</div>
</div>
