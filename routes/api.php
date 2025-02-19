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

// Route for the API search controller.
Route::get('/search', 'Api\SearchController@search');
Route::get('/message', 'Api\MessageController@message');

//Route for the statistics
Route::get('/statistics', 'Api\StatisticController@getData');
