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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

Route::post('match', "ApiController@match")->middleware('api');
Route::post('game/play', "GamesController@play")->middleware('api');
Route::post('game/newgame', "ApiController@newgame")->middleware('api');
Route::post('game/checkboard', "ApiController@checkboard")->middleware('api');