# Roles y permisos del panel

El panel dispone de dos roles:

- **Administrador:** puede gestionar todas las páginas, contenidos, cuentas y permisos.
- **Editor:** comienza sin permisos y solo accede a los módulos asignados.

El registro público continúa deshabilitado. Desde el dashboard, el Administrador puede abrir **Gestión de usuarios** (`/gestionar-usuarios`) para crear cuentas o editar una cuenta concreta. **Mi perfil** corresponde únicamente a la cuenta conectada.

## Asignar permisos

Cada página base tiene permisos de consulta y edición. Editar una página base modifica directamente el contenido público.

Noticias, Alumnis, Galería y Descargas permiten asignar consulta, creación, edición, eliminación y publicación. La consulta se incluye automáticamente al seleccionar otra acción. Publicar requiere también la acción de crear o editar correspondiente.

Un Editor sin publicación solo puede crear y editar borradores inactivos. No puede cambiar fechas de programación ni modificar contenido activo. Para publicar, programar o desactivar se necesita el permiso de publicación. El permiso de eliminación permite retirar el registro, por lo que debe asignarse solo a quienes deban hacerlo.

Los formularios aparecen en modo consulta si falta permiso para guardar. Ocultar o deshabilitar controles es solo una ayuda visual: el servidor comprueba los permisos de cada ruta mediante Gates y el middleware del panel.

## Cuentas

- Las contraseñas nuevas requieren al menos 12 caracteres y confirmación; se almacenan mediante el cast `hashed` de Laravel.
- Dejar la contraseña vacía al editar conserva la existente.
- Desactivar una cuenta impide iniciar sesión y bloquea sus sesiones abiertas.
- Los cambios de permisos se aplican en la siguiente solicitud.
- No se permite degradar o desactivar al último Administrador activo.
- Se utiliza desactivación de cuentas; la eliminación del perfil propio está bloqueada.
- Ningún Editor puede asignarse roles o permisos desde Mi perfil.

## Migración aplicada

La migración `2026_10_13_120000_add_roles_to_users_table.php` agrega `role`, `is_active` y `permissions` a `users`. Conserva como Administrador la única cuenta preexistente. Si encuentra varias cuentas, se detiene antes de cambiar el esquema para que se defina una transición explícita.

En este entorno, la cuenta `admin@ues.edu.sv` se conservó como Administrador sin cambiar su contraseña.

## Verificación

Ejecutar desde la raíz del proyecto:

```powershell
C:\xampp\php\php.exe tests/panel_authorization_check.php
```

La prueba utiliza SQLite en memoria y verifica autorización, gestión de cuentas, modo consulta, publicación, desactivación y protección del último Administrador. No modifica las cuentas de la base de desarrollo.