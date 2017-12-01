<? $this -> load -> helper("url"); ?>
<?
$calle = $numero = $piso = $cp = $letra = $tlf = "";
$descripcion = "[Datos del inmueble]\r\n\r\n[Número habitaciones]\r\n\r\n[Plazas ofertadas]\r\n\r\n[Tipo de calefacción]\r\n\r\n[Comunidad incluida]\r\n\r\n[Mobiliario]\r\n\r\n[Otros]\r\n\r\n[Preguntar por]\r\nNombre y Apellidos\r\n\r\n[Email]\r\n";
$libre = true;
$idlocalidad = $idbarrio = 0;
$extras = array();
if (isset($datos_piso)) {
	foreach ($datos_piso as $paso) {
		$descripcion = $paso -> descripcion;
		$extras = explode("|", $paso -> extras);
		$calle = $paso -> calle;
		$numero = $paso -> numero;
		$piso = $paso -> piso;
		$letra = $paso -> letra;
		$cp = $paso -> cp;
		$idlocalidad = $paso -> idlocalizacion;
		$idbarrio = $paso -> idbarrio;
		$tlf = $paso -> tlf;
		$libre = $paso -> libre;
	}
}

if (!isset($edicion)) {
	// No lo tamos editando cansinos
	$edicion = 0;
}
?>
<script>
function MM_validateForm() { //v4.0
	if (document.getElementById){
		var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
		for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
			if (val) { nm=val.name; if ((val=val.value)!="") {
				if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
				if (p<1 || p==(val.length-1)) errors+='- '+nm+' Debe de ser un correo.\n';
			} else if (test!='R') { num = parseFloat(val);
				if (isNaN(val)) errors+='- '+nm+' debe de ser un numero.\n';
				if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
				min=test.substring(8,p); max=test.substring(p+1);
				if (num<min || max<num) errors+='- '+nm+' debe de ser un numero entre '+min+' t '+max+'.\n';
			} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
		} if (errors) alert('Se han encontrado los siguientes errores:\n'+errors);
		document.MM_returnValue = (errors == '');
	} }
