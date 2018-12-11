# Documentacion de las librerias

## ANALIZADORSINTACTICO.PHP

Libreria usada para el tema de hacer opciones con los textos (de las query) y similares.

### function buscaBarrio($string)

Metodo que busca y separa el barrio o barrios de un string gordo. Es necesario que use (la query) el formato estandar de spotify para buscar cosas, es decir: ciudad:nombre ciudad barrio:nombre del barrio

- ENTRADA

string: (string)

- SALIDA

Array con los barrios

### function buscaCiudad($string)

Metodo que busca y separa la ciudad o ciudades de un string gordo. Es necesario que use (la query) el formato estandar de spotify para buscar cosas, es decir: ciudad:nombre ciudad barrio:nombre del barrio

- ENTRADA

string: (string)

- SALIDA

Array con las ciudades

### function eliminaPronombres($string)

Metodo que elimina pronombres personales de un string con una expresion regular.

- ENTRADA

string: (string)

- SALIDA

Un (string) sin los pronombres

### function eliminaUnidores($string)

Metodo que elimina "palabras que unen" como y, o, a, ... de un string con una expresion regular.

- ENTRADA

string: (string)

- SALIDA

Un string

### function devuelveArrayWhere($string)

Este metodo devuelve un string con la consulta SQL a partir del WHERE buscando en descripcion y calle de cada palabra del string.

- ENTRADA

string: (string)

- SALIDA

Un string que es un cacho del SQL

### function devuelveSQLWheredeArray($array)

Metodo que devuelve un string con la consulta SQL a partir del WHERE distinguiendo si hay ciudades y barrios metidos.

- ENTRADA

string: (string)

- SALIDA

Un string que es un cacho del SQL

### function devuelveArrayBarrioCiudad($id, $tipo)

Metodo que devuelve los pisos segun sea un barrio o una ciudad lo que se le meta.

- ENTRADA

id: (number) id de barrio o ciudad en la base de datos
tipo: (string) para saber si es un barrio o una ciudad donde ha de buscar

- SALIDA

false si nada o el SQL entero de la busqueda para el modelo.

### function esUnNumero($string)

Metodo que te dice si es un numero o no lo que le metes.

- ENTRADA

string: (string)

- SALIDA

true si es numero
false si NO es numero

### function queryTexto($string)

Metodo que devuelve un array que busca en el string si hay barrios y ciudades devolviendo unicamente estos (todos seguidos).

- ENTRADA

string: (string)

- SALIDA

Un array con cada elemento uno de los resultados de si es ciudad o barrio.

### function troceador($string)

Metodo que devuelve un array troceado separando barrios y ciudades y metiendolo en un array separado cada cosa. Es muy importante que tenga en cuenta si hay ciudad solo, barrio solo o ambos a la vez, cosa que hace... mas o menos. Seguro que se puede mejorar un monton.

- ENTRADA

string: (string)

- SALIDA

Un array multidimensional donde la primera es si es un barrio o ciudad y las demas el contenido del mismo.

### function similitudes($arrayDatos, $arrayConQuienComparar)

Metodo que compara dos arrays, uno con las palabras y otro con las palabras con las que hay que comparar. Lo que devuelve es un array con las palabras buenas.

- ENTRADA

arrayDatos: (array de strings)
arrayConQuienComparar: (array de strings)

- SALIDA

Un array con "palabra origen" => palabra destino buena

### function similitudes_sale($origen, $destino)

Metodo/funcion interna (que se supone que no se debe usar en el exterior ya que la usa solo el objeto y, no la he puesto un private por si acaso) que compara dos strings devuelve la palabra correcta si supera un tanto por ciento de igualdad.

- ENTRADA

origen: (string)
destino: (string)

- SALIDA

origen si se parecen un 65 o mas y false si no.
