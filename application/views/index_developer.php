<? $this -> load -> helper ("url"); ?>

		<!-- Slideshow component -->
		<div id="slideshowcomponent"></div>
		<script type="text/babel" src="<?=base_url()?>js/components/slideshowComponent.js"></script>

		<!-- Buscador -->
		<div class="buscador align-middle">
      <form action="<?=base_url()?>index.php/buscar/busquedas" method="get">
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
			<p class="text-center" style="background-color: #e9e9e9; margin-top: -10px;"><small>completa tu busqueda con <strong>ciudad:nombre de la ciudad</strong> o <strong>barrio:nombre del barrio</strong> para restringuir tu busqueda.</small></p>
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
					<div id="barriosciudadescomponent"></div>

				</div>
			</div>
		</div>
		<script type="text/babel" src="<?=base_url()?>js/components/barriosCiudadesComponent.js"></script>

	<!-- ultimos 6 -->
	<div class="ultimas_ofertas">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">
				<div class="medium-12 cell">
					<h2 class="headline">Últimos pisos</h2>
				</div>
			</div>
			<!-- casas destacadas -->
			<div class="grid-x grid-margin-x" id="ultimos_6_pisos">
			</div>
		</div>
	</div>
	<script type="text/babel" src="<?=base_url()?>js/components/ultimos6pisosComponent.js"></script>
