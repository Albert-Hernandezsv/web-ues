Proyecto UES — Instalación

Aplicación web desarrollada con Laravel para administrar páginas, noticias, descargas, egresados y galerías.

Requisitos

- PHP 8.2.12, versión verificada en el entorno XAMPP de desarrollo. `composer.json` permite PHP `^8.2`.
- Laravel Framework 12.56.0, fijado en `composer.lock`. Se instala con Composer.
- Composer 2.
- MySQL o MariaDB, disponible en XAMPP.
- Node.js 22.12.0 o superior y npm, compatibles con el requisito del Vite incluido en `package-lock.json`.
- Extensiones de PHP requeridas por Composer y `pdo_mysql` habilitadas.

Los pasos siguientes utilizan PowerShell en Windows y la carpeta `C:\xampp\htdocs\ues`.

1. Preparar el proyecto

Copiar el proyecto en `C:\xampp\htdocs\ues`. Iniciar MySQL desde el panel de XAMPP.

```powershell
cd C:\xampp\htdocs\ues
$env:Path = "C:\xampp\php;" + $env:Path
php -v
composer --version
node --version
npm --version
```

Verificar que `php -v` corresponda al PHP de XAMPP. Composer y Node.js deben estar instalados y disponibles en el PATH.

2. Instalar las dependencias

```powershell
composer install
npm ci
```

Conservar `composer.lock` y `package-lock.json` para instalar las versiones fijadas por el proyecto.

3. Configurar el entorno

En una instalación nueva, copiar el archivo de ejemplo. Si `.env` ya existe, conservarlo y revisar sus valores.

```powershell
if (!(Test-Path .env)) { Copy-Item .env.example .env }
```

Editar `.env` con la configuración local. El ejemplo original utiliza SQLite; cambiarlo a MySQL y activar las variables de conexión:

```dotenv
APP_NAME=UES
APP_ENV=local
APP_DEBUG=false
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ues
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

Ajustar el usuario y la contraseña al servidor local. La contraseña vacía solo corresponde a instalaciones de XAMPP configuradas así.

Para una instalación nueva con `APP_KEY` vacía, generar la clave:

```powershell
php artisan key:generate
php artisan config:clear
```

Si se está restaurando una instalación existente con información cifrada por Laravel, conservar su `APP_KEY` original. No compartir el archivo `.env` en el repositorio.

4. Importar la estructura y los datos

Usar el archivo `ues_completo_2026-09-07.sql`, entregado por separado. Contiene las 17 tablas y los datos exportados del entorno de desarrollo el 7 de septiembre de 2026.

1. Iniciar también Apache en XAMPP para acceder a `http://localhost/phpmyadmin`.
2. Crear una base de datos vacía llamada `ues` con cotejamiento `utf8mb4_unicode_ci`.
3. Seleccionar `ues` y abrir la pestaña Importar.
4. Seleccionar el archivo SQL y ejecutar la importación.

Importar en una base vacía: el dump incluye instrucciones que reemplazan las tablas existentes.

Después, desde la carpeta del proyecto:

```powershell
php artisan migrate:status
php artisan migrate
```

El segundo comando aplica únicamente migraciones pendientes. No ejecutar `migrate:fresh`, ya que elimina las tablas y los datos restaurados.

El dump es necesario para reproducir el contenido del sitio. `DatabaseSeeder` solo crea un usuario genérico; no carga las páginas ni sus secciones. Ejecutar únicamente `migrate --seed` no reproduce la instalación entregada y puede ocasionar respuestas 404 en páginas sin registros.

5. Restaurar imágenes y archivos

El SQL contiene referencias a los archivos, pero no incluye sus contenidos. Copiar también la carpeta `storage/app/public` del proyecto original para conservar imágenes, galerías y documentos descargables.

Crear el enlace público:

```powershell
php artisan storage:link
```

Si el enlace ya existe y apunta a la carpeta correcta, conservarlo. En Windows, si faltan permisos para crearlo, ejecutar este comando desde una terminal con permisos de administrador.

Las carpetas `storage` y `bootstrap/cache` deben permitir escritura al proceso de PHP.

6. Compilar y ejecutar

```powershell
npm run build
php artisan serve --host=127.0.0.1 --port=8000
```

Abrir http://127.0.0.1:8000. Mantener abierta la terminal del servidor.

Para trabajar con recarga automática de estilos y scripts, ejecutar `npm run dev` en una segunda terminal mientras se mantiene `php artisan serve` en la primera.

Este procedimiento sirve la aplicación con Artisan. Si se configura Apache para servirla directamente, el `DocumentRoot` debe apuntar a `C:/xampp/htdocs/ues/public` y se debe ajustar `APP_URL` a esa dirección.

7. Acceso y comprobación

- Sitio público: `http://127.0.0.1:8000`.
- Inicio de sesión: `http://127.0.0.1:8000/login`.
- Panel después de iniciar sesión: `http://127.0.0.1:8000/dashboard`.

Solicitar al responsable del proyecto las credenciales de una cuenta incluida en la base restaurada. El proyecto no tiene una ruta pública de registro habilitada; las contraseñas del dump están almacenadas como hashes.

Verificar que se pueda abrir el inicio, iniciar sesión y visualizar imágenes y descargas.

```powershell
php artisan --version
composer check-platform-reqs
php artisan migrate:status
```

Problemas frecuentes

- Error de conexión a la base de datos: comprobar que MySQL esté iniciado, revisar las variables `DB_*` y ejecutar `php artisan config:clear`.
- Vite manifest not found: ejecutar `npm ci` y `npm run build`.
- Imágenes o descargas ausentes: restaurar `storage/app/public` y comprobar el enlace `public/storage`.
- 404 en el inicio o páginas del sitio: verificar que se importó el dump y que existen los registros de páginas activos.
- Error 500: revisar `storage/logs/laravel.log`, la clave `APP_KEY` y los permisos de escritura.
## Cookies de sesión en HTTPS

Al desplegar el sitio con HTTPS, establecer en `.env` (sustituir el dominio de ejemplo):

```dotenv
APP_URL=https://tu-dominio.example
SESSION_SECURE_COOKIE=true
```

Aplicar la configuración desde la carpeta del proyecto:

```powershell
php artisan config:cache
```

La cookie de sesión tendrá el atributo `Secure`, por lo que el navegador solo la enviará por HTTPS. Esta opción no instala un certificado ni redirige HTTP a HTTPS; el servidor debe tener HTTPS configurado.

Si `SESSION_SECURE_COOKIE` se omite, el proyecto activa esta protección cuando `APP_URL` comienza con el esquema `https`. Para trabajar localmente por HTTP, mantener `APP_URL=http://localhost/ues` (o la URL local utilizada) y omitir `SESSION_SECURE_COOKIE`; después ejecutar `php artisan config:clear`.

En el navegador, verificar tras iniciar sesión que la cookie de sesión tenga el atributo `Secure` en el entorno HTTPS.

## Depuración en producción

Mantener APP_DEBUG=false en producción. El archivo .env.example también lo desactiva por defecto. Después de modificar el entorno, ejecutar php artisan config:cache en producción, o php artisan config:clear en desarrollo. Revisar los errores en storage/logs/laravel.log; las trazas no deben mostrarse a los visitantes.
