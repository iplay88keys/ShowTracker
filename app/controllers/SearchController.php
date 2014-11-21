<?php
require_once __DIR__ . '/../includes/TvDb/vendor/autoload.php';
include __DIR__ . '/../includes/custom/settings.php';
include __DIR__ . '/../includes/TvDb/src/Moinax/TvDb/CurlException.php';
include __DIR__ . '/../includes/TvDb/src/Moinax/TvDb/Client.php';
include __DIR__ . '/../includes/TvDb/src/Moinax/TvDb/Serie.php';
include __DIR__ . '/../includes/TvDb/src/Moinax/TvDb/Banner.php';
include __DIR__ . '/../includes/TvDb/src/Moinax/TvDb/Episode.php';

use Illuminate\Support\Facades\Facade;
use Moinax\TvDb\Client;

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return "Please enter a search term";
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(! count(Input::all())) {
			return Redirect::to('/');
		}else {
			$tvdb = new Client(TVDB_URL, TVDB_API_KEY);

			$serverTime = $tvdb->getServerTime();
			// Search for a show
			$term = Input::get('term');
			$data = $tvdb->getSeries($term);
			foreach($data as $seriesKey => $series) {
				if($series->name == "** All The Crap You Should Not Add To TheTVDb **") {
					unset($data[$seriesKey]);
				}
			}
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
