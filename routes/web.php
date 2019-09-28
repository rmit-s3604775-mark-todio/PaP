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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('product-request', 'RequestController');
Route::post('search', 'ProductsController@searchProduct')->name('product.search');

Route::resource('products', 'ProductsController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/product-requests', 'HomeController@product_requests')->name('product-requests');

Route::prefix('admin')->name('admin.')->group(function(){
    //Administrator Products Routes
    //These are the routes that allow the administrator to access and modify the products
    Route::get('/product', 'AdminController@products')->name('product');
    Route::delete('/product/{product}', 'AdminController@productDestroy')->name('product.destroy');
    Route::post('/product/search', 'AdminController@productSearch')->name('product.search');

    //Administrator User Routes
    //These are the routes that allow the administrator to access and modify the users
    Route::get('/user', 'AdminController@users')->name('user');
    Route::post('/user/create', 'AdminController@userCreate')->name('user.create');
    Route::delete('/user/{user}', 'AdminController@userDestroy')->name('user.destroy');
    Route::post('/user/search', 'AdminController@userSearch')->name('user.search');

    //Administrator Settings Page and avatar route
    Route::get('/settings', 'AdminController@settings')->name('settings');
    Route::post('/avatar', 'AdminController@update_avatar')->name('avatar');

    //Administrator admin routes
    //These are the routes that allow the administrator ato access and modify the administrator accounts
    Route::get('/administrators', 'AdminController@administrators')->name('administrators');
    Route::get('/register', 'AdminRegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminRegisterController@register')->name('register');
    Route::delete('/destroy/{admin}', 'AdminRegisterController@destroy')->name('destroy');
    Route::post('/administrators/search', 'AdminController@search')->name('search');

    //Message inbox route
    Route::get('/messages', 'AdminController@messages')->name('messages');

    //Administrator Login routes
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

    //Administrator password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
});
