<? $this -> load -> helper("url"); ?>
<? $this -> load -> model("pisos_model"); ?>

<div class="busqueda">
  <div class="grid-container">
		<? foreach ($pisos_usuario as $row) { ?>
    <!-- elemento -->
    <div class="grid-x grid-margin-x elemento">
      <div class="small-12 medium-3 cell">
        <? if ($row["imagen"]=="sin_imagen.png") { ?>
        <div style="width: 100%; height: 100%;background: url(http://via.placeholder.com/350x350?text=sin+imagen) no-repeat center center; background-size: 100%;"><a href="#" role="link"><div style="width: 100%; height: 100%"></div></a></div>
        <? } else { ?>
        <div style="width: 100%; height: 100%;background: url(<?=base_url()?>img_pisos/<?=$row["idpiso"]?>/<?=$row["imagen"]?>) no-repeat center center; background-size: 100%;"><a href="#" role="link"><div style="width: 100%; height: 100%"></div></a></div>
      <? } // Fin del if ?>
      </div>
      <div class="small-9 cell">
					<? if ($_SESSION["logeado"] == true) { ?>
						<? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
						<p><a href="<?=base_url()?>index.php/pisos/producto_piso?id=<?=$row["idpiso"]?>" role="link">
							<? if (strlen($row["descripcion"])>350) {
									echo str_replace("]",":",str_replace("[","",substr($row["descripcion"], 0, 250)))." [...]";
							} else {
									echo str_replace("]",":",str_replace("[","",$row["descripcion"]));
							} // fin del if de mostrar 350 caracteres?>
						</a></p>
					<? } // fin de si es piso de usuario o uva. Esto vale para que el usuario solo pueda ver sus pisos (requerido por asuntos sociales) ?>
					<? } else { ?>
						<p>Solo los <strong><a href="<?=base_url()?>index.php/principal/haz_login">usuarios autentificados</a></strong> pueden verlo.</p>
					<? } // fin del if de si esta logeado o no?>
					<? if ($_SESSION["logeado"] == true) { ?>
						<? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
							<p class="text-right extras">
                <? $extras = explode("|", $row["extras"]); ?>
                <? for ($i2=0;$i2<count($extras);$i2++) { ?>
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
                <? } // fin del for ?>
              </p>
						<? } // Solo el dueño o gente de la uva pueden verlo ?>
					<? } // Solo los autentificados tienen el privilegio de ver estas cosas ?>
          <div class="grid-x grid-margin-x">
            <div class="small-8 cell vertical-align">
							<? if ($_SESSION["logeado"] == true) { ?>
								<? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
              	<p><small><?=$row["direccion"]?> <?=$row["poblacion"]?></small></p>
							<? } // Solo el dueño o gente de la uva puede verlo ?>
						<? } // Solo los autentificados... ya sabes ?>
            </div>
            <div class="small-4 cell text-right">
							<? if ($_SESSION["logeado"] == true) { ?>
								<? if (($this -> pisos_model ->  es_piso_usuario($usuario, $row["idpiso"]) == true) || ($_SESSION["uva"] == true)) { ?>
              	<p><a href="http://maps.google.es/maps?f=q&amp;source=embed&amp;hl=es&amp;geocode=&amp;q=<?=$row["direccion"]?>,España&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=<?=$row["direccion"]?>,España&amp;t=m&amp;z=50&amp" class="button small" role="link" target="_blank"><i class="fi-marker"></i>&nbsp;&nbsp;Google maps</a></p>
							<? } // Solo el dueño o alguien de la uva puede lo que puede ?>
						<? } // Solo los autentificados pueden... ?>
            </div>
          </div>
      </div>
    </div> <!-- // elemento -->
	<? } // fin del foreach ?>
	</div>
</div>
<!-- paginacion -->
<div class="grid-x grid-margin-x" style="margin-top:20px; margin-bottom:20px;">
	<div class="smal-12 cell">
    <center><?=$this -> pagination -> create_links();?></center>
	</div>
</div>
