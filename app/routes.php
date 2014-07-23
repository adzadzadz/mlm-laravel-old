<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showHome');

Route::get('init', 'HomeController@initDatabase');

Route::get('update', 'HomeController@update');

Route::get('register', 'AccountController@showRegister');

// Add user - Registration Route
Route::post('adduser', 'AccountController@addUser');
// Login route
Route::post('login', 'AccountController@login');
// Logout route
Route::post('logout', 'AccountController@logout');
// Activation codes creation
Route::post('generateCodes', 'CodesController@generateCode');

