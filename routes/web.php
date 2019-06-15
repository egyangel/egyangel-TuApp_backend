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


Route::group(['prefix' => 'application'], function () {
    Route::resource('applications', 'Application\applicationController', ["as" => 'application']);
});


Route::group(['prefix' => 'service'], function () {
    Route::resource('services', 'Service\serviceController', ["as" => 'service']);
});
