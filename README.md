# ipa
Información de Pisos de Alquiler UVa

Aplicación realizada en CodeIgniter de la Información de Pisos en Alquiler de la Universidad de Valladolid http://ipa.uva.es

## Realizada con
v1.0 > Codeigniter + custom CSS

v2.0 > Codeigniter + Foundation

v2.5 > Codeigniter > WebServices > Angular X o React (Estamos en este punto) (se la versión que este en ese momento aunque ahora dudo si implementar react + redux o angular o incluso vue, ahora que hay una "lucha entre ellos") > Foundation (Web components)

## Necesidades
Base de datos MySQL.
Conexión a LDAP (libreria customizada en Codeigniter)

## Master puede funcionar o no
Usar la rama master significa que puede funcionar... o no ya que es la rama de desarrollo.

Recordad, si alguien quiere usar esto, ir al ultimo branch.

## Falta la base de datos

No esta incorporado un .sql con la base de datos vacia.

## Punto en el que esta el Master

Compendio de cosas:

- No sabemos que framework de JS elegir... y eso es tan bonito.
- No esta optimizada (se pretende usar lighthouse de Chrome para ello).
- Se pretende, por si se pasa a PWA, tener el service worker para la cache de ficheros (primera version subida, sin los fetchs en la aplicacion para que los saque de la cache). Necesitamos migrar a HTTPS para que funcione.
- Unidades de test!. No hay ninguna, ni para el PHP ni para el JS.
