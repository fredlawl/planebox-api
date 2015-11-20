<?php namespace App;

use Validator;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends PlaneBoxModel implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'occupation',
		'age',
		'gender'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $validation_rules = [
		'name' => 'required|max:255',
		'email' => 'required|email|max:255|unique:users',
		'password' => 'required|min:6',
		'age' => 'required',
		'occupation' => 'required',
		'gender' => 'required'
	];

	public function getGenderAttribute ($value) {
		return ($value === 1) ? 'Male' : 'Female';
	}

}
