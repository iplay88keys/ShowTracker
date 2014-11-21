<?php

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$js_config = Session::get('js_config');
		if (Auth::check()) {
			return Redirect::to('/list');
		} else {
			if(count($js_config) > 0) {
				return View::make('sessions.create')->with('js_config', $js_config);
			} else {
				return View::make('sessions.create');
			}
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::attempt(Input::only('email', 'password'))) {
			$js_config = array(
				'message' => 'You have been logged in',
				'message_type' => 'success'
			);
			return Redirect::to('/list')
				->with('js_config', $js_config);
		} else {
			$js_config = array(
				'message' => 'Invalid credentials',
				'message_type' => 'error'
			);
			return Redirect::to('login')
				->with('js_config', $js_config)
				->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if (Auth::guest()) {
			return View::make('site.default');
		} else {
			Auth::logout();
			$js_config = array(
				'message' => 'You have been logged out',
				'message_type' => 'success'
			);
			return View::make('site.default')
				->with('js_config', $js_config);
		}
	}


}
