# UNITOR

Manage you studies!

Domain:
http://unitor.tk/public/

## How to execute UNITOR

This is how you run UNITOR on a Linux system using artisan and apache server (httpd). You will need composer.

* Run the following commands to install all the required dependencies:

    ````
    $ npm install
    $ composer install
    ````

* Configure the `.env` file with the database engine you use, the database name and etc.

    ````
    $ cp .env.example .env # edit .env file
    ````

    Example `.env` database configuration:

    ````
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=unitor
    DB_USERNAME=root
    DB_PASSWORD=
    ````

* Start your database server and Apache Server; here we use MySQL.

    ````
    $ systemctl start mysqld httpd
    ````

* Run the migrations

    ````
    $ php artisan migrate:fresh --seed
    ````

* Start your server

    ````
    $ php artisan serve
    ````

* Go to http://localhost:8000 and browse in UNITOR!
