<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class DataRepository {

	public function insert (array $data) {
		$session = new Data();
		$session->fill($data);

		if (!$session->isValid())
			return $session->getValidationErrors();

		$session->save();
		return $session;
	}

	public function update ($session, array $data) {
		$data = Data::where('session', '=', $session)->first();

		if (empty($data)) {
			return false;
		}

		$data->update($data);
		return false;
	}

	public function fetchAll () {
		return Data::all();
	}

}
