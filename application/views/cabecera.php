<? $this -> load -> helper ("url"); ?>
<!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPA Información de Pisos en Alquiler. Universidad de Valladolid</title>
    <link rel="stylesheet" href="<?=base_url()?>css/foundation.css">
    <link rel="stylesheet" href="<?=base_url()?>css/foundation-icons/foundation-icons.css">
    <link rel="stylesheet" href="<?=base_url()?>css/slick.css">
    <link rel="stylesheet" href="<?=base_url()?>css/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url()?>css/app.css">
  </head>
  <body>
		<!-- header -->
		<div class="cabecera">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="top-bar-right">
						<ul class="menu simple">
							<li class="menu-text"><img src="<?=base_url()?>img/Secundaria_Roja.jpg" alt="Universidad de Valladolid" width="30">&nbsp;&nbsp;IPA UVa</li>
							<li class="superior"><a href="<?=base_url()?>"><i class="fi-home"></i>&nbsp;&nbsp;Home</a></li>
              <? if (!isset($_SESSION["logeado"]) || $_SESSION["logeado"] == false) { ?>
							<li class="superior"><a href="<?=base_url()?>index.php/principal/haz_login"><i class="fi-torso"></i>&nbsp;&nbsp;Identificate</a></li>
              <? } ?>
							<? if (isset($_SESSION["logeado"]) && $_SESSION["logeado"] == true) { ?>
              <li class="superior">
                <form action="<?=base_url()?>index.php/buscar/busquedas">
                  <div class="input-group">
                    <input class="input-group-field" type="search" placeholder="Buscar en IPA">
                      <div class="input-group-button">
                      <input type="submit" class="button" value="Buscar">
                      </div>
                    </div>
                </form>
              </li>
							<li>|</li>
							<li class="superior"><a href="<?=base_url()?>index.php/mis/mispisos">Mis pisos</a></li>
							<li class="superior"><a href="<?=base_url()?>index.php/mis/miscomentarios">Mis comentarios</a></li>
							<? if ($_SESSION["uva"]==0) { ?><li class="superior"><a href="<?=base_url()?>index.php/principal/vermisdatos">Mis datos</a></li><? } ?>
							<li class="superior"><a href="<?=base_url()?>index.php/principal/logout">Salir</a></li>
							<li class="superior"><a href="<?=base_url()?>index.php/doc/cambiartipo">Administración</a></li>
							<? } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
