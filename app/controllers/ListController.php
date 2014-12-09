<?php

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class ListController extends \BaseController {

	//Add a series to a user's watchlist
	public function add_series()
	{
		$id = Input::get('id');
		$userID = Auth::user()->id;

		$seriesList = Series::where('id', '=', $id)->get();
		if(is_null($seriesList->first())) {
			$retriever = App::make('ShowRetriever');
			$data = $retriever->getSeriesByID($id);

			$series = new Series;
			$series->setAttribute('id', $id);
			$series->setAttribute('banner', $data->banner);
			$series->setAttribute('name', $data->name);
			$series->setAttribute('overview', $data->overview);
			$series->setAttribute('status', $data->status);
			$series->save();
		}

		$userList = Lst::where('user_id', '=', $userID)->where('series_id', '=', $id)->get();
		if(is_null($userList->first())) {
			$item = new Lst;
			$item->setAttribute('user_id', $userID);
			$item->setAttribute('series_id', $id);
			$item->save();
		} else {
			return 'exists';
		}

		return 'saved';
	}

	//Remove a series from a user's watchlist
	public function remove_series()
	{
		$id = Input::get('id');
		$userID = Auth::user()->id;

		$row = Lst::where('user_id', '=', $userID)->where('series_id', '=', $id)->get();
		if(count($row) > 1) {
			return 'error';
		} else if(is_null($row)) {
			return "couldn't find";
		} else {
			Lst::where('user_id', '=', $userID)->where('series_id', '=', $id)->delete();
			return 'deleted';
		}
	}

	//Display a user's watchlist
	public function show_list()
	{
		$js_config = Session::get('js_config');
		$userID = Auth::user()->id;
		$data = DB::table('lists')
			->join('series', 'lists.series_id', '=', 'series.id')
			->select('series.id', 'series.name', 'series.banner', 'series.overview')
			->where('lists.user_id', '=', $userID)
			->get();
		if(count($js_config) > 0) {
			return View::make('lists.list')
				->with('data', $data)
				->with('type', 'list')
				->with('js_config', $js_config);
		} else {
			return View::make('lists.list')
				->with('data', $data)
				->with('type', 'list');
		}
	}

	//Display the episodes for a specific series
	public function show_series($id)
	{
		$userID = Auth::user()->id;

		$seriesList = Series::where('id', '=', $id)->get();
		if(is_null($id) || is_null($seriesList->first())) {
			$js_config = array(
				'message' => 'That series is not in our database. Try searching for it.',
				'message_type' => 'error'
			);
			return Redirect::to('list')
				->with('js_config', $js_config);
		}

		$retriever = App::make('ShowRetriever');
		$data = $retriever->getSeriesEpisodesByID($id);
		if(count($data) > 0) {
			return View::make('lists.single')->with('data', $data);
		} else {
			$js_config = array(
				'message' => 'Something went wrong',
				'message_type' => 'error'
			);
			return Redirect::to('list')
				->with('js_config', $js_config);
		}
	}
}