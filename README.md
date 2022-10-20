# Requerimientos

    PHP v8.1
    Node v19.0.0
    Npm v8.19.2
    Docker Windows v4.11.1

# Pasos a seguir

Utilizamos Laravel Sail para levantar el entorno de desarrollo (https://laravel.com/docs/9.x/sail)

    1. composer install
    2. cp .env.example .env
    3. ./vendor/bin/sail up -d
    4. ./vendor/bin/sail up
    5. ./vendor/bin/sail artisan migrate:fresh --seed
    6. npm install
    7. npm run build
    8. Ingresar a http://localhost/

# Como obtener el precio de BTC?

Para obtener el precio de BTC usamos el comando

    ./vendor/bin/sail artisan get:bitcoin.price {sleepTime}

Donde el sleepTime es el tiempo que estara el proceso inactivo antes de que se ejecute, para poder emular una llamada cada 10 segundo en el crontab configuramos los siguientes procesos

    * * * * * php /{project_path}/artisan get:bitcoin.price 0
    * * * * * php /{project_path}/artisan get:bitcoin.price 10
    * * * * * php /{project_path}/artisan get:bitcoin.price 20
    * * * * * php /{project_path}/artisan get:bitcoin.price 30
    * * * * * php /{project_path}/artisan get:bitcoin.price 40
    * * * * * php /{project_path}/artisan get:bitcoin.price 50
