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

## DNI.PHP

Libreria que contiene para ver que un DNI es correcto o no.

### function es_DNI_NIE_valido($cadena)

Metodo que revisa si un DNI o un NIE es valido o no.

- ENTRADA

cadena: (string)

- SALIDA

true si es correcto y false si no.

### function comprobar_nif($nif)

Metodo que revisa si un DNI o un NIE es valido o no.

- ENTRADA

nif: (string)

- SALIDA

true si es correcto y false si no.

## IMAGENES.PHP

Libreria que manipula las imagenes del usuario (las que sube para los inmuebles). Se trata de una libreria externa de uso de imagenes ampliada.

### function load($filename)

Metodo que carga una imagen y la convierte a su tipo.

- ENTRADA

filename: (string)

- SALIDA

Llama a imagecreatefrom(TIPO DE IMAGEN)

### function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null)

Guarda una imagen en disco.

- ENTRADA

filename: (string)
image_type: (string)
compresion: (number)
permission: (boolean o null)

- SALIDA

El fichero en disco

### function output($image_type=IMAGETYPE_JPEG)

Saca una imagen concreta (el objeto es imagen y asi saca el BASE64 en crudo).

- ENTRADA

image_type: (string)

- SALIDA

El crudo de la imagen.

### function getWidth()

Metodo que devuelve el ancho de una imagen (objeto) llamado.

- ENTRADA

Nada porque se llama desde el objeto

- SALIDA

(number) en pixels

### function getHeight()

Metodo que devuelve el alto de una imagen (objeto) llamado.

- ENTRADA

Nada porque se llama desde el objeto

- SALIDA

(number) en pixels

### function resizeToHeight($height)

Metodo que cambia el tamaño de una imagen ALTO.

- ENTRADA

height: (number)

- SALIDA

Nada, cambia el objeto en si que es la imagen

### function resizeToWidth($width)

Metodo que cambia el tamaño de una imagen ANCHO.

- ENTRADA

width: (number)

- SALIDA

Nada, cambia el objeto en si que es la imagen

### function scale($scale)

Metodo que cambia la escala de un tamaño (ancho y alto a la vez). Reescala con proporcion.

- ENTRADA

scale: (number)

- SALIDA

Nada, cambia el objeto en si que es la imagen

### function resize($width,$height)

Metodo que cambia la escala de un tamaño (ancho y alto a la vez). Reescala SIN proporcion.

- ENTRADA

width: (number)
height: (number)

- SALIDA

Nada, cambia el objeto en si que es la imagen

## LDAP.PHP

Libreria que mola y que necesita todo lo que compone opensso-uva (es el añadido a la libreria) y sirve para controlar todo lo necesario (principalmente consulta) datos del LDAP de la UVa.

### function login_action(&$err, &$id)

Metodo de login que lee el host, el puerto y demas de la configuracion del fichero de LDAP del config del CodeIgniter.

- ENTRADA

err: (string)
id: (string)

- SALIDA

Depende o va a la pagina del LDAP o simplemente devuelve true si esta todo ok. Si ha habido un error (el LDAP peta, algo esta mal en la configuracion, etc etc etc) devuelve un false como una casa.

### function get_user_data($id)

Metodo que devuelve la informacion de un usuario concreto.

- ENTRADA

id: (string)

- SALIDA

Un array con los atributos (id, cn, givenName y mail) o false si no.

## MAIL_UVA.PHP

Libreria que carbura y se encarga de ayudar para enviar correos.

### function envia_mail($usuario, $asunto, $texto)

Metodo que envia un mail a un usuario concreto. Mete las cabeceras y esas cosas que molan tanto.

- ENTRADA

usuario: el correo del usuario (string)
asunto: (string)
texto: (string)

- SALIDA

true si todo ha ido bien y false si ha ido mal.

## SESIONES_USUARIOS.PHP
