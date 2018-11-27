# Documentacion de los controladores de AJAX

Los controladores cargan antes las librerias, configuracion y esas cosas necesarias para los controladores.

## AJAX.PHP (EN DESUSO)

Este controlador se encarga de las peticiones por AJAX.

Todos los metodos contienen una variable $ws (que por defecto se pone a null) que sirve para responder un JSON en vez de algo "normal".

### function comprueba_user($ws = null)

Esta funcion comprueba el usuario y devuelve si esta vacio, libre u ocupado

- Entrada (POST)

usuario: el usuario que hace la peticion.

- Salida

Un span de la respuesta con su CSS correspondiente (vario, libre u ocupado).

### function cambia_estado()

Esta funcion cambia el estado de un piso de ocupado a libre y viceversa

- Entrada (POST)

id: identificador del piso de la tabla pisos.

- Salida

El HTML donde pone libre u ocupado.

### function buscador_ajax()

Funcion del buscador para el AJAX si hay resultados. Escribe los enlaces rapidos. Esta pensado para el buscador para que muestre unos resultados rapidos.

- Entrada (POST)

q: la query, el texto

- Salida

Enlaces a los resultados

## BUSCADOR.PHP (EN DESUSO)

Controlador de las busquedas en generico.

### function buscar()

Intento de controlador de busqueda. Saca el usuario de la sesion, consulta los pisos y los comentarios

- Entrada (POST)

q: la query, el texto

- Salida

No hay salida
