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

class TVDB implements ShowRetriever {
	public $tvdb;
	public $serverTime;
	function __construct() {
		$this->tvdb = new Client(TVDB_URL, TVDB_API_KEY);
		$this->serverTime = $this->tvdb->getServerTime();
	}

	public function getSeriesByID($id) {
		return $this->tvdb->getSerie($id);
	}

	public function getSeriesEpisodesByID($id) {
		return $this->tvdb->getSerieEpisodes($id);;
	}

	public function getSeriesBySearch($term) {
		$data = $this->tvdb->getSeries($term);
		foreach($data as $seriesKey => $series) {
			if($series->name == "** All The Crap You Should Not Add To TheTVDb **" || $series->name == "** 403: Series Not Permitted **") {
				unset($data[$seriesKey]);
			}
		}
		return $data;
	}
}
