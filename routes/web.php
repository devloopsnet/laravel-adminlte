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

Route::domain(env('APP_DOMAIN'))->group(static function () {
  Route::get('/', static function () {
    return view('welcome');
  });
});

Route::get('test', static function () {
});

Route::get('terms', static function () {
  return 'Terms Page...';
});

require_once 'admin.php';

require_once 'user.php';

//Auth::routes();
