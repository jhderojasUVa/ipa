
<script>
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' Dha de ser una direccion de correo electronico.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' debe de ser un numero.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' debe de ser un numero entre '+min+' y '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
    } if (errors) alert('Existe el siguiente error:\n'+errors);
    document.MM_returnValue = (errors == '');
} }

function finalizar() {
	alert("Los datos del piso han sido completados con exito.\r\nEn el menu de MIS PISOS puede verlo y modificarlo.");
	window.location = "<?=base_url()?>";
}

</script>
<form action="<?=base_url()?>index.php/pisos/editpiso1" method="post">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
  <div class="grid-container">
    <div class="grid-x grid-margin-x">
      <div class="small-12 cell">
        <? if (isset($edicion)) { ?><input type="hidden" name="edicion" value="<?=$edicion?>" />
        <? if ($edicion == 1) {?><input type="hidden" name="idpiso" value="<?=$idpiso?>" /><? } ?><? } ?>
        <ul class="menu simple">
          <li><a href="<?=base_url()?>index.php/pisos/editpiso1?idpiso=<?=$idpiso?>" role="link">1. Descripcion</a></li>
          <li><a href="#">2. Precio</a></li>
          <li class="active">3. Imagenes</li>
          <li><input class="button" type="submit" name="enviar" value="&laquo; primer paso" /></li>
          <li><input class="button" type="button" value="finalizar" onclick="finalizar()"/></li>
        </ul>
      </div>
    </div>
  </div>
</form>

<form action="<?=base_url()?>index.php/pisos/addpiso3" id="upload_file" method="post" enctype="multipart/form-data" onsubmit="MM_validateForm('descripcion','','R');return document.MM_returnValue">
<input type="hidden" name="idpiso" value="<?=$idpiso?>" />
  <div class="grid-container contenido">
    <div class="grid-x grid-margin-x">
      <div class="small-12 medium-3 cell">
        <center>
          <label for="upload" class="button">Seleccione el fichero</label>
          <input type="file" name="upload" id="upload" class="show-for-sr"/>
        </center>
      </div>
      <div class="small-12 medium-6 cell">
        <center>
          <input name="descripcion" type="text" placeholder="Descripci&oacute;n de la imagen" id="descripcion" />
          <div class="nombre_fichero_upload"></div>
        </center>
      </div>
      <div class="small-12 medium-3 cell">
        <input type="submit" name="add_imagen" class="button" id="add_imagen" value="Subir imagen y añadir otra" />
      </div>
    </div>
    <!-- instrucciones -->
    <div class="grid-x grid-margin-x">
      <div class="small-12 cell">
        <p>Para subir una imagen, <strong>pulse sobre el bot&oacute;n de <em>Seleccione el fichero</em></strong> y seleccione la imagen de su ordenador, luego pulse sobre el bot&oacute;n <strong><em>subir imagen y a&ntilde;adir otra</em></strong> para completar la carga.</p>
        <p><strong>Recomendado</strong>: las imagenes han de ser de 1024x768 a 72 puntos en formato <a href="http://es.wikipedia.org/wiki/Jpg" target="_blank">JPG</a>, <a href="http://es.wikipedia.org/wiki/Gif" target="_blank">GIF</a> o <a href="http://es.wikipedia.org/wiki/Portable_Network_Graphics" target="_blank">PNG</a>. <strong>Las imagenes se cambiaran de tamaño automaticamente a 1024x768</strong>.</p>
        <p><strong>Atenci&oacute;n:</strong> solo se permite un maximo de 5 imagenes.</p>
      </div>
    </div>
    <? if ($hay_error == true) { // Si ha habido errores?>
    <div class="grid-x grid-margin-x">
      <div class="small-12 cell">
        <h2 class="headline">¡Ha habido un error!</h2>
        <p>¡Vaya! ¡estamos abochornados!, hemos tenido un error. Por favor ponte <a href="mailto:soporte-web@uva.es?subject=Error en subida IPA - <?=$error?>">en contacto con nosotros</a> para ver que podemos hacer para que no vuelva a sucederte.</p>
      </div>
    </div>
    <? } ?>
  </div>
</form>
<? $temp=0 // Imagenes subidas ?>
<div class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="small-12 cell imagenes_piso">
      <? foreach ($imagenes_piso as $row) { // Esto es un apaño y hay que AJAXearlo?>
        <div id="trozo" class="final">
            <img src="<?=base_url()?>img_pisos/<?=$row -> imagen?>" alt="<?=$row -> descripcion?>" width="130" class="imagenes" /><br /><center><em><p><?=$row -> descripcion?></p></em><br /></center>
              <div id="formularios_img">
                <a href="javascript:cambiaorden(<?=$idpiso?>, '<?=$row -> imagen?>', <?=($row -> orden)-1?>, <?=$row->orden?>)" class="button" role="link"><i class="fi-arrow-left"></i></a>
                <a href="javascript:cambiaorden(<?=$idpiso?>, '<?=$row -> imagen?>', <?=($row -> orden)+1?>, <?=$row->orden?>)" class="button" role="link"><i class="fi-arrow-right"></i></a>
                <a href="javascript:borraimagen(<?=$idpiso?>, '<?=$row -> imagen?>', '<?=$row -> descripcion?>')" class="button" role="link"><i class="fi-arrow-left"></i></a>
                <div id="clear"></div>
              </div>
          </div> <!-- fin trozo -->
          <? $temp++;
          if ($temp>=3) {
            $temp=0; ?>
            <div id="clear"></div>
          <? } // Fin clear?>
      <? } ?>
    </div>
  </div>
</div>
