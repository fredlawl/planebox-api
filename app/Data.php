<?php namespace App;

use Validator;

class Data extends PlaneBoxModel {

	protected $table = 'data';

	protected $fillable = [
		'user_id',
		'session',
		'city',
		'state',
		'zip',
		'country',
		'category',
		'difficulty',
		'session'
	];

	protected $guarded = ['id'];

	protected $hidden = [];

	protected $validation_rules = [
		'session' => 'required'
	];

	public function stats () {
		return $this->hasMany('App\Stat', 'session', 'session');
	}

	public function user () {
		return $this->hasOne('App\User', 'id', 'user_id');
	}

}
