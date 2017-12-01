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
					<li>1. Descripcion</li>
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
				<label>
					<input class="button" type="submit" name="precio_enviar" value="a&ntilde;adir precio" />
				</label>
			</div>
		</div>

	<? if ($cant_precios_piso>0) { ?>
		<div class="grid-x grid-margin-x precios_piso" style="margin-top:15px;margin-bottom:20px;">
			<div class="small-12 cell">
				<h2 class="headline">Precios anteriormente a&ntilde;adidos</h2>
			</div>
			<div class="precios">
				<? foreach ($precios_piso as $row) { ?>
					<div class="small-4 cell">
						<?=$row -> precio?> &euro;
					</div>
					<div class="small-6 cell">
						<?=$row -> descripcion?>
					</div>
					<div class="small-2 cell">
						<a href="<?=base_url()?>index.php/pisos/borra_precio/?idpiso=<?=$idpiso?>&precio=<?=$row->precio?>&desc=<?=$row->descripcion?>&ok=1"><i class="fi-x"></i></a>
					</div>
				<? } ?>
			</div>
		</div>
	<? } ?>
	</div>
</form>
