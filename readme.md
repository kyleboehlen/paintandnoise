# Paint and Noise (Alpha Dev)

## Installation
Before installing the site the following tools need to be installed:
- php7.1 or higher with the extensions
- imagemagick
- apache2
- MySQL (MariaDB)
- git
- composer (added to the PATH)
- npm
- yarn
- phpunit

<br/>
Start by cloning into the repository

`git clone https://github.com/kyleboehlen/paintandnoise`

<br/>
cd into the project directory

`cd paintandnoise`

<br/>
Install the required depdendencies

`composer install`

`yarn install` DO NOT USE `npm install` until the laravel mix issue has been resolved

<br/>
Generate the .css and .js files

`npm run prod`

<br/>
Create a copy of the enviroment file from the template

`cp .env.example .env`

<br/>
Generate the application encryption key

`php artisan key:generate`

<br/>
Change the apache2 webroot to the laravel public folder
- Change to the apache2 root directory

   `cd /etc/apache2/sites-available`
- Open the configuation file

   `sudo nano 000-default.conf`
- Edit the document root option to:

   `DocumentRoot /var/www/html/paintandnoise/public`
- Restart apache2

   `sudo service apache2 restart`

<br/>
In order to allow laravel to handle URLs, make sure the apache mod_rewrite extension is enabled and allow overrides
- Edit apache2.conf to allow overrides

   `cd etc/apache2/`

   `sudo nano apache2.conf`
- Add the following to the directory settings

```
   <Directory /var/www/html/paintandnoise/public>

      Options Indexes FollowSymLinks

      AllowOverride All

      Require all granted

   </Directory>
```

- Enable mod_rewrite extension

   `sudo a2enmod rewrite`
- Restart apache2

   `sudo service apache2 restart`

<br/>
Allow apache to serve the files

`sudo chown -R www-data:{your_user_group} paintandnoise`

<br/>
Create a symbolic link for the storage folder

`php artisan storage:link`

<br/>
Create a nysql database and create a new user to grant all privliages to the database on. Be sure to fill out the DB .env vars

- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

<br/>
Change the default admin username, password and email

- DEFAULT_ADMIN_USERNAME=
- DEFAULT_ADMIN_EMAIL=
- DEFAULT_ADMIN_PASSWORD=

<br/>
Add the mail api details

- MAILGUN_DOMAIN=
- MAILGUN_SECRET=

<br/>
Run the database migration and seed it with the admin user

`phpunit --filter Deploy`

<br/>
Change the php.ini file to let Laravel handle file upload sizes

`upload_max_filesize = 0`
`post_max_size = 0`

<br/><br/>
### _Make sure these steps are completed last_ 

Optimize the autoloader class

   `composer install --optimize-autoloader --no-dev`

<br/>
Cache the configuration

   `php artisan config:cache`


Optimize route loading

   `php artisan route:cache`

<br/><br/>
To-do/Notes: