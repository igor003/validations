<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('device_types', DeviceTypesController::class);
    $router->resource('devices', DevicesController::class);
    $router->resource('validations', ValidationsController::class);
    $router->resource('type-mentenances', TypeMentenanceController::class);
    $router->resource('type-interventions', TypeInterventionController::class);

});
 