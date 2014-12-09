<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Episode extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'episodes';

	protected $fillable = ['user_id', 'episode_id', 'series_id'];

	public function series() {
		return $this->hasMany('Series', 'series_id');
	}
}