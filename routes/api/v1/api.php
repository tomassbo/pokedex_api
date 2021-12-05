<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::prefix('/user')->group(function () {
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
});


Route::middleware('auth:api')->prefix('/pokemon')->group(function () {

    Route::get('/types', 'App\Http\Controllers\TypeController@index');
    Route::post('/type', 'App\Http\Controllers\TypeController@store');
    Route::get('/type/{id}', 'App\Http\Controllers\TypeController@show');
    Route::put('/type/{id}', 'App\Http\Controllers\TypeController@update');
    Route::delete('/type/{id}', 'App\Http\Controllers\TypeController@destroy');

    Route::get('/rarities', 'App\Http\Controllers\RarityController@index');
    Route::post('/rarity', 'App\Http\Controllers\RarityController@store');
    Route::get('/rarity/{id}', 'App\Http\Controllers\RarityController@show');
    Route::put('/rarity/{id}', 'App\Http\Controllers\RarityController@update');
    Route::delete('/rarity/{id}', 'App\Http\Controllers\RarityController@destroy');

    Route::get('/expansions', 'App\Http\Controllers\ExpansionController@index');
    Route::post('/expansion', 'App\Http\Controllers\ExpansionController@store');
    Route::get('/expansion/{id}', 'App\Http\Controllers\ExpansionController@show');
    Route::put('/expansion/{id}', 'App\Http\Controllers\ExpansionController@update');
    Route::delete('/expansion/{id}', 'App\Http\Controllers\ExpansionController@destroy');
});
