$(document).ready(function(){
  $(".slideshow").slick({
    autoplay: true,
    autoplayspeed: 3000,
    dots: true,
    arrows: true,
    speed: 800,
    infinite: true,
    slidesToShow: 1,
    variableWidth: true,
    centerMode: true,
  });

  // El tab de cambio de barrios
  cambia_tab("barrios");
  // El listener del upload de ficheros
  listener_upload();
  // El mejunje de subir la imagen
  //$("#upload_file").on("submit", subeimagen());
});

function cambia_tab(tab) {
  // Funcion que cambia el contenido de un tab
  // Ocultamos todos
  $(".opciones .barrios ul li").hide();
  $(".opciones .ciudades ul li").hide();
  // Mostramos la que necesitamos
  $(".opciones ."+tab+" ul li").show();
}

function pre_addprecio() {
  // Funcion de toma de datos para añadir un precio
  // Si, lo podia haber metido dentro de la funcion principal, pero... ya sabesh
  var idpiso = $("input[name='idpiso']").val();
  var precio = $("input[name='precio']").val();
  var contenido = $("input[name='descripcion']").val();
  addprecio(idpiso, precio, contenido);
  // Ponemos los valores a 0
  $("input[name='precio']").val("");
  $("input[name='descripcion']").val("");
}

function addprecio(idpiso, precio, contenido) {
  var resultado = "";
  // Funcion que añade un precio a un piso
  // Necesario
  // idpiso = id del piso
  // precio = el precio (obvio)
  // descripcion = la descripcion para el precio concreto
  $.ajax({
    url: "/index.php/pisos/addpiso2",
    data: {
      idpiso: idpiso,
      precio: precio,
      descripcion: contenido,
      ws: "json"
    }
  }).done(function(data) {
    resultado += "<table width='100'><tr><td>Precio</td><td>Descripci&oacute;n</td><td></td></tr>";
    $.each(data.precios_piso, function(i, item){
      resultado += "<tr>";
      resultado += "<td>"+item.precio+"</td><td>"+item.descripcion+"</td>";
      resultado += "<td><a onclick=\"javascript:borraprecio("+idpiso+", "+item.precio+", '"+item.descripcion+"',1);\"><i class='fi-x'></i></a></td>";
      resultado += "</tr>";
    });
    resultado += "</table>";
    $(".precios").html(resultado);
  }).fail(function(data) {
    $(".precios").html("<h2>Lo sentimos</h2><p><strong>Ha habido un problema al añadir el precio</strong>.");
    resultado += "<p>Por favor, pongase <a href='mailto:soporte-web@uva.es?Subject=Error en add precio'>en contacto con el administrador</a> indicando el procedimiento que ha seguido para reproducir el problema.</p>";
  });
}

function borraprecio(idpiso, precio, contenido, ok) {
  var resultado = "";
  // Funcion que borra un precio a un piso
  // Necesario
  // idpiso = el identificador del piso
  // precio = el precio a borrar
  // contenido = la descripcion
  // ok = 1 que sino no borra (security reasons)
  $.ajax({
    url: "/index.php/pisos/borra_precio",
    data: {
      idpiso: idpiso,
      precio: precio,
      descripcion: contenido,
      ok: ok,
      ws: "json"
    }
  }).done(function(data) {
    resultado += "<table width='100'><tr><td>Precio</td><td>Descripci&oacute;n</td><td></td></tr>";
    $.each(data.precios_piso, function(i, item) {
      resultado += "<tr>";
      resultado += "<td>"+item.precio+"</td><td>"+item.descripcion+"</td>";
      resultado += "<td><a onclick=\"javascript:borraprecio("+idpiso+", "+item.precio+", '"+item.descripcion+"',1);\"><i class='fi-x'></i></a></td>";
      resultado += "</tr>";
    });
    resultado += "</table>";
    $(".precios").html(resultado);
  }).fail(function(data){
    $(".precios").html("<h2>Lo sentimos</h2><p><strong>Ha habido un problema al borrar el precio</strong>.");
    resultado += "<p>Por favor, pongase <a href='mailto:soporte-web@uva.es?Subject=Error borrando precio'>en contacto con el administrador</a> indicando el procedimiento que ha seguido para reproducir el problema.</p>";
  });
}

function listener_upload() {
  // Funcion que mira si el upload cambia para poner el nombre en el label y dejarlo bonito
  // Buscamos el elemento y añadimos el listener
  $("#upload").change(function() {
    // Hacemos el cambio del texto y de formato en el label
    $("label[for=upload]").html("<i class='fi-check'></i> Fichero a&ntilde;adido");
    $("label[for=upload]").css("color","white");
    $("label[for=upload]").addClass("success");
    $(".nombre_fichero_upload").html("<p><strong>Fichero</strong>: <small>"+this.files[0].name+"</small></p>");
  });
}

function sube_comentario() {
  // Funcion que sube un comentario por ajax
  var texto_comentario = $("textarea[name='comentario']").val();
  var idpiso = $("input[name='idpiso']").val();
  $.ajax({
    url: "/index.php/pisos/comentarios",
    type: "POST",
    data: {
      idpiso: idpiso,
      comentario: texto_comentario
    }
  }).done(function(data) {
    resultado = "";
    $.each(data.comentarios, function (i, item) {
      resultado += "<div class=\"small-12 cell comentario\">";
      resultado += "<h4>"+item.nombre.nombre+"</h4>";
      resultado += "<p>"+item.comentario+"</p>";

      resultado += "</div>";
    });
  });
}
