# Conecta API

<!-- > [!NOTE]
> ¡Ya está disponible el Endpoint de Eventos! -->

## 💾 Al importar en el PC
> [!IMPORTANT]
> Antes de realizar cualquier cosa es importante hacer todos estos pasos para asegurarnos de que todo funciona correctamente.

1. Generar un .env a partir de ejemplo y insertar los datos de la bbdd. Importante mirar que está puesto en mysql y no en sqlite en DB_CONNECTION.
2. Generar una APP_KEY con `php artisan key:generate`.
3. Crear el vendor con `composer install`. 
4. Generar las migraciones de las tablas default de la API con `php artisan migrate`.

> [!CAUTION]
> No se sabe de momento si al importar se deben de hacer configuraciones iniciales de Sanctum y Breeze, estamos mirando a ver como funciona en repositorios compartidos.

## ❓ Preguntas pendientes
- **Libertad a la hora de crear la bbdd (limitada)**
- **Diferenciar entre categorias y tags**
- **Servidor**
- **Tabla de logros**

La idea es hacer una tabla intermedia.

**LOGROS**
- id_logro (PK)
- nombre
- descripcion
- icono
- total_progreso
- puntos_generados
- secreto (bool)

**USUARIO_LOGRO**
- id_usuario (FK)
- id_logro (FK)
- fecha_conseguido
- progreso (opcional)
- PRIMARY KEY (id_usuario, id_logro)


## 💀 TO-DO
- [ ] Categorías
- [ ] Eventos
- [ ] Usuarios
- [ ] Entidades
- [ ] Reportes
- [ ] Logros

### Tablas intermedias
- [ ] Usuarios-Logros
- [ ] Usuarios-Eventos
- [ ] Entidades-Eventos
- [ ] Categorias-Eventos (?)

### Documentación
- [ ] Categorías
- [ ] Eventos
- [ ] Usuarios
- [ ] Entidades
- [ ] Reportes
- [ ] Logros
- [ ] Usuarios-Logros
- [ ] Usuarios-Eventos
- [ ] Entidades-Eventos
- [ ] Categorias-Eventos (?)

## ❗ ENDPOINTS
### Eventos

| Método | Ruta             | Acción      |
|--------|------------------|-------------|
| GET    | /v1/eventos            | Muestra todos los eventos       |
| GET    | /v1/eventos/{id}       | Muestra un evento por ID        |

**Mostrar todos los eventos**

- Método HTTP: **GET**
- Endpoint: `/v1/eventos`
```json
[
  {
    "id_evento": 1,
    "id_categoria": 1,
    "fecha_evento": "2025-01-15",
    "tipo_evento": "Torneo amateur de fútbol sala",
    "bool_acceso": 1,
    "bool_equipo": 1,
    "bool_masc": 0,
    "descripcion": "Torneo local con equipos de distintos barrios",
    "num_participantes": 12,
    "incidencias": "Retraso de 10 minutos por problemas técnicos",
    "valoracion": 4.5
  }
]
```

**Mostrar evento por ID**

Endpoint: `/v1/eventos/{id}`

Requisitos:
 ```json
[
  {

  }
]
```


```json
{
  "id_evento": 1,
  "id_categoria": 1,
  "fecha_evento": "2025-01-15",
  "tipo_evento": "Torneo amateur de fútbol sala",
  "bool_acceso": 1,
  "bool_equipo": 1,
  "bool_masc": 0,
  "descripcion": "Torneo local con equipos de distintos barrios",
  "num_participantes": 12,
  "incidencias": "Retraso de 10 minutos por problemas técnicos",
  "valoracion": 4.5
}
```
### Categorias
