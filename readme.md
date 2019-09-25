# Project Loro

### Instalación

Clonar repositorio

```sh
user@debian:~$ git clone https://github.com/ljsea6/loro.git project && cd project
user@debian:~/project$ composer install
user@debian:~/project$ cp -r .env.example .env
user@debian:~/project$ php artisan key:generate
user@debian:~/project$ sudo chmod 777 -R storage/
user@debian:~/project$ sudo chmod 777 -R boostrap/cache
```

Por último configurar las variables de entorno en el archivo .env con la información de la base de datos.

``` printenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
### Endpoints

#### User Resources

- **[ GET /users]**
- **[ POST /users]**
- **[ GET /users/{id}]**
- **[ PUT /users/{id}]**
- **[ DELETE /users/{id}]**
