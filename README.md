# ipa
Información de Pisos de Alquiler UVa

Aplicación realizada en CodeIgniter de la Información de Pisos en Alquiler de la Universidad de Valladolid http://ipa.uva.es

Esta aplicación reune y pone en comun propietarios de pisos y habitaciones que quieren alquilarla con el alumnado y personal de la Universidad de Valladolid.

Solo aquellos pertenecientes a la entidad pueden ver todas las ofertas, los propietarios que hayan puesto pisos o habitaciones (inmuebles) solo podran ver su oferta.

Dispone de un sistema de valoración de imuebles y denuncias para los usuarios y un sistema de administracion del back por parte de personal de la universidad de valladolid.

## Realizada con
v1.0 > Codeigniter + custom CSS

v2.0 > Codeigniter + Foundation (responsive)

v2.5 (aqui) > Codeigniter > WebServices > React (Estamos en este punto) > Foundation (Web components)

Se ha elegido React ya que finalmente lo primero que necesitamos es una libreria de visualización más que un framework con MVC completo. Se iran creando los componentes uno a uno.

Tambien se ira limpiando toda la morralla de paso de una versión a otra que da un poco de verguencita verlo.

## Front End
Como se ha indicado parte del front esta realizado con React. En la carpeta 'js/components' se encuentran los componentes separados por ficheros.

addpisoComponent.js > (En proceso) Componente para la inserccion de pisos en 3 fases

barriosCiudadesComponent.js > Componente que muestra una lista con los barrios y ciudades que tienen pisos anunciados en la plataforma

slideshowComponent.js > Componente del slideshow. Este componente usa slick como slideshow (y por lo tanto necesita JQuery por el parche metido)

ultimos6pisosComponent.js > Componente que muestra los ultimos 6 pisos en la plataforma

## Necesidades
Base de datos MySQL.
Conexión a LDAP (libreria customizada en Codeigniter), vamos, un SSO que en el caso de esta aplicacion es el de la Universidad de Valladolid.

## Master puede funcionar o no
Usar la rama master significa que puede funcionar... o no ya que es la rama de desarrollo.

Recordad, si alguien quiere usar esto, ir al ultimo branch.

## Base de datos

Un volcado, vamos, lo normal.

```
sql/ipa.sql
```

En este fichero se encuentra la estructura (esta sin datos, obviamente) de la base de datos.

## Punto en el que esta el Master

Compendio de cosas:

- Mejorando la administracion para los usuarios de la entidad (ver, borrar pisos, esas cosas).
- No esta limpiada la morralla que no se necesita de la version 1.0 (ouch!) ni tampoco de la 2.0 (mas ouch!).
- Zona de la administracion no pasada a nuevo formato (aun) y valoramos no hacerlo (o si).
- No esta optimizada (se pretende usar lighthouse de Chrome para ello).
- Se pretende, por si se pasa a PWA, tener el service worker para la cache de ficheros (primera version subida, sin los fetchs en la aplicacion para que los saque de la cache). Recordad, necesita entonces HTTPS.
- Unidades de test!. No hay ninguna, ni para el PHP ni para el JS.
