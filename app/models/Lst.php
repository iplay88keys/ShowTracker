<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Lst extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lists';

	protected $fillable = ['user_id', 'series_id'];
	
	public function user() {
		return $this->hasMany('User', 'user_id');
	}

	public function series() {
		return $this->hasMany('Series', 'series_id');
	}
}
