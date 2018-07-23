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
//    if (empty(auth()->user())) {
        return view('auth/adminLogin');
//    } else {
//        route('dashboard');
//        die;
//    }
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('admin', 'HomeController@admin')->middleware('admin');
