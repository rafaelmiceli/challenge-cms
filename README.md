# Proyecto Laravel

Guía para clonar, configurar y ejecutar este proyecto Laravel en un entorno local.

## Requisitos

Antes de comenzar, asegúrate de tener instalado:

* PHP 8.2 o superior
* Composer
* Git
* MySQL
* Extensiones de PHP requeridas por la versión de Laravel utilizada

Puedes verificar las instalaciones con:

```bash
php -v
composer -V
git --version
```

## 1. Clonar el repositorio

Clona el proyecto y entra en la carpeta:

```bash
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_PROYECTO>
```

## 2. Instalar dependencias de PHP

Ejecuta:

```bash
composer install
```

## 3. Configurar las variables de entorno

Copia el archivo de configuración:

```bash
cp .env.example .env
```

En Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Edita `.env` y configura principalmente la conexión a la base de datos:

```env
APP_NAME="Mi Aplicación"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=root
DB_PASSWORD=
```

Asegúrate de que la base de datos indicada en `DB_DATABASE` exista antes de continuar.

## 4. Generar la clave de la aplicación

Ejecuta:

```bash
php artisan key:generate
```

Esto completará automáticamente `APP_KEY` en el archivo `.env`.

## 5. Ejecutar migraciones

Para crear la estructura de la base de datos:

```bash
php artisan migrate
```

## 9. Ejecutar Laravel

En otra terminal, inicia el servidor:

```bash
php artisan serve
```

Por defecto, la aplicación estará disponible en:

```text
http://localhost:8000
```
