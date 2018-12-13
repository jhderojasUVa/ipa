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
