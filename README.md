Sulashop

This is a system that allows the world to purchanse products online

The Application is written in Laravel A PHP Framwork

===== How to set Up ==========

NB: Make sure you have php 7 and above and then Apache with Myql

After clonning this project

    composer install
    set up the .env file
    php artisan migrate
    php artisan db:seed [You do this to create a default user with the role of admin so open the seed folder and read the default logins]
    php artisan key:generate

You may change to CACHE_DRIVER=array instead of file in the .env file

php artisan serve

=========================== WORK FLOW ====================================

    Main admin logs In
    Main admin Adds Store Man
    Store man recieves and email containing his password.
    Store man adds categories of products
    Store man adds products to those categories.
    Some body registers. (Any body that registers is given a role of buyer)
    Buyer views products
    Buyer Adds produts to cart
    Buyer Pays his cart

Then somebody will deliver. That is it for now
