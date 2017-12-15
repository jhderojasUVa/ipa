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

  cambia_tab("barrios");
  listener_upload();
  $("#upload_file").on("submit", subeimagen());
});

function cambia_tab(tab) {
  // Ocultamos todos
  $(".opciones .barrios ul li").hide();
  $(".opciones .ciudades ul li").hide();
  // Mostramos la que necesitamos
  $(".opciones ."+tab+" ul li").show();
}

function pre_addprecio() {
  var idpiso = $("input[name='idpiso']").val();
  var precio = $("input[name='precio']").val();
  var contenido = $("input[name='descripcion']").val();
  addprecio(idpiso, precio, contenido);
}

function addprecio(idpiso, precio, contenido) {
  var resultado = "";
  // Funcion que añade un precio a un piso
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
    $(".precios").html("<h2>Lo sentimos</h2><p><strong>Ha habido un problema al añadir el precio</strong>. Por favor vuelva a intentarlo y si no funciona, pongase en contacto con el administrador.");
  });
}

function borraprecio(idpiso, precio, contenido, ok) {
  var resultado = "";
  // Funcion que borra un precio a un piso
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
    $(".precios").html("<h2>Lo sentimos</h2><p><strong>Ha habido un problema al borrar el precio</strong>. Por favor vuelva a intentarlo y si no funciona, pongase en contacto con el administrador.");
  });
}

function subeimagen() {
  // Function que sube una imagen
  // Cogemos las variables
  var idpiso = $("input[name='idpiso']").val();
  var fichero_imagen = $("input[name='upload']").val();
  var descripcion = $("input[name='descripcion']").val();
  // Paramos la propagacion y el evento del submit
  event.stopPropagation();
  event.preventDefault();
  // Cambiamos el boton a que se esta haciendo
  $("input[name='add_imagen']").val("Subiendo imagen <i class='fi-loop'></i>");
  $.ajax({
    url: "/index.php/pisos/addpiso3",
    method: "POST",
    data: {
      idpiso: idpiso,
      imagen: fichero_imagen,
      descripcion: descripcion,
      ws: "json"
    }
  }).done(function(data){
    console.log(data);
    var resultado = "";
    $.each(data.imagenes_piso, function(i, item) {
      resultado += "";
    });
    $(".imagenes_piso").html(resultado);
    // Lo dejamos como antes el formulario
    $("label[for=upload]").html("Seleccione el fichero");
    $("label[for=upload]").removeClass("success");
    $("input[name='add_imagen']").val("Subir imagen y añadir otra");
    // Añadimos que se ha subido con exito
    $(".nombre_fichero_upload").html("<p><i class='fi-ok'></i> Fichero subido con exito</p>");
  }).fail(function(data){
    alert("Lo sentimos.\r\nHa ocurrido un error.");
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
    var resultado = "<div id='trozo' class='final'>";
    for (var i=0; i<=data.lenght; i++) {
      // Montamos el resultado
      resultado += "";
    }
    resultado += "</div>";
    // Lo pintamos
    $(".imagenes_piso").html(resultado);
  }).fail(function(data){
    // Si hay error lo mostramos
    $(".imagenes_piso").html("<h1>Lo sentimos</h1><p><strong>Ha habido un error</strong> cambiando el orden de las imagenes.</p>");
  });
}

function borraimagen(idpiso, imagen, descripcion) {
  // Funcion que borra una imagen
  var resultado;
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
    for (var i=0; i<=data.lenght; i++) {
      // No es la mejor forma, pero vale para enterarnos
      resultado += "<img src='<?=base_url()?>img_pisos/"+data[i].imagen+"' alt='"+data[i].descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+data[i].descripcion+"</p></em><br /></center>";
      resultado += "<div id='formularios_img'>";
      resultado += "<a href='javascript:cambiaorden("+data[i].idpiso+", '"+data[i].imagen+"', "+(data[i].orden-1)+", "+data[i].orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<a href='javascript:cambiaorden("+data[i].idpiso+", '"+data[i].imagen+"', "+(data[i].orden+1)+", "+data[i].orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>";
      resultado += "<a href='javascript:borraimagen("+data[i].idpiso+", '"+data[i].imagen+"', '"+data[i].descripcion+"')' class='button' role='link'><i class='fi-arrow-left'></i></a>";
      resultado += "<div id='clear'></div>";
      resultado += "</div>";
    }
    resultado += "</div>";
    // Lo pintamos
    $(".imagenes_piso").html(resultado);
  }).fail(function(data){
    // Si hay error lo mostramos
    $(".imagenes_piso").html("<h1>Lo sentimos</h1><p><strong>Ha habido un error</strong> borrando la imagen de nuestro servidor.</p>");
  });
}

function listener_upload() {
  // Funcion que mira si el upload cambia para poner el nombre en el label
  // Buscamos el elemento y añadimos el listener
  $("#upload").change(function() {
    // Hacemos el cambio del texto y de formato en el label
    $("label[for=upload]").html("<i class='fi-check'></i> Fichero a&ntilde;adido");
    $("label[for=upload]").css("color","white");
    $("label[for=upload]").addClass("success");
    $(".nombre_fichero_upload").html("<p><strong>Fichero</strong>: <small>"+this.files[0].name+"</small></p>");
  });
}
