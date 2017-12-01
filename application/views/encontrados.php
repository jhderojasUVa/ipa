<? $this -> load -> helper("url"); ?>
<? $this -> load -> model("pisos_model"); ?>

<div class="busqueda">
  <div class="grid-container">
		<? foreach ($pisos_usuario as $row) { ?>
    <!-- elemento -->
    <div class="grid-x grid-margin-x elemento">
      <div class="small-12 medium-3 cell">
        <div style="width: 100%; height: 100%;background: url(<?=base_url()?>img_pisos/<?=$row["idpiso"]?>/<?=$row["imagen"]?>) no-repeat center center; background-size: 100%;"><a href="#" role="link"><div style="width: 100%; height: 100%"></div></a></div>
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
							<p class="text-right"><i class="extras fi-telephone"></i>&nbsp;&nbsp;<i class="extras fi-video"></i>&nbsp;&nbsp;<i class="extras fi-telephone"></i>&nbsp;&nbsp;<i class="extras fi-wheelchair"></i></p>
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
