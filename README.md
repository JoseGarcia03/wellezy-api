# Wellezy API

Esta es la API backend para la aplicación Wellezy, una plataforma para reservar vuelos.

## Tabla de Contenidos

- [Instalación](#instalación)
- [Configuración](#configuración)
- [Uso](#uso)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)

## Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/JoseGarcia03/wellezy-api.git
    ```

2. Navega al directorio del proyecto:

    ```bash
    cd wellezy-api
    ```

3. Instala las dependencias:

    ```bash
    composer install
    ```

## Configuración

1. Copia el archivo `.env.example` a `.env`:

    ```bash
    cp .env.example .env
    ```

2. Genera la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

3. Configura tu archivo `.env` con las credenciales de tu base de datos y otros ajustes necesarios.

4. Ejecuta las migraciones y los seeders para preparar la base de datos:

    ```bash
    php artisan migrate --seed
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta (debe ser en el puerto 8000):

```bash
php artisan serve
```

## Tecnologías Utilizadas

- Laravel 11
- MySQL
- JWT
- Composer

## Tests

Para correr todos los test, ejecuta:

```bash
php artisan test
```
