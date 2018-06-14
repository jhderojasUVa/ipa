$(document).ready(function(){
  $(".slideshow").slick({
    autoplay: true,
    autoplayspeed: 800,
    dots: true,
    arrows: true,
    speed: 300,
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
  $("#upload_file").on("submit", subeimagen());
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

function subeimagen() {
  // Funcion que sube la imagen en cuestion

  // La respuesta, siempre vacia (manias)
  var resultado = "";
  // Los valores que necesitamos, el idpiso y la descripcion
  var idpiso = $("input[name='idpiso']").val();
  var descripcion = $("input[name='descripcion']").val();
  // Creamos la variable de los datos del formulario
  var datos = new FormData();
  // Cambiamos el boton para que aparezca el icono de que esta subiendo
  $("input[name='add_imagen']").val("Subiendo imagen <i class='fi-loop'></i>");
  $("#upload_file").submit(function(e){
    // Creamos los datos de envio
    datos.append("ws", "json");
    // Pillamos el fichero, lo dejamos para si "hay mas" que nunca se sabe (subida multiple)
    jQuery.each(jQuery("input[name='upload']")[0].files, function (i, file) {
      datos.append("file-"+i, file);
    });
    // Eliminamos que haga el submit el formulario
    e.preventDefault();
    // El envio en si
    $.ajax({
      url: "/index.php/pisos/addpiso3",
      method: "POST",
      type: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
    }).done(function(data){
      // El WS ha respondido
      $.each(data.imagenes_piso, function(i, item){
        // Montamos el resultado
        resultado += "<img src='<?=base_url()?>img_pisos/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
        resultado += "<div id='formularios_img'>";
        resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden-1)+", "+ditem.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>";
        resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>";
        resultado += "<a href='javascript:borraimagen("+data.idpiso+", '"+item.imagen+"', '"+item.descripcion+"')' class='button' role='link'><i class='fi-arrow-left'></i></a>";
        resultado += "<div id='clear'></div>";
        resultado += "</div>";
      });
      resultado += "</div>"; // El div del cierre porque esta a la vieja usanza
      // Dejamos el formulario como antes
      $("label[for=upload]").html("Seleccione el fichero");
      $("label[for=upload]").removeClass("success");
      $("input[name='add_imagen']").val("Subir imagen y añadir otra");
      // Añadimos que se ha subido con exito
      $(".nombre_fichero_upload").html("<p><i class='fi-ok'></i> Fichero subido con exito</p>");
      // Pintamos el resultado
      $(".imagenes_piso").html(resultado);
    }).fail(function(data){
      // Algo ha pasado hay que contarselo al usuario para que no se ponga nervioso
      resultado = "<h1>Lo sentimos</h1><p>Ha habido un error al subir su imagen.</p>";
      resultado += "<p>Por favor, pongase <a href='mailto:soporte-web@uva.es?Subject=Error subida de ficheros IPA'>en contacto con el administrador</a> indicando el procedimiento que ha seguido para reproducir el problema.</p>";
      $(".imagenes_piso").html(resultado);
    });
  });
}

function cambiaorden(idpiso, imagen, nuevo, actual) {
  // Funcion que cambia el orden de las cosas
  $.ajax({
    url: "/index.php/pisos/cambiarorden",
    data: {
      idpiso: idpiso,
      imagen: imagen,
      nuevo: nuevo,
      actual: actual,
      ws: "json"
    }
  }).done(function(data) {
    // El WS ha respondido
    var resultado = "<div id='trozo' class='final'>";
    $.each(data.imagenes_piso, function (i, item){
      // Montamos el tinglado
      resultado += "<img src='<?=base_url()?>img_pisos/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
      resultado += "<div id='formularios_img'>";
      resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden-1)+", "+ditem.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>";
      resultado += "<a href='javascript:borraimagen("+data.idpiso+", '"+item.imagen+"', '"+item.descripcion+"')' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<div id='clear'></div>";
      resultado += "</div>";
    });
    resultado += "</div>"; // A la vieja usanza... esto hay que cambiarlo
    // Lo pintamos
    $(".imagenes_piso").html(resultado);
  }).fail(function(data){
    // Si hay error lo mostramos para que no se ponga nervioso
    resultado = "<h1>Lo sentimos</h1><p><strong>Ha habido un error</strong> cambiando el orden de las imagenes.</p>";
    resultado += "<p>Por favor, pongase <a href='mailto:soporte-web@uva.es?Subject=Error cambiando orden de fichero'>en contacto con el administrador</a> indicando el procedimiento que ha seguido para reproducir el problema.</p>";
    $(".imagenes_piso").html(resultado);
  });
}

function borraimagen(idpiso, imagen, descripcion) {
  // Funcion que borra una imagen
  var resultado;
  // La peticion del asunto
  $.ajax({
    url: "/index.php/pisos/del_img",
    data: {
      idpiso: idpiso,
      imagen: imagen,
      descripcion: descripcion,
      ws: "json"
    }
  }).done(function(data) {
    // Montamos el resultado por resultado
    var resultado = "<div id='trozo' class='final'>";
    $.each(data.imagen_piso, function(i, item){
      // No es la mejor forma, pero vale para enterarnos
      resultado += "<img src='/img_pisos/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
      resultado += "<div id='formularios_img'>";
      resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden-1)+", "+item.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<a href='javascript:cambiaorden("+data.idpiso+", '"+item.imagen+"', "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>";
      resultado += "<a href='javascript:borraimagen("+data.idpiso+", '"+item.imagen+"', '"+item.descripcion+"')' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<div id='clear'></div>";
      resultado += "</div>";
    });
    resultado += "</div>";
    // Lo pintamos
    $(".imagenes_piso").html(resultado);
  }).fail(function(data){
    // Si hay error lo mostramos que sino se pone nervioso
    resultado += "<h1>Lo sentimos</h1><p><strong>Ha habido un error</strong> borrando la imagen de nuestro servidor.</p>";
    resultado += "<p>Por favor, pongase <a href='mailto:soporte-web@uva.es?Subject=Error cambiando orden de fichero'>en contacto con el administrador</a> indicando el procedimiento que ha seguido para reproducir el problema.</p>";
    $(".imagenes_piso").html(resultado);
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
