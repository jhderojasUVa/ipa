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

## CARPETA RAIZ

Contenido de la carpeta raiz de las vistas. Los ficheros no nombrados normalmente no se usan y son pruebas tontas.

### BUSCAR.PHP

Fichero/Vista de contenido de la apliacacion. En el se muestra las busquedas que realice el usuario. Por ello se muestra una barra de busqueda y el web component busquedasComponent.js (ya sea en desarrollo o en produccion).

### CABECERA.PHP

Vista que muestra el logotipo de identificacion de la aplicacion, los CSS necesarios para toda la aplicacion y los ficheros javascript comunes para toda la aplicacion. Tambien esta añadido el service worker por si se necesita. Este no esta desarrollado aun y presenta funcionalidad basica (es decir, nada).

Ademas, esta vista crea el menu de la aplicacion que cambia segun el usuario identificado.

### ENCONTRADOS.PHP

Vista que pinta los elementos encontrados. Esta vista usa el antiguo metodo en el que el controlador del pasa la mandanga a la vista y, por lo tanto, ya no se usa. Pero por si acaso es bueno dejarla ahi.

### ERROR_PERMISOS.PHP

Vista para cuando alguien intenta hacer algo que no tiene permitido. Es decir, existe un nivel "de ACLs" en la cual, solo los miembros UVa tienen acceso total a la plataforma (insertar alojamientos y ver los alojamientos de todo el mundo, es decir, interactuar) mientras que los miembros no UVa solo pueden obtener informacion de su inmueble y responder a los comentarios del mismo.

Si alguien sin ese tipo de permisos hace algo que no puede hacer, se le muestra esta vista o si intenta acceder directamente a alguna pagina sin registrarse... esas cosas.

### FOOTER.PHP

Debido a que la cabecera y el pie es "igual" en todas las paginas, aqui se puede encontrar dicho pie. Ni mas ni menos.

### INDEX.PHP

Es la frontpage (o la parte central) del sitio. Aqui se puede encontrar un slideshow, la barra de buscar, los ultimos pisos añadidos... todo via web components. Aun hay alguna cosa en JQuery que deberia ser refactorizada si o si. Vamos, el carousel, el slideshow aun tiene reminiscencias de JQuery en el React y eso... eso es muy malo (kk del culo).

### PRODUCTO.PHP

Vista que muestra los datos de un inmueble concreto. No todo hay que hacerlo con web components, en serio. Asi que esta parte sigue a la vieja usanza, renderizada por el PHP a HTML. ¿Se podria hacer un componente?, seguramente y no seria nada complicado, sinceramente. Habria que calcular el tiempo que tarda en cargar en paralelo (no me gusta el defer, no lo niego) el HTML, el componente y las peticiones REST al servidor... quizas compense. Para una proxima refactorizacion (si se hace).

### RSS.PHP

Puede sonar raro, pero se planteo la posiblidad de unas RSS donde se mostraran los ultimos pisos para que los clientes estuvieran enterados. Más tarde, por las ACLs se "desecho", pero eso no indica que algo no se pueda hacer (salvo el problema de autentificarte para ver unas RSS que seria una penuria para el usuario y que no hay cliente que lo soporte). Esta vista y este "producto" necesitaria mas vueltas.

### SLIDESHOW.PHP

Otra reminiscencia del pasado. Aqui esta la configuracion del slick, el slideshow usado. No es mas que el JS de la configuracion del slick. ¿Se usa ahora?. No.

## /AJAX

En esta carpeta estan las minivistas en PHP cuando este "respondia HTML". Vamos, la forma vieja no, lo siguiente, de hacer las cosas.

### PISO.PHP

Cambia "el boton", el aspecto de ocupado a libre.

### USUARIO.PHP

En principio esto es cuando meten un comentario a un alojamiento.

## /DOC

Las vistas de la zona de gestion, de administacion, de la herramienta. Aqui todo va junto, cabecera, pie, contenido... y esta un poco "guarro". Hay que cuidar y darle mucho cariño a esta zona.

