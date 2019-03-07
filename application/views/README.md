# Documentacion de las vistas

Actualmente realizado en Foundation (con la version mas reciente de la documentacion, Foundation 6).

Las vistas se dividen en 3 tipos principales:

- Vistas de la aplicacion
- Vistas del usuario identificado
- Vistas del administrador

A su vez existen vistas de errores y de elementos generados por ajax.

Las vistas de la aplicacion, a su vez, se dividen en 3 partes. Es decir, el HTML que ve el usuario se divide en 3:

- cabecera.php: la cabecera con el menu generado dinamicamente
- contenido: este fichero varia y es el que soporta o los controladores (principalmente) o los componentes web (v2.5)
- footer.php: el pie de la pagina

## BUSCAR.PHP

Fichero/Vista de contenido de la apliacacion. En el se muestra las busquedas que realice el usuario. Por ello se muestra una barra de busqueda y el web component busquedasComponent.js (ya sea en desarrollo o en produccion).

## CABECERA.PHP

Vista que muestra el logotipo de identificacion de la aplicacion, los CSS necesarios para toda la aplicacion y los ficheros javascript comunes para toda la aplicacion. Tambien esta añadido el service worker por si se necesita. Este no esta desarrollado aun y presenta funcionalidad basica (es decir, nada).

Ademas, esta vista crea el menu de la aplicacion que cambia segun el usuario identificado.
