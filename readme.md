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

=========================== WORK FLOW ====================================

1. Main admin logs In
2. Main admin Adds Store Man
3. Store man recieves and email containing his password.
4. Store man adds categories of products
5. Store man adds products to those categories.
6. Some body registers. (Any body that registers is given a role of buyer)
7. Buyer views products
8. Buyer Adds produts to cart
9. Buyer Pays his cart

Then somebody will deliver. That is it for now