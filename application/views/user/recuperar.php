<? $this -> load -> helper ("url"); ?>

<style>
#simplemodal-container {
	background-color: #ebebeb;
	border: 1px solid #9b9b9b;
	box-shadow: 0px 0px 5px #888;
	-moz-box-shadow: 0px 0px 5px #888;
	-webkit-box-shadow: 0px 0px 5px #888;
	padding: 5px;
}

#simplemodal-container a.modalCloseImg {
	background: url(<?=base_url()?>img/x.png) no-repeat;
	width :25px;
	height: 29px;
	display: inline;
	z-index: 3200;
	position: absolute;
	top: -15px;
	right: -16px;
	cursor: pointer;
}
</style>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe de ser una direccion de correo electronico.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es necesario.\n'; }
    } if (errors) alert('Se ha encontrado el siguiente error:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>

<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<h2>Recuperar datos de IPA</h2>
			<p>Si usted dispone de cuenta en <a href="http://miportal.uva.es">Mi Portal UVa</a> pero <strong>no recuerda ni su nombre de usuario o contaseña</strong>, rellene la direcci&oacute;n de correo con la que se dio de alta y le enviaremos por correo los datos de su usuario y contraseña.</p>
			<p>En caso de no recordar la direcci&oacute;n de correo con la que se dio de alta en el sistema, por favor, pongase en contacto con el <a href="mailto:ipa.asuntos.sociales@uva.es">Area de Asuntos Sociales de la Universidad de Valladolid</a>.</p>
      <center>
      <form action="<?=base_url()?>index.php/principal/recordar_password" method="post" onsubmit="MM_validateForm('email','','RisEmail');return document.MM_returnValue">
        <input type="hidden" name="ok" value="1" />
        <input type="email" name="email" id="email" size="50" placeholder="direccion@correo.com"/><br /><br />
        <input type="submit" value="recuperar datos" />
      </form>
      </center>
		</div>
	</div>
</div>

<? if (strlen($bien)>0) { ?>
<div class="grid-container" style="margin-top: 20px;">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<center><div id="caja_recuperar_ok"><?=$bien?></div></center>
		</div>
	</div>
</div>
<? } ?>
