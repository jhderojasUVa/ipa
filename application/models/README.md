# Documentacion de los modelos de datos

## ADMIN_MODEL.PHP

En este fichero se encuentra todo el modelo usado en la zona de administracion.

### function es_admin ($pollo)

Metodo que indica, tras consultarlo en la base de datos, si es administrador o no.

- ENTRADA

pollo: persona (string)

- SALIDA

1 si lo es 0 si no lo es

## BARRIOS_MODEL.PHP

En este modelo esta todo el tema de los modelos de consulta de los barrios.

### function show_barrios($orden)

Metodo que devuelve los barrios segun un orden que se indica.

- ENTRADA

orden: (string) -> nombre/nombre_invertido

- SALIDA

El resultado de la consulta o false si no hay nada

### function showCiudades()

Metodo que devuelve las ciudades, ahi a palo seco, a cascoporro.

- ENTRADA

Nada

- SALIDA

El resultado de la consulta

### function showBarriosLocalizaciones()

Metodo que devuelve los barrios y las ciudades de cada uno.

- ENTRADA

Nada

- SALIDA

El resultado de la consulta

### function add_barrio($localizacion, $barrio)

Metodo que añade un barrio especifico a una localizacion.

- ENTRADA

localizacion: (number)
barrio: (string)

- SALIDA

Nada

### function del_barrio($barrio)

Metodo que borra un barrio. El metodo borra en cascada todo lo que cuelga de el, lease TODOS los pisos (solo el piso y las imagenes, esto requiere mas trabajo) que tienen dicho barrio. NO BORRA LAS IMAGENES DEL DISCO DURO.

- ENTRADA

barrio: (number)

- SALIDA

Nada

### function update_barrio($idbarrio, $barrio)

Metodo que cambia el nombre a un barrio.

- ENTRADA

idbarrio: (number)
barrio: (string)

- SALIDA

Nada

### function barrios_con_pisos()

Metodo que devuelve los barrios que tienen piso dentro false si no hay ninguno.

- ENTRADA

Nada

- SALIDA

El id del barrio, el barrio en si y el id de la localizacion donde esta o false si no

### function ciudades_con_pisos()

Metodo que devuelve las ciudades que tienen piso dentro false si no hay ninguno.

- ENTRADA

Nada

- SALIDA

El id de la localizacion y la localizacion

### function devuelve_barrio($idpiso)

Metodo que te dice que barrio esta un piso.

- ENTRADA

idpiso: (number)

- SALIDA

El nombre del barrio

### function devuelveBarriosLocalizaciones()

Metodo que devuelve el barrio y las localizaciones en texto con sus identificadores.

- ENTRADA

Nada

- SALIDA

idbarrio, idlocalizacion, barrio y localizacion

## COMENTARIOS_MODEL.PHP

Aqui residen los metodos usados para el modelo de los comentarios.

### function add_comentario ($persona, $comentario, $puntuacion, $idobjeto)

Metodo que añade un comentario.

- ENTRADA

persona: (string)
comentario: (string)
puntacion: (number)
idobjeto: (number)

- SALIDA

Nada

### function show_comentario($idcomentario)

Metodo que devuelve un comentario especifico.

- ENTRADA

idcomentario: (number)

- SALIDA

Los comentarios.

### function show_comentario_objeto($idobjeto, $usuario)

Metodo que devuelve los comentarios de un inmueble (objeto) y los devuelve quitando los denunciados ordenados por fecha.

- ENTRADA

idobjeto: (number)
usuario: (string)

- SALIDA

Los comentarios

### function editar_comentario($idcomentario, $texto)

Metodo que edita un comentario determinado.

- ENTRADA

idcomentario: (number)
texto: (string)

- SALIDA

Nada

### function show_comentario_usuario($idusuario)

Metodo que devuelve los comentarios de un usuario concreto.

- ENTRADA

idusuario: (string)

- SALIDA

Los comentarios

### function show_cantidad_comentario_usuario($idusuario)

Metodo que devuelve la cantidad de comentarios que ha hecho un usuario concreto.

- ENTRADA

idusuario: (string)

- SALIDA

(number)

### function q_show_comentario_usuario($q, $idusuario)

Metodo que busca en los comentarios de un usuario concreto.

- ENTRADA

q: (string)
idusuario: (string)

- SALIDA

Los comentarios filtrados

