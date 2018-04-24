# laravel-calendar-demo

##Based on Laravel 5.6

###JS Libraries:
  * FullCalendar (jQuery plugin)
  * bootstrap-datepicker
  
 
##Requirements:
* PHP 7 (prepackaged in Docker configuration)
* MySQL 5.7 (prepackaged in Docker configuration)

 
##Installation
1. Install Docker  
1. In the main directory run: docker-compose up -d
1. Enter the web container's terminal by typing: docker exec -ti laravelcalendardemo_web_1 bash
1. Inside the container terminal, run: cd /var/www/project/
1. Create an .env file with contents shown below. Update the database connection details so that it connects to an empty database.
1. Then run: php artisan migrate
1. Access the app in your browser via: http://localhost:8080


## .env file contents

APP_NAME='Laravel Calendar Demo'
APP_ENV=local
APP_KEY=base64:b3RU0rndvG//Tw4Tz0cgcUFZz0+keRU6mZYqgDPgZJc=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=database_user
DB_PASSWORD=database_user_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
  

