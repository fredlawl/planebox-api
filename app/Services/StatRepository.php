<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class StatRepository {

	public function insert (array $data) {
		$stat = new Stat();
		$stat->fill($data);

		if (!$stat->isValid())
			return $stat->getValidationErrors();

		$stat->save();
		return $stat;
	}

	public function update ($session, $level, array $data) {
		$data = Stat::where('session', '=', $session)->andWhere('level', '=', $level)->first();

		if (empty($data)) {
			return false;
		}

		$data->update($data);
		return false;
	}

	public function fetchAll () {
		return Stat::all();
	}

}
