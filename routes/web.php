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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'DeviceTypesController@show')->name('home');
Route::get('/devices/{id}', 'DevicesController@show')->name('device_list');
Route::get('/device/validation/{id}', 'ValidationsController@show')->name('device_valid');
Route::get('/valid_download/{id}','ValidationsController@download')->name('validation_download');
