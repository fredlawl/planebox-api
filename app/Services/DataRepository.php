<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class DataRepository {

	public function insert (array $data) {
		$data = new Data();
		$data->fill($data);

		if (!$data->isValid())
			return $data->getValidationErrors();

		$data->save();
		return $data;
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
