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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('list-users','UserController@index');

Route::post('login', 'UserControllerAPI@login');
Route::post('register', 'UserControllerAPI@register');
Route::post('save-product', 'API\ProductController@store');
Route::post('update-product', 'API\ProductController@update');
Route::get('users','UserControllerAPI@index');
Route::get('external-books/{id?}','BookController@index');
Route::post('/v1/books','BookController@store');
Route::get('/v1/books','BookController@list');
Route::patch('/v1/books/{id}','BookController@update');
Route::delete('/v1/books/{id}','BookController@destroy');
Route::get('/v1/books/{id}','BookController@show');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserControllerAPI@details');
    Route::post('update-user','UserControllerAPI@update');
});
