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

Route::group(['prefix' => 'games', 'as' => 'games.'], function () {
    Route::get('/{game}', 'GamesController@show')->name('game.show');
    Route::post('', 'GamesController@store')->name('game.store');
});
