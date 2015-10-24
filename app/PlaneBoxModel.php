<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class PlaneBoxModel extends Model {

	protected $validation_rules = [];
	protected $validation_errors;

	public function getValidationErrors () {
		return $this->validation_errors;
	}

	public function isValid () {
		$validator = Validator::make($this->attributes, $this->validation_rules);
		return $this->validate($validator);
	}

	public function validate (\Illuminate\Validation\Validator $validator) {
		if ($validator->fails()) {
			$this->validation_errors = $validator->messages();
			return false;
		}

		return true;
	}

}