Como el administrador es un usuario UVa hay un truco muy malo. Cualquier busqueda en la cual haya que modificar un piso no tiene vistas, pasa por las vistas de la aplicacion, que como usuario UVa y administrador, podra meter mano ahi (por si ha de cambiar un dato, una cifra, esas cosas...).

### BUSCAR.PHP

Resultados de la busqueda, ahi, a porron. De las busquedas que duelen. ¿Que busquedas? Todas.

### COMENTARIOS.PHP

Toda la gestion de comentarios esta aqui, es decir, los nuevos, los viejos, las busquedas, borrar, esas cosas. Para editar hay una vista aparte.

### CORREO.PHP

Una vista que ayuda al admin a hacer un envio masivo de correos segun ciertas cosas: gente UVa, gente no UVa, todos o un usuario concreto. Ya se sabe. Asunto, texto y patapum.

### DATOS_USUARIO.PHP

Aqui es donde se pueden ver todas las cosas de un usuario (la ficha) y un acceso a los pisos que tiene para "darles vidilla".

### EDITAR_COMENTARIO.PHP

Como su nombre indica, para editar un comentario... que los niños se les va la cabeza y a veces hay que cortarles un poco.

### ESTADISTICAS.PHP

Esta vista mola un monton. Un "modulo" basico para crear ciertas estadisticas (requiere mucho amor, en el sentido de que hay que continuarlo). Permite saber usuarios/tipos de usuarios/pisos creados/borrados/totales... vamos, bastantes cosas. Saca grafiquitos bonitos a fin de que se puedan poner en informes para los jefes.

### INDEX.PHP

Vista de entrada de administracion. Como siempre, cuando entre un usuario hay que mostrarle un resumen de todo lo que hay. Usuarios nuevos sin validar, pisos nuevos sin validar, comentarios nuevos si hay... lo normal. Aparte de instrucciones por si hay alguna actualizacion o cosas que tenga que hacer si o si.

### USUARIOS.PHP

Vista de usuarios generica. Se muestra un resumen de los nuevos usuarios sin validar para que se puedan ver y realizar acciones con ellos. Ademas un buscador de usuarios y el acceso al sistema de envio masivo de correos de la plataforma.

## /ERRORS

Paginas de error. Ni mas ni menos. Poco hay que explicar aqui, sinceramente por lo que no nos vamos a entretener.

## /MIS

Vistas de cuando un usuario esta autentificado, de su "zona personal". Aqui esta el cogollo de la aplicacion. Las que no se comentan estan "depreciated" de la v2 a la v2.5.

### ADD.PHP

Vista de cuando se añade un piso y tira de un web component. Aqui van las 3 fases (en el componente, obviamente) de añadir un inmueble.

### MISCOMENTARIOS.PHP

Vista que muestra los comentarios realizados y el inmueble.

### MIS_DATOS.PHP y MIS_DATOS_OK.PHP

Un par de vistas para que el usuario pueda cambiar ciertas cosas de su perfil (principalmente el password).

### MISPISOS.PHP

Vista que saca una lista de los inmuebles que ha metido en la plataforma ademas de algun texto que le dice como hay que hacer las cosas o el tema de cuando esta apobado o no un inmueble.

## /USER

Aqui se encuentra toda la parte de entrada/salida/recuperar del tema de los usuarios (por eso se llama user). En principio se iba a isolarizar cada parte, pero luego pense... bahhh... tampoco hay que hacer cosas tan liosas y mira... a medio camino.

### ADD.PHP

Vista con un formulario tocho para añadir un usuario y sus comprobaciones. Recordad que hay doble comprobacion, en cliente (web browser) y en servidor (el php es tu amigo).

### LOGIN.PHP

Vista con el doble login (o por SSO o por la herramienta) y el poder añadirte como usuario, vamos darte de alta.

### RECUPERAR.PHP

Pues, obviamente, para recuperar la contreaseña. Nada mas.
