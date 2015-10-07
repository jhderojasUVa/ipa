// JavaScript Document
// Funciones de geolocalización para navegadores y dispositivos moviles
var lat = position.coords.latitude;
var long = position.coords.longitude;

function geolocalizacion() {
	// Arrancamos todo
	navigator.geolocation.getCurrentPosition(foundLocation, noLocation);
}

function foundLocation(position) {
	// Preguntamos al navegador la latitud y longuitud
	var lat = position.coords.latitude;
	var long = position.coords.longitude;
	
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
	
	// Creamos un marcador con la posicion del usuario
	var marker = new google.maps.Marker({
		position: latlng,
		title:"Usted esta aquí!"
	});
	marker.setMap(map);
	
	setMarkers(map, pisos);
}

function clearOverlays() {
	// Funcion para limpiar las marcas viejas
	if (markersArray) {
		for (i in markersArray) {
			markersArray[i].setMap(null);
		}
	}
}

function noLocation() {
	// Error si no logra geolocalizarte
	alert('Imposible encontrar localización.\nQuizas su dispositivo no lo soporte.');
}
