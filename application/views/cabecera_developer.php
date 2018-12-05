<? $this -> load -> helper ("url"); ?>
<!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPA Información de Pisos en Alquiler. Universidad de Valladolid</title>
    <!-- React base -->
    <!-- Production -->
    <!--<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>-->
    <!-- Development -->
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <!-- Babel -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <!-- Polyfill -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    <!-- General CSS -->
    <link rel="stylesheet" href="<?=base_url()?>css/foundation.css">
    <link rel="stylesheet" href="<?=base_url()?>css/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>css/slick.css">
    <link rel="stylesheet" href="<?=base_url()?>css/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url()?>css/app.css">
    <script>
    // Service worker para cache de ficheros
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
          navigator.serviceWorker.register('/js/sw/service-worker.js')
          .then(function(registration) {
           // Registrado perfectamente
          }).catch(function(err) {
           // Error al registrar el service worker
           console.log('Error al registrar el Service Worker: '+err);
          });
        });
      }
    </script>
  </head>
  <body>
    <!-- header UVa -->
    <div class="grid-container full cabecera_uva show-for-medium">
      <div class="grid-container">
        <div class="grid-x align-middle">
          <div class="cell small-1">
            <a href="http://www.uva.es" role="link"><i class="fi-home"></i></a>
          </div>
          <div class="cell small-5">
            <h1 class="uvalogo"><strong>Universidad</strong> de <strong>Valladolid</strong></h1>
          </div>
          <div class="cell small-6" style="text-align: right;">
            <ul>
              <li>|</li>
              <li><div class="cabecera_uva_letras" style="width: 60px;padding-top: 7px;"><a href="http://directorio.uva.es" role="link">Directorio</a></div><a href="http://directorio.uva.es" role="link" class="uva_icon"><i class="fi-results-demographics"></i></a></li>
              <li>|</li>
              <li><div class="cabecera_uva_letras" style="width: 80px;"><a href="https://miportal.uva.es" role="link">Comunidad Universitaria</div><a href="https://miportal.uva.es" role="link" class="uva_icon"><i class="fi-lock"></i></a></li>
              <li>|</li>
              <li><a href="http://www.uva.es/buscador.html" role="link" class="uva_icon"><i class="fi-magnifying-glass"></i></a></li>
              <li>|</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="grid-container full cabecera_uva show-for-small-only">
      <div style="height:5px;"></div>
    </div>

		<!-- header md & lg -->
		<div class="cabecera show-for-medium">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="top-bar-right ">
						<ul class="menu simple">
							<li class="menu-text"><img src="<?=base_url()?>img/Secundaria_Roja.jpg" alt="Universidad de Valladolid" width="30">&nbsp;&nbsp;IPA UVa</li>
							<li class="superior"><a href="<?=base_url()?>"><i class="fi-home"></i>&nbsp;&nbsp;Home</a></li>
              <? if (!isset($_SESSION["logeado"]) || $_SESSION["logeado"] == false) { ?>
							<li class="superior"><a href="<?=base_url()?>index.php/principal/haz_login"><i class="fi-torso"></i>&nbsp;&nbsp;Identificate</a></li>
              <? } ?>
							<? if (isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true) { ?>
              <? if (!isset($q)) { ?>
              <li class="superior">
                <form action="<?=base_url()?>index.php/buscar/busquedas">
                  <div class="input-group">
                    <input class="input-group-field" type="search" name="q" placeholder="Buscar en IPA">
                      <div class="input-group-button">
                      <input type="submit" class="button" value="Buscar">
                      </div>
                    </div>
                </form>
              </li>
              <? } ?>
							<li>|</li>
							<li class="superior"><a href="<?=base_url()?>index.php/mis/mispisos" role="menuitem">Mis pisos</a></li>
							<li class="superior"><a href="<?=base_url()?>index.php/mis/miscomentarios" role="menuitem">Mis comentarios</a></li>
							<? if ($_SESSION["uva"]==0) { ?><li class="superior"><a href="<?=base_url()?>index.php/principal/vermisdatos" role="menuitem">Mis datos</a></li><? } ?>
							<li class="superior"><a href="<?=base_url()?>index.php/principal/logout" role="menuitem">Salir</a></li>
							<? if ($_SESSION["fue_admin"]==true) { ?><li class="superior"><a href="<?=base_url()?>index.php/doc/cambiartipo" role="menuitem">Administración</a></li><? } ?>
							<? } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
    <!-- header xs & sm -->
    <div class="cabecera show-for-small-only" style="border-bottom: 1px solid #c9c9c9; margin-bottom: 0.3em; box-shadow: 0px 0px 4px #aaa;">
      <div class="grid-container">
				<div class="grid-x grid-margin-x" style="background-color: #f5f5f5">
          <div class="top-bar-right" style="margin-top: 1rem;">
            <ul class="menu simple" style="margin: 0 1em;">
              <li class="menu-text">IPA</li>
              <li class="superior iconos_azul"><a href="<?=base_url()?>" role="menuitem"><i class="fi-home"></i></a></li>
              <? if (!isset($_SESSION["logeado"]) || $_SESSION["logeado"] == false) { ?>
							<li class="superior iconos_azul"><a href="<?=base_url()?>index.php/principal/haz_login" role="menuitem"><i class="fi-torso"></i></a></li>
              <? } ?>
              <? if (isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true) { ?>
                <li class="superior">|</li>
                <li class="superior iconos_rojos"><a href="<?=base_url()?>index.php/buscar/busquedas" role="menuitem"><i class="fi-magnifying-glass"></i></a></li>
                <li class="superior iconos_rojos"><a href="<?=base_url()?>index.php/mis/mispisos" role="menuitem"><i class="fi-home"></i></a></li>
                <? if ($_SESSION["uva"]==0) { ?><li class="superior iconos_rojos"><a href="<?=base_url()?>index.php/principal/vermisdatos" role="menuitem"><i class="fi-torso"></i></a></li><? } ?>
                <li class="superior iconos_rojos"><a href="<?=base_url()?>index.php/principal/logout" role="menuitem"><i class="fi-lock"></i></a></li>
              <? } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
