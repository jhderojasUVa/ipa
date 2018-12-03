# Documentacion de los controladores de COMPONENTS

Controladores usados por los componentes en React separados segun para lo que valgan.

## BUSQUEDA.PHP

Contiene todas las funciones de la busqueda.

### function busqueda()

Metodo de la busqueda. La busqueda no solo vale para buscar sino tambien obviamente, para cuando se tiran de barrios y ciudades. Es decir, el buscador sirve para buscar por palabras, por barrios y por ciudades. La sintaxis es la siguiente.

Ejemplo:
palabra palabra palabra ciudad:nombre de la ciudad barrio:nombre del barrio

"gran ciudad:valladolid barrio:delicias"

Puede contener varias ciudades y varios barrios.

- Entrada (POST & GET)

q: el texto de la query

- Salida

Un JSON con lo siguiente:

{
  "q": String con la query completa,
  "separadoOriginalCiudadesBarrios": [
    "PALABRA",
    "PALABRA"
  ],
  "palabrasQuery": [
    "PALABRA",
    "PALABRA"
  ],
  "idBarriosCiudades": [
    [
      {
        "idlocalizacion": ID
      }
    ],
    [
      {
        "idbarrio": ID
      },
    ]
    ],
      "resultados": [
        {
          "idpiso": ID,
          "descripcion": String,
          "direccion": String,
          "idlocalizacion": ID,
          "idbarrio": ID,
          "libre": 0 o 1,
          "extras": "string|string|string",
          "imagen": String
        },
        ...
    ],
    "total": number
}

### function devuelveBarrios()

Metodo que devuelve de la base de datos todos los identificadores de ciudad, barrio con sus descripciones para ayudar en la busqueda a poner, justamente, en texto, eso. Esto, seguramente, se podria hacer con un inner join en busqueda y ahorrarnos un paso.

- Entrada

Ninguna.

- Salida (JSON)

{
  "barriosCiudades": [
    {
    "idbarrio": "6",
    "idlocalizacion": "1",
    "barrio": "Circular",
    "localizacion": "Valladolid"
    },
    ...
  ]
}

## MIS.PHP

Contiene todo lo usado para cuando uno esta registrado, cuando añade un piso, un comentario, etc...

Se reintenta usar y reutilizar lo antiguo en el controlador del mismo nombre en el raiz, que no es solo para los componentes, por compatibilidad. Esto se ha de eliminar en un futuro.

### function devuelveCiudadesBarrios()

Metodo que devuelve las ciudades y barrios en un JSON, todo junto. Se usa en el componente para saber que barrios pertenecen a que ciudades a traves de filtros en javascript.

- Entrada

Nada

- Salida

Un JSON

### function devuelveCiudades()

Metodo que devuelve las ciudades en la base de datos.

- Entrada

Nada

- Salida

Un JSON

### function addPiso()

Metodo para añadir un piso en la base de datos.

- Entrada (JSON)

[
  "inmueble": {
      "descripcion": string,
      "calle": string,
      "numero": number
      "piso": string, (puede tener atico o bajo, A atico, B bajo),
      "letra": string,
      "cp": numero,
      "contenido": string (cosa|cosa|cosa|cosa),
      "idlocalidad": number,
      "idbarrio": number,
      "tlf": number
  },
  "precios": [
    {
      "precio": number,
      "descripcion": string
    }
  ],
  "libre": boolean (1 o 0),
  "idpiso": number
]

- Salida

El mismo JSON que la entrada o false si ha habido un error.

### function datosPiso()

Metodo que devuelve todos los datos de un piso concreto.

- Entrada (POST/GET)

id: id del piso en cuestion

- Salida (JSON)

{
  "inmueble": {
      "descripcion": string,
      "calle": string,
      "numero": number
      "piso": string, (puede tener atico o bajo, A atico, B bajo),
      "letra": string,
      "cp": numero,
      "contenido": string (cosa|cosa|cosa|cosa),
      "idlocalidad": number,
      "idbarrio": number,
      "tlf": number
  },
  "precios": [
    {
      "precio": number,
      "descripcion": string
    },
    ...
  ],
  "imagenes": [
    {
      "imagen": string (el fichero),
      "descripcion": string,
      "orden": number
    },
    ...
  ],
  "libre": boolean (1 o 0),
  "idpiso": number
}

### function devuelveDatosPiso()

Metodo que devuelve solo los datos del piso, sin imagenes, ni sin es libre... datos pelados.

- Entrada (POST/GET)

id: id del piso (number)

- Salida (JSON)

{
  "inmueble": {
      "descripcion": string,
      "calle": string,
      "numero": number
      "piso": string, (puede tener atico o bajo, A atico, B bajo),
      "letra": string,
      "cp": numero,
      "contenido": string (cosa|cosa|cosa|cosa),
      "idlocalidad": number,
      "idbarrio": number,
      "tlf": number
  }
}

### function devuelveImagenes()

Metodo que devuelve las imagenes de un determinado inmueble.

- Entrada (POST/GET)

id: id del piso (number)

- Salida (JSON)

{
  "imagenes": [
    {
      "imagen": string (el fichero),
      "descripcion": string,
      "orden": number
    },
    ...
  ]
}

## PORTADA.PHP

Todos los componentes usados en la portada llaman a diferentes metodos de esta parte del backend para "recibir las ordenes" y los datos pertinentes

### function slideshow()

Metodo usado en el slideshow para las imagene. Devuelve el id para componer la URL, el fichero y la descripcion para el ALT.

- Entrada

Nada

- Salida (JSON)

{
  "slideshow": [
    {
    "id_piso": number,
    "imagen": string,
    "descripcion": string
    },
    ...
}

### function ultimos_6()

Metodo que devuelve los ultimos 6 pisos añadidos en la plataforma con sus datos necesarios para componerlos en la portada.

- Entrada

Nada

- Salida (JSON)

{
  "ultimos_6": [
    {
    "idpiso": string,
    "descripcion": string,
    "extras": string (cosa|cosa|cosa|cosa),
    "direccion": string,
    "imagen": string
    },
    ...
  ]
}

### function barriosciudades()

Metodo que devuelve un JSON con los barrios y ciudades para que los use el componente.

- Entrada

Nada

- Salida (JSON)

{
  "barrios": [
    {
    "idbarrio": number,
    "barrio": string,
    "ciudad": string
    },
    ...
  ],
  "ciudades": [
    {
    "idlocalizacion": number,
    "localizacion": string
    },
    ...
  ]
}  
