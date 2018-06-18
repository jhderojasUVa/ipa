function subeimagen() {
  // Funcion que sube la imagen en cuestion

  // La respuesta, siempre vacia (manias)
  var resultado = "";

  // Cambiamos el boton para que aparezca el icono de que esta subiendo
  //$("input[name='add_imagen']").val("Subir imagen y añadir otra");
  $("#upload_file").submit(function(e){

    // Eliminamos que haga el submit el formulario
    e.preventDefault();

    // Creamos la variable de los datos del formulario
    var datos = new FormData();

    // Los valores que necesitamos, el idpiso y la descripcion
    var idpiso = $("input[name='idpiso']").val();
    var descripcion = $("input[name='descripcion']").val();

    // Creamos los datos de envio
    datos.append("idpiso", idpiso);
    datos.append("descripcion", descripcion);
    datos.append("ws", "json");
    // Pillamos el fichero, lo dejamos para si "hay mas" que nunca se sabe (subida multiple)
    jQuery.each(jQuery("input[name='upload']")[0].files, function (i, file) {
      datos.append("upload", file);
    });

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
        resultado += "<div style='width:140px; margin: 0 0.5em; float: left;'>";
        resultado += "<img src='/img_pisos/"+item.idpiso+"/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
        resultado += "<div id='formularios_img'>";
        resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden-1)+", "+item.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>&nbsp;";
        resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>&nbsp;";
        resultado += "<a href='javascript:borraimagen("+item.idpiso+", \""+item.imagen+"\", \""+item.descripcion+"\")' class='button' role='link'><i class='fi-x'></i></a>";
        resultado += "</div>";
        resultado += "</div>";
      });
      resultado += "</div>"; // El div del cierre porque esta a la vieja usanza
      // Dejamos el formulario como antes
      $("label[for=upload]").html("Seleccione el fichero");
      $("label[for=upload]").removeClass("success");
      $("input[name='add_imagen']").val("Subir imagen y añadir otra");
      $("input[name='descripcion']").val("");
      // Añadimos que se ha subido con exito
      $(".nombre_fichero_upload").html("<p style=\"background-color: #a5e8ae; font-weight: bold;\">Fichero subido con exito</p>");
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
    method: "POST",
    type: "POST",
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
      resultado += "<div style='width:140px; margin: 0 0.5em; float: left;'>";
      resultado += "<img src='/img_pisos/"+item.idpiso+"/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
      resultado += "<div id='formularios_img'>";
      resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden-1)+", "+item.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>&nbsp;";
      resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>&nbsp;";
      resultado += "<a href='javascript:borraimagen("+item.idpiso+", \""+item.imagen+"\", \""+item.descripcion+"\")' class='button' role='link'><i class='fi-x'></i></a>";
      resultado += "</div>";
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
    method: "POST",
    type: "POST",
    data: {
      idpiso: idpiso,
      imagen_borrar: imagen,
      descripcion_borrar: descripcion,
      ws: "json"
    }
  }).done(function(data) {
    // Montamos el resultado por resultado
    console.log(data);
    var resultado = "<div id='trozo' class='final'>";
    $.each(data.imagenes_piso, function(i, item){
      // No es la mejor forma, pero vale para enterarnos
      resultado += "<div style='width:140px; margin: 0 0.5em; float: left;'>";
      resultado += "<img src='/img_pisos/"+item.idpiso+"/"+item.imagen+"' alt='"+item.descripcion+"' width='130' class='imagenes' /><br /><center><em><p>"+item.descripcion+"</p></em><br /></center>";
      resultado += "<div id='formularios_img'>";
      resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden-1)+", "+item.orden+")' class='button' role='link'><i class='fi-arrow-left'></i></a>&nbsp;";
      resultado += "<a href='javascript:cambiaorden("+item.idpiso+", \""+item.imagen+"\", "+(item.orden+1)+", "+item.orden+")'  class='button' role='link'><i class='fi-arrow-right'></i></a>&nbsp;";
      resultado += "<a href='javascript:borraimagen("+item.idpiso+", \""+item.imagen+"\", \""+item.descripcion+"\")' class='button' role='link'><i class='fi-x'></i></a>";
      resultado += "</div>";
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
