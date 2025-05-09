# 📚 API REST - Laravel 12

Este es un proyecto backend construido con **Laravel 12** que expone una API RESTful para gestionar autores y libros. Incluye autenticación con **Laravel Sanctum**, operaciones CRUD completas y pruebas automatizadas con **PHPUnit**.

---

## ⚙️ Tecnologías Utilizadas

- ⚡ **Laravel 12**
- 🐘 **PHP 8.4** (utilizando [Herd](https://herd.laravel.com/))
- 🛢️ **MySQL 8.x**
- 🔐 **Laravel Sanctum** (autenticación con tokens)
- 🧪 **PHPUnit** (pruebas automatizadas)

---

## ✅ Requisitos Previos

Antes de comenzar, asegúrate de tener lo siguiente instalado:

- PHP 8.4 (con Herd)
- Composer
- MySQL o MariaDB
- Laravel CLI (`herd install laravel`)
- Postman (opcional, para pruebas manuales)

---

## 🚀 Instalación del Proyecto

1. Clona el repositorio:

```bash
git clone https://github.com/joel-gomez/Api_Restful.git
cd Api_Restful
```

2. Instala las dependencias:

```bash
composer install
```

3. Copia el archivo `.env` de ejemplo y genera la clave de la app:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configura tu archivo `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. Ejecuta las migraciones:

```bash
php artisan migrate
```

Opcionalmente, si usás seeders:

```bash
php artisan db:seed
```

---

## 🔐 Autenticación con Sanctum

Este proyecto usa **Laravel Sanctum** para autenticación basada en tokens.

### 📥 Registro

```http
POST /register
```

**Body:**
```json
{
  "name": "Joel",
  "email": "joel@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### 🔑 Login

```http
POST /login
```

**Body:**
```json
{
  "email": "joel@example.com",
  "password": "password"
}
```

🔒 **Token de acceso:** Utilizá el token recibido en los encabezados de tus peticiones:

```http
Authorization: Bearer TU_TOKEN
```

---

## 📡 Endpoints de la API

| Método | Endpoint           | Descripción         | Autenticación |
|--------|--------------------|---------------------|---------------|
| POST   | /api/authors       | Crear autor         | ✅ Sí         |
| GET    | /api/authors       | Listar autores      | ✅ Sí         |
| GET    | /api/authors/{id}  | Ver autor por ID    | ✅ Sí         |
| PUT    | /api/authors/{id}  | Actualizar autor    | ✅ Sí         |
| DELETE | /api/authors/{id}  | Eliminar autor      | ✅ Sí         |

---

## 🧪 Ejecutar Pruebas

Este proyecto incluye pruebas automatizadas con PHPUnit. Para ejecutarlas:

```bash
php artisan test
```

---

## 📁 Estructura del Proyecto

```
Api_Restful/
├── app/
│   └── Models/
│   └── Http/Controllers/
├── database/
│   └── migrations/
│   └── seeders/
├── routes/
│   └── api.php
├── tests/
│   └── Feature/
├── .env
└── README.md
```



