<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Users@index');
    Route::post('/getUsers', 'Users@getUsers');
    Route::post('/getUserDetails', 'Users@getUserDetails');
    Route::post('/updateUserDetails', 'Users@updateUserDetails');
});
