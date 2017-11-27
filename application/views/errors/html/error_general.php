<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IPA Información de Pisos en Alquiler. Universidad de Valladolid</title>
  <link rel="stylesheet" href="/css/foundation.css">
  <link rel="stylesheet" href="/css/foundation-icons/foundation-icons.css">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/slick-theme.css">
</head>
<body>
  <!-- header -->
  <div class="cabecera">
    <div class="grid-container">
      <div class="grid-x grid-margin-x">
        <div class="top-bar-right">
          <ul class="menu simple">
            <li class="menu-text"><img src="http://<?=$_SERVER['SERVER_NAME']?>/img/Secundaria_Roja.jpg" alt="Universidad de Valladolid" width="30">&nbsp;&nbsp;IPA UVa</li>
            <li class="superior"><a href="http://<?=$_SERVER['SERVER_NAME']?>"><i class="fi-home"></i>&nbsp;&nbsp;Home</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="grid-container error">
    <div class="grid-y">
      <div class="cell">
        <h1 class="text-center">? <?=$status_code?></h1>
      </div>
      <div class="cell">
        <p><strong>Lo sentimos</strong> ha ocurrido un error.</p>
        <p>Seguramente sea culpa nuestra, pero no te preocupes porque lo estamos teniendo en cuenta y vamos a trabajar en solucionarlo.</p>
				<p><strong>Error</strong>: <?=$message ?></p>
        <p>Aun con todo eso, si necesitas ayuda puedes usar nuestro buscador o <a href="mailto:ipa.asuntos.sociales@uva.es?subject=Error en la web">enviarnos un correo</a> indicandonos el problema que has encontrado y que es lo que querias realizar.</p>
      </div>
      <div class="cell">
        <form action="busquedas.html">
          <div class="grid-x">
            <div class="medium-12 cell">
              <div class="input-group">
                <input class="input-group-field" type="search" placeholder="Pruebe a buscar dentro de IPA">
                <div class="input-group-button">
                  <input type="submit" class="button" value="Buscar">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- footer -->
  <footer>
    <div class="grid-container full">
      <div class="grid-x grid-margin-x">
        <div class="medium-4 small-12 cell">
          <center>
            <img src="/img/Secundaria_Roja.jpg" width="100" alt="Universidad de Valladolid">
            <h3>Servicio de Asuntos Sociales</h3>
            <p>
              <small>
                <span class="direccion">Casa del Estudiante, Real de Burgos s/n<br/>
                  47011 Valladolid<br/>
                <i class="fi-telephone"></i> Tlf <a href="tel://+34983174099">+34 983 184 099</a><br/>
                <i class="fi-telephone"></i> Fax <a href="tel://+34983423251">+34 983 423 251</a><br/>
                <i class="fi-mail"></i> <a href="mailto: ipa.asuntos.sociales@uva.es">ipa.asuntos.sociales@uva.es</a><br>
                <a href="http://www.uva.es/sas" target="_blank">www.uva.es/sas</a>
              </span>
            </p>
            </small>
          </center>
        </div>
        <div class="medium-3  small-12 cell">
          <h3 class="headline">Manual</h3>
          <p><a href="http://ipa.uva.es/css/IPA.pdf">Descargate el manual de la aplicación [PDF]</a>.</p>
          <h3 class="headline">Buscar</h3>
          <p><a href="http://ipa.uva.es/index.php/buscar/busquedas">Usa nuestro buscador para encontrar tu piso o habitación ideal</a>.</p>
        </div>
        <div class="medium-3 medium-offset-1 small-12 cell">
          <h3 class="headline">Somos sociales</h3>
          <p>
            <ul>
              <li><a href="#"><i class="fi-social-twitter"></i>&nbsp;&nbsp;Twitter de Asuntos Sociales</a></li>
              <li><a href="#"><i class="fi-social-twitter"></i>&nbsp;&nbsp;Twitter de la UVa</a></li>
              <li><a href="#"><i class="fi-social-facebook"></i>&nbsp;&nbsp;Facebook de la UVa</a></li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/what-input.js"></script>
  <script src="js/vendor/foundation.js"></script>
  <script src="js/slick.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