### function q_show_cantidad_comentario_usuario($q, $idusuario)

Metodo que indica el numero total de comentarios de un usuario tras aplicarles una busqueda.

- ENTRADA

q: (string)
idusuario: (string)

- SALIDA

(number)

### function modificar_comentario($campo, $idcomentario, $nuevo)

Metodo generico para modificar "cualquier campo" de la tabla comentarios en caso de que "crezca".

- ENTRADA

campo: (string)
idcomentario: (number)
nuevo: (string)

- SALIDA

Nada

### function del_comentario($idcomentario)

Metodo que borra un comentario.

- ENTRADA

idcomentario: (number)

- SALIDA

Nada

### function q_comentario($texto)

Metodo que busca en todos los comentarios y devuelve los filtrados.

- ENTRADA

texto: (string)

- SALIDA

Los comentarios

### function add_denuncia($idcomentario, $denunciante)

Metodo que añade una denuncia a un comentario determinado. Es decir que marca el comentario como denunciado.

- ENTRADA

idcomentario: (number)
denunciante: (string)

- SALIDA

Nada

### function del_denuncia($idcomentario, $denunciante)

Metodo que elimina una denuncia hecha por un usuario.

- ENTRADA

idcomentario: (number)
denunciante: (string)

- SALIDA

Nada

### function hay_denuncias()

Metodo que muestra todas las denuncias hechas y existentes.

- ENTRADA

Nada

- SALIDA

Un array con el identificador de la denuncia, del denunciante y los datos que tenemos del mismo.


### function buscar_comentario($q)

Metodo para buscar en los comentarios. Usada en la zona de administracion.

- ENTRADA

q: (string)

- SALIDA

Los comentarios

### function cantidad_buscar_comentario($q)

Metodo que te dice la cantidad de denuncias que hay con lo que has buscado. Usado en la zona de administracion.

- ENTRADA

q: (string)

- SALIDA

(number)

### function repara_add_id_denuncias()

Metodo de paso de la version 2 a la 2.5 que arregla la tabla de denuncias poniendo identificador unico.

- ENTRADA

Nada

- SALIDA

Si todo va bien, la tabla como un dios menor indica

## ESTADISTICAS_MODEL.PHP

En este modelo esta todo lo usado para las estadisticas, todas las consultas de base de datos y esas cosas.

### function cantidad_pisos($fechainicio, $fechafin)

Metodo que devuelve la cantidad de pisos que hay entre una fecha y otra.

- ENTRADA

fechainico: (date)
fechafin: (date)

- SALIDA

(number)

### function cantidad_pisos_uva($fechaincio, $fechafin)

Metodo que devuelve la cantidad de pisos que hay entre una fecha y otra. Solo devuelve pisos puestos por personas de la UVa.

- ENTRADA

fechainico: (date)
fechafin: (date)

- SALIDA

(number)

### function cantidad_pisos_nouva($fechaincio, $fechafin)

Metodo que devuelve la cantidad de pisos que hay entre una fecha y otra. Solo devuelve pisos puestos por personas NO de la UVa.

- ENTRADA

fechainico: (date)
fechafin: (date)

- SALIDA

(number)

### function cantidad_usuarios($fechainicio, $fechafin)

Metodo que devuelve la cantidad de usuarios que se han dado de alta entre dos fechas.

- ENTRADA

fechainico: (date)
fechafin: (date)

- SALIDA

(number)

### function cantidad_pisos_mes($mes, $ano)

Metodo que devuelve la cantidad de pisos nuevos en un mes determinado.

- ENTRADA

mes: (date)
ano: (date)

- SALIDA

(number)

### function cantidad_pisos_mes_uva($mes, $ano)

Metodo que devuelve la cantidad de pisos nuevos en un mes determinado. Solo pisos por personal UVa.

- ENTRADA

mes: (date)
ano: (date)

- SALIDA

(number)

### function cantidad_pisos_mes_nouva($mes, $ano)

Metodo que devuelve la cantidad de pisos nuevos en un mes determinado. Solo pisos por personal NO UVa.

- ENTRADA

mes: (date)
ano: (date)

- SALIDA

(number)

### function cantidad_comentarios_mes($mes, $ano)

Metodo que devuelve la cantidad de comentarios realizados en un mes determinado.

- ENTRADA

mes: (date)
ano: (date)

- SALIDA

(number)

