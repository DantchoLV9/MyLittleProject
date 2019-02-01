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

//Route Group - Middleware Auth
Route::middleware('auth')->group(function () {

//Profile Page Routes
Route::get('profile/{username?}', 'ProfileController@index')->name('profile');
Route::post('profile/update', 'ProfileController@updateProfile')->name('updateProfile');
Route::get('profile/avatar/update', function () {
    return redirect()->route('profile', ['username' => mb_strtolower(Auth::user()->username, 'UTF-8')]);
});
Route::post('profile/avatar/update', 'UserAvatarController@updateUserAvatar')->name('updateUserAvatar');

});

//Route Group - Middlewares Aith and AllowIfAdmin
Route::middleware(['auth', 'isadmin'])->group(function () {

//Dashboard Routes
Route::get('dashboard', 'Dashboard\HomeController@index')->name('dashboard');
Route::get('dashboard/settings/general', 'Dashboard\Settings\General@index')->name('settingsGeneral');

});

//Auth Routes
Auth::routes(['verify' => true]);
