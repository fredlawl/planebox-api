<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PictureStat;
use App\Services\StatRepository;
use App\Services\UserRepository;
use App\Services\PictureStatRepository;
use App\Services\DataRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Test\Providers\JWT\JWTManagerTest;

class DataController extends Controller {

	private $statRepository;
	private $pictureStatRepository;
	private $dataRepository;
	private $userRepository;

	public function __construct (
		StatRepository $statRepository,
		PictureStatRepository $pictureStatRepository,
		DataRepository $dataRepository,
		UserRepository $userRepository
	) {
		$this->statRepository = $statRepository;
		$this->pictureStatRepository = $pictureStatRepository;
		$this->dataRepository = $dataRepository;
		$this->userRepository = $userRepository;
	}


	public function index()
	{
		$items = $this->statRepository->fetchAll();
		$table = [];

		foreach ($items as $item) {
			$session = $item->gameSession()->first();
			$user = $session->user()->first();

			$user_info = [
				'name' => '',
				'email' => '',
				'occupation' => '',
				'age' => '',
				'gender' => ''
			];

			if (!empty($user)) {
				$user_info['name'] = $user->name;
				$user_info['email'] = $user->email;
				$user_info['occupation'] = $user->occupation;
				$user_info['age'] = $user->age;
				$user_info['gender'] = $user->gender;
			}

			$session_info = [
				'session' => $session->session,
				'category' => $session->category,
				'difficulty' => $session->difficulty,

				'city' => $session->city,
				'state' => $session->state,
				'zip' => $session->zip,
				'country' => $session->country
			];

			$level_info = [
				'level' => $item->level,
				'won' => $item->won,
				'time_taken' => $item->time_taken,
				'clicks' => $item->clicks
			];

			$table[] = $session_info + $level_info + $user_info;
		}

		$content = "";
		$rowLen = count($table);
		$colLen = count($table[0]);

		// Print out column headers
		$columns = array_keys($table[0]);
		for ($i = 0; $i < $colLen; $i++) {
			$content .= $columns[$i];
			if ($i < $colLen - 1) {
				$content .= ",";
			}
		}
		$content .= "\r\n";

		// Print out data
		for ($i = 0; $i < $rowLen; $i++) {
			$row = $table[$i];
			$col_count = 0;

			foreach ($row as $column) {
				$content .= '"' . $column . '"';
				$col_count++;

				if ($col_count < $colLen) {
					$content .= ',';
				}
			}

			$content .= "\r\n";
		}

		return response($content)
			->header('Content-Type', 'text/csv')
			->header('Content-Disposition', 'attachment; filename="PlaneBox User Data.csv"');

	}


	public function pictureStats()
	{
		$items = $this->pictureStatRepository->fetchAll();

		$content = "";
		$columns = array_keys($items->first()->attributesToArray());
		$colLen = count($columns);

		// Print out column headers
		for ($i = 0; $i < $colLen; $i++) {
			$content .= $columns[$i];
			if ($i < $colLen - 1) {
				$content .= ",";
			}
		}
		$content .= "\r\n";

		// Print out data
		foreach ($items as $row) {
			$col_count = 0;
			$data = $row->attributesToArray();

			foreach ($data as $column) {
				$content .= '"' . $column . '"';
				$col_count++;

				if ($col_count < $colLen) {
					$content .= ',';
				}
			}

			$content .= "\r\n";
		}

		return response($content)
			->header('Content-Type', 'text/csv')
			->header('Content-Disposition', 'attachment; filename="PlaneBox Picture Data.csv"');

	}


	/**
	 * Create Session for FE
	 * @param Request $request
	 */

	public function createSession (Request $request) {
		$session = md5(time());
		$create = $request->all();
		$create['session'] = $session;

		$token = JWTAuth::getToken();

		if ($token) {
			try {
				$user = JWTAuth::authenticate($token);
				if ($user != false) {
					$create['user_id'] = $user->id;
				}
			} catch (\Exception $e) {

			}
		}

		$data = $this->dataRepository->insert($create);

		if ($data instanceof MessageBag) {
			return response()
				->json($data)
				->setStatusCode(412, 'Invalid session create');
		}

		return response()->json([
			'session' => $session
		])->setStatusCode(200, 'Session created');
	}


	/**
	 * Save level data after level completion
	 * @param Request $request
	 */

	public function onLevelComplete ($session, Request $request) {
		$stats = $request->all();
		$stats['session'] = $session;

		$update = $this->statRepository->insert($stats);
		if ($update instanceof MessageBag) {
			return response()
				->json($update)
				->setStatusCode(412, 'Invalid stat stuff');
		}

		return response()->json([])->setStatusCode(200, 'Stats saved');
	}


	/**
	 * Save picture data I guess?
	 * @param Request $request
	 */

	public function pictureSave (Request $request) {
		$stats = $request->all();

		$update = $this->pictureStatRepository->insert($stats);
		if ($update instanceof MessageBag) {
			return response()
				->json($update)
				->setStatusCode(412, 'Invalid stat stuff');
		}

		return response()->json([])->setStatusCode(200, 'Picture Stats saved');
	}

}
