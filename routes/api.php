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
Route::domain(env('APP_DOMAIN'))->group(static function () {
  Route::prefix('user')->name('user.')->group(static function () {
    Route::post('register', [
      'as' => 'register',
      'uses' => 'Api\UsersController@register',
    ]);

    Route::post('{user}/verify-otp', [
      'as' => 'verifyOtp',
      'uses' => 'Api\UsersController@verifyOtp',
    ]);

    Route::post('{user}/resend-otp', [
      'as' => 'resendOtp',
      'uses' => 'Api\UsersController@resendOtp',
    ]);

    Route::post('social-login/{fbId}', [
      'as' => 'socialLogin',
      'uses' => 'Api\UsersController@socialLogin',
    ]);

    Route::post('login', [
      'as' => 'login',
      'uses' => 'Api\UsersController@login',
    ]);

    Route::post('reset-password', [
      'as' => 'resetPassword',
      'uses' => 'Api\UsersController@resetPassword',
    ]);

    Route::middleware('auth:api-user')->group(static function () {
      Route::get('me', [
        'us' => 'me',
        'uses' => 'Api\UsersController@me',
      ]);

      Route::get('application-settings', [
        'as' => 'applicationSettings',
        'uses' => 'Api\HomeController@applicationSettings',
      ]);

      Route::post('update-information', [
        'as' => 'updateInformation',
        'uses' => 'Api\UsersController@updateInformation',
      ]);

      Route::get('home-screen', [
        'as' => 'homeScreen',
        'uses' => 'Api\HomeController@homeScreen',
      ]);

      Route::get('notifications', [
        'as' => 'notifications',
        'uses' => 'Api\UsersController@notifications',
      ]);
    });
  });
});
