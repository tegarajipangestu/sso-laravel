<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/welcome', function () {
			return view('welcome');
	});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/', function () {
		$user = Auth::user();
			return view('home', ['user' => $user]);
	});

Route::get('/logout', function() {
		Saml2::logout();
	});

});
