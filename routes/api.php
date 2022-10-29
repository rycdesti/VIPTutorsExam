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

Route::get('filterRoster', function () {
    return redirect()->route('rosters', build_url_param());
});
Route::get('exportRoster', function () {
    return redirect()->route('export', build_url_param());
});

Route::get('rosters', 'App\Http\Controllers\RosterController@index')->name('rosters');
Route::get('playerTotals/{id}', 'App\Http\Controllers\PlayerTotalsController@show')->name('playerTotals');
Route::get('export', 'App\Http\Controllers\RosterController@printRoster')->name('export');
