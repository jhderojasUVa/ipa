# Documentacion de los controladores de CONTROLLERS

Este documento relata los metodos de los diferentes controladores de la carpeta raiz de CONTROLLERS. Privienen de la version 1, version 2 y version 2.5. En la version 2.5 muchos de ellos han dejado de ser utiles ya que se han pasado a los controladores de la carpeta COMPONENTS. Aun con eso, en el desarrollo se han intentado re utilizar los maximos posibles por compatibilidad.

## BUSCAR.PHP

Este controlador tiene los metodos usados, antiguamente, por la funcion de busqueda del backend. En la version 2.5 se ha pasado "todo" al front, por lo que muchos estan en deshuso.

### function refinar($ws = null)

Este metodo sirve para refinar las busquedas que ya se hayan realizado. Es decir, sirve para filtrar de forma exhaustiva una busqueda.

- ENTRADA (POST/GET)

El post/get se hace a la vieja usanza, se puede refactorizar usando post_get, que es mucho mejor.

q: la query (string)
cp: codigo postal (number)
loc: la ciudad (number)
rango: rango de precios a buscar (number-number)
per_page: elementos por pagina (number) Para paginacion de resultados
pagina_llego: pagina que estamos visualizando (number) Para paginacion de resultados
ws: string (json). Si se envia, el resultado se envia en JSON.

- DEVUELVE

Si no se ha definido el parametro **ws** se envia para la vista, en caso contrario se envia en JSON sin pasar por la vista.

q: la query (string)
cp: codigo postal (number)
loc: la ciudad (number)
rango: rango de precios a buscar (number-number)
per_page: elementos por pagina (number) Para paginacion de resultados
pagina_llego: pagina que estamos visualizando (number) Para paginacion de resultados
ciudades: las ciudades (array)

## DOC.PHP

Este controlador tiene todas las funciones/metodos usados en la trastienda de la aplicacion. Es decir, cuando un administrador se logea en la aplicacion usara, mayoritariamente, este controlador.

Ademas, este controlador tiene las funciones/metodos usados para el paso entre versiones. Para el paso de la version 1 a 2 (donde hubo cambios en la estructura de ficheros y archivos de almacenaje de imagenes) y de la 2 a la 2.5 (donde ha habido cambios en la base de datos).

En todos los controladores se comprueba si quien lo ve esta registrado como administrador por una cookie doble (servidor/cliente). La forma de hacerlo es a traves del SSO y su identificacion y la cookie almacenada en el navegador.

### function delspam()

Metodo que borra un comentario que alguien lo ha marcado como spam o se ha quejado de el.

- ENTRADA (GET)

idspam: id del comentario a borrar (number)

- SALIDA

La vista de entrada (index) con las denuncias realizadas

### function del_comentario()

Metodo que elimina un comentario en concreto de la plataforma. Se llama desde la vista de comentarios, principalmente.

- ENTRADA  (GET)

id: id del comentario (number)
q: query de busqueda de comentarios (string)

- SALIDA

La vista de los comentarios.

### function edit_comentario()

Metodo para la edicion de un comentario en concreto. El administrador puede editar el texto de un comentario para... ya sabes... suele venir de una busqueda de comentarios.

- ENTRADA (POST aunque admite GET pero no funciona)

id: identificador del comentario (number)
q: query de busqueda de comentarios (string)
textocomentario: texto nuevo del comentario (string)

- SALIDA

La vista de editar un comentario.

### function noespam()

Metodo que elimina un comentario del spam. Vamos le quita de la tabla de SPAM porque no lo es. Esto vale para falsas acusaciones.

- ENTRADA (GET)

id: id del comentario (number)
us: usuario que ha marcado otro como spam (string)

- SALIDA

La vista generica de los comentarios.

### function borrapiso()

Metodo que elimina un piso de la plataforma. No borra el directorio de las imagenes, por si acaso. En un futuro, si todo es correcto y no hace falta se podria cepillar.

- ENTRADA (GET)

id: id del piso (number)
ok: siempre por si acaso, doble comprobacion true/false (boolean)

- SALIDA

La vista de base de la administracion o IPA.

### function buscar()

Metodo de busqueda en IPA bastante basico y que devuelve mucha miga, pero mas optimo para los administradores (o no). Esta funcion/metodo y vista requieren mucho cariño que habra que darlo mas adelante.

