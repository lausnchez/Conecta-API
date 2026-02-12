# Conecta API
API Rest para el proyecto Conecta del instituto Juan XXIII de Alcorcón para la Hackathon del municipio de 2025/2026.

Su objetivo es recoger la información almacenada en varias bases de datos para asegurar el correcto funcionamiento de las aplicaciones del proyecto de forma escalable y limpia.


## 🔍 Índice
1. [Al importar al PC](#-al-importar-en-el-pc)
2. [Estructura de la base de datos](#-estructura-de-la-base-de-datos)
3. [ENDPOINTS](#endpoints)
    - [Usuarios](#--usuarios) 
    - [Eventos](#--eventos) 
    - [Categorías](#--categorías) 
    - [Entidades](#--entidades) 
    - [Tags](#--tags) 
    - [Aplicaciones](#--aplicaciones) 
    - [Opiniones](#--opiniones) 
4. [Tecnologías usadas y sus versiones](#-tecnologías-usadas-versiones)

## 💾 Al importar en el PC
> [!IMPORTANT]
> La URL base es: `www.hackathon.lausnchez.es/api/v1`. A partir de ahí se deben agregar los endpoints de cada función.

1. **Generar un .env a partir de ejemplo** y insertar los datos de la bbdd. Importante mirar que está puesto en `mysql` y no en sqlite en DB_CONNECTION.
2. Crear el vendor con `composer install`. 
3. Generar una APP_KEY con `php artisan key:generate`.
4. Crear la base de datos en local vacía con el mismo nombre que la hayáis puesto en el .env. También se puede crear al realizar las migraciones gracias a composer.
5. Generar las migraciones de las tablas default de la API con `php artisan migrate --seed`. La API se encarga de crear los roles mediante un seeder.

> [!CAUTION]
> No se sabe de momento si al importar se deben de hacer configuraciones iniciales de Sanctum y Breeze, estamos mirando a ver como funciona en repositorios compartidos. De momento no le hagáis caso, no debería de afectaros en nada al desarrollar.

## 📁 Estructura de la base de datos
### Base de datos en MySQL
![Estructura de la base de datos](https://github.com/Hackathon-JuanXXIII/Conecta-API/blob/main/docs/images/Conecta_db_structure.png)

[Página para ver la estructura actualizada de la base de datos](https://dbdiagram.io/d/Conecta-694bc6dcb8f7d868860d100e)

### Base de datos en MongoDB

## ENDPOINTS
> [!WARNING]
> Para poder usar los endpoints es necesario registrarse primero y mandar como header el token que nos devuelve del usuario para poder pasar la barrera de autentificación.

### 💡 | Usuarios

**Validaciones**:
| Parámetro                 | Datatype                         |
| ------------------------- | -------------------------------- |
| `id`                      | BIGINT (PRIMARY KEY)             |
| `username`                | VARCHAR(20)                      |
| `nombre`                  | VARCHAR(100)                     |
| `apellido`                | VARCHAR(100)                     |
| `email`                   | VARCHAR(255) (unique)            |
| `password`                | VARCHAR(255)                     |
| `telefono`                | VARCHAR(20) (nullable)           |
| `es_empresa`              | BOOLEAN                          |
| `es_familiar`             | BOOLEAN                          |
| `fecha_nacimiento`        | DATE (nullable)                  |
| `porcentaje_discapacidad` | DECIMAL(5,2)                     |
| `rol` (deprecated actualmente)| BIGINT (unsigned, FK → roles.id)|
| `activo` (deprecated actualmente)|BOOLEAN                    |


---
**Endpoints:**
#### Autentificación de usuarios
- [**POST** | Registrar usuario](#registrarse)
- [**POST** | Registrar usuario](#login)
---
#### Generales
- [**GET** | Todos los users](#get--todos-los-users)
- [**GET** | User por ID](#get--user-por-id)
- [**GET** | Eventos creados por un User](#get--user-por-id)
- [**GET** | Eventos en los que participa un User](#get--user-por-id)
- [**GET** | User por Username](#get--user-por-username)
- [**GET** | Users por coincidencias en el nombre completo o username](#get--users-por-coincidencias-en-el-nombre-completo-y-el-username)
- [**GET** | Users activos](#get--users-activos)
- [**GET** | Users inactivos](#get--users-inactivos)
- [**GET** | Users empresas](#get--users-que-son-empresas)
- [**GET** | Users no-empresas](#get--users-que-no-son-empresas)
- [**GET** | Users familiares](#get--users-que-son-familiares)
- [**GET** | Users no-familiares](#get--users-que-no-son-familiares)
- [**GET** | Users Admins](#get--users-admins)
- [**GET** | Users Developers](#get--users-developers)
- [**GET** | Users General-Users](#get--users-general-users)
- [**POST** | Crear nuevo User (no usar a ser posible)](#post--crear-nuevo-user)
- [**DELETE** | Borrar un user (no usar a ser posible)](#delete--borrar-un-user)
- [**PATCH** | Actualizar user ya existente (parcial)](#patch--actualizar-user-ya-existente-parcial)
- [**PUT** | Actualizar user ya existente (completo)](#put--actualizar-user-ya-existente-completo)
---
## Autentificación de Users
### Registrarse
> [!IMPORTANT]
> Éste endpoint no necesita token de Auth para usarse.
- **Método**: POST
- **URL**: **`/registro`**
- **Descripción**: Crea un nuevo usuario en la base de datos a partir de un conjunto de datos. Es obligatorio insertar mínimo el **email**, **password**, **username**, **nombre**, y **apellido**. En caso de no ponerlos *es_empresa* y *es_familiar* se pondrán default a false, *porcentaje_discapacidad* a 0, y el rol siempre será *General-User*.

Body de la request:
```json
{
    "email": "emailEjemplo@gmail.com",
    "username": "userEjemplo",
    "password": "password",
    "password_confirmation": "password",
    "nombre": "User",
    "apellido": "Ejemplo",
    "telefono": "000000000",
    "fecha_nacimiento": "1990-05-15",
    "es_empresa": false,
    "es_familiar": false,
    "porcentaje_discapacidad": 0
}
```

Respuesta (**201 OK**):
```json
{
    "mensaje": "Usuario registrado exitosamente",
    "user": {
        "id": 0,
        "email": "emailEjemplo@gmail.com",
        "username": "userEjemplo"
    },
    "token": "xxxxxxxxxxxx"
}
```
[Volver arriba](#-índice)


### Login
> [!IMPORTANT]
> Éste endpoint no necesita token de Auth para usarse.
- **Método**: POST
- **URL**: **`/login`**
- **Descripción**: Inicia sesión de un usuario devolviendo su token de autentificación.

Body de la request:
```json
{
    "email": "emailEjemplo@gmail.com",
    "password": "password",
}
```

Respuesta (**201 OK**):
```json
{
    "token": "xxxxxxxxxxxx",
    "mensaje": "Inicio de sesión exitoso"
}
```
[Volver arriba](#-índice)

---
### GET | Todos los users
- **Método**: GET
- **URL**: **`/users`** / `/users?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.          |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users?page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users?page=2",
      "label": "Next &raquo;",
      "page": 2,
      "active": false
    }
  ],
  "next_page_url": "http://127.0.0.1:8000/api/v1/users?page=2",
  "path": "http://127.0.0.1:8000/api/v1/users",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 20
}
```
[Volver arriba](#-índice)

---
### GET | User por ID
- **Método**: GET
- **URL**: **`/user/{id}`**
- **Descripción**: Devuelve el usuario con el ID insertado. Si no hay coincidencias dará error 404. 

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si      | ID del usuario que se quiera encontrar.|


Respuesta (**200 OK**):
```json
{
  "id": 1,
  "email": "wilfred71@example.com",
  "username": "rwalter",
  "nombre": "Eliseo",
  "apellido": "Romaguera",
  "telefono": "+1.724.413.1142",
  "es_empresa": false,
  "es_familiar": false,
  "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
  "porcentaje_discapacidad": "68.84",
  "rol": {
    "id": 1,
    "nombre": "Admin"
  },
  "activo": true
}
```
[Volver arriba](#-índice)
---
### GET | Eventos creados por un User
- **Método**: GET
- **URL**: **`/user/{id}/eventosPropios`**
- **Descripción**: Recoge una lista de eventos creados por un User específico. 

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si      | ID del usuario del que se quiera recoger la lista de eventos creados por él.|


Respuesta (**200 OK**):
```json
[
    {
        "id": 4,
        "id_aplicacion": 1,
        "nombre": "Conferencia Tech 2026",
        "fecha_inicio_evento": "2026-03-15T10:00:00.000000Z",
        "fecha_final_evento": "2026-03-15T18:00:00.000000Z",
        "descripcion": "Evento sobre nuevas tecnologías.",
        "valoracion": "4.50",
        "ubicacion": "Madrid, Centro",
        "num_participantes": 150,
        "foto_evento": "tech.jpg",
        "es_accesible": true,
        "categoria": {
            "id": 1,
            "nombre": "Deporte"
        },
        "entidad": {
            "id": 1,
            "nombre": "Entidad1"
        },
        "creador": {
            "id": 10,
            "username": "dolores"
        },
        "tags": []
    }
]
```
[Volver arriba](#-índice)
---
### GET | Eventos en los que participa un User
- **Método**: GET
- **URL**: **`/user/{id}/eventos`**
- **Descripción**: Recoge un listado de eventos en los que participa o ha participado un User específico. 

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si      | ID del usuario del que se quiera recoger la lista de eventos en los que participa.|


Respuesta (**200 OK**):
```json
[
  {
      "id": 4,
      "id_aplicacion": 1,
      "nombre": "Conferencia Tech 2026",
      "fecha_inicio_evento": "2026-03-15T10:00:00.000000Z",
      "fecha_final_evento": "2026-03-15T18:00:00.000000Z",
      "descripcion": "Evento sobre nuevas tecnologías.",
      "valoracion": "4.50",
      "ubicacion": "Madrid, Centro",
      "num_participantes": 150,
      "foto_evento": "tech.jpg",
      "es_accesible": true,
      "categoria": {
          "id": 1,
          "nombre": "Deporte"
      },
      "entidad": {
          "id": 1,
          "nombre": "Entidad1"
      },
      "creador": {
          "id": 10,
          "username": "dolores"
      },
      "aplicacion": {
          "id": 1,
          "nombre_app": "Deportes"
      }
  }
]
```
[Volver arriba](#-índice)


---
### GET | User por Username
- **Método**: GET
- **URL**: **`/users/username/{username}`** / `/users/username/?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios cuyo username coincida con el parámetro pasado. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Username ``      | string       | Si      | Username del usuario. Comprueba coincidencias con el inicio del username.      |
| ``Num_Pagina ``      | integer       | No      | Número de página de la búsqueda. La página 0 es igual que la página 1.        |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/username/rwalter?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/username/rwalter?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/username/rwalter?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/username/rwalter",
  "per_page": 10,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```
[Volver arriba](#-índice)


---
### GET | Users por coincidencias en el nombre completo y el username
- **Método**: GET
- **URL**: **`/users/search/{busqueda}`** / `/users/search/{busqueda}?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios de la base de datos cuyo nombre, apellido, o username comience con el parámetro de búsqueda. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Busqueda ``      | string      | Si       | Parámetro de búsqueda.       |
| ``Num_Pagina ``      | integer       | No      | Número de página de la búsqueda. La página 0 es igual que la página 1.       |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 18,
      "email": "fleta58@example.org",
      "username": "usteuber",
      "nombre": "Delia",
      "apellido": "Kulas",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": null,
      "porcentaje_discapacidad": "57.53",
      "rol": {
        "id": 3,
        "nombre": "User"
      },
      "activo": false
    },
    {
      "id": 19,
      "email": "qlubowitz@example.net",
      "username": "yheathcote",
      "nombre": "Destiney",
      "apellido": "Frami",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "2014-10-23T00:00:00.000000Z",
      "porcentaje_discapacidad": "5.76",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/search/de?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/search/de?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/search/de?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/search/de",
  "per_page": 10,
  "prev_page_url": null,
  "to": 2,
  "total": 2
}
```
[Volver arriba](#-índice)


---
### GET | Users activos
- **Método**: GET
- **URL**: **`/users/activos`** / `/users/activos?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios definidos como activos en la base de datos. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.     |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/activos?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/activos?page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/activos?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/activos?page=2",
      "label": "2",
      "page": 2,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/activos?page=2",
      "label": "Next &raquo;",
      "page": 2,
      "active": false
    }
  ],
  "next_page_url": "http://127.0.0.1:8000/api/v1/users/activos?page=2",
  "path": "http://127.0.0.1:8000/api/v1/users/activos",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 17
}
```
[Volver arriba](#-índice)


---
### GET | Users inactivos
- **Método**: GET
- **URL**: **`/users/inactivos`** / `/users/inactivos?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios definidos como inactivos de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 8,
      "email": "xbradtke@example.com",
      "username": "eferry",
      "nombre": "Kari",
      "apellido": "Murphy",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": true,
      "fecha_nacimiento": "1993-09-07T00:00:00.000000Z",
      "porcentaje_discapacidad": "49.23",
      "rol": {
        "id": 2,
        "nombre": "Developer"
      },
      "activo": false
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/inactivos?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/inactivos?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/inactivos?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/inactivos",
  "per_page": 10,
  "prev_page_url": null,
  "to": 3,
  "total": 3
}
```
[Volver arriba](#-índice)


---
### GET | Users que son empresas
- **Método**: GET
- **URL**: **`/users/empresas`** / `/users/empresas?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios definidos como empresa de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 20,
      "email": "drutherford@example.org",
      "username": "tanya.becker",
      "nombre": "Kira",
      "apellido": "Rice",
      "telefono": null,
      "es_empresa": true,
      "es_familiar": false,
      "fecha_nacimiento": "1990-03-17T00:00:00.000000Z",
      "porcentaje_discapacidad": "76.75",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/empresas?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/empresas?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/empresas?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/empresas",
  "per_page": 10,
  "prev_page_url": null,
  "to": 5,
  "total": 5
}
```
[Volver arriba](#-índice)


---
### GET | Users que no son empresas
- **Método**: GET
- **URL**: **`/users/no-empresas`** / `/users/no-empresas?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios no definidos como empresa de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=2",
      "label": "2",
      "page": 2,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=2",
      "label": "Next &raquo;",
      "page": 2,
      "active": false
    }
  ],
  "next_page_url": "http://127.0.0.1:8000/api/v1/users/no-empresas?page=2",
  "path": "http://127.0.0.1:8000/api/v1/users/no-empresas",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 15
}
```
[Volver arriba](#-índice)


---
### GET | Users que son familiares
- **Método**: GET
- **URL**: **`/users/familiares`** / `/users/familiares?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios definidos como familiar de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |

Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 8,
      "email": "xbradtke@example.com",
      "username": "eferry",
      "nombre": "Kari",
      "apellido": "Murphy",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": true,
      "fecha_nacimiento": "1993-09-07T00:00:00.000000Z",
      "porcentaje_discapacidad": "49.23",
      "rol": {
        "id": 2,
        "nombre": "Developer"
      },
      "activo": false
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/familiares?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/familiares?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/familiares?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/familiares",
  "per_page": 10,
  "prev_page_url": null,
  "to": 2,
  "total": 2
}
```
[Volver arriba](#-índice)


---
### GET | Users que no son familiares
- **Método**: GET
- **URL**: **`/users/no-familiares`** / `/users/no-familiares?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios no definidos como familiar de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=1",
  "from": 1,
  "last_page": 2,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=2",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=2",
      "label": "2",
      "page": 2,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=2",
      "label": "Next &raquo;",
      "page": 2,
      "active": false
    }
  ],
  "next_page_url": "http://127.0.0.1:8000/api/v1/users/no-familiares?page=2",
  "path": "http://127.0.0.1:8000/api/v1/users/no-familiares",
  "per_page": 10,
  "prev_page_url": null,
  "to": 10,
  "total": 18
}
```
[Volver arriba](#-índice)


---
### GET | Users Admins
- **Método**: GET
- **URL**: **`/users/admins`** / `/users/admins?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios con el rol de "Admin" de la base de datos. En caso de usar la primera url se dará la primera página. Paginada, muestra 10 resultados por página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "email": "wilfred71@example.com",
      "username": "rwalter",
      "nombre": "Eliseo",
      "apellido": "Romaguera",
      "telefono": "+1.724.413.1142",
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1985-06-05T00:00:00.000000Z",
      "porcentaje_discapacidad": "68.84",
      "rol": {
        "id": 1,
        "nombre": "Admin"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/admins?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/admins?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/admins?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/admins",
  "per_page": 10,
  "prev_page_url": null,
  "to": 9,
  "total": 9
}
```
[Volver arriba](#-índice)


---
### GET | Users Developers
- **Método**: GET
- **URL**: **`/users/developers`** / `/users/developers?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios con el rol de "Developer" de la base de datos. En caso de usar la primera url se dará la primera página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |


Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 4,
      "email": "gregg02@example.com",
      "username": "dickens.connor",
      "nombre": "Thea",
      "apellido": "Rogahn",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "1997-12-10T00:00:00.000000Z",
      "porcentaje_discapacidad": "97.33",
      "rol": {
        "id": 2,
        "nombre": "Developer"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/developers?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/developers?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/developers?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/developers",
  "per_page": 10,
  "prev_page_url": null,
  "to": 3,
  "total": 3
}
```
[Volver arriba](#-índice)


---
### GET | Users General-Users
- **Método**: GET
- **URL**: **`/users/general-users`** / `/users/general-users?page={num_pagina}` (opcional)
- **Descripción**: Devuelve todos los usuarios con el rol de "General User" de la base de datos. En caso de usar la primera url se dará la primera página.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Num_Pagina ``      | integer       | No       | En caso de no darse se mostrará la primera página. La página 0 es igual que la página 1.      |

Respuesta (**200 OK**):
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 3,
      "email": "bwunsch@example.net",
      "username": "keeling.cheyanne",
      "nombre": "Ellis",
      "apellido": "Grimes",
      "telefono": null,
      "es_empresa": false,
      "es_familiar": false,
      "fecha_nacimiento": "2018-09-18T00:00:00.000000Z",
      "porcentaje_discapacidad": "18.14",
      "rol": {
        "id": 3,
        "nombre": "User"
      },
      "activo": true
    },
  ],
  "first_page_url": "http://127.0.0.1:8000/api/v1/users/general-users?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/api/v1/users/general-users?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/api/v1/users/general-users?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/api/v1/users/general-users",
  "per_page": 10,
  "prev_page_url": null,
  "to": 8,
  "total": 8
}
```
[Volver arriba](#-índice)

---
### POST | Crear nuevo User
- **Método**: POST
- **URL**: **`/user`**
- **Descripción**: Crea un nuevo usuario en la base de datos a partir de un conjunto de datos. Es obligatorio insertar mínimo el **email**, **password**, **username**, **nombre**, y **apellido**. En caso de no ponerlos *es_empresa* y *es_familiar* se pondrán default a false, *porcentaje_discapacidad* a 0, y el rol a *General-User*.

Body de la request:
```json
{
  "username": "juanperez",
  "email": "juanperez@mail.com",
  "nombre": "Juan",
  "apellido": "Pérez",
  "telefono": "+34600111222",
  "es_empresa": false,
  "fecha_nacimiento": "1995-06-20",
  "porcentaje_discapacidad": 15,
  "rol": 3,
  "password": "Secreta123!",
  "password_confirmation": "Secreta123!"
}
```

Respuesta (**201 OK**):
```json
{
    "username": "juanperez",
    "email": "juanperez@mail.com",
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "+34600111222",
    "es_empresa": false,
    "fecha_nacimiento": "1995-06-20T00:00:00.000000Z",
    "porcentaje_discapacidad": "15.00",
    "rol": 3,
    "id": 28
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar un user
- **Método**: DELETE
- **URL**: **`/user/{id}`**
- **Descripción**: Elimina el user de la base de datos.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si       | ID del usuario que se quiere eliminar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar User ya existente (PARCIAL)
- **Método**: PATCH
- **URL**: **`/user/{id}`**
- **Descripción**: Actualiza uno o varios campos de un usuario. Solo deben enviarse los campos que se desean modificar.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       | ID del usuario que se quiere modificar.      |
| `username`      | string       | No       |       |
| `nombre`      | string       | No       |       |
| `apellido`      | string       | No       |       |
| `email`      | string       | No       |       |
| `telefono`      | string / null      | No       |       |
| `es_empresa`      | boolean      | No       |       |
| `es_familiar`      | boolean       | No       |       |
| `fecha_nacimiento`      | date       | No       | Formato YYYY-MM-DD      |
| `activo`      | boolean       | No       | Deprecated. No se usa.      |


Body de la request (poner sólo los campos que se quieran cambiar):
```json
{
  "username": "nuevo_usuario",
  "email": "nuevo_email@mail.com",
  "nombre": "Juan",
  "apellido": "Pérez",
  "telefono": "+34600111222",
  "es_empresa": false,
  "fecha_nacimiento": "1995-06-20",
  "porcentaje_discapacidad": 15,
  "rol": 3,
  "password": "NuevaPassword123!",
  "password_confirmation": "NuevaPassword123!"
}
```

Respuesta (**200 OK**):
```json
{
    "id": 2,
    "email": "nuevo_email@mail.com",
    "username": "nuevo_usuario",
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "+34600111222",
    "es_empresa": false,
    "es_familiar": false,
    "fecha_nacimiento": "1995-06-20T00:00:00.000000Z",
    "porcentaje_discapacidad": "15.00",
    "rol": 3,
    "activo": true
}
```
[Volver arriba](#-índice)

---
### PUT | Actualizar User ya existente (COMPLETO)
- **Método**: PUT
- **URL**: **`/user/{id}`**
- **Descripción**: Actualiza uno o varios campos de un usuario. Solo deben enviarse los campos que se desean modificar.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       | ID del usuario que se quiere modificar.      |
| `username`      | string       | No       |       |
| `nombre`      | string       | No       |       |
| `apellido`      | string       | No       |       |
| `email`      | string       | No       |       |
| `telefono`      | string / null      | No       |       |
| `es_empresa`      | boolean      | No       |       |
| `es_familiar`      | boolean       | No       |       |
| `fecha_nacimiento`      | date       | No       | Formato YYYY-MM-DD      |
| `activo`      | boolean       | No       | Deprecated. No se usa.      |


Body de la request:
```json
{
  "username": "jp",
  "email": "juanperez_actualizado@mail.com",
  "nombre": "Juan",
  "apellido": "Pérez",
  "telefono": "+34600111222",
  "es_empresa": false,
  "fecha_nacimiento": "1995-06-20",
  "porcentaje_discapacidad": 15,
  "rol": 3,
  "password": "NuevaPassword123!",
  "password_confirmation": "NuevaPassword123!"
}
```

Respuesta (**200 OK**):
```json
{
    "id": 2,
    "email": "juanperez_actualizado@mail.com",
    "username": "jp",
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "+34600111222",
    "es_empresa": false,
    "es_familiar": false,
    "fecha_nacimiento": "1995-06-20T00:00:00.000000Z",
    "porcentaje_discapacidad": "15.00",
    "rol": 3,
    "activo": true
}
```
[Volver arriba](#-índice)


---

### 💡 | Eventos
**Validaciones**:
| Parámetro             | Datatype                |
| --------------------- | ----------------------- |
| `id`                  | BIGINT (PRIMARY KEY)    |
| `id_categoria`        | BIGINT (unsigned, FK)   |
| `id_entidad`          | BIGINT (unsigned, FK)   |
| `id_creador`          | BIGINT (unsigned, FK)   |
| `nombre`              | VARCHAR(255)            |
| `fecha_inicio_evento` | TIMESTAMP               |
| `fecha_final_evento`  | TIMESTAMP               |
| `descripcion`         | TEXT (nullable)         |
| `valoracion`          | DECIMAL(4,2)            |
| `ubicacion`           | VARCHAR(24) (nullable)  |
| `num_participantes`   | INT                     |
| `foto_evento`         | VARCHAR(255) (nullable) |
| `es_accesible`        | BOOLEAN                 |
| `created_at`          | TIMESTAMP               |
| `updated_at`          | TIMESTAMP               |


---
**Endpoints:**
- [**GET** | Todos los eventos](#get--todos-los-eventos)
- [**GET** | Evento por ID](#get--evento-por-id)
- [**GET** | Eventos con datos reducidos para la web](#get--eventos-para-la-web)
- [**POST** | Crear nuevo Evento](#post--crear-nuevo-evento)
- [**DELETE** | Borrar un Evento](#delete--borrar-un-evento)
- [**PUT** | Actualizar un Evento](#patch--actualizar-un-evento)

---

**Endpoints:**
### GET | Todos los Eventos
- **Método**: GET
- **URL**: **`/eventos`**
- **Descripción**: Recoge todas los eventos de la base de datos. Paginación de 10.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "id_categoria": 2,
    "id_entidad": 1,
    "id_creador": 21,
    "nombre": "Concierto solidario",
    "fecha_inicio_evento": "2026-03-10T18:00:00.000000Z",
    "fecha_final_evento": "2026-03-10T21:00:00.000000Z",
    "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
    "valoracion": "5.55",
    "ubicacion": "65b8f1a9c2e44f0a12345678",
    "num_participantes": 200,
    "foto_evento": "evento1.jpg",
    "es_accesible": true,
    "categoria": {
        "id": 2,
        "nombre": "Deportes"
    },
    "entidad": {
        "id": 1,
        "nombre": "Deportes Paco S.L.",
        "es_accesible": true
    },
    "creador": {
        "id": 21,
        "username": "username",
        "email": "email@gmail.com",
        "nombre": "nombreUsuario",
        "apellido": "apellidoUsuario"
    },
    "tags": []
}
```
[Volver arriba](#-índice)

---

### GET | Eventos para la web
> [!IMPORTANT]
> Éste endpoint no necesita token de Auth para usarse.
- **Método**: GET
- **URL**: **`/eventosweb`**
- **Descripción**: Recoge todos los eventos con datos reducidos para la web de demostración. Paginación de 10.

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "Concierto solidario",
  "fecha_inicio_evento": "2026-03-10T18:00:00.000000Z",
  "ubicacion": "65b8f1a9c2e44f0a12345678",
  "es_accesible": true,
  "categoria": {
      "id": 2,
      "nombre": "Deportes"
  },
  "entidad": {
      "id": 1,
      "nombre": "Deportes"
  },
  "creador": {
      "id": 21,
      "username": "lausnchez"
  },
  "tags": []
}
```
[Volver arriba](#-índice)

---

### GET | Evento por ID
- **Método**: GET
- **URL**: **`/evento/{id}`**
- **Descripción**: Recoge un Evento por ID.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "id_categoria": 2,
    "id_entidad": 1,
    "id_creador": 21,
    "nombre": "Concierto solidario",
    "fecha_inicio_evento": "2026-03-10T18:00:00.000000Z",
    "fecha_final_evento": "2026-03-10T21:00:00.000000Z",
    "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
    "valoracion": "5.55",
    "ubicacion": "65b8f1a9c2e44f0a12345678", // Relación futura con MongoDB
    "num_participantes": 200,
    "foto_evento": "evento1.jpg",
    "es_accesible": true,
    "categoria": {
        "id": 2,
        "nombre": "Deportes"
    },
    "entidad": {
        "id": 1,
        "nombre": "Deportes Paco S.L.",
        "es_accesible": true
    },
    "creador": {
        "id": 21,
        "username": "username",
        "email": "email@gmail.com",
        "nombre": "nombreUsuario",
        "apellido": "apellidoUsuario"
    },
    "tags": []
}
```
[Volver arriba](#-índice)

---
### POST | Crear nuevo Evento
- **Método**: POST
- **URL**: **`/evento`**
- **Descripción**: Crea un nuevo Evento.

**Parámetros**: 
| Parámetro                 | Tipo    | Requerido |
| ------------------------- | ------- | --------- |
| `username`                | string  | Sí        |
| `nombre`                  | string  | Sí        |
| `apellido`                | string  | Sí        |
| `email`                   | string  | Sí        |
| `password`                | string  | Sí        |
| `telefono`                | string  | No        |
| `es_empresa`              | boolean | No        |
| `es_familiar`             | boolean | No        |
| `fecha_nacimiento`        | date    | No        |
| `porcentaje_discapacidad` | decimal | No        |
| `rol`                     | integer | Sí        |
| `activo`                  | boolean | No        |


Body de la request:
```json
{
  "id_categoria": 2,
  "id_entidad": 1,
  "id_creador": 21,
  "nombre": "Concierto solidario",
  "fecha_inicio_evento": "2026-03-10 18:00:00",
  "fecha_final_evento": "2026-03-10 21:00:00",
  "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
  "valoracion": 0.00,
  "ubicacion": "65b8f1a9c2e44f0a12345678",
  "num_participantes": 0,
  "foto_evento": "evento1.jpg",
  "es_accesible": true
}
```

Respuesta (**200 OK**):
```json
{
  "id_categoria": 2,
  "id_entidad": 1,
  "id_creador": 21,
  "nombre": "Concierto solidario",
  "fecha_inicio_evento": "2026-03-10T18:00:00.000000Z",
  "fecha_final_evento": "2026-03-10T21:00:00.000000Z",
  "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
  "valoracion": "0.00",
  "ubicacion": "65b8f1a9c2e44f0a12345678",
  "num_participantes": 0,
  "foto_evento": "evento1.jpg",
  "es_accesible": true,
  "id": 2
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar un Evento
- **Método**: DELETE
- **URL**: **`/evento/{id}`**
- **Descripción**: Elimina el evento de la base de datos.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``id``      | integer       | Si       | ID del evento que se quiere eliminar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar un Evento
- **Método**: PUT
- **URL**: **`/evento/{id}`**
- **Descripción**: Actualiza un evento.

**Parámetros**: 
| Parámetro                 | Tipo    | Requerido |
| ------------------------- | ------- | --------- |
| `username`                | string  | Sí        |
| `nombre`                  | string  | Sí        |
| `apellido`                | string  | Sí        |
| `email`                   | string  | Sí        |
| `password`                | string  | Sí        |
| `telefono`                | string  | No        |
| `es_empresa`              | boolean | No        |
| `es_familiar`             | boolean | No        |
| `fecha_nacimiento`        | date    | No        |
| `porcentaje_discapacidad` | decimal | No        |
| `rol`                     | integer | Sí        |
| `activo`                  | boolean | No        |

Body de la request:
```json
{
  "id_categoria": 2,
  "id_entidad": 1,
  "id_creador": 21,
  "nombre": "Concierto solidario",
  "fecha_inicio_evento": "2026-03-10 18:00:00",
  "fecha_final_evento": "2026-03-10 21:00:00",
  "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
  "valoracion": 0.00,
  "ubicacion": "65b8f1a9c2e44f0a12345678",
  "num_participantes": 0,
  "foto_evento": "evento1.jpg",
  "es_accesible": true
}
```

Respuesta (**200 OK**):
```json
{
  "id_categoria": 2,
  "id_entidad": 1,
  "id_creador": 21,
  "nombre": "Concierto solidario",
  "fecha_inicio_evento": "2026-03-10 18:00:00",
  "fecha_final_evento": "2026-03-10 21:00:00",
  "descripcion": "Evento benéfico con música en directo para recaudar fondos.",
  "valoracion": 0.00,
  "ubicacion": "65b8f1a9c2e44f0a12345678",
  "num_participantes": 0,
  "foto_evento": "evento1.jpg",
  "es_accesible": true
}
```
[Volver arriba](#-índice)



### 💡 | Categorías

**Validaciones**:
| Parámetro | Datatype |
|--------------|--------------|
| ``Nombre``| VARCHAR(50)|
| ``Descripcion``| VARCHAR(255)|

---
- [**GET** | Todos las Categorías](#get--todos-las-categorías)
- [**GET** | Categoría por ID](#get--categoría-por-id)
- [**POST** | Crear nueva Categoría](#post--crear-nueva-categoría)
- [**DELETE** | Borrar una Categoría](#delete--borrar-una-categoría)
- [**PUT** | Actualizar una Categoría](#patch--actualizar-una-categoría)

---
**Endpoints:**
### GET | Todos las Categorías
- **Método**: GET
- **URL**: **`/categorias`**
- **Descripción**: Recoge todas las categorías de la base de datos. Paginación de 10.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nombreCategoria",
    "descripcion": "Descripción de la categoría"
}
```
[Volver arriba](#-índice)

---

### GET | Categoría por ID
- **Método**: GET
- **URL**: **`/categoria/{id}`**
- **Descripción**: Recoge una Categoria por ID.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nombreCategoria",
    "descripcion": "descripciónCategoria",
}
```
[Volver arriba](#-índice)

---
### POST | Crear nueva Categoría
- **Método**: POST
- **URL**: **`/categoria`**
- **Descripción**: Crea una nueva Categoría.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``Nombre``      | string       | Si       | Nombre de la categoría|
| ``Descripción``      | string       | Si       | Descripción de la categoría|


Body de la request:
```json
{
  "nombre": "nombreCategoria",
  "descripcion": "descripcionCategoria"
}
```

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "nombreCategoria",
  "descripcion": "descripcionCategoria"
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar una Categoría
- **Método**: DELETE
- **URL**: **`/categoria/{id}`**
- **Descripción**: Elimina la categoría de la base de datos.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si       | ID de la categoría que se quiere eliminar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar una Categoría
- **Método**: PUT
- **URL**: **`/categoria/{id}`**
- **Descripción**: Actualiza una categoría.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       | ID del usuario que se quiere modificar.      |
| `nombre`      | string       | Si      | Nombre de la categoría |
| `descripcion`      | string       | Si      | Descripción de la categoría |


Body de la request:
```json
{
  "nombre": "nombreCategoría",
  "descripcion": "descripcionCategoria",
}
```

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nuevoNombreCategoria",
    "descripcion": "nuevaDescripcionCategoria",
}
```
[Volver arriba](#-índice)



### 💡 | Entidades
**Endpoints:**

**Validaciones**:
| Parámetro | Datatype |
|--------------|--------------|
| ``Nombre``| VARCHAR(255)|
| ``Descripcion``| TEXT|
| ``Es_Accesible``| BOOLEAN|
| ``Foto_Entidad``| VARCHAR(255) |

---
- [**GET** | Todos las Entidades](#get--todos-las-entidades)
- [**GET** | Entidad por ID](#get--entidad-por-id)
- [**POST** | Crear nueva Entidad](#post--crear-nueva-entidad)
- [**DELETE** | Borrar una Entidad](#delete--borrar-una-entidad)
- [**PUT** | Actualizar Entidad](#patch--actualizar-entidad)

---

### GET | Todos las Entidades
- **Método**: GET
- **URL**: **`/entidades`**
- **Descripción**: Recoge todos las entidades de la base de datos. Paginación de 10.

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "nombre de la entidad",
  "descripcion": "Descripción de la entidad",
  "es_accesible": true,
  "foto_entidad": "url de la foto"  
}
```
[Volver arriba](#-índice)

---

### GET | Entidad por ID
- **Método**: GET
- **URL**: **`/entidad/{id}`**
- **Descripción**: Recoge una Entidad por ID.

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "nombre de la entidad",
  "descripcion": "Descripción de la entidad",
  "es_accesible": true,
  "foto_entidad": "url de la foto"  
}
```
[Volver arriba](#-índice)

---
### POST | Crear nueva Entidad
- **Método**: POST
- **URL**: **`/entidad`**
- **Descripción**: Crea una nueva Entidad.

Body de la request:
```json
{
  "nombre": "nombre de la entidad",
  "descripcion": "Descripción de la entidad",
  "es_accesible": true,
  "foto_entidad": "url de la foto" 
}
```

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "nombre de la entidad",
  "descripcion": "Descripción de la entidad",
  "es_accesible": true,
  "foto_entidad": "url de la foto"  
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar una Entidad
- **Método**: DELETE
- **URL**: **`/entidad/{id}`**
- **Descripción**: Elimina la entidad de la base de datos.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si       | ID del tag que se quiere eliminar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar Entidad
- **Método**: PUT
- **URL**: **`/entidad/{id}`**
- **Descripción**: Actualiza una entidad. Edita parcialmente, por lo que sólo se deben pasar los datos que se quieren actualizar.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       |  |
| `nombre`      | string       | Si       |  |
| `descripcion`      | string       | No      |  |
| `es_accesible`      | boolean      | Si       |  |
| `foto_entidad`      | string       | No       |  |


Body de la request:
```json
{
    "nombre": "Deportes",
    "descripcion": "Para hacer ejercicio en compañía."
}
```

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "Deportes",
    "descripcion": "Para hacer ejercicio en compañía.",
    "es_accesible": false,
    "foto_entidad": null
}
```
[Volver arriba](#-índice)



### 💡 | Tags
**Endpoints:**
**Validaciones**:
| Parámetro | Datatype |
|--------------|--------------|
| ``Nombre``| VARCHAR(255)|

---
- [**GET** | Todos los Tags](#get--todos-los-tags)
- [**GET** | Tag por ID](#get--tag-por-id)
- [**POST** | Crear nuevo Tag](#post--crear-nuevo-tag)
- [**DELETE** | Borrar un Tag](#delete--borrar-un-tag)
- [**PUT** | Actualizar Tag](#patch--actualizar-tag)

---

### GET | Todos los Tags
- **Método**: GET
- **URL**: **`/tags`**
- **Descripción**: Recoge todos los tags de la base de datos. Paginación de 10.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nombreTag",
}
```
[Volver arriba](#-índice)

---

### GET | Tag por ID
- **Método**: GET
- **URL**: **`/tag/{id}`**
- **Descripción**: Recoge un Tag por ID.

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nombreTag",
}
```
[Volver arriba](#-índice)

---
### POST | Crear nuevo Tag
- **Método**: POST
- **URL**: **`/tag`**
- **Descripción**: Crea un nuevo Tag.

Body de la request:
```json
{
  "nombre": "nombreTag"
}
```

Respuesta (**200 OK**):
```json
{
  "id": 1,
  "nombre": "nombreTag"
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar un Tag
- **Método**: DELETE
- **URL**: **`/tag/{id}`**
- **Descripción**: Elimina el tag de la base de datos.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``ID ``      | integer       | Si       | ID del tag que se quiere eliminar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar Tag
- **Método**: PUT
- **URL**: **`/tag/{id}`**
- **Descripción**: Actualiza un tag. 

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       | ID del usuario que se quiere modificar.      |
| `nombre`      | string       | No       |       |


Body de la request:
```json
{
  "nombre": "nuevoNombreTag",
}
```

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre": "nuevoNombreTag",
}
```
[Volver arriba](#-índice)

### 💡 | Aplicaciones
**Endpoints:**
**Validaciones**:
| Parámetro | Datatype |
|--------------|--------------|
| ``nombre_app``| VARCHAR(255)|

---
- [**GET** | Todos las Aplicaciones](#get--todas-las-aplicaciones)
- [**GET** | Aplicación por ID](#get--aplicaciones-por-id)
- [**POST** | Crear nueva Aplicación](#post--crear-nueva-aplicación)
- [**DELETE** | Borrar una Aplicación](#delete--borrar-una-aplicación)
- [**PUT** | Actualizar Aplicación](#patch--actualizar-aplicación)

---

### GET | Todas las aplicaciones
- **Método**: GET
- **URL**: **`/aplicaciones`**
- **Descripción**: Recoge todos las aplicaciones de la base de datos. Sin paginar.

Respuesta (**200 OK**):
```json
[
    {
        "id": 1,
        "nombre_app": "Deportes"
    },
    {
        "id": 2,
        "nombre_app": "Mayores"
    },
    {
        "id": 3,
        "nombre_app": "Jóvenes"
    }
]
```
[Volver arriba](#-índice)

---

### GET | Aplicaciones por ID
- **Método**: GET
- **URL**: **`/aplicacion/{id}`**
- **Descripción**: Recoge una aplicación por ID.

Respuesta (**200 OK**):
```json
{
    "id": 3,
    "nombre_app": "Jóvenes"
}
```
[Volver arriba](#-índice)

---
### POST | Crear nueva Aplicación

> [!IMPORTANT]
> No se debe usar, sólo funciona por usabilidad.

- **Método**: POST
- **URL**: **`/aplicacion`**
- **Descripción**: Crea una nueva aplicación.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``nombre_app ``      | VARCHAR(255)       | Si       | Nombre de la aplicación      |


Body de la request:
```json
{
    "nombre_app": "Deportes"
}
```

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre_app": "Deportes"
}
```
[Volver arriba](#-índice)

---
### DELETE | Borrar una Aplicación

> [!IMPORTANT]
> No se debe usar, sólo funciona por usabilidad.

- **Método**: DELETE
- **URL**: **`/aplicacion/{id}`**
- **Descripción**: Elimina la aplicación.

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| ``id ``      | integer       | Si       | ID de la aplicación que se quiere borrar.      |


Respuesta (**204 OK**).

[Volver arriba](#-índice)

---
### PATCH | Actualizar Aplicación

> [!IMPORTANT]
> No se debe usar, sólo funciona por usabilidad.

- **Método**: PUT
- **URL**: **`/aplicacion/{id}`**
- **Descripción**: Actualiza una aplicación. 

**Parámetros**: 
| Parámetro | Tipo | Requerido | Descripción |
|--------------|--------------|--------------|--------------|
| **`ID`**     | integer       | Si       | ID de la aplicación.      |
| `nombre_app`      | string       | No       | Nombre de la app      |


Body de la request:
```json
{
    "id": 1,
    "nombre_app": "Deportes"
}
```

Respuesta (**200 OK**):
```json
{
    "id": 1,
    "nombre_app": "Deportes"
}
```
[Volver arriba](#-índice)


### 💡 | Opiniones
Todavía no está desarrollado.

## ❗ Tecnologías usadas (versiones)
- PHP: 8.2
- Laravel: 12.0
- MySQL
- Laravel Sanctum: 4.2
- Laravel Breeze: 2.3
