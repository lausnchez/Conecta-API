# Conecta API

## 💾 Al importar en el PC
> [!IMPORTANT]
> Antes de realizar cualquier cosa es importante importar la base de datos en el PC para asegurarnos de que funcione todo correctamente

1. Generar un .env a partir de ejemplo y insertar los datos de la bbdd. Importante mirar que está puesto en mysql y no en sqlite en DB_CONNECTION.
2. Generar una APP_KEY con `php artisan key:generate`.
3. Crear el vendor con `composer install`. 
4. Generar las migraciones de las tablas default de la API con `php artisan migrate`.

>[!ALERT]
>No se sabe de momento si al importar se deben de hacer configuraciones iniciales de Sanctum y Breeze, estamos mirando a ver como funciona en repositorios compartidos.

