<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@home');

Route::resource('/sales', 'SalesController');

Route::resource('/products', 'ProductsController');

Route::resource('/users', 'UsersController');

Route::get('/products/search/{cod}/{nombre}/{categoria}', 'ProductsController@search');

Route::get('/users/search/{nombre}/{email}/{priv}', 'UsersController@search');

Route::get('/sales/search/{cod}/{fecha}/{vendedor}', 'SalesController@search');

Auth::routes();
