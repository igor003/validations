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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
 Route::get('/home', 'DeviceTypesController@show')->name('home');

Route::group(['middleware' => 'auth'], function () {
   
    Route::get('/devices/{id}', 'DevicesController@show')->name('device_list');

    Route::get('/type_inregistration/{id_disp}/{id_type}','DevicesController@type_inregistration_view')->name('type_intreg');

    Route::get('/device/validation/{id}', 'ValidationsController@show')->name('device_valid');
    Route::get('/valid_download/{id}','ValidationsController@download')->name('validation_download');
    Route::get('/add_intervention','InterventionsController@index')->name('add_interv');
    Route::post('/devices_list_by_type','DevicesController@get_by_id_type')->name('dev_by_type');
    Route::post('/interventions_list','TypeInterventionsController@list_by_machine_mentenance_type');
    Route::post('/inreg_interventions','InterventionsController@store')->name('create_interv');
    Route::get('/interventions_list/{id}/{id_machine?}','InterventionsController@show')->name('interv_list');
    Route::post('/get_interventions', 'InterventionsController@get_by_machine_type_id')->name('get_interv');
    Route::post('/download_interv_report','InterventionsController@download_report')->name('rep_download');
    Route::get('download__machine_instruction/{id}','DeviceTypesController@download_instruction')->name('download_machine_instruction');
    Route::get('download_validation_instruction/{id}','DeviceTypesController@download_validation_instruction')->name('download_validation_instruction');


    
    Route::get('/device/info_download/{id}','DevicesController@download_info')->name('download_info');
    Route::get('/interv_excell_report','InterventionsController@report_generate_view')->name('interv_report_view');
    Route::post('/generate_interv_excell_report','InterventionsController@generate_report')->name('generate_report_excell');
    Route::post('/gener_excell_rep_filter','InterventionsController@filter_excell_report')->name('filter_excell_report');
    Route::post('/machine_count','DevicesController@get_machine_pices')->name('machine_pices');
    Route::post('/get_shuts','InterventionsController@get_shuts')->name('get_shuts');
    Route::get('/device/data_sheet_download/{id}','DevicesController@download_data_sheet')->name('download_data_sheet');
});