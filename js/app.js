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
});

$(document).foundation(function(){

});

function cambia_tab(tab) {
  // Ocultamos todos
  $(".opciones .barrios ul li").hide();
  $(".opciones .ciudades ul li").hide();
  // Mostramos la que necesitamos
  $(".opciones ."+tab+" ul li").show();
}

function addprecio(idpiso, precio, contenido) {
  // Funcion que añade un precio a un piso
  $.ajax({
    url: "/index.php/pisos/addpiso2",
    data: {
      id: idpiso,
      precio: precio,
      descripcion: contenido,
      ws: "json"
    }
  }).done(function(data) {
    for (var i=0; i<=data.lenght; i++) {
      resultado .= "<div class='small-4 cell'>"+data[i].precio+"</div><div class='small-6 cell'>"+data[i].descripcion+"</div>";
      resultdao .= "<div class='small-2 cell'><a href='javascript:borraprecio("+data[i].idpiso, data[i].precio, data[i].descripcion")'>><i class='fi-x'></i></a></div>";
    }
    $(".precios_piso .precios").html(resultado);
  });
}

function borraprecio(idpiso, precio, contenido) {
  // Funcion que borra un precio a un piso
  $.ajax({
    url: "/index.php/pisos/borra_precio",
    data: {
      id: idpiso,
      precio: precio,
      descripcion: contenido,
      ws: "json"
    }
  }).done(function(data) {
    for (var i=0; i<=data.lenght; i++) {
      resultado .= "<div class='small-4 cell'>"+data[i].precio+"</div><div class='small-6 cell'>"+data[i].descripcion+"</div>";
      resultdao .= "<div class='small-2 cell'><a href='javascript:borraprecio("+data[i].idpiso, data[i].precio, data[i].descripcion")'>><i class='fi-x'></i></a></div>";
    }
    $(".precios_piso .precios").html(resultado);
  });
}
