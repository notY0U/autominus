<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'vehicles'], function () {
    Route::get('', 'VehicleController@index')->name('vehicle.index');
    Route::get('create', 'VehicleController@create')->name('vehicle.create');
    Route::post('store', 'VehicleController@store')->name('vehicle.store');
    Route::get('edit/{vehicle}', 'VehicleController@edit')->name('vehicle.edit');
    Route::post('update/{vehicle}', 'VehicleController@update')->name('vehicle.update');
    Route::post('delete/{vehicle}', 'VehicleController@destroy')->name('vehicle.destroy');
    Route::get('show/{vehicle}', 'VehicleController@show')->name('vehicle.show');
});