- ENTRADA (POST)

q: la query (string)

- SALIDA

La vista que pone los pisos uno tras otro para verlos.

### function buscar_todos()

Como el anterior (buscar()), salvo que las busquedas devuelven más cosas. Devuelve ahi, todos a lo loco, sin filtrar.

- ENTRADA (POST)

q: la query (string)

- SALIDA

La vista que pone los pisos uno tras otro para verlos.

### function buscar_ocupados()

Como el anterior (buscar()), salvo que las busquedas devuelven más cosas. En esta ocasion solo devuelve los ocupados (libre = false).

- ENTRADA (POST)

q: la query (string)

- SALIDA

La vista que pone los pisos uno tras otro para verlos.

### function borrar_imagen()

Metodo que borra una imagen. Realmente no se usa porque como el administrador puede entrar a editar los pisos como el usuario sin problema, simplemente, cuando llegue a las imagenes, que las borre. Por eso esta vacio, que nunca se sabe.

### activar_user()

Metodo que activa los usuarios que no son UVa. Es decir, los usuarios externos que se dan de alta para meter sus inmuebles necesitan ser aprovados (que hay mucha inmobiliaria suelta). Aqui esta el metodo.

Manda un correo al usuario activado indicando que ha sido activado para que lo sepa.

- ENTRADA (GET)

id: id del usuario a activar (number)

- SALIDA

La vista general.

### function borrar_user()

Metodo que elimina un usuario de la plataforma y todo su rastro (comentarios, denuncias, imagenes, pisos... vamos, lo deja como un erial).

- ENTRADA (GET)

id: id del usuario a borrar (number)

- SALIDA

La vista general.

### function editar_user()

Metodo que envia a la vista para la edicion de un usuario.

- ENTRADA (GET)

id: id del usuario (number)

- SALIDA

Vista donde se muestran todos los datos en un formulario (salvo el nombre que no se puede cambiar).

### function cambia_datos_usuario()

Metodo para cambiar los datos de un usuario concreto.

- ENTRADA (POST)

id: id del usuario (number)
nombre: (string)
apellidos: (string)
login: (string)
password: (string)
direccion: (string)
tlf: (string)
email: (string)
verificado: (boolean)

- SALIDA

Vista general de administracion.

### function validar_piso()

Metodo para validar un piso. Cuando un piso es insertado por un usuario NO UVa, el piso ha de ser validado para ver que esta todo correcto.

Cuando se valida, se le envia al usuario un correo indicando que el piso ya se ve en la plataforma.

- ENTRADA (GET)

id: id del piso (number)

- SALIDA

La vista general de administracion.


### function usuarios()

Metodo que busca y muestra los usuarios (buscados) o, si no se envia nada los usuarios no activados.

- ENTRADA (POST)

q: la query de busqueda de usuarios (string)

- SALIDA

La vista generica de los usuarios.

### function estadisticas()

Metodo que se encarga de sacar la vista de las estadisticas. Esta vista puede contener unos datos preciosos o sino, se mandan unos genericos.

- ENTRADA (POST)

diai: dia de inicio (number)
mesi: mes de inicio (number)
anoi: año de inicio (number)
diaf: dia de fin (number)
mesf: mes de fin (number)
anof: año de fin (number)

- SALIDA

Vista de las estadisticas.

### function mostrar_pisos_usuario()

Metodo que devuelve los pisos de un usuario concreto.

- ENTRADA (POST/GET)

id: id del usuario (number)

- SALIDA

Vista generica de la busqueda.

### function comentarios()

Metodo que busca y muestra los comentarios de la busqueda.

- ENTRADA (POST/GET)

q: query (string)

- SALIDA

Vista generica de los comentarios.

### function cambiartipo()

Metodo que cambia las cookies para que un administrador pueda ver la web como si fuera un usuario o viceversa.

- ENTRADA

Nada.

- SALIDA

Pagina web principal del sitio.

### function correomasivo()

Metodo para el envio de correos masivos desde la plataforma. Cuando se dice masivos significa a muchas personas.

- ENTRADA (POST)

enviado: si vuelve al controlador despues de enviar un correo (boolean)
gente: por si envia a personas concretas, el login (string)
asunto: (string)
texto: (string)
verificado: si envia a verificados o no (boolean)

- SALIDA

