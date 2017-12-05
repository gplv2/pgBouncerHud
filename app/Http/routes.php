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

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/', function () {
    return redirect('console');
});
*/

Route::resource('console', 'ConsoleController@showConsole');
Route::resource('restricted', 'ConsoleController@showConsole');

Route::resource('about', 'ConsoleController@showAbout', ['only' => [
    'index', 'show'
]]);

