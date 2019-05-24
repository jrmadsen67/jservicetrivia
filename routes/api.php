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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'games', 'as' => 'games.'], function () {
        Route::get('/{game}', 'GamesController@show')->name('game.show');
        Route::post('', 'GamesController@store')->name('game.store');

    });
});
