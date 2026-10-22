# 🛍️ TiendaOnline - E-Commerce en Laravel

Proyecto de E-Commerce desarrollado en **Laravel 11 / 12** con control de acceso por roles (**Gerente**, **Empleado** y **Cliente**), vistas dinámicas en Blade, dashboards específicos por nivel de usuario y **CRUD completo de usuarios**.

---

## 🚀 Guía de Instalación para Colaboradores

Si descargas o clonas este repositorio en otra máquina, sigue estos sencillos pasos:

### 1. Clonar o descargar el proyecto
```bash
git clone https://github.com/TU-USUARIO/TU-REPOSITORIO.git
cd miniproy
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar el archivo de entorno (`.env`)
Copia la plantilla `.env.example` para crear tu `.env`:
* En Windows (PowerShell / CMD):
  ```powershell
  copy .env.example .env
  ```
* En Linux / macOS / Git Bash:
  ```bash
  cp .env.example .env
  ```

Genera la clave única de la aplicación:
```bash
php artisan key:generate
```

### 4. Base de Datos y Carga de Datos Iniciales (Seeders)
Por defecto en Laragon o XAMPP, el proyecto busca la base `ecommerce_db` con usuario `root` y sin contraseña.

1. Asegúrate de tener MySQL iniciado y que exista la base de datos `ecommerce_db` (puedes crearla con `mysql -u root -e "CREATE DATABASE IF NOT EXISTS ecommerce_db;"` o desde HeidiSQL / phpMyAdmin).
2. Ejecuta las migraciones y los seeders automáticos:
```bash
php artisan migrate --seed
```

*(Nota: Si no deseas usar MySQL, puedes cambiar `DB_CONNECTION=sqlite` en tu `.env`).*

### 5. Iniciar el Servidor de Desarrollo
```bash
php artisan serve
```
Abre en tu navegador: [http://localhost:8000](http://localhost:8000)

---

## 🔑 Cuentas de Demostración Pre-configuradas

El seeder incluye tres cuentas listas para probar las redirecciones de rol y permisos:

| Nivel / Rol | Correo Electrónico | Contraseña | Dashboard Asignado |
| :--- | :--- | :--- | :--- |
| **Gerente (Admin)** | `admin@tienda.com` | `password` | `/gerente/dashboard` + CRUD `/gerente/usuarios` |
| **Empleado** | `empleado@tienda.com` | `password` | `/empleado/dashboard` |
| **Cliente** | `cliente@tienda.com` | `password` | `/cliente/dashboard` |

---

## 🧪 Pruebas Automatizadas
Para verificar el correcto funcionamiento de todas las rutas, autenticaciones y el CRUD de usuarios:
```bash
php artisan test
```
