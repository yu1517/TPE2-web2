# Books API

Endpoint de la API: http://localhost/web2/tpe2/TPE2-web2/api/books

## Endpoints 

## Servicios GET

* `GET/books`: Accede a la lista completa de libros que estan guardados en la base de dato 'db_tpe'.

*Ordenamiento ASC y DESC

 `GET /books?sort=FIELD&orderBY=ORDERTYPE`
  Agregando `?sort=FIELD&orderBy=ORDERTYPE` permite ordenar la lista de manera ascendente o descendente por un campo. El campo se debe especificar en el `sort` y el `orden` deseado en el orderBy.

  * **Ejemplo** `GET /books?sort=title&orderBy=desc`
  Este ejemplo traera el listado de libros por titulo ordenador de forma descendente.
    
* Paginacion

    `GET /books?start=VALUE&limit=VALUE`
    Para utilizar la paginacion debemos ingresar dos valores para nuetras keys "start"(pagina) y "limit"(cantidad de registros que queremos mostras).
    Los datos que ingresamos en paginacion son integer para ambos valores.  

    * **Ejemplo** `GET /books?start=1&limit=4`
    ```
        [
            {
                "id": 1,
                "id_author": 1,
                "title": "Caballo de Fuego - Paris",
                "genre": "Narrativa Romantica",
                "imagen": "imgs/books/caballodefuego-paris.jpg",
                "name": "Florencia Bonelli"
            },
            {
                "id": 2,
                "id_author": 2,
                "title": "Los Siete Maridos de Evelyn Hugo",
                "genre": "Narrativa Romántica",
                "imagen": "imgs/books/losSieteMaridosdeEvelynHugo.jpg",
                "name": "Taylor Jenkins Reid"
            },
            {
                "id": 3,
                "id_author": 10,
                "title": "Asesinato en Fleat House",
                "genre": "Crimen y Misterio",
                "imagen": "imgs/books/AsesinatoenFleatHouse.jpg",
                "name": "Lucinda Riley"
            },
            {
                "id": 4,
                "id_author": 3,
                "title": "Muerte en el Nilo",
                "genre": "Crimen y Misterio",
                "imagen": "imgs/books/muerteenelNilo.jpg",
                "name": "Agatha Christie"
            }
        ]
    ```

## Servicio POST

* `POST /books`: Este servicio permite agregar un nuevo libro a la tabla a traves del body de `Postman`.
* **Ejemplo** `POST /books`
```
{
    "id": 49,
    "id_author": 2,
    "title": "Nuevo Libro de Prueba",
    "genre": "de Prueba",
    "imagen": null
}
```

## Servicio PUT

* `PUT /books/:ID`
Por medio se puede hacer una modificacion a un libro existente en la tabla de la base de datos. Para especificar el libro a modificar se captura el ID que viene por parametro. Este ID debe existir en la tabla de lo contrario se arroja un status `404 Not Found`. La modificacion al igual que con `POST` se hace a traves del body de postman, respetando la estructura del objeto.

* **Ejemplo** `PUT /books`
Los nuevos valores de los campos del libre de id:49 seran los siguientes:

```
{
    "title": "Nuevo libro",
    "genre": "Nuevo Genero",    
    "id_author": 2
}
```

## Servicio DELETE

* `DELETE /books/:ID` Este servicio elimina el libro de la tabla cuyo id sea el que se pase por parametro. De no existir tal parametro ocurrira un 404 Not found.

* **Ejemplo** `DELETE/books/49`
De existir ese producto la respuesta sera: "El libro fue eliminado correctamente"

