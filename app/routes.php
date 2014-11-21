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

Route::get('/', function()
{
	return View::make('site.default');
});

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::post('login', 'SessionsController@store');

Route::post('search', 'SearchController@create')->before('auth');
Route::get('search', 'SearchController@create')->before('auth');

Route::get('list', 'ListController@show_list')->before('auth');
Route::post('list/add_series', 'ListController@add_series')->before('auth');
Route::get('list/{id}', 'ListController@show_series')->before('auth');
Route::post('list/remove_series', 'ListController@remove_series')->before('auth');
