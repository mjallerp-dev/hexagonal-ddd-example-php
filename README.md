# CRUDL de Usuarios y Artículos: Arquitectura Hexagonal con DDD y CQRS

Aplicación web en PHP puro (sin frameworks) con dos módulos:

- **Usuarios**: registro, listado, visualización, edición, eliminación, autenticación con sesión, recuperación de contraseña por correo y notificaciones por correo.
- **Artículos**: CRUDL completo desde la web y desde una **API REST en JSON** documentada con Swagger.

Despliegue: **Azure App Service** con contenedor Docker, base de datos **Azure Database for PostgreSQL** y CI/CD con **GitHub Actions**.

- Aplicación: https://app-hexagonal-ddd-php-h8haawccb3dfd2bc.westus3-01.azurewebsites.net
- Swagger UI: https://app-hexagonal-ddd-php-h8haawccb3dfd2bc.westus3-01.azurewebsites.net/public/swagger.html

---

## Tecnologías

- PHP 8.3 (con `pdo_pgsql` y `mbstring`)
- PostgreSQL 16
- Apache 2.4 con `mod_rewrite`
- PHPMailer (incluido en el repositorio) para el envío de correo por SMTP
- Docker y Docker Compose
- GitHub Actions y GitHub Container Registry (`ghcr.io`)
- Azure App Service (Web App for Containers) y Azure Database for PostgreSQL
- OpenAPI 3 / Swagger UI y Postman

---

## Estructura del proyecto

```
Domain/            Modelos, Value Objects, Enums, Excepciones y Eventos de dominio
Application/       Puertos de entrada y salida, servicios (casos de uso), commands, queries y mappers
Infrastructure/
  Adapters/        Persistencia PostgreSQL (repositorios, mappers, DTO, entidades) y envío de correo
  Entrypoints/Web/ Rutas, controladores, request/response, mappers, validador, manejador de errores y vistas
Common/            ClassLoader, DependencyInjection y EnvLoader
public/            index.php (web), api.php (API REST), openapi.yaml y swagger.html
database/          Migraciones SQL numeradas y usuario administrador base
postman/           Colección y entornos de Postman
.github/workflows/ Pipeline de CI/CD
Dockerfile, docker-compose.yml, .dockerignore
```

---

## Funcionalidades

### Usuarios
- Crear, listar, ver, editar y eliminar usuarios
- Autenticación con sesión (login / logout)
- Recuperación de contraseña mediante contraseña temporal enviada por correo
- Notificaciones por correo al crear y actualizar usuarios
- Protección de rutas según el estado de autenticación
- Protección contra acceso directo a archivos y listado de directorios

### Artículos
- Crear, listar, ver, editar y eliminar artículos desde la web (requiere sesión)
- API REST en JSON protegida con la cabecera `X-API-Key`
- Validación en tres niveles: entrada (web/API), dominio (Value Objects) y base de datos (tipos, `NOT NULL`, claves)

---

## Puesta en marcha en local

### 1. Variables de entorno

```bash
cp .env.example .env
```

Completa los valores de base de datos, SMTP y `API_KEY` en `.env`. Este archivo está en `.gitignore` y nunca se sube al repositorio. Las variables reales del servidor tienen prioridad sobre `.env`.

### 2. Base de datos

Ejecuta las migraciones en orden (ajusta host y usuario):

```bash
psql -h localhost -U postgres -d postgres     -f database/00_create_database.sql
psql -h localhost -U postgres -d pgarticlesdb -f database/01_create_users_table.sql
psql -h localhost -U postgres -d pgarticlesdb -f database/02_create_articles_table.sql
psql -h localhost -U postgres -d pgarticlesdb -f database/03_seed_admin_user.sql
```

La última migración crea el **usuario administrador base**, activo:

| Correo | Contraseña inicial |
|---|---|
| `admin@example.com` | `Admin12345*` |

Cámbiala desde **Editar usuario** después del primer inicio de sesión.

Los scripts de tablas y del administrador se pueden ejecutar varias veces sin error.

### 3. Ejecutar la aplicación

**Opción A: Docker Compose (recomendada)**

```bash
docker compose up -d --build
```

- Web: http://localhost:8080
- API: http://localhost:8080/api/articles
- Swagger: http://localhost:8080/public/swagger.html

Para detenerla: `docker compose down`.

**Opción B: servidor integrado de PHP**

```bash
php -S localhost:8080 -t .
```

- Web: http://localhost:8080/public/index.php
- API: http://localhost:8080/public/api.php/articles

El servidor integrado no lee `.htaccess`, por eso la API se llama a través de `public/api.php`.

---

## API REST de artículos

Todas las peticiones requieren la cabecera `X-API-Key` con el valor de `API_KEY`.

| Método | Ruta | Acción | Respuestas |
|---|---|---|---|
| GET | `/api/articles` | Listar | 200 |
| POST | `/api/articles` | Crear | 201 (cabecera `Location`), 400, 409, 422 |
| GET | `/api/articles/{id}` | Ver | 200, 404 |
| PUT | `/api/articles/{id}` | Actualizar | 200, 400, 404, 422 |
| DELETE | `/api/articles/{id}` | Eliminar | 204, 404 |

Errores comunes: 401 (falta la API key o es incorrecta), 404 (ruta inexistente), 405 (método no permitido) y 500 (error interno, sin detalles técnicos).

Ejemplo de cuerpo para crear o actualizar:

