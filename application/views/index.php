<? $this -> load -> helper ("url"); ?>

		<!-- Slideshow -->
		<div class="grid-x">
      <div class="cell" style="overflow: hidden;">
        <div class="slideshow">
					<? if (count($pisos)==1) { ?>
						<div class="caja"><h2>Lo sentimos</h2><p>No hay pisos disponibles.</p></div>
					<? } else { ?>
							<? foreach ($pisos as $row) { ?>
							<div class="caja">
								<a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["id_piso"]?>" role="link">
									<img src="http://ipa.uva.es/img_pisos/<?=$row["id_piso"]?>/<?=$row["imagen"]?>" alt="<?=$row["descripcion"]?>" />
								</a>
							</div>
						<? } // fin del foreach ?>
					<? } // fin del if ?>
        </div>
      </div>
    </div>

		<!-- Buscador -->
		<div class="buscador align-middle">
      <form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
        <div class="grid-container">
          <div class="grid-x">
            <div class="medium-12 cell">
              <div class="input-group">
                <input class="input-group-field" name="q" type="search" placeholder="Buscar en IPA">
                  <div class="input-group-button">
                  <input type="submit" class="button" value="Buscar">
                  </div>
                </div>
            </div>
          </div>
        </div>
      </form>
    </div>

		<!-- opciones -->
		<div class="opciones">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="medium-12 cell">
						<ul class="menu align-center">
							<li><a href="javascript:cambia_tab('barrios');">Barrios</a></li>
							<li><a href="javascript:cambia_tab('ciudades');">Ciudades</a></li>
						</ul>
					</div>
				</div>
				<div class="grid-x grid-margin-x">
					<div class="medium-12 cell barrios">
						<ul>
							<? if ($barrios==false) { ?>
	            	<li>Lo sentimos. No existen pisos aun.</li>
	            <? } else { ?>
		            <? for ($i=0;$i<count($barrios);$i++) { ?>
		            	<li><a href="<?=base_url()?>index.php/principal/barrios?id=<?=$barrios[$i]["idbarrio"]?>"><?=$barrios[$i]["barrio"]?> (<?=$barrios[$i]["ciudad"]?>)</a></li>
								<? } // fin del for ?>
	            <? } // fin del if ?>
						</ul>
					</div>
					<div class="medium-12 cell ciudades">
						<ul>
							<? if (count($ciudades)>0) {?>
		            <? for ($i=0;$i<count($ciudades);$i++) { ?>
		            	<li><a href="<?=base_url()?>index.php/principal/ciudades?id=<?=$ciudades[$i]["idlocalizacion"]?>"><?=$ciudades[$i]["localizacion"]?></a></li>
		            <? } // fin del for ?>
	            <? } else { ?>
	            	<li>Lo sentimos. No existen pisos aun.</li>
	            <? } // fin del if ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<? if (count($ultimos_6)>0) {?>
		<!-- ultimas ofertas -->
		<div class="ultimas_ofertas">
      <div class="grid-container">
        <div class="grid-x grid-margin-x">
          <div class="medium-12 cell">
            <h2 class="headline">Últimos pisos</h2>
          </div>
        </div>
        <!-- casas destacadas -->
        <div class="grid-x grid-margin-x">

					<? for ($i=0; $i<count($ultimos_6); $i++) { ?>
          <!-- destacado -->
          <div class="medium-4 cell">
            <div class="card">

              <!--<div style="width: 100%; height: 100%;background: url(<?=$ultimos_6[$i]["imagen"]?>) no-repeat center center; background-size: 100%;"><div style="width: 100%; height: 200px;"></div></div>-->
							<div style="width: 100%; height: 100%;background: url(<?=base_url()?><?=$ultimos_6[$i]["idpiso"]?>/<?=$ultimos_6[$i]["imagen"]?>) no-repeat center center; background-size: 100%;"><div style="width: 100%; height: 200px;"></div></div>

							<div class="card-section">
                <p class="texto"><?=str_replace("[Plazas ofertadas]", "", str_replace("[Número habitaciones]", "", str_replace("[Datos del inmueble]", "", $ultimos_6[$i]["descripcion"])))?></p>
                <ul class="opciones">
									<?
									$extras = explode("|",$ultimos_6[$i]["extras"]);
									for ($i2=0;$i2<count($extras);$i2++) { ?>
										<li>
											<? switch ($extras[$i2]) {
												case 'Cocina':
													?><img class="extras" src="<?=base_url()?>img/icons/009-cocina.png" alt="Cocina" /><?
													break;

													case 'Frigo':
														?><img class="extras" src="<?=base_url()?>img/icons/004-frigorifico.png" alt="Frigorigico" /><?
														break;

													case 'Lavadora':
														?><img class="extras" src="<?=base_url()?>img/icons/010-lavadora.png" alt="Lavadora" /><?
														break;

													case 'Vajilla':
														?><img class="extras" src="<?=base_url()?>img/icons/005-vajilla.png" alt="Vajilla" /><?
														break;

													case 'Cama':
														?><img class="extras" src="<?=base_url()?>img/icons/006-cama.png" alt="Cama" /><?
														break;

													case 'Bano':
														?><img class="extras" src="<?=base_url()?>img/icons/011-servicio.png" alt="Baño" /><?
														break;

													case 'Horno':
														?><img class="extras" src="<?=base_url()?>img/icons/008-horno.png" alt="Horno" /><?
														break;

													case 'Secadora':
														?><img class="extras" src="<?=base_url()?>img/icons/012-secadora.png" alt="Secadora" /><?
														break;

													case 'TV':
														?><img class="extras" src="<?=base_url()?>img/icons/002-television.png" alt="TV" /><?
														break;

													case 'Telefono':
														?><img class="extras" src="<?=base_url()?>img/icons/003-phone.png" alt="Telefono" /><?
														break;

													case 'WIFI':
														?><img class="extras" src="<?=base_url()?>img/icons/001-wifi.png" alt="Internet" /><?
														break;

													case 'Compartido':
														?><img class="extras" src="<?=base_url()?>img/icons/013-compartido.png" alt="Compartido" /><?
														break;

												default:
													# code...
													break;
											} ?>
										</li>
								<? }  // fin del for ?>
                </ul>
              </div>
              <div class="card-section">
                <center>
                  <a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$ultimos_6[$i]["idpiso"]?>" class="button" role="link">Ver piso</a>
                  <a href="http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=<?=$ultimos_6[$i]["direccion"]?>&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?=$ultimos_6[$i]["direccion"]?>&amp;t=m&amp;z=50&amp" class="button" role="link" target="_blank">Google Maps</a>
                </center>
              </div>

            </div>

          </div>
					<? } ?>

				</div>

      </div>
    </div>
	<? } // fin de si hay ultimos ?>
