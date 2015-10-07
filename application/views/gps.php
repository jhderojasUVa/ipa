<? $this -> load -> helper ("url"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Información sobre pisos en alquiler UVa</title>
<link href="<?=base_url()?>css/principal.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/mapa.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&region=ES&language=es"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.jcarousel.js"></script>
<script>
function geolocalizacion() {
	// Arrancamos todo
	navigator.geolocation.getCurrentPosition(foundLocation, noLocation);
}

function foundLocation(position) {	
	var lat = position.coords.latitude;
	var long = position.coords.longitude;
	
	// Pisos en la bd
	var pisos = [
		<? $i=0; for ($i==0; $i<($cantidad-2);$i++) { ?>
		["Piso", <?=$pisos[$i]["lt"]?>, <?=$pisos[$i]["ln"]?>, <?=$pisos[$i]["idpiso"]?>],
		<? } ?>
		["Piso", <?=$pisos[($cantidad-1)]["lt"]?>, <?=$pisos[($cantidad-1)]["ln"]?>, <?=$pisos[($cantidad-1)]["idpiso"]?>]
	];
	
	var tam = pisos.length;
		
	var facultades_va = [
		["Ciencias", 41.655054,-4.71571,1],
		["Industriales",41.657235,-4.71571,2],
		["Arquitectura",41.63944,-4.745928,3],
		["Teleco e Informatica",41.662589,-4.710431,4],
		["Enfermeria y Medicina",41.655503,-4.720087,5],
		["Empresariales", 41.659543,-4.709058,6],
		["Derecho",41.652681,-4.721804,7],
		["Trabajo Social",41.652681,-4.721804,8],
		["Filosofia",,,9]
	];
	
	var tam_fa_va = facultades_va.length;
		
	// Creamos el mapa de Google (con su API) en las coordenadas recibidas
	var latlng = new google.maps.LatLng(lat, long);
	// Opciones del mapa
	var myOptions = {
	  zoom: 15,
	  center: latlng,
	  navigationControl: true,
	  navigationControlOptions: {
		style: google.maps.NavigationControlStyle.SMALL
	  },
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	// Iniciamos el mapa
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	// Icono de las casas
	var image = new google.maps.MarkerImage("<?=base_url()?>img/home.png",
	// This marker is 20 pixels wide by 32 pixels tall.
	new google.maps.Size(40, 40),
	// The origin for this image is 0,0.
	new google.maps.Point(0,0),
	// The anchor for this image is the base of the flagpole at 0,32.
	new google.maps.Point(0, 40));
	// Shapes define the clickable region of the icon.
	// The type defines an HTML <area> element 'poly' which
	// traces out a polygon as a series of X,Y points. The final
	// coordinate closes the poly by connecting to the first
	// coordinate.
	var shape = {
	  coord: [1, 1, 1, 40, 40, 40, 40 , 1],
	  type: 'poly'
	};
	
	for (i=0;i<tam;i++) {
		var piso = pisos[i];
		var myLatLng = new google.maps.LatLng(piso[1], piso[2]);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: image,
			shape: shape,
			setClickable: true,
			title: piso[0],
			zIndex: piso[3]
		});
		google.maps.event.addListener(marker, "click", function() {
			window.location = "<?=base_url()?>index.php/pisos/producto_piso?id="+piso[3];
		});
		marker.setMap(map);
	}
	
	// Posicion de las facultades de valladolid
	
	// Icono de las casas
	var image = new google.maps.MarkerImage("<?=base_url()?>img/pin_facul.png",
	// This marker is 20 pixels wide by 32 pixels tall.
	new google.maps.Size(40, 40),
	new google.maps.Point(0,0),
	new google.maps.Point(0, 40));
	var shape = {
	  coord: [1, 1, 1, 40, 40, 40, 40 , 1],
	  type: 'poly'
	};
	
	for (i=0;i<tam_fa_va;i++) {
		var facultad = facultades_va[i];
		var myLatLng = new google.maps.LatLng(facultad[1], facultad[2]);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: image,
			shape: shape,
			setClickable: false,
			title: facultad[0],
			zIndex: facultad[3]
		});
		marker.setMap(map);
	}
	
	// Creamos un marcador con la posicion del usuario
	var marker = new google.maps.Marker({
		position: latlng,
		title:"Usted esta aquí!"
	});
	marker.setMap(map);
}

