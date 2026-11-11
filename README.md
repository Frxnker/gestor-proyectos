# Gestor de Proyectos

Plataforma de gestión de proyectos colaborativos hecha con **Laravel 13**. Los usuarios crean proyectos y asignan a otros usuarios con un rol (Desarrollador, Diseñador o Tester), registrando las horas que trabaja cada uno.

Práctica final del tema 3 de **Desarrollo Web en Entorno Servidor** — 2º DAW, IES Celia Viñas.

## Funcionalidades

- Registro e inicio de sesión (Laravel Breeze).
- CRUD de proyectos: título, descripción, fecha límite y estado.
- Solo el propietario puede editar o borrar su proyecto (Policy).
- Gestión de participantes desde el detalle del proyecto: añadir, cambiar rol y horas, y quitar.
- Landing page para visitantes y aplicación traducida al español.

## Tecnologías

Laravel 13 · Blade · Tailwind CSS · MySQL · Laravel Sail (Docker)

## Base de datos

- `users` — usuarios.
- `projects` — proyectos. Cada uno tiene un propietario (`user_id`, relación 1:N con `users`).
- `project_user` — tabla pivote de la relación N:N entre proyectos y usuarios, con los campos extra `role` y `contribution_hours`.

## Instalación

Requisitos: **Docker** (en Windows, Docker Desktop con WSL2).

```bash
# 1. Entrar en la carpeta del proyecto (clonado o descomprimido)
cd gestor-proyectos

# 2. Instalar las dependencias de PHP (no hace falta tener PHP instalado)
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

# 3. Levantar los contenedores (la primera vez tarda unos minutos)
./vendor/bin/sail up -d

# 4. Crear las tablas
./vendor/bin/sail artisan migrate
```

Abre **http://localhost**.

> **Si has clonado el repositorio** (en vez de descargar el ZIP), crea también el archivo `.env` y su clave antes del paso 4:
> ```bash
> cp .env.example .env
> ./vendor/bin/sail artisan key:generate
> ```

### Datos de prueba (opcional)

```bash
./vendor/bin/sail artisan migrate --seed
```

Crea varios usuarios y proyectos con participantes. Puedes entrar con `test@example.com` / `password`.

## Autor

Francisco López Lobanova — [@Frxnker](https://github.com/Frxnker)