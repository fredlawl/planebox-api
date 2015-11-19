<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class StatRepository {

	public function insert (array $data) {
		$data = new Stat();
		$data->fill($data);

		if (!$data->isValid())
			return $data->getValidationErrors();

		$data->save();
		return $data;
	}

	public function update ($session, $level, array $data) {
		$data = Stat::where('session', '=', $session)->andWhere('level', '=', $level)->first();

		if (empty($data)) {
			return false;
		}

		$data->update($data);
		return false;
	}

}
