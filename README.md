Proyecto Laravel: Sistema de Gestión de Pacientes

Este es un proyecto desarrollado en Laravel con MySQL, que permite gestionar pacientes a través de un sistema CRUD.

📌 Requisitos Previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu computadora:

-PHP (versión 8.1 o superior)

-Composer

-Laravel (si no lo tienes, instálalo con composer global require laravel/installer)

-MySQL

-Git
🚀 Instalación y Configuración

1️⃣ Clonar el repositorio

Ejecuta el siguiente comando en tu terminal:

git clone https://github.com/JUPAMUHE/App-Pacientes.git

2️⃣ Instalar dependencias

Ejecuta el siguiente comando en tu terminal:

composer install

3️⃣ Configurar variables de entorno

Copia el archivo de configuración:

cp .env.example .env

Edita el archivo .env y configura la base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba_tecnica_sinergia
DB_USERNAME=root
DB_PASSWORD=

Asegúrate de cambiar DB_USERNAME y DB_PASSWORD según tu configuración.

4️⃣ Crear la base de datos

Accede a MySQL y crea la base de datos manualmente o ejecuta:

CREATE DATABASE prueba_tecnica_sinergia;

5️⃣ Ejecutar migraciones y seeders

Ejecuta las migraciones para generar las tablas necesarias:

php artisan migrate --seed

Esto creará las tablas y poblará la base de datos con datos iniciales.

6️⃣ Iniciar el servidor

Ejecuta el siguiente comando para levantar el servidor de desarrollo:

php artisan serve  

php artisan servePor defecto, la aplicación se ejecutará en http://127.0.0.1:8000/, pero para entrar a la app
modificas la ruta a http://127.0.0.1:8000/login

🔐 Credenciales de acceso

Si se han ejecutado los seeders, puedes iniciar sesión con las credenciales por defecto:

Usuario: 123456789
Contraseña: 1234567890

