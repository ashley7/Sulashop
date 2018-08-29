<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/user','UserController');
Route::resource('/category','CategoryController');
Route::resource('/product','ProductController');
Route::resource('/cart','CartController');
Route::post('/savetransactions',"CartController@savetransactions")->name("savetransactions");
Route::get('/pay_cart',"CartController@pay_cart")->name("pay_cart");
