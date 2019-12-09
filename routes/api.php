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


Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});



Route::prefix('tenants')->group(function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/', 'TenantController@index');
        Route::post('confirmid', 'TenantController@getId');
        Route::post('store', 'TenantController@store');
    });
});

Route::prefix('resources')->group(function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/get/{tenantid}', 'ResourceController@index');
        Route::post('/approve/{id}', 'ResourceController@approve');
    });
});

Route::prefix('meters')->group(function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('get', 'MeterController@index');
    });
});

Route::prefix('usage')->group(function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/get/{tenantid}', 'UsageController@index');
    });
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/