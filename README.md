# IPA
Información de Pisos de Alquiler UVa

Aplicación realizada en CodeIgniter de la Información de Pisos en Alquiler de la Universidad de Valladolid http://ipa.uva.es

Esta aplicación reune y pone en comun propietarios de pisos y habitaciones que quieren alquilarla con el alumnado y personal de la Universidad de Valladolid.

Solo aquellos pertenecientes a la entidad pueden ver todas las ofertas, los propietarios que hayan puesto pisos o habitaciones (inmuebles) solo podran ver su oferta.

Dispone de un sistema de valoración de imuebles y denuncias para los usuarios y un sistema de administracion del back por parte de personal de la universidad de valladolid.

## Realizada con
v1.0 > Codeigniter (PHP) + custom CSS

v2.0 > Codeigniter (PHP) + Foundation (responsive)

v2.5 (aqui) Codeigniter (PHP) + WebServices + React (Estamos en este punto) > Foundation (Web components)

Se ha elegido React ya que finalmente lo primero que necesitamos es una libreria de visualización más que un framework con MVC completo. Se iran creando los componentes uno a uno.

Tambien se ira limpiando toda la morralla de paso de una versión a otra que da un poco de verguencita verlo.

## Front End
Como se ha indicado parte del front esta realizado con React. En la carpeta 'js/components' se encuentran los componentes separados por ficheros.

addpisoComponent.js > Componente para la inserccion de pisos en 3 fases

barriosCiudadesComponent.js > Componente que muestra una lista con los barrios y ciudades que tienen pisos anunciados en la plataforma

busquedasComponent.js > Componente de las busquedas. Se usa tambien para cuando se selecciona una ciudad o un barrio y asi sirve para todo de un golpe. Las busquedas se hacen al "estilo spotify", es decir, con palabras y si se quiere buscar una ciudad añadiendo "ciudad:nombre de la ciudad" o un barrio con "barrio:nombre del barrio". Se pueden añadir tantos como se quiera o haga falta (en principio)

slideshowComponent.js > Componente del slideshow. Este componente usa slick como slideshow (y por lo tanto necesita JQuery por el parche metido)

ultimos6pisosComponent.js > Componente que muestra los ultimos 6 pisos en la plataforma

## Back end
El backend se realiza con CodeIgniter, luego funciona bajo PHP. Es muy recomendable que la version de PHP sea la 7, aunque funciona bajo la 5.3.X "sin problemas".

Si se ejecuta bajo PHP 5.3.X es necesario algunos cambios como el poner todos los controladores, librerias y modelos (los ficheros) con la primera letra en mayusculas si el sistema donde se aloja es "case sensitive" debido al CodeIgniter por si mismo.

Se han creado librerias especificas para la conexion al LDAP de la Universidad de Valladolid, otra libreria especifica para revisar los DNI y ver que son de verdad, otra libreria especifica para el tratamiento de imagenes, otra libreria para el envio de correos personalizados y una ultima para la gestion de las sesiones de usuario (aparte de la cookie del SSO de la Universidad de Valladolid, claro).

Se ha creado una mini libreria con un analizador sintactico bastante básico que ayuda a sacar y diferenciar las ciudades y los barrios del resto de palabras de las busquedas. Es muy básico y da un poco de penita.

## Necesidades
Base de datos MySQL.
Conexión a LDAP (libreria customizada en Codeigniter), vamos, un SSO que en el caso de esta aplicacion es el de la Universidad de Valladolid.

## Master puede funcionar o no
Usar la rama master significa que puede funcionar... o no ya que es la rama de desarrollo.

Recordad, si alguien quiere usar esto, ir al ultimo branch.

## Documentacion

Cada carpeta (o la mayoria de ellas) tienen un Readme.md que es la documentacion de los metodos/funciones/lo que sea de los elementos que componen el directorio.

No se si esta bien hecha o escrita.

## Base de datos

Un volcado, vamos, lo normal.

```
sql/ipa.sql
```

En este fichero se encuentra la estructura (esta sin datos, obviamente) de la base de datos.

## Punto en el que esta el Master

Recordad que se esta usando el developer del React!. Dudo mucho que, salvo en explotación, use la versión de explotación de React y que pase el codigo por Babel. Cuando este la versión finalizada, recordad el hacer ambos pasos, primero poner el React en explotación, el polyfill y, sobre todo pasarlo por Babel para que sea ES2015 compatible (para los viejos clientes web).

Compendio de cosas:

- Mejorando la administracion para los usuarios de la entidad (ver, borrar pisos, esas cosas).
- No esta limpiada la morralla que no se necesita de la version 1.0 (ouch!) ni tampoco de la 2.0 (mas ouch!).
- Zona de la administracion no pasada a nuevo formato (aun) y valoramos no hacerlo (o si).
- No esta optimizada (se pretende usar lighthouse de Chrome para ello).
- Se pretende, por si se pasa a PWA, tener el service worker para la cache de ficheros (primera version subida, sin los fetchs en la aplicacion para que los saque de la cache). Recordad, necesita entonces HTTPS.
- Unidades de test!. No hay ninguna, ni para el PHP ni para el JS.
- Se esta intentado usar camelCase en las notaciones de funciones y variables como estandar porque ya toca usar un estandar.
- Se intentara usar PSR (https://www.php-fig.org/psr/) para el PHP ahora o en un futuro... vamos a partir de ahora, pese a que hay cosas que no me gustan un pimiento.
- Se quiere crear una libreria que use las API de Google de Machine Learning que ayudaria a desgranar el texto enviado por los usuarios de forma que reconozca palabras, frases, nombres de barrios, ciudades... esas cosas. Se plantea el uso de AutoML Natural Language de Google o Cloud Natural Language (https://cloud.google.com/natural-language).
- Documentando, estoy documentando.

## Futuro?

Quizas, en un futuro, con Electron, se cree una versión de la aplicacion de escritorio/movil aunque no se descarta el uso de React Native (o si, quien sabe).
