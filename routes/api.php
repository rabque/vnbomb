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
Route::post('game/cashout', "ApiController@cashout")->middleware('api');
Route::post('game/getaddr', "ApiController@getaddr")->middleware('api');
Route::post('game/live', "ApiController@live")->middleware('api');
Route::post('game/refresh_balance', "ApiController@refresh_balance")->middleware('api');
Route::post('action/newaffiliate', "ApiController@newaffiliate")->middleware('api');

Route::post('game/full_cashout', "ApiController@full_cashout")->middleware('api');
Route::post('account/change', "ApiController@account")->middleware('api');

