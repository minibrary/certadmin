<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::auth();
Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
//Route::get('/callback/{provider}', 'SocialAuthController@callback');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/list/warning', 'CertificateController@warning');
    Route::get('/list/danger', 'CertificateController@danger');
    Route::resource('/list', 'CertificateController');
    Route::resource('/profile', 'ProfileController', ['except' => ['index', 'store']]);
});
