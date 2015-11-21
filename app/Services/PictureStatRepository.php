<?php

namespace App\Services;

use App\Data;
use App\User;
use App\Stat;
use App\PictureStat;

class PictureStatRepository {

	public function insert (array $data) {
		$stat = PictureStat::firstOrCreate([
			'category' => $data['category'],
			'picture' => $data['picture']
		]);

		if ($data['won'] == '1') {
			$data['won'] = $stat->won + 1;
			$data['lost'] = $stat->lost;
		} else {
			$data['lost'] = $stat->lost + 1;
			$data['won'] = $stat->won;
		}

		$stat->fill($data);

		if (!$stat->isValid())
			return $stat->getValidationErrors();

		$stat->save();
		return $stat;
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
