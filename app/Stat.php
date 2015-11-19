<?php namespace App;

use Validator;

class Stat extends PlaneBoxModel {

	protected $table = 'stats';

	protected $fillable = [
		'session',
		'level',
		'clicks',
		'won',
		'time_taken'
	];


	protected $hidden = [];

	protected $guarded = ['id'];

	protected $validation_rules = [];

	public function gameSession () {
		return $this->belongsTo('App\Data', 'session');
	}

}
