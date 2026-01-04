# Conecta API
> [!NOTE]
> Ya están disponibles las migraciones de la base de datos. Tenéis la estructura más abajo por si la necesitáis. **Se está trabajando actualmente en los modelos**.

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
    - [Opiniones](#--opiniones) 
4. [Tecnologías usadas y sus versiones](#-tecnologías-usadas-versiones)

[Cosas por hacer](#️-cosas-por-hacer)

## 💾 Al importar en el PC
> [!IMPORTANT]
> La URL base es: `www.url-temporal.com/v1`. A partir de ahí se deben agregar los endpoints de cada función.

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
> [!IMPORTANT]
> Se está trabajando actualmente en: `Users`

### 💡 | Usuarios
- [Todos los users](#get--todos-los-users)
- [User por ID](#get--user-por-id)
- [User por Username](#get--user-por-username)
- [Users activos](#get--users-activos)
- [Users inactivos](#get--users-inactivos)
- [Users empresas](#get--users-que-son-empresas)
- [Users no-empresas](#get--users-que-no-son-empresas)
- [Users familiares](#get--users-que-son-familiares)
- [Users no-familiares](#get--users-que-no-son-familiares)
- [Users Admins](#get--users-admins)
- [Users Developers](#get--users-developers)
- [Users General-Users](#get--users-general-users)


#### GET | Todos los users
- Método: **GET**

- **URL: `/users`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[
    
]
```
#### GET | User por ID
- Método: **GET**

- **URL: `users/{id}`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | User por Username
- Método: **GET**

- **URL: `/username/{username}`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users activos
- Método: **GET**

- **URL: `/users/activos`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users inactivos
- Método: **GET**

- **URL: `/users/inactivos`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users que son empresas
- Método: **GET**

- **URL: `users/empresas`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users que no son empresas
- Método: **GET**

- **URL: `users/no-empresas`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users que son familiares
- Método: **GET**

- **URL: `/users/familiares`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users que no son familiares
- Método: **GET**

- **URL: `/users/no-familiares`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users Admins
- Método: **GET**

- **URL: `/users/admins`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users Developers
- Método: **GET**

- **URL: `/users/developers`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```
#### GET | Users General-Users
- Método: **GET**

- **URL: `/users/general-users`**

- Body de la request:
```json
[

]
```
- Respuesta:
```json
[

]
```

### 💡 | Eventos
Todavía no está desarrollado.

### 💡 | Categorías
Todavía no está desarrollado.

### 💡 | Entidades
Todavía no está desarrollado.

### 💡 | Tags
Todavía no está desarrollado.

### 💡 | Opiniones
Todavía no está desarrollado.

## ✏️ Cosas por hacer
### Modelos básicos
- [x] Usuarios 
- [x] Entidades 
- [x] Eventos
- [x] Categorías
- [x] Tags
- [x] Opiniones
- [x] Roles

### Relaciones
- [x] Usuarios 
- [x] Entidades 
- [x] Eventos
- [x] Categorías
- [x] Tags
- [x] Opiniones
- [x] Roles

### Métodos del modelo
- [x] Usuarios 
- [ ] Entidades 
- [ ] Eventos
- [ ] Categorías
- [ ] Tags
- [ ] Opiniones
- [ ] Roles

### Controladores
- [x] Usuarios 
- [ ] Entidades 
- [ ] Eventos
- [ ] Categorías
- [ ] Tags
- [ ] Opiniones
- [ ] Roles

### Routing
- [x] Usuarios 
- [ ] Entidades 
- [ ] Eventos
- [ ] Categorías
- [ ] Tags
- [ ] Opiniones
- [ ] Roles


## ❗ Tecnologías usadas (versiones)
- PHP: 8.2
- Laravel: 12.0
- MySQL
- Laravel Sanctum: 4.2
- Laravel Breeze: 2.3