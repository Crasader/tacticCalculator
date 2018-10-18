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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('basic-data', 'Api\BasicDataController', [
    'only' => ['index', 'update'],
    'names' => [
        'index' => 'api.basic-data.index',
        'update' => 'api.basic-data.update',
    ],
]);

Route::post('image-upload', 'Api\ImageUploadController@store');
Route::get('images', 'Api\ImageUploadController@index');

Route::resource('tactic-data', 'Api\TacticDataController', [
    'only' => ['index'],
    'names' => [
        'index' => 'api.basic-data.index',
    ],
]);

