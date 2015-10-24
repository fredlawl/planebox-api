<?php

namespace App\Services;

use App\User;

class UserRepository {

	public function create (array $data) {
		$user = new User();
		$user->fill($data);

		if (!$user->isValid())
			return $user->getValidationErrors();

		$user->save();
		return true;
	}

}
