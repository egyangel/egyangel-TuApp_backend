<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    Route::post('/users/register', 'AuthController@register');
    Route::post('/users/login', 'AuthController@login');
    Route::post('/users/logout', 'AuthController@logout');
    Route::resource('services', 'Service\serviceAPIController');
    Route::resource('applications', 'Application\applicationAPIController');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});





Route::group(['prefix' => 'API/v1/'], function () {

});
