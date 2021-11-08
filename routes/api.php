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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('lanuds', 'LanudAPIController');


Route::resource('estimates', 'EstimateAPIController');
Route::post('/estimates/search', [App\Http\Controllers\API\EstimateAPIController::class, 'search']);
Route::get('/schedules/{day}',[App\Http\Controllers\API\EstimateAPIController::class, 'schedule']);