## LOCALIZACIONES_MODEL.PHP

En este modelo esta todo lo que se realiza con las localizaciones (ciudades).

### function show_localizaciones($forma)

Metodo que devuelve las localizaciones segun como se la pidan.

- ENTRADA

forma: (string) nombre/nombre_invertido

- SALIDA

idlocalizacion y localizacion

### function update_localizacion($idciudad, $ciudad)

Metodo que actualiza una localidad concreta.

- ENTRADA

idciudad: (number)
ciudad: (string)

- SALIDA

Nada

### function mostrar_localizaciones_pisos()

Devuelve las localizaciones que tienen pisos verificados.

- ENTRADA

Nada

- SALIDA

id de las localizaciones

### function devuelve_ciudad($idpiso)

Metodo que devuelve el identificador de la ciudad de un piso determinado. Totalmente mejorable con un INNER JOIN de toda la vida.

- ENTRADA

idpiso: (number)

- SALIDA

(string) el nombre de la localizacion

### function saca_pisos_gps($idlocalizacion)

Metodo que saca los pisos de una localizacion concreta y sus coordenadas para GMaps.

- ENTRADA

idlocalizacion: (number)

- SALIDA

idpiso, descripcion, latitud y longitud

### function cantidad_saca_pisos_gps($idlocalizacion)

Metodo que te indica la cantidad de pisos por una localizacion concreta.

- ENTRADA

idlocalizacion: (number)

- SALIDA

(number)

## PALABRAS_MODEL.PHP

Todo lo referente a las palabras para el "quiso decir".

### function devuelvePalabras()

Metodo que devuelve todas las palabras.

- ENTRADA

Nada

- SALIDA

Las palabras a cascoporro

## PISOS_MODEL.PHP

Aqui residen todas las operaciones con los pisos.

### function show_piso($idpiso)

Metodo que devuelve todo el contenido de un piso en raw, en bruto.

- ENTRADA

idpiso: (number)

- SALIDA

Todos los datos de la tabla pisos de un piso concreto

### function cantidad_pisos_usuario($usuario)

Metodo que devuelve la cantidad de pisos en la plataforma de un usuario concreto. Con un num_rows valdria pero esta hecho de una forma complicada.

- ENTRADA

usuario: (string)

- SALIDA

(number)

### function show_datos_pisos_usuario($usuario)

Metodo que muestra los datos bien puestos (sin identificadores de lugar y cosas de esas) de un usuario en concreto y con la ultima imagen subida.

- ENTRADA

usuario: (string)

- SALIDA

Un array con los datos del pisos y una imagen, si no hay imagen devuelve "sin_imagen.png"

### function show_piso_barrio($idbarrio, $total, $llego)

Metodo que muestra los pisos de un barrio determinado pero en un rango, desde donde le dices a un numero total que le indicas.

- ENTRADA

idbarrio: (number)
total: (number)
llego: (number)

- SALIDA

Un array con los datos del pisos y una imagen, si no hay imagen devuelve "sin_imagen.png"

### function show_piso_barrio_total($idbarrio)

Metodo que devuelve todos los pisos de un barrio determinado.

- ENTRADA

idbarrio: (number)

- SALIDA

Un array con los datos del pisos y una imagen, si no hay imagen devuelve "sin_imagen.png"

### function show_piso_cuidad($idciudad, $total, $llego)

Metodo que muestra los pisos de una ciudad determinada pero en un rango, desde donde le dices a un numero total que le indicas.

- ENTRADA

idciudad: (number)
total: (number)
llego: (number)

- SALIDA

Un array con los datos del pisos y una imagen, si no hay imagen devuelve "sin_imagen.png"

### function show_piso_cuidad_total($idciudad)

Metodo que devuelve todos los pisos de una ciudad determinado.

- ENTRADA

idciudad: (number)

- SALIDA

Un array con los datos del pisos y una imagen, si no hay imagen devuelve "sin_imagen.png"

### function show_imagenes_piso($idpiso)

Metodo que devuelve todas las imagenes de un piso concreto ordenadas por su orden (maximo 5).

- ENTRADA

idpiso: (number)

- SALIDA

idimagen, imagen, descripcion y orden

### function show_pisos_pollo($usuario)

Metodo que devuelve los identificadores de pisos de un usuario concreto en la plataforma independientemente de si estas validados o no.

- ENTRADA

