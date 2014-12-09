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
	$js_config = Session::get('js_config');
	if(isset($js_config)) {
		return View::make('site.default')
			->with('js_config', $js_config);
	} else {
		return View::make('site.default');
	}
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

App::missing(function($exception)
{
	$js_config = array(
		'message' => 'Sorry, but that page does not exist',
		'message_type' => 'info'
	);

	if (Auth::guest()) {
	    return Redirect::to('/')
			->with('js_config', $js_config);
	} else {
	    return Redirect::to('/list')
			->with('js_config', $js_config);
	}
});