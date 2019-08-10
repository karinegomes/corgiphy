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

Route::get('search', 'SearchController@search');

Route::middleware('auth:api')->group(function () {
    Route::post('favorites', 'FavoriteController@store');
    Route::get('favorites', 'FavoriteController@getFavorites');

    Route::get('user', 'UserController@getUser');
    Route::post('update-user', 'UserController@updateUser');

    Route::get('history', 'HistoryController@getHistory');
});