usuario: (string)

- SALIDA

idpiso

### function cantidad_show_imagenes_piso($idpiso)

Metodo que devuelve la cantidad de imagenes de un piso determinado a cascoporro.

- ENTRADA

idpiso: (number)

- SALIDA

(number)

### function cambiar_campo_piso($campo, $nuevovalor, $idpiso)

Metodo que cambia un campo determinado de un piso determinado.

- ENTRADA

idpiso: (number)
campo: (string)
nuevovalor: (string)

- SALIDA

Nada

### function cambiar_piso ($idpiso, $descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $idbarrio, $extras, $tlf, $libre)

Metodo que cambia los datos de un piso concreto (todos de golpe, a cascoporo).

- ENTRADA

idpiso: (number)
descripcion: (string)
calle: (string)
numero: (string)
piso: (string)
letra: (string)
cp: (string)
idlocalizacion: (number)
idbarrio: (number)
extras: (string) cosa|cosa|cosa
tlf: (string)
libre: (boolean)

- SALIDA

Nada

### function cambiar_campo_imagen($viejo, $nuevo, $campo)

Metodo que cambia un campo determinado de la tabla de imagenes_piso

- ENTRADA

viejo: (string)
nuevo: (string)
campo: (string)

- SALIDA

Nada

### function del_piso($idpiso)

Metodo que borra un piso de la bd. No borra las imagenes del HD por si acaso. **Se podria poner un flag para que borre (o no) las imagenes de disco**.

- ENTRADA

idpiso: (number)

- SALIDA

Nada

### function add_piso($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $idbarrio, $extras, $tlf, $libre, $usuario, $verificado)

Metodo que añade un piso a la plataforma.

- ENTRADA

descripcion: (string)
calle: (string)
numero: (string)
piso: (string)
letra: (string)
cp: (string)
idlocalizacion: (number)
idbarrio: (number)
extras: (string) cosa|cosa|cosa
tlf: (string)
libre: (boolean)
usuario: (string)
verificado: (boolean)

- SALIDA

(number) el identificador del piso, idpiso

### function existe_piso($calle, $numero, $piso, $letra, $cp, $idlocalizacion)

Metodo que revisa si un piso existe, o al menos esta en esa ubicacion ya.

- ENTRADA

calle: (string)
numero: (string)
piso: (string)
letra: (string)
cp: (string)

- SALIDA

idpiso si el piso existe, 0 si no.

### function add_piso_nobarrio($descripcion, $calle, $numero, $piso, $letra, $cp, $idlocalizacion, $extras, $verificado)

Depreciado. Antiguamente, antes del React, habia que hacer el añadir pisos por pasos, este es el paso 1 de dicho proceso. Vamos lo que llamaba el controlador.

- ENTRADA

descripcion: (string)
calle: (string)
numero: (string)
piso: (string)
letra: (string)
cp: (string)
idlocalizacion: (number)
extras: (string) cosa|cosa|cosa
verificado: (boolean)

- SALIDA

(number) el identificador del piso, idpiso

### function add_imagen_piso($imagen, $descripcion, $idpiso)

Depreciado. Metodo que añade una imagen a un piso. Le añade al orden

- ENTRADA

imagen: (string)
descripcion: (string)
idpiso: (number)

- SALIDA

Nada

### function del_imagen_piso($imagen, $descripcion, $idpiso)

Metodo que elimina una imagen. NO LA BORRA DE DISCO. **Mejorable añadiendo el borrado de fichero del disco**

- ENTRADA

imagen: (string)
descripcion: (string)
idpiso: (number)

- SALIDA

Nada

### function del_imagen_piso_burro($imagen, $idpiso)

Metodo que borra a lo burro una imagen concreta a traves del nombre de su fichero. **Mejorable añadiendo el borrado de fichero del disco**

- ENTRADA

imagen: (string)
idpiso: (number)

- SALIDA

Nada

### function cambia_orden_imagen($imagen, $actual, $nuevo, $idpiso)

Metodo que cambia el orden de una imagen.

- ENTRADA

imagen: (string)
actual: (number)
nuevo: (number)
idpiso: (number)

- SALIDA

Nada

### function total_imagenes_piso($idpiso)

Metodo que devuelve el total de imagenes de un piso concreto.

- ENTRADA

idpiso: (number)

- SALIDA

(number)

### function muestra_5_imagenes_piso()

