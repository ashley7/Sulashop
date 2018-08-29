# Sulashop
This is a system that allows the world to purchanse products online

The Application is written in Laravel A PHP Framwork

===== How to set Up ==========

NB: Make sure you have php 7 and above and then Apache with Myql

After clonning this project

1. composer install
2. set up the .env file
3. php artisan migrate
4. php artisan db:seed [You do this to create a default user with the role of admin so open the seed folder and read the default logins]
5. php artisan key:generate

You may change to CACHE_DRIVER=array instead of file in the .env file

php artisan serve