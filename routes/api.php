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
Route::post('register', 'V1\RegisterController@register');
Route::post('forgotPassword','V1\RegisterController@forgetPasswordMailSend');
Route::post('getSponser','V1\RegisterController@getSponsor');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
