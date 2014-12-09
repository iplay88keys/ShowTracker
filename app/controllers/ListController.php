<?php

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class ListController extends \BaseController {

	public function add_episode()
	{
		$id = Input::get('id');
		$series = Input::get('series');
		$userID = Auth::user()->id;

		$episode = new Episode;
		$episode->setAttribute('user_id', $userID);
		$episode->setAttribute('episode_id', $id);
		$episode->setAttribute('series_id', $series);
		$episode->save();

		return 'done';
	}

	public function remove_episode()
	{
		$id = Input::get('id');
		$userID = Auth::user()->id;

		$data = Episode::where('user_id', '=', $userID)
					->where('episode_id', '=', $id)
					->get();
		if(count($data) > 1) {
			return 'error';
		} else if(is_null($data)) {
			return "couldn't find";
		} else {
			$data = Episode::where('user_id', '=', $userID)
						->where('episode_id', '=', $id)
						->delete();
			return 'done';
		}
	}

	//Add a series to a user's watchlist
	public function add_series()
	{
		$id = Input::get('id');
		$userID = Auth::user()->id;

		$seriesList = Series::where('id', '=', $id)
						->get();
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

		$userList = Lst::where('user_id', '=', $userID)
						->where('series_id', '=', $id)
						->get();
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

		$row = Lst::where('user_id', '=', $userID)
			->where('series_id', '=', $id)
			->get();
		if(count($row) > 1) {
			return 'error';
		} else if(is_null($row)) {
			return "couldn't find";
		} else {
			Lst::where('user_id', '=', $userID)
				->where('series_id', '=', $id)
				->delete();
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

		$seriesList = Series::where('id', '=', $id)
						->get();
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
			$watched = Episode::where('user_id', '=', $userID)
				->where('series_id', '=', $id)
				->get();

			$final = [];
			foreach($watched as $watch) {
				$final[$watch['attributes']['episode_id']] = null;
			}
			return View::make('lists.single')
				->with('data', $data)
				->with('watched', $final);
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