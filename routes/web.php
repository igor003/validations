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

Route::get('/type_inegistration/{id}','DevicesController@type_inregistration_view')->name('type_intreg');

Route::get('/device/validation/{id}', 'ValidationsController@show')->name('device_valid');
Route::get('/valid_download/{id}','ValidationsController@download')->name('validation_download');
Route::get('/add_intervention','InterventionsController@index')->name('add_interv');
Route::post('/devices_list_by_type','DevicesController@get_by_id_type')->name('dev_by_type');
Route::post('/interventions_list','TypeInterventionsController@list_by_machine_mentenance_type');
Route::post('/inreg_interventions','InterventionsController@store')->name('create_interv');