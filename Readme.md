#Docker Repository

https://hub.docker.com/repository/docker/adriansocha/symfony-project

Includes: Apache PHPmyadmin and Mysql

Pulling and using docker-compose up should be enough to get your project up and running.
To create tables in database ```symfony console doctrine:migrations:migrate``` or ```php bin\console doctrine:migrations:migrate```

#Dockerfile: 

Install PHP 8.1 & Zip & Unzip & Nano 

#On main folder: 
Docker-compose up - builds container with apache server, phpmyadmin and mariadb, and starts them.

You can check them using docker-compose ps 

localhost:8101 - apache server
localhost:8102 - phpmyadmin

If you have problem with apache (forbiden error) on root folder use 
``` docker-compose exec server bash  ```
Then head to /etc/apache2/sites-available/ and create new file with name of your choice.

Then add following lines to your file:
```
<VirtualHost *:80>
DocumentRoot /var/www/html/public
<Directory /var/www/html/public>
AllowOverride None
Order Allow,Deny
Allow from All
      <IfModule mod_rewrite.c>
          Options -MultiViews
          RewriteEngine On
          RewriteCond %{REQUEST_FILENAME} !-f
          RewriteRule ^(.*)$ index.php [QSA,L]
      </IfModule>
  </Directory>
</VirtualHost>
 ```

Then restart apache server with docker-compose exec server service apache2 restart
Then you can access your site on http://localhost:8101 

Now when you are here try doing
```composer selfupgrade``` in your terminal (in case you want to edit composer.json, in my installation i had problem with installing all packages because composer was outdated, solved problem for me and. )

If you want to use symfony CLI in server bash you need to first install it with:

```
curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
apt install symfony-cli
```

Then you will be able to use symfony CLI in server bash.


Try using:
```
symfony php --version - shows you version of php if its linked to wrong php version you can use this command to fix it.
cd codebase/
```
```
echo 8.1.2 > .php-version - this command creates .php-version file in codebase folder.
```


Application have fixture with admin user and admin password.
