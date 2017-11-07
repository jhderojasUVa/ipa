<? $this -> load -> helper ("url"); ?>

<script>
$(document).ready(function(){
	geolocalizacion();
});

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

<div class="grid-container">
	<div class="grid-x grid-margin-x">
		<div class="small-12 cell">
			<!-- Aqui va el mapa -->
	    <center>
		    <div id="map_canvas"></div>
	    </center>
		</div>
	</div>
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
</div>
