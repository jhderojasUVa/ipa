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
