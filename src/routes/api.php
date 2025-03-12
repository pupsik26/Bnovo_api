<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/guest', 'App\Http\Controllers\GuestsController@index');

Route::get('/guest/{id}', 'App\Http\Controllers\GuestsController@show');

Route::post('/guest', 'App\Http\Controllers\GuestsController@store');

Route::put('/guest/{id}', 'App\Http\Controllers\GuestsController@update');

Route::delete('/guest/{id}', 'App\Http\Controllers\GuestsController@destroy');