```json
{
  "description": "Portátil 14 pulgadas",
  "provider": "Proveedor Demo",
  "brand": "Lenovo",
  "model": "ThinkPad E14",
  "category": "electronica",
  "store": "Tienda Centro",
  "quantity": 5,
  "purchase_price": 2500000.5,
  "sale_price": 3200000,
  "iva": 19
}
```

Formato de error:

```json
{ "error": { "status": 422, "message": "Los datos del artículo no son válidos.", "details": { "iva": "..." } } }
```

### Swagger

Abre `/public/swagger.html`, pulsa **Authorize**, pega la API key y elige el servidor `../api` (Apache, Docker o Azure) o `api.php` (servidor integrado de PHP).

### Postman

Importa los archivos de `postman/`, elige el entorno (**Local** o **Azure**), completa `apiKey` en **Current value** y ejecuta la colección con **Run collection** (13 peticiones y 25 comprobaciones).

---

## Docker

- `Dockerfile`: imagen `php:8.3-apache` con `pdo_pgsql`, `mod_rewrite`, configuración PHP de producción y Apache escuchando en el puerto de la variable `PORT` (80 por defecto).
- `.dockerignore`: deja fuera de la imagen `.env`, `.git`, `database/`, `postman/`, `docs/` y archivos de desarrollo.
- `docker-compose.yml`: construye la imagen, publica el puerto 8080 y pasa las variables de `.env` sin copiarlo dentro de la imagen.

---

## Despliegue y CI/CD

El workflow `.github/workflows/ci-cd.yml` se ejecuta en cada `push` a `main`:

1. Construye la imagen Docker.
2. Valida la sintaxis PHP dentro de la imagen.
3. Arranca el contenedor y ejecuta una prueba rápida (login, redirecciones, protección de `.htaccess`, Swagger y respuestas de la API).
4. Publica la imagen en `ghcr.io/mjallerp-dev/hexagonal-ddd-example-php` con las etiquetas del commit y `latest`.
5. Despliega esa imagen en Azure App Service y verifica que la aplicación responde.

En los pull requests solo se ejecutan los pasos 1 a 3.

Configuración necesaria:

- Secreto de GitHub `AZURE_WEBAPP_PUBLISH_PROFILE` con el perfil de publicación de App Service.
- Acceso de GitHub Actions (rol **Write**) al paquete en `ghcr.io`.
- En App Service: las variables de `.env`, más `WEBSITES_PORT=80` y `PORT=80`.
- En el servidor PostgreSQL de Azure: permitir el acceso desde servicios de Azure.

---

## Conceptos aplicados

### Arquitectura general
- Arquitectura Hexagonal (Ports & Adapters)
- DDD (Domain-Driven Design)
- CQRS
- Capas: Domain / Application / Infrastructure / Entrypoints
- Front Controller · un punto de entrada para la web (`index.php`) y otro para la API (`api.php`)

### Capa de Dominio
- Rich Domain Model
- Value Objects
- Named Constructors
- Domain Exceptions
- Domain Events
- Enumerations (Enums)
- Ubiquitous Language
- Inmutabilidad
- Fail-fast validation
- Encapsulación de reglas de negocio (el dominio es el dueño de las reglas de valores)

### Capa de Aplicación
- Use Cases
- Application Services
- Ports In (interfaces de casos de uso)
- Ports Out (interfaces de persistencia y de correo)
- Commands y Queries
- DTOs
- Anti-corruption Layer
- Application Mapper

### Capa de Infraestructura
- Repository Pattern
- Data Mapper
- Persistence DTO
- Persistence Entity
- PDO con Prepared Statements
- Adapter Pattern

### Entrypoints / Presentación
- Enrutamiento por query string (`?route=`) en la web y por método + ruta en la API
- PRG (Post-Redirect-Get)
- Flash Messages
- Autenticación basada en sesiones (web) y API key (API)
- Web Mapper
- Web DTOs (WebRequest / Response)
- Validador de entrada compartido por la web y la API
- Manejador central de errores de la API (`ApiExceptionHandler`)
- `View::render` con `extract` para HTML y `JsonView` para JSON
- Documentación OpenAPI / Swagger
- Security Guard (IIFE)

---

### Patrones de diseño
- Front Controller
- Repository
- Data Mapper
- Factory Method
- DTO
- Strategy
- Template Method
- IIFE
- PRG (Post-Redirect-Get)

### Principios SOLID
- **SRP** — Single Responsibility Principle
- **OCP** — Open/Closed Principle
- **LSP** — Liskov Substitution Principle
- **ISP** — Interface Segregation Principle
- **DIP** — Dependency Inversion Principle

### Principios de Clean Code
- `declare(strict_types=1)` en todos los archivos
- Clases `final`
- Value Objects inmutables
- Named Constructors
- Fail-fast
- Nombres autodocumentados
- Separación estricta de capas
- Sin fugas de abstracción
- Fail-safe defaults (valores por defecto seguros)

### Configuración externalizada (12-Factor App: Factor III)
- Variables de entorno separadas del código fuente
- Credenciales en `.env` (ignorado por git) o en la configuración del servidor; nunca se publican en el repositorio
- `.env.example` como plantilla y documentación de ejemplo para el equipo
- `EnvLoader` con responsabilidad única: leer el entorno
- Las variables reales del servidor tienen prioridad sobre `.env` (environment-over-code)

### Seguridad
- Credenciales fuera del código fuente, del historial de git y de la imagen Docker
- Contraseñas cifradas con bcrypt
- Consultas preparadas contra inyección SQL
- Escape de HTML con `htmlspecialchars`
- API protegida con API key y respuestas de error sin detalles técnicos
- Bloqueo de acceso directo a archivos internos mediante `.htaccess`
