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

//Home Page Route
Route::get('/', 'HomeController@index')->name('home');

//Profile Page Routes
Route::get('profile/{username}', 'ProfileController@index')->name('profile');
Route::post('profile/update', 'ProfileController@updateProfile')->name('updateProfile');
Route::post('profile/avatar/update', 'UserAvatarController@updateUserAvatar')->name('updateUserAvatar');

//Auth Routes
Auth::routes(['verify' => true]);
