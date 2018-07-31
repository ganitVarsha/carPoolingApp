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

Route::group([
    'prefix' => 'auth'
        ], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('signupViaPhone', 'AuthController@signupViaPhone');
    Route::post('logout', 'AuthController@logout');
    Route::post('matchOTP', 'AuthController@matchOTP');
    Route::post('mobileLogin', 'AuthController@mobileLogin');
    Route::post('mobileLogout', 'AuthController@mobileLogout');
    Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('getProfile', 'AuthController@getProfile');
    Route::post('setProfile', 'AuthController@setProfile');
    Route::post('createToken', 'AuthController@createToken');

    Route::group([
        'middleware' => 'auth:api'
            ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'prefix' => 'action'
        ], function () {
    Route::post('addPool', 'ApiController@setPool');
});