Metodo que devuelve 5 imagenes (las mas modernas, las ultimas) siendo 1 de cada piso y a su vez, los datos del piso (el identificador que es lo principal).

- ENTRADA

Nada

- SALIDA

Un array con id_piso, imagen, descripcion sacados de la BD

### function muestra_10_pisos()

Metodo que devuelve los 10 ultimos pisos insertados en la plataforma sin imagen.

- ENTRADA

Nada

- SALIDA

Un array con id_piso, descripcion y direccion o false si no hay nada.

### function muestra_ultimos_pisos($numero)

Metodo que muestra un numero indicado de ultimos pisos insertados en la plataforma con 1 imagen (si tienen)

- ENTRADA

numero: (number)

- SALIDA

Un array con id_piso, descripcion, extras, direccion e imagen o false si no hay nada.

### function pisos_usuario($usuario)

Metodo que devuelve los pisos de un usuario concreto.

- ENTRADA

usuario: (string)

- SALIDA

Array con todos los datos de los pisos y 1 imagen

### function es_piso_usuario($usuario, $idpiso)

Metodo que te indica si un piso es de un usuario o no.

- ENTRADA

usuario: (string)
idpiso: (number)

- SALIDA

true si lo es, false si no

### function buscar_piso($q , $total, $llego)

Metodo para buscar un piso por la descripcion o calle devolviendo un total de elementos y empezando a partir de uno determinado.

- ENTRADA

q: (string)
total: (number)
llego: (number)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function buscar_piso_2($q)

Metodo para administracion que busca en los pisos. **Solo busca en los libres**. Se podria haber juntado con la siguiente simplemente poniendo un flag.

- ENTRADA

q: (string)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function buscar_piso_3($q)

Metodo para administracion que busca en los pisos. **Solo busca en los ocupados**. Se podria haber juntado con la anterior simplemente poniendo un flag.

- ENTRADA

q: (string)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function buscar_piso_4($q)

Metodo para administracion que busca en los pisos. **Busca en todos, a cascoporro, sin distincion**. Se podria haber juntado con la anterior de la anterior simplemente poniendo un flag.

- ENTRADA

q: (string)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function mostar_pisos_no_validados()

Metodo que devuelve los pisos no validados.

- ENTRADA

Nada

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function buscar_piso_total($q)

Metodo que te devuelve el numero total de pisos de una busqueda concreta. **Totalmente mejorable porque es una autentica chapuza de metodo**.

- ENTRADA

q: (string)

- SALIDA

(number)

### function refinar_cantidad_buscar_piso($q, $cp, $loc, $rango)

Metodo que refina una busqueda anteriormente hecha segun unos parametros como el rango de precios, la localizacion y/o el codigo postal y te dice la cantidad que has tenido. **Totalmente mejorable porque es una autentica chapuza de metodo**.

- ENTRADA

q: (string)
cp: (string)
loc: (string)
rango: (string)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function refinar_buscar_piso($q, $cp, $loc, $rango, $total, $llego)

Metodo que refina una busqueda anteriormente hecha segun unos parametros como el rango de precios, la localizacion y/o el codigo postal.

- ENTRADA

q: (string)
cp: (string)
loc: (string)
rango: (string)
total: (number)
llego: (number)

- SALIDA

Un array con id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png"

### function buscar_piso_ajax($q)

Metodo que se supone (porque no se usa) que es para un AJAX de la caja de buscar que complete los textos.

- ENTRADA

q: (string)

- SALIDA

O false sino, o los resultados.


### function buscar_piso_query($queryPrimaria, $querySecundaria)

Metodo que completa una query a traves de dos subquerys enviadas, una con los datos de la descripcion y las calles y otra con los barrios y las ciudades.

- ENTRADA

queryPrimaria: (string)
querySecundaria: (string)

- SALIDA

O false si no hay nada o un array con los datos id_piso, descripcion, direccion, poblacion, extras, imagen y libre. Si no hay imagen se envia "sin_imagen.png".

### function ejecutaQueryRaw($query)

**Este metodo es una mierda** y nunca deberia estar y es que ejecuta una query que le envian y punto. Esto esta mas que prohibido y, hay que mejorarlo mas que mucho.

- ENTRADA

query: (string)

- SALIDA

Lo que la query escupa

### function devuelveSqlBarrioCiudad($arrayDatos)
