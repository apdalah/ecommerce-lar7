<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "dashboard" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth:dashboard'], function() {

	Route::get('/', 'HomeController@show')->name('admin.index');

});

Route::group(['middleware' => 'guest:dashboard'], function() {

	Route::get('login', 'LoginController@showLoginForm')->name('admin.showLoginForm');
	Route::post('login', 'LoginController@login')->name('admin.login');

});