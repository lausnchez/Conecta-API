# Conecta API

> [!NOTE]
> Ya están disponibles las migraciones de la base de datos. Tenéis la estructura más abajo por si la necesitais.

## 💾 Al importar en el PC
> [!IMPORTANT]
> Antes de realizar cualquier cosa es importante hacer todos estos pasos para asegurarnos de que todo funciona correctamente.

1. **Generar un .env a partir de ejemplo** y insertar los datos de la bbdd. Importante mirar que está puesto en mysql y no en sqlite en DB_CONNECTION.
2. Generar una APP_KEY con `php artisan key:generate`.
3. Crear el vendor con `composer install`. 
4. Crear la base de datos en local con el mismo nombre que la hayáis puesto en el .env.
5. Generar las migraciones de las tablas default de la API con `php artisan migrate`.

> [!CAUTION]
> No se sabe de momento si al importar se deben de hacer configuraciones iniciales de Sanctum y Breeze, estamos mirando a ver como funciona en repositorios compartidos. De momento no le hagáis caso, no debería de afectaros en nada al desarrollar.

## 📁 Estructura de la base de datos
![Estructura de la base de datos](docs\images\Conecta_db_structure.png)

[Página para ver la estructura de la base de datos](https://dbdiagram.io/d/Conecta-694bc6dcb8f7d868860d100e)

