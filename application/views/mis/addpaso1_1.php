<? $this -> load -> helper("url"); ?>
<?
	$descripcion = $calle = $numero = $piso = $cp = $letra = $tlf = "";
	$libre = true;
	$idlocalidad = $idbarrio = 0;
	$extras = array();
	if (isset($datos_piso)) {
		foreach ($datos_piso as $paso) {
			$descripcion = $paso -> descripcion;
			if (strlen($paso -> extras)>0) {
				$extras = explode("|", $paso -> extras);
			}
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

<form action="<?=base_url()?>index.php/pisos/addpiso2_fin" method="post">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
				<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
				<ul class="menu simple">
					<li><a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$idpiso?>" role="link">1. Descripcion</a></li>
					<li class="active">2. Precio</li>
					<li>3. Imagenes</li>
					<li><input class="button" type="submit" name="enviar" value="continuar &raquo;" /></li>
				</ul>
			</form>
		</div>
	</div>
</form>

<form action="<?=base_url()?>index.php/pisos/addpiso2" method="post">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
	<div class="grid-container contenido">
		<div class="grid-x grid-margin-x">
			<div class="small-12 cell">
				<h2 class="headline">Precio</h2>
				<p>A continuaci&oacute;n indique el precio y el porque del precio. Puede poner precio a diferentes habitaciones o poner un precio comun para todas o precio por el piso completo.</p>
        <p><strong>El precio es necesario hasta que no tenga un precio no podra continuar con el proceso</strong>.</p>
			</div>
		</div>
		<div class="grid-x grid-margin-x">
			<div class="small-12 medium-4 cell">
				<label>precio
					<input type="number" name="precio" placeholder="50"/>
				</label>
			</div>
			<div class="small-12 medium-6 cell">
				<label>referente a
					<input type="text" name="descripcion" size="20" maxlength="50"placeholder="habitacion doble" />
				</label>
			</div>
			<div class="small-12 medium-2 cell">
				<label style="margin-top: 20px;">
					<input class="button" onclick="pre_addprecio()" name="precio_enviar" value="a&ntilde;adir precio" />
				</label>
			</div>
		</div>

	<? if ($cant_precios_piso>0) { ?>
		<div class="grid-x grid-margin-x conjunto_precios_piso" style="margin-top:15px;">
			<div class="small-12 cell">
				<h2 class="headline">Precios anteriormente a&ntilde;adidos</h2>
			</div>
		</div>
		<div class="grid-x grid-margin-x precios_piso" style="margin-bottom:20px;">
			<div class="precios" style="margin: 0 auto;">
					<table width="100">
						<tr>
							<td>Precio</td>
							<td>Descripci&oacute;n</td>
							<td></td>
						</tr>
					<? foreach ($precios_piso as $row) { ?>
						<tr>
							<td><?=trim($row -> precio)?> &euro;</td>
							<td><?=trim($row -> descripcion)?></td>
							<td><a onclick="javascript:borraprecio(<?=$idpiso?>,<?=$row->precio?>,'<?=$row->descripcion?>',1)"><i class="fi-x"></i></a></td>
						</tr>
					<? } ?>
					</table>
			</div>
		</div>
	<? } ?>
	</div>
</form>
