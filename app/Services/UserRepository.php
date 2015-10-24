<?php

namespace App\Services;

use App\User;

class UserRepository {

	public function create (array $data) {
		$user = new User();
		$user->fill($data);

		if (!$user->isValid())
			return $user->getValidationErrors();

		$user->password = bcrypt($data['password']);
		$user->save();
		return $user;
	}

	public function update (array $data, $id) {

	}

}
