<? $this -> load -> helper ("url"); ?>

		<!-- Slideshow component -->
		<div class="grid-x">
			<div class="cell" style="overflow: hidden;">
				<SlideshowComponent />
			</div>
		</div>
		<script src="<?=base_url()?>js/components/slideshowComponent.js"></script>

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
					<BarriosciudadesComponent />
					<? /*
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
					*/ ?>

				</div>
			</div>
		</div>
		<script src="<?=base_url()?>js/components/barriosCiudadesComponent.js"></script>

	<!-- ultimos 6 -->
	<div class="ultimas_ofertas">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="medium-12 cell">
					<h2 class="headline">Últimos pisos</h2>
				</div>
			</div>
			<!-- casas destacadas -->
			<div class="grid-x grid-margin-x">
				<Ultimos6Pisos />
			</div>
		</div>
	</div>
	<script src="<?=base_url()?>js/components/ultimos6pisosComponent.js"></script>
