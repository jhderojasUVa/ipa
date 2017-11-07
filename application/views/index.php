<? $this -> load -> helper ("url"); ?>

		<!-- Slideshow -->
		<div class="grid-x">
      <div class="cell" style="overflow: hidden;">
        <div class="slideshow">
					<? if (count($pisos)==1) { ?>
						<div class="caja"><h2>Lo sentimos</h2><p>No hay pisos disponibles.</p></div>
					<? } else { ?>
							<? foreach ($pisos as $row) { ?>
							<div class="caja"><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["id_piso"]?>" role="link"><img src="<?=base_url()?>img_pisos/<?=$row["imagen"]?>" alt="<?=$row["descripcion"]?>" /></a></div>
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

		<? if (count($6_ultimos)>0) {?>
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
					<? for ($i=0; $i<count($6_ultimos);$i++) { ?>
          <!-- destacado -->
          <div class="medium-4 cell">
            <div class="card">
              <div style="width: 100%; height: 100%;background: url(<?=$6_ultimos->imagen?>) no-repeat center center; background-size: 100%;"><div style="width: 100%; height: 200px;"></div></div>
              <div class="card-section">
                <p class="texto"><?=$6_ultimos->descripcion?></p>
                <ul class="opciones">
									<?
									$extras = split($6_ultimos->extras,"|");
									for ($i=0;$i<$extras;$i++) { ?>
										<li>
											<? switch ($extras[i]) {
												case 'Cocina':
													?>Icono cocina<?
													break;

													case 'Frigo':
														?>Icono frigo<?
														break;

													case 'Lavadora':
														?>Icono lavadora<?
														break;

													case 'Vajilla':
														?>Icono vajilla<?
														break;

													case 'Cama':
														?>Icono cama<?
														break;

													case 'Bano':
														?>Icono Baño<?
														break;

													case 'Horno':
														?>Icono horno<?
														break;

													case 'Secadora':
														?>Icono secadora<?
														break;

													case 'TV':
														?>Icono tv<?
														break;

													case 'Telefono':
														?>Icono tv<?
														break;

													case 'WIFI':
														?>Icono tv<?
														break;

													case 'Compartido':
														?>Icono tv<?
														break;

												default:
													# code...
													break;
											} ?>
										</li>
                  <li><i class="extras fi-male-female"></i></li>
                  <li><i class="extras fi-telephone"></i></li>
                  <li><i class="extras fi-laptop"></i></li>
                  <li><i class="extras fi-credit-card"></i></li>
								<? } // fin del for ?>
                </ul>
              </div>
              <div class="card-section">
                <center>
                  <a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$6_ultimos->idpiso?>" class="button" role="link">Ver piso</a>
                  <a href="http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=<?=$6_ultimas->direccion?>&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?=$6_ultimas->direccion?>&amp;t=m&amp;z=50&amp\" class="button" role="link" target="_blank">Google Maps</a>
                </center>
              </div>
            </div>
          </div>
					<? } ?>
				</div>

      </div>
    </div>
	<? } // fin de si hay ultimos ?>
