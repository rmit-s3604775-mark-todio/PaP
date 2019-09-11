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

<<<<<<< HEAD

// my routes

// learning routes
Route::resource('songs', 'SongsController');

// project routes
Route::resource('products', 'ProductsController');

=======
Route::resource('request', 'RequestController');
>>>>>>> develop

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/product-requests', 'HomeController@product_requests')->name('product-requests');

Route::prefix('admin')->group(function(){
    Route::get('/settings', 'AdminController@settings')->name('admin.settings');
    Route::post('/avatar', 'AdminController@update_avatar')->name('admin.avatar');

    Route::get('/users', 'AdminController@users')->name('admin.users');
    Route::get('/administrators', 'AdminController@administrators')->name('admin.administrators');
    Route::get('/products', 'AdminController@products')->name('admin.products');
    Route::get('/messages', 'AdminController@messages')->name('admin.messages');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});
