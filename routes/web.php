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

Route::get('settings/{settings_type}', 'SettingController@show')->middleware('admin');

Route::put('settings/{settings_type}', 'SettingController@update')->middleware('admin');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::resource('users', 'UserController');
Route::put('users/checkemail', 'UserController@checkemail')->middleware('ajax');