Vista del correo.

### function ver_pisos_uva()

Metodo que muestra los pisos de la gente de la UVa. No usado.

- ENTRADA

Nada.

- SALIDA

Nada.


### function ver_pisos_usuarios_uva()

Metodo que muestra los pisos de la gente de la UVa. Mejora del anterior. No usado.

- ENTRADA (GET)

idu: identificador del usuario

- SALIDA

Nada.

### function coloca_en_directorio()

Metodo de paso de la version 1 a 2. Este metodo coloca las imagenes en el directorio del identificador correspondiente. Es un poco burro, va mirando en el directorio (las imagenes tienen nombre unico en la BD), mira en la BD el identificador, crea el directorio (si es necesario) y lo mueve a el.

**Importante**: cambiar la variable $path que es el path donde estan guardadas las imagenes.

- ENTRADA

Nada

- SALIDA

Texto plano directo al navegador con lo que va haciendo

### function borra_imagenes_sin_duenyo()

Metodo que elimina las imagenes que no tienen piso asociado, es decir, que no estan en la base de datos de imagenes_piso.

- ENTRADA

Nada

- SALIDA

Texto plano de lo que va haciendo.

### FUNCIONES DE PASO DE LA VERSION 2 A LA 2.5

La primera hornada son para poner primary keys. En principio no deberia hacer falta, pero un compañero insistio en que hay que poner a todas las tablas primary key. Aun con eso, yo sigo pensando que no haria falta porque me recuerda al fallo que tienen los primerizos cuando usan Access (jet database system) poniendo primary keys como si no hubiera mañana para donde no hace falta.

### function imagen_sin_id()

Metodo que revisa si hay imagenes sin id en el directorio y las elimina.

**Importante**: cambiar la variable $path que es el path donde estan guardadas las imagenes.

### function repara_order_imagenes()

Metodo que repara la tabla de imagenes_piso para poder poner como primary key el id y el orden. Busca ordenes mal puesto y los recoloca.

El texto de salida es del metodo, una mierda si y hay que cambiarlo.

- ENTRADA

Nada

- SALIDA

Texto plano de lo que va haciendo.

### function add_id_precios()

Metodo que cambia la tabla de precios añadiendola un id para que sea primary key.

El texto de salida es del metodo, una mierda si y hay que cambiarlo.

- ENTRADA

Nada

- SALIDA

Texto plano de lo que va haciendo.

### function repara_add_id_denuncias()

Metodo que añade un id para el primary key a la tabla de denuncias.

El texto de salida es del metodo, una mierda si y hay que cambiarlo.

- ENTRADA

Nada

- SALIDA

Texto plano de lo que va haciendo.

## MIS.PHP

Controlador que se usa cuando un usuario entra en su zona particular en la web.

### function mispisos()

Metodo que devuelve un listado con los pisos del usuario. Deja un log en los log indicando que ha entrado por seguridad.

- ENTRADA

Nada

- SALIDA

La vista donde se muestra un listado de los pisos del usuario.

### function miscomentarios()

Metodo que devuelve los comentarios del usuario (que ha realizado) para que tenga constancia de ellos.

- ENTRADA

Nada

- SALIDA

La vista de los comentarios de la zona privada del usuario.

### function buscar()

Metodo de busqueda de los comentarios que ha hecho.

- ENTRADA (POST)

q: query (string)

- SALIDA

La vista de los comentarios

### function misdatos_usuario()

Metodo que muestra sus datos a fin de que pueda modificar algo de ellos. Solo para usuarios NO UVA (los UVA van por el LDAP).
Tambien puede modificarlos. En principio era el pass y el usuario, luego se dejo solo el poder cambiar el password.

- ENTRADA

change_pass: (string)
change_user: (string)
nombre: (string)
apellidos: (string)
direccion: (string)
tlf: (string)
email: (string)
dni: (string)

- SALIDA

La vista que se muestra y permite cambiarlo al llamar a este controlador de nuevo.

## PISOS.PHP

Controlador para todas las acciones que se realizan con los pisos.

### function producto_piso($ws = null)

Metodo que muestra la informacion de un piso en concreto. Si ws es "json" devuelve un JSON con la informacion de vuelta.

- ENTRADA (GET)

id: id del piso (number)

- SALIDA

Vista del piso o el JSON correspondiente.
