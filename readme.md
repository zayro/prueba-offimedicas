# Guia Examen API - OFFIMEDICAS

El exámen está generado una api backend escrito en Php con Laravel y MYSQL el cual expondra una API REST para la interacción con la aplicación frontend con Angular

## instalar el aplicativo

Se debe tener instalado

- composer

clonar el repositorio y ejecutar el comando `composer install`  

## Ejecutar aplicacion entorno desarrollo local

- [x] install MYSQL y agregar base de datos ubicado en la carpeta db



## Status Codes
devuelve los siguientes códigos de estado en el API:

| Status Code | Description |
|-------------| ----------- |
| 200 | `OK` |
| 201 | `CREATED` |
| 400 | `BAD REQUEST` |
| 404 | `NOT FOUND` |
| 500 | `INTERNAL SERVER ERROR`|


## Responses
API devuelven la representación JSON de los recursos creados o editados. Sin embargo, si se envía una solicitud no válida o se produce algún otro error, devuelve una respuesta JSON en el siguiente formato:

```
{
  "message" : string,
  "status" : bool,
  "data"    : string
}
```

El atributo `message` contiene un mensaje comúnmente utilizado para indicar errores o, en el caso de eliminar un recurso, el éxito de que el recurso se eliminó correctamente.

El atributo `status` describe si la transacción fue exitosa o no.

El atributo `data` contiene cualquier otro metadato asociado con la respuesta. Esta será una cadena escapada que contiene datos JSON.





### Development Local

Ejecutar `php -S 0.0.0.0:8000 -t public`  permite navegar localmente `http://localhost:8000/`. la aplicacion automaticamente se recarga segun los cambios que se afecten.

## Public

composer dump-autoload -o

php -S localhost:8000 -t public

php -S 0.0.0.0:8000 -t public
