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
