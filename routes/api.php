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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('rosters', 'App\Http\Controllers\RosterController@index');
Route::resource('teams', 'App\Http\Controllers\TeamController');

//Route::resource('roster', 'App\Http\Controllers\RosterController');
Route::get('roster/{code}', 'App\Http\Controllers\RosterController@show');
Route::get('playerTotals/{id}', 'App\Http\Controllers\PlayerTotalsController@show');

Route::get('printRoster', 'App\Http\Controllers\RosterController@printRoster');
