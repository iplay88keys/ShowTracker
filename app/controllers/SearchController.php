<?php

use Illuminate\Support\Facades\Facade;

class SearchController extends \BaseController {

	public function index()
	{
		return "Please enter a search term";
	}


	//Search
	public function create()
	{
		if(! count(Input::all())) {
			return Redirect::to('/');
		}else {
			// Search for a show
			$retriever = App::make('ShowRetriever');
			$data = $retriever->getSeriesBySearch(Input::get('term'));
			if(count($data) >= 1) {
				JavaScript::put([
        				'data' => $data
    				]);
				return View::make('search.search')->with('data', $data);
			} else {
				$js_config = array(
					'message' => 'Nothing found',
					'message_type' => 'info'
				);
				return Redirect::to('list')
					->with('js_config', $js_config);
			}
		}
	}
}