function noLocation() {
	// Error si no logra geolocalizarte
	alert("Imposible encontrar localización.\nQuizas su dispositivo no lo soporte.");
}



</script>
</head>

<body onload="geolocalizacion();">
<div id="beta"></div>
<div id="menu_sup">
	<table align="center">
    	<tr>
        	<? if ($_SESSION["logeado"] == true) { ?>
            <td width="350">
            	<span class="botones"><img src="<?=base_url()?>img/home2.png" align="absbottom" width="20" alt="home" border="0"/><a href="<?=base_url()?>">&nbsp;Principal</a></span>
            	<span class="botones"><a href="<?=base_url()?>index.php/mis/mispisos">Mis pisos</a></span>
                <span class="botones"><a href="<?=base_url()?>index.php/mis/miscomentarios">Mis comentarios</a></span>
                <span class="botones"><a href="<?=base_url()?>index.php/principal/logout">Salir</a></span>
            </td>
            <? } else { ?>
            <td width="350">
            	Usuario <strong>no identificado</strong>&nbsp;
                <span class="botones"><img src="<?=base_url()?>img/home2.png" align="absbottom" width="20" alt="home" border="0"/><a href="<?=base_url()?>">&nbsp;Principal</a></span>
                <span class="botones"><a href="<?=base_url()?>index.php/principal/haz_login">Autentificarse</a></span>
            </td>
            <? } ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
            	 <form action="<?=base_url()?>index.php/buscar/busquedas" method="post">
                    <input type="text" name="q" placeholder="buscar...." class="buscar" size="50" />&nbsp;<input type="submit" value="Buscar" />
                </form>
            </td>
        </tr>
    </table>
</div>
<div id="contenido">
	<!-- Aqui va el mapa -->
    <center>
	    <div id="map_canvas"></div>
    </center>
</div>
<div id="ciudades_principal">
	<form action="<?=base_url()?>index.php/principal/geo" method="get">
    	<h2>Seleccione ciudad</h2>
        <p>El cambio de ciudad es necesario para no saturar el mapa de Google Maps y mejorar la velocidad de presentaci&oacute;n.</p>
        <select name="idciudad">
        	<? for ($i=0;$i<count($ciudades);$i++) { ?>
            	<option value="<?=$ciudades[$i]["idlocalizacion"]?>"><?=$ciudades[$i]["localizacion"]?></option>
            <? } ?>
        </select>
        <input type="submit" value="cambiar ciudad" class="boton"/>
    </form>
    <p>&nbsp;</p>
    <br /><br />
    <!-- iconos sociales -->
    <!--
        <table width="500" align="left">
        	<tr>
            	<td>
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=base_url()?>" data-via="universidaddeva" data-lang="es" data-size="normal">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</td>
			<td>
            	<div id="fb-root"></div>
				<script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
				<fb:like href="<?=base_url()?>" show_faces="true" width="450" send="true">
				</fb:like>
			</td>
            </tr>
        </table>
        -->
        <div id="clear"></div>
</div>
<div id="pie">
    <div id="contenido">
    	<table width="600" align="center">
        	<tr>
           	  <td width="20"><img src="<?=base_url()?>img/logo_azul.jpg" alt="Universidad de Valladolid" align="middle" /></td>
                <td align="left">Universidad de Valladolid - <a href="http://www.uva.es">www.uva.es</a> | STIC - <a href="http://www.uva.es/stic">www.uva.es/stic</a> | <img src="<?=base_url()?>img/mail.png" alt="mail" width="10" /> <a href="soporteweb@uva.es">administrador</a> | &copy; 2011</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
