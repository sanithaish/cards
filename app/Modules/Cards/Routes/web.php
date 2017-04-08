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

Route::group(['prefix' => 'cards'], function () {
    Route::get('/', 'Cards@index');
    Route::post('/saveCard', 'Cards@saveCard');
    Route::post('/getCards', 'Cards@getCards');
    Route::post('/getCardDetails', 'Cards@getCardDetails');
    Route::post('/updateCardDetails', 'Cards@updateCardDetails');
    Route::post('/deleteCard', 'Cards@deleteCard');
});
