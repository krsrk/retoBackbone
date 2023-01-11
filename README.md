# Zip Codes

Api que provee códigos postales de las entidades federativas de México.

Actualizada a la versión 2023 que provee el Gobierno de México: https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx

## Resolución del problema
Al momento de la publicación de esta API, se encontró que los códigos postales no cuentan con un servicio o API para acceder a este tipo de información.
Por lo tanto, se creo esta API para proporcionar este tipo de información.

Como no cuentan con un API, se tiene que descargar el archivo de todos los códigos postales e importarlo, este proceso es un tanto laborioso, ya que el archivo; ya sea en TXT, Excel o XML, contiene bastante información.
Para lograr esto, se desarrolo un comando, el cual genera los códigos postales a la base de datos, tomando como base el archivo XML que se descarga de la p{agina del Gobierno de México.

Una vez realizada la importación de la información, se consultan los datos actualizados de los códigos postales en el API.

### Proceso de actualización de Códigos Postales
1. Se descarga el archivo XML en la página de Gobierno de México
2. Se copia y se sobreescribe el archivo en la raíz del proyecto.
3. Se limpian las tablas correspondientes: zip_codes y settlements.
4. Se ejecuta el comando desde un ambiente local, y se importan las tablas a la base de datos de AWS: **sail artisan import:zipcodes**

## Stack de tecnologías
Como principal herramienta se utiliza **Laravel 9.31 y PHP 8.1**

- Laravel Octane: Mejora el rendimiento de la aplicación usando Swoole con rutinas asíncronas en prod.
- Git workflow: Flujo de trabajo de git para organizar los features y hotfixes
- Github: Para publicar el código fuente de la API.
- Postgres SQL: Base de datos para almacenar la información de los códigos postales.

## Ambiente Local

### Prerrequisitos
Se necesitan los siguiente prerrequisitos instalados para poder replicar el API en ambiente local:
- Composer
- PHP 8.1
- Docker y Docker Compose
- Npm y Node
- Extensión **pdo_pgsql** instalada

### Instalación

1. Clonar el proyecto: **git clone https://github.com/krsrk/retoBackbone.git zip-codes**
2. Cambiar al directorio del proyecto: **cd zip-codes**
3. Copiar el archivo de configuración: **cp .env.example .env**
4. Instalar las dependencias: **composer install**
5. Generar el APP Key del proyecto: php artisan key:generate
6. Ejecutar el server: php artisan serve
7. Probar el endpoint en: http://127.0.0.1:8000/api/zip-codes/20000





