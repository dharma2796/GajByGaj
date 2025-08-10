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

Route::get('appUpdate','V1\SupportController@appUpd');

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::get('user/dashboard','V1\UserDetailController@dashboard');
    Route::get('user/userProfile','V1\UserDetailController@userProfile');
    Route::post('user/userUpdate','V1\UserDetailController@updateUserDetails');
    Route::post('user/changePassword','V1\UserDetailController@updateUserPasswords');

    //team
    Route::get('user/directTeam','V1\UserDetailController@directTeam');
    Route::get('user/totalTeam','V1\UserDetailController@getTotalTeam');
    Route::get('user/teamDashboard','V1\UserDetailController@getTotalTeamHeading');
    Route::post('user/userDirectList','V1\UserDetailController@userDirectList');

    //Support 
    Route::get('user/viewTicket','V1\SupportController@viewUserTicket');
    Route::post('user/createTicket','V1\SupportController@userCreateTicket');
    Route::get('user/ticketView/{id}','V1\SupportController@viewTicketSingleUser');
    Route::post('user/replyTicket','V1\SupportController@postReplyUser');


    Route::post('user/logOut','V1\UserDetailController@logOutUser');

});
