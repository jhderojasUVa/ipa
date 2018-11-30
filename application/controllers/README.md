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
ciudades:
