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

Route::get('/', 'HomeController@index')->name('home');
Route::get('profile/{username}', 'ProfileController@index')->name('profile');
Route::post('profile/{username}', 'ProfileController@updateProfile');
Route::post('profile/{username}', 'UserAvatarController@updateUserAvatar')->name('updateUserAvatar');

Auth::routes(['verify' => true]);
