<?php

interface ShowRetriever {
	public function getSeriesByID($id);
	public function getSeriesBySearch($term);
}