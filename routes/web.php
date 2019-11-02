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

Route::get('/', 'WelcomeController@welcome');
Route::post('search', 'WelcomeController@search')->name('search');

Auth::routes();

//Phone Search Routes (Matching)
Route::resource('phone-search', 'ProductSearchController');
Route::post('/phone-search/results/{id}', 'ProductSearchController@results')->name('phone-search.results');


//Phone routes
Route::get('/details/{phone}', 'ProductsController@details')->name('phone.details');
Route::resource('/phones', 'ProductsController');
Route::post('/phones/search', 'ProductsController@searchProduct')->name('phone.search');

//Phone images
Route::get('/phone-image','Product_ImageController@create')->name('image.create');
Route::post('/phone-image','Product_ImageController@store')->name('image.store');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::post('/update', 'HomeController@update')->name('update');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

//Administrator Routes
Route::prefix('admin')->name('admin.')->group(function(){
    //Administrator Phone Routes
    //These are the routes that allow the administrator to access and modify the Phones
    Route::get('/phone', 'AdminController@products')->name('phone');
    Route::delete('/phone/{phone}', 'AdminController@productDestroy')->name('phone.destroy');
    Route::post('/phone/search', 'AdminController@productSearch')->name('phone.search');

    //Administrator User Routes
    //These are the routes that allow the administrator to access and modify the users
    Route::get('/user', 'AdminController@users')->name('user');
    Route::post('/user/create', 'AdminController@userCreate')->name('user.create');
    Route::delete('/user/{user}', 'AdminController@userDestroy')->name('user.destroy');
    Route::post('/user/search', 'AdminController@userSearch')->name('user.search');

    //Administrator Settings Page and avatar route
    Route::get('/settings', 'AdminController@settings')->name('settings');
    Route::post('/update', 'AdminController@update')->name('update');

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
