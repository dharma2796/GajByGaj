<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    // return what you want
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getSponsor/{sponsorid}','Auth\RegisterController@getSponsor');
Route::get('/register/{userid}','Auth\RegisterController@reffer');


//Admin
Route::group(['middleware' => ['auth','adminverification']], function () {
    Route::get('/Main/Dashboard', 'HomeController@adminindex');


});




//User
Route::group(['middleware' => ['auth','userverification']], function () {
    Route::get('/User/Dashboard', 'HomeController@userindex');



});
