<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Series extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'series';

	protected $fillable = ['series_id', 'name', 'banner', 'overview', 'status'];

	public function lsts() {
		return $this->belongsToMany('Lst', 'series_id');
	}
}
