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
> La URL base es: `www.url-temporal.com`. A partir de ahí se deben agregar los endpoints de cada función.

1. **Generar un .env a partir de ejemplo** y insertar los datos de la bbdd. Importante mirar que está puesto en `mysql` y no en sqlite en DB_CONNECTION.
2. Generar una APP_KEY con `php artisan key:generate`.
3. Crear el vendor con `composer install`. 
4. Crear la base de datos en local vacía con el mismo nombre que la hayáis puesto en el .env. También se puede crear al realizar las migraciones gracias a composer.
5. Generar las migraciones de las tablas default de la API con `php artisan migrate`.

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
Todavía no está desarrollado.

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
- [ ] Usuarios 
- [ ] Entidades 
- [ ] Eventos
- [ ] Categorías
- [ ] Tags
- [ ] Opiniones
- [ ] Roles

### Controladores
- [ ] Usuarios 
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