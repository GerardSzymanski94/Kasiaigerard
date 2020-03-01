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

Route::get('/', 'UserController@index')->name('index');
Route::get('/send_email', 'UserController@sendEmail')->name('send_email');

Route::namespace('Admin')->name('admin.')->prefix('administracja')->group(function () {

    Route::get('/', 'DashboardController@index')->name('index');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });

    Route::prefix('guest')->name('guest.')->group(function () {
        Route::get('/', 'GuestController@index')->name('index');
        Route::post('/store', 'GuestController@store')->name('store');
        Route::post('/update/{guest}', 'GuestController@update')->name('update');
        Route::get('/delete/{guest}', 'GuestController@destroy')->name('delete');
        Route::get('/confirm/{guest}', 'GuestController@confirm')->name('confirm');
        Route::get('/canceled/{guest}', 'GuestController@canceled')->name('canceled');
    });


    Route::get('login', 'LoginController@index')->name('login');

});
Auth::routes();
