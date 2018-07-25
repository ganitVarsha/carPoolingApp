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


Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');

Route::get('admin', 'HomeController@admin')->middleware('admin');

Route::get('settings/app', 'SettingController@app')->middleware('admin');
Route::put('settings/app', 'SettingController@appUpdate')->middleware('admin');
Route::get('settings/page', 'SettingController@page')->middleware('admin');
Route::put('settings/page', 'SettingController@pageUpdate')->middleware('admin');
Route::get('settings/web', 'SettingController@web')->middleware('admin');
Route::put('settings/web', 'SettingController@webUpdate')->middleware('admin');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::resource('users','UserController');