<? $this -> load -> helper ("url"); ?>
<?
foreach ($piso as $row) {
	$descripcion = $row -> descripcion;
	$calle = $row -> calle;
	$numero = $row -> numero;
	$piso = $row -> piso;
	$letra = $row -> letra;
	$cp = $row -> cp;
	$extras = explode("|", $row -> extras);
	$libre = $row -> libre;
	$fecha_insercion = $row -> fecha;
	$telf = $row -> tlf;
}

$dia = substr($fecha_insercion, 8, 2);
$mes = substr($fecha_insercion, 5, 2);
$ano = substr($fecha_insercion, 0, 4);
$hora = substr($fecha_insercion, 11, 2);
$minuto = substr($fecha_insercion, 14, 2);
?>
		<div class="grid-x">
      <div class="cell" style="overflow: hidden;">
        <div class="slideshow">
					<? if (count($imagenes)>0) { ?>
            	<? foreach ($imagenes as $row) { ?>
								<div class="caja"><center><img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" alt="<?=$row -> descripcion?>" /></center></div>
              <? } ?>
            <? } else { ?>
							<div class="caja"><center><img src="<?=base_url()?>css/sin_piso.png" alt="el piso no tiene imagen" /></center></div>
            <? } ?>
        </div>
      </div>
    </div>

		<? if ($_SESSION["logeado"] == true) { ?>
			<div class="grid-container contenido"> <? // Inicio del div del contenido total ?>
				<!-- Libre o no -->
				<? if ($libre==true) { ?>
		      <div class="grid-x grid-margin-x align-center">
		        <div class="medium-6 libres">
		          <p>Existen plazas libres</p>
		        </div>
		      </div>
				<? } else { ?>
					<div class="grid-x grid-margin-x align-center">
		        <div class="medium-6 ocupados">
		          <p>No hay plazas libres</p>
		        </div>
		      </div>
				<? } ?>

				<!-- contenido -->
				<div class="grid-x grid-margin-x" style="margin-bottom: 10px;">
					<!-- izquierda -->
	        <div class="medium-8 small-12 cell">
	          <h2 class="headline">Descripción</h2>
							<p><?=str_replace("]","</h3>",str_replace("[","<h3>",$descripcion))?></p>
							<p>Tlf <?=$telf?></p>
	            <p><i class="fi-calendar"></i>&nbsp;&nbsp;última actualización | <?=$dia?>/<?=$mes?>/<?=$ano?></p>
	          </div>

					<!-- derecha -->
	        <div class="medium-4 small-12 cell">
	          <h2 class="headline">Contenido</h2>

						<? if (count($precios_piso)>0) { ?>
	          <h2 class="headline">Precio</h2>
							<? foreach ($precios_piso as $row) { ?>
	          		<p><?=$row -> precio?> &euro;</strong> <?=$row -> descripcion?></p>
							<? } // Fin de recorrer todos los precios ?>
						<? } ?>

	          <h2 class="headline">Dirección</h2>
	          <div class="grid-x">
	            <div class="small-2 medium-2 cell text-center">
	              <p><i class="fi-marker"></i></p>
	            </div>
	            <div class="small-10 medium-10 cell">
	              <p>
									<?=$calle?>, <?=$numero?> <?
										if (strtoupper($piso)=="A") {
											echo "Atico ";
										} elseif (strtoupper($piso)=="0") {
											echo "Bajo ";
										} elseif (strtoupper($piso)=="B") {
											echo "Bajo ";;
										} else {
											echo $piso;
										}
									?><?=strtoupper($letra)?><br />
									<?=$cp?> (<?=$ciudad?>)
	              </p>
	            </div>
	          </div>
	            <div class="grid-x">
	              <div class="small-2 medium-2 cell text-center">
	                <p><i class="fi-telephone"></i></p>
	              </div>
	              <div class="small-10 medium-10 cell">
	                <p>Tlf <?=$telf?></p>
	              </div>
	          	</div>
							<div class="grid-x">
								<div class="small-12 cell text-center">
									<a href="http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=<?=$calle?>,<?=$numero?>,<?=$cp?>,<?=$ciudad?>,España&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=?=$calle?>,<?=$numero?>,<?=$cp?>,<?=$ciudad?>>&amp;t=m&amp;z=50&amp" class="button" role="link" target="_blank">Google Maps</a>
								</div>
							</div>

	        </div>
	      </div>
	    </div>

			<div class="grid-container comentarios" style="margin-bottom: 20px;">
	      <div class="grid-x">
	        <div class="small-12 cell">
	          <h2 class="headline">Comentarios</h2>
	        </div>
	      </div>
				<? if ($_SESSION["logeado"] == true && $_SESSION["uva"] == true) { // Solo si eres de la UVa puedes denunciar un comentario ?>
					<div class="small-12 cell comentario">
						<h3>Envia tu comtario</h3>
						<form action="<?=base_url()?>index.php/pisos/comentarios" method="post">
							<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
							<textarea cols="50" style="border: 1px solid #e6e6e6;" name="comentario" rows="4"></textarea>
							<p><center><input type="submit" class="button primary" style="color: white; padding-left: 40px; padding-right: 40px" value="envia tu comentario" /></center></p>
						</form>
					</div>
				<? } // Fin de ser de la UVa para formulario de envio de quejas ?>
				<? foreach ($comentarios as $row) { ?>
					<div class="small-12 cell comentario">
		        <h4><?=$row["nombre"]["nombre"]?> </h4>
		        <p><?=$row["comentario"]?></p>
						<? if ($row["spam"]==false) {?>
							<? if ($_SESSION["logeado"] == true && $_SESSION["uva"] == true) { // Solo si eres de la UVa puedes denunciar un comentario ?>
		        	<p class="text-right"><a href="<?=base_url()?>index.php/pisos/spam?idspam=<?=$row['idcomentario']?>&id=<?=$idpiso?>"><i class="fi-flag"></i>&nbsp;&nbsp;Denunciar comentario</a></p>
							<? } // Fin de si es de la UVa  ?>
						<? } // Fin de si spam ?>
		      </div>
				<? } ?>
			</div><!-- Fin de los comentarios -->


		<? } else { ?>
			<div class="grid-x grid-margin align-center">
				<div class="small-12 medium-6 cell">
					<h2 class="headline">Solo usuarios registrados</h2>
					<p><strong>Lo sentimos</strong>. Solo los <a href="<?=base_url()?>index.php/principal/haz_login">usuarios registrados</a> en la plataforma pueden ver los contenidos.</p>
				</div>
			</div>
		<? } // Fin de si esta logeado ?>
