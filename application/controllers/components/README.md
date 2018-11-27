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
