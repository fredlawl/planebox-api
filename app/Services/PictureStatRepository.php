<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class PictureStatRepository {

	public function insert (array $data) {
		$data = new PictureStat();
		$data->fill($data);

		if (!$data->isValid())
			return $data->getValidationErrors();

		$data->save();
		return $data;
	}

	public function update ($session, $level, array $data) {
		$data = PictureStat::where('session', '=', $session)->andWhere('level', '=', $level)->first();

		if (empty($data)) {
			return false;
		}

		$data->update($data);
		return false;
	}

	public function fetchAll () {
		return PictureStat::all();
	}

}
