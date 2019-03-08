# Documentacion de los Javascript

Aqui se encuentran los ficheros Javascript de la aplicacion. Seguramente hay cosas que sobran ya que no esta hecha la limpieza de turno.

Cada JS tiene un monton de comentarios que explican que se va haciendo en cada momento. Mas simple que un chupete.

## /COMPONENTS

En esta carpeta se encuentran todos los componentes en React usados (que en si son pocos). En principio puede verse los componentes en React para desarrollo, los de explotacion (babellizados y polyfilleados) estan en una carpeta dentro llamada "production".

En principio y por "normativa", todos los JS que pertenecen a un componente acaba con la palabra "component".

Hay que recordar que las de produccion y las de desarrollo son diferentes. Las de produccion son "lentas" y solo compatibles con ES6 y amigos.

### addPisoComponent.js

Componente para la logica de cuando se añade un piso. Este proceso se hace en 3 pasos:

1. Añadir datos basicos del piso/inmueble
2. Añadir lo que valen las habitaciones
3. Añadir las imagenes

Por eso este componente en realidad son 5 componentes juntos que se pasan estados entre ellos.

Ademas, los datos del piso/inmueble, aunque se puede refactorizar a Redux, se meten en un objeto que tiene scope de navegador. Tambien se usa esto porque al subir ficheros y tener que jugar con el binario de este, React se hacia un poco de "lio" y habia que hacerlo con un objeto que no pase por React.

Organizacion:

```
Pasador -> Breadcrumb
        -> Paso 1
        -> Paso 2
        -> Paso 3
```

Pasador es el componente padre que carga (fetchea) todo lo necesario para el resto cuando se monta y lo almacena en el objeto "datos". Tambien el componente padre es el encargado de mostrar/ocultar cada uno de los componentes hijos, es decir, cada paso segun sea necesario. Esta parte se puede optimizar mucho mas.

El padre, en la carga, comprueba si le enviamos un ID de inmueble y, si lo tiene, rellena el objeto "datos" con lo necesario (en el componentWillMount) asi rellena todos los pasos. Esto se usa para editar.

Breadcrumb, como su nombre indica es el componente que le indica al usuario en que paso esta del proceso. Mas simple que un chupete.

Paso 1, este componente hijo sirve para almacenar en el objeto todos los datos basicos (direccion, que tiene -extras- si esta libre u ocupado, contacto...) y hace las pertinentes comprobaciones de que todo es correcto (primero el form del HTML y luego el JS). Los botones de pasar al siguiente se activan si y solo si ha metido lo minimo necesario.

Paso 2, este componente hijo sirve para guardar en el objeto un array con los dineros y que es.

¡Cuando se pasa del paso 2 al paso 3 se almacena todo el contenido en la base de datos! (y se genera un ID). Este ID sirve no solo para retroceder sino para cuando edita el contenido el usuario o el admin.

Paso 3, componente hijo de las imagenes que tiene su bollo. Debido a que el React no se lleva muy bien con los binarios en la version 16 el binario del fichero se almacena en el objeto principal (datos) y se pasa solo lo necesario a este componente. Luego hace algunas cositas bonitas de arratrar y soltar imagenes y tal, y poco mas. Tambien se encarga de consultar cuantas imagenes tiene el inmueble por el ID para mostrarlas y tal. En el fondo es muy simple.

### barriosCiudadesComponent.js

Este componente es usado en la portada y sirve para el elemento que te muestra los barrios y ciudades que tienen inmuebles en un cacharro con un tab. Es megahipersimple.

### busquedasComponent.js

Componente sencillo que simplemente usa la barra de busqueda, lo lanza contra un ws y este le escupe los resultados que pinta. Tiene una paginacion chorraca, pone bonito cuando escribes mal (el ws comprueba lo escrito y te ayuda a escribirlo bien, ese es el mejunje de esto) e imagenes del capitan kirk cuando algo va mal (ni se os ocurra tocarlas u os muerdo).

### slideshowComponent.js

Componente que saca el slideshow de la portada. Consulta el ws en cuestion que le responde lo que necesita nada mas. Obviamente, al usar slick como slideshow (http://kenwheeler.github.io/slick/) al final hay que meter JQuery ahi.

Existe un slick para React como modulo externo y tal, pero como no esta hecho con el create-react-app en node sino, como siempre se ha hecho en esta casa todo, es "complicado" dicha incorporacion (en el sentido que haria falta algo aparte para tocarlo y no es plan). Esto es para el futuro (quien sea que se encarge de esto).

### ultimos6pisosComponent.js

Componente que saca los ultimos 6 pisos subidos en la plataforma de forma basica. Es un elemento de la pagina de entrada principal de la aplicacion.

## /COMPONENTS/PRODUCTION

Las mismas que en desarrollo pero pasadas por Babel y minimizadas. Aqui estan las versiones compatibles con todos los navegadores.

## /SW

Aqui esta y deberia estar todo lo relacionado con el service worker.

### service-worker.js

El basico del service worker... este hay que desarrollarlo del todo, ahora mismo no hace nada porque ni esta en HTTPS (se deberia) como que no hace absolutamente nada (ni coge fetchs ni guarda en caches ni nada). Aqui hay un interesante mundo que descubrir.

## app.js

Foundation suele poner este fichero JS como "fichero principal" donde se coloca toda la logica de la aplicacion. Aqui hay algun javascript tonto, como el arranque de la slick y un par de funciones tontas usadas como el cambio de tab de la portada, el antiguo de añadir precios (v2 de la herramienta), subir comentarios... esas cosas... la mayoria son de la v2 y en la v2.5 no se usan y se puede limpiar.

## ficheros.js

En principio este ya no se usa, que era de la v1 y la v2 en JQuery para el uso y disfrute de cosas con los ficheros.

## highcharts-more.js highcharts.js highcharts.src.js (https://www.highcharts.com/)

Libreria para la zona de documentacion que hace graficos y pinta. La documentacion de su sitio web te dira todo.

## jquery-*

Pues nada, todo el JQuery aunque en la v2.5 se caga "online", vamos que no se lee el aqui metido.

## selectToUISlider.JQuery.js

Otra cosa que no se usa. El antiguo (antiguo, antiguo, de la v1) slideshow.

## slick.js (http://kenwheeler.github.io/slick/)

Libreria slick del slideshow, necesario JQuery para que el funcione. Su documentacion es DIOS.

## slider_extras.js

Sobra, completamente. Aqui era el intento de, si se intentaba montar un slideshow a mano sin usar slick o cualquier otra libreria el meterlo... pero esta pa-ra-do.

## upload.js

Antiguo JS para el upload. No usado. Se puede borrar. De hecho el contenido tiene pinta que no lo he hecho yo.
