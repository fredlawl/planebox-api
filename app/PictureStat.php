<?php namespace App;

use Validator;

class PictureStat extends PlaneBoxModel {

	protected $table = 'picture_stats';
	public $timestamps = false;

	protected $fillable = [
		'category',
		'picture',
		'won',
		'lost'
	];


	protected $hidden = [];

	protected $guarded = ['id'];

	protected $validation_rules = [];

}
