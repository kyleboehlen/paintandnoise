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

`cd /var/www/html && git clone https://github.com/kyleboehlen/paintandnoise`

<br/>
Install the required depdendencies

`cd /var/www/html/paintandnoise && composer install`

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
- Change to the apache2 root directory and open the configuration file

   `cd /etc/apache2/sites-available && sudo nano 000-default.conf`
- Edit the document root option to:

   `DocumentRoot /var/www/html/paintandnoise/public`
- Restart apache2

   `sudo service apache2 restart`

<br/>
In order to allow laravel to handle URLs, make sure the apache mod_rewrite extension is enabled and allow overrides
- Edit apache2.conf to allow overrides

   `cd /etc/apache2/ && sudo nano apache2.conf`
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

`cd /var/www/html && sudo chown -R www-data:{your_user_group} paintandnoise`

<br/>
Create a symbolic link for the storage folder

`cd /var/www/html/paintandnoise && php artisan storage:link`

<br/>
Create a nysql database and create a new user to grant all privliages to the database on. Be sure to fill out the DB .env vars

- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

<br/>
Add the mail api details

- MAILGUN_DOMAIN=
- MAILGUN_SECRET=

<br/>
Add the zipwise api key if enabling the local feed

- LOCAL_FEED_ENABLED=true
- ZIP_WISE_API_KEY=

<br/>
Set the super admin details

- SUPER_ADMIN_EMAIL="admin_email@domain.com"
- SUPER_ADMIN_PASSWORD=password

<br/>
Run the database migration and seed it with the admin user

`phpunit --filter Deploy`

If the global install of phpunit does not work, is not installed, or throws an error use app local one

`vendor/phpunit/phpunit/phpunit --filter Deploy`

Or if you wanna be really big brain, just alias it

`alias vendor_phpunit=vendor/phpunit/phpunit/phpunit`

<br/>
Delete the test assets if launching in production

`php artisan assets:delete-test-dir`

<br/>
Change the php.ini file to let Laravel handle file upload sizes

`upload_max_filesize = 0`
`post_max_size = 0`

<br/>
Run crontab -e and add the following line

`* * * * * cd /var/www/html/paintandnoise && php artisan schedule:run >> /dev/null 2>&1`

<br/>
Change the file permissions ONLY for the logs file so that the console can also write log files

`cd /var/www/html/paintandnoise/storage && sudo chmod -R 775 logs`

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
### Current External Service List:
- Cloudflare (streaming and CDN)
- Mailgun (email)
- Papertrail (logging)
- Nexmo (sms)
- zipwise (ZIP code services)