</script>
<!-- form aqui -->
<form action="<?=base_url()?>index.php/pisos/addpiso1" method="post" onsubmit="MM_validateForm('calle','','R','numero','','RisNum','piso','','R','letra','','R','cp','','RisNum','tlf','','RisNum');return document.MM_returnValue">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				<input type="hidden" name="edicion" value="<?=$edicion?>" />
				<? if ($edicion == 1) {?><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><? } ?>
				<ul class="menu simple">
					<li class="active">1. Descripcion</li>
					<li>2. Precio</li>
					<li>3. Imagenes</li>
					<li><input class="button" type="submit" name="enviar" value="continuar &raquo;" /></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="grid-container contenido">
		<div class="grid-x grid-margin-x">
			<div class="small-12 medium-8 cell">
				<h2 class="headline">Descripci&oacute;n</h2>
				<textarea width="100%" cols="40" rows="18" name="descripcion"><?=$descripcion?></textarea>
			</div>
			<div class="small-12 medium-4 cell">
				<h2 class="headline">Contenido</h2>
				<?
				$bano=$tv=$cocina=$telf=$wifi=$compartido=$lavadora=$frigo=$cama=$vajilla=$horno=$secadora=0;
				if (sizeof($extras)>0) {
					foreach ($extras as $row) {
						// La chapu, seguramente los input se pueden meter aqui dentro...
						switch ($row) {
							case "Cocina":
							$cocina=1;
							break;
							case "Frigo":
							$frigo=1;
							break;
							case "Lavadora":
							$lavadora=1;
							break;
							case "Cama":
							$cama=1;
							break;
							case "Vajilla":
							$vajilla=1;
							break;
							case "Horno":
							$horno=1;
							break;
							case "Secadora":
							$secadora=1;
							break;
							case "Bano":
							$bano=1;
							break;
							case "TV":
							$tv=1;
							break;
							case "Tlf":
							$telf=1;
							break;
							case "WIFI":
							$wifi=1;
							break;
							case "Compartido":
							$compartido=1;
							break;
						}

					} // Fin del foreach
				} // Fin del if
				?>
				<? if ($cocina == 1) { ?>
					<input type="checkbox" name="contenido[]" value="Cocina" checked="checked"/>&nbsp;Cocina<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Cocina" />&nbsp;Cocina<br />
				<? } ?>

				<? if ($frigo==1) { ?>
					<input type="checkbox" name="contenido[]" value="Frigo" checked="checked"/>&nbsp;Frigorifico<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Frigo"/>&nbsp;Frigorifico<br />
				<? } ?>

				<? if ($lavadora==1) { ?>
					<input type="checkbox" name="contenido[]" value="Lavadora" checked="checked"/>&nbsp;Lavadora<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Lavadora"/>&nbsp;Lavadora<br />
				<? } ?>

				<? if ($vajilla==1) {?>
					<input type="checkbox" name="contenido[]" value="Vajilla" checked="checked"/>&nbsp;Vajilla<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Vajilla"/>&nbsp;Vajilla<br />
				<? } ?>

				<? if ($cama==1) { ?>
					<input type="checkbox" name="contenido[]" value="Cama" checked="checked"/>&nbsp;Ropa de cama y mesa<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Cama"/>&nbsp;Ropa de cama y mesa<br />
				<? } ?>

				<? if ($horno==1) { ?>
					<input type="checkbox" name="contenido[]" value="Horno" checked="checked"/>&nbsp;Horno, Microondas<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Horno"/>&nbsp;Horno, Microondas<br />
				<? } ?>

				<? if ($secadora==1) { ?>
					<input type="checkbox" name="contenido[]" value="Secadora" checked="checked"/>&nbsp;Secadora<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Secadora"/>&nbsp;Secadora<br />
				<? } ?>

				<? if ($bano==1) {?>
					<input type="checkbox" name="contenido[]" value="Bano" checked="checked"/>&nbsp;Baño<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Bano"/>&nbsp;Baño<br />
				<? } ?>

				<? if ($tv == 1) { ?>
					<input type="checkbox" name="contenido[]" value="TV" checked="checked"/>&nbsp;TV<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="TV"/>&nbsp;TV<br />
				<? } ?>

				<? if ($telf == 1) { ?>
					<input type="checkbox" name="contenido[]" value="Tlf" checked="checked"/>&nbsp;Telefono<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Tlf" />&nbsp;Telefono<br />
				<? } ?>

				<? if ($wifi == 1) { ?>
					<input type="checkbox" name="contenido[]" value="WIFI" checked="checked"/>&nbsp;Internet<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="WIFI"/>&nbsp;Internet<br />
				<? } ?>

				<? if ($compartido == 1) { ?>
					<input type="checkbox" name="contenido[]" value="Compartido" checked="checked"/>&nbsp;Compartido<br />
				<? } else { ?>
					<input type="checkbox" name="contenido[]" value="Compartido"/>&nbsp;Compartido<br />
				<? } ?>
				<div id="libre">
					<? if ($libre == true) { ?>
						<input type="checkbox" name="libre" value="1" checked="checked" />&nbsp;Existen plazas libres
					<? } else { ?>
						<input type="checkbox" name="libre" value="1" />&nbsp;Existen plazas libres
					<? } ?>
				</div>
			</div>
		</div>


			<div class="grid-x grid-margin-x">
				<div class="small-12 cell">
					<fieldset class="fieldset">
						<legend><i class="fi-home"></i> Direcci&oacute;n</legend>
						<label for="calle">calle</label>
						<input id="calle" name="calle" type="text" class="form_boton" placeholder="C/Falsa" value="<?=$calle?>" />
						<label for="numero">numero</label>
						<input name="numero" type="text" class="form_boton" id="numero" placeholder="22" value="<?=$numero?>" size="3" maxlength="3"/>
						<label for="piso">piso (escriba <strong>B</strong> para un bajo y <strong>A</strong> para un &aacute;tico)</label>
						<input name="piso" type="text" class="form_boton" id="piso" placeholder="2" value="<?=$piso?>" size="2" maxlength="2"/>
						<label for="letra">letra
							<input name="letra" type="text" id="letra" placeholder="A" value="<?=$letra?>" size="2"/>
							<label for="cp">codigo costal (CP)</label>
							<input name="cp" type="text" id="cp" placeholder="00000" value="<?=$cp?>" size="5" maxlength="5" />
							<label for="localidad">localidad</label>
							<select name="localidad" id="localidad" class="form_boton">
								<? foreach ($localidades as $row) { ?>
									<? if ($idlocalidad == $row -> idlocalizacion) { ?>
										<option value="<?=$row -> idlocalizacion?>" selected="selected"><?=$row -> localizacion?></option>
									<? } else { ?>
										<option value="<?=$row -> idlocalizacion?>"><?=$row -> localizacion?></option>
									<? } ?>
								<? } ?>
							</select>
							<label for="tlf">tel&eacute;fono de contacto</label>
							<input name="tlf" type="text" id="tlf" placeholder="983423000" value="<?=$tlf?>" size="10" maxlength="9" />
							<label for="barrio">barrio</label>
							<select name="barrio" id="barrio" class="form_boton">
								<? foreach ($barrios as $row) { ?>
									<? if ($idbarrio == $row -> idbarrio) { ?>
										<option value="<?=$row -> idbarrio?>" selected="selected"><?=$row -> barrio?></option>
									<? } else { ?>
										<option value="<?=$row -> idbarrio?>"><?=$row -> barrio?></option>
									<? } ?>
								<? } ?>
							</select>
						</fieldset>
					</div>
				</div>
			</div>
		</form>
