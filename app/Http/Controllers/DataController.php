<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\StatRepository;
use App\Services\UserRepository;
use App\Services\DataRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Tymon\JWTAuth\Facades\JWTAuth;

class DataController extends Controller {

	private $userRepository;
	private $dataRepository;

	public function __construct (UserRepository $userRepository, DataRepository $dataRepository) {
		$this->userRepository = $userRepository;
		$this->dataRepository = $dataRepository;
	}


	public function index()
	{
		$items = $this->dataRepository->fetchAll();
		$table = [];

		foreach ($items as $item) {
			$user = $item->user()->first();

			$user_info = array(
				'name' => '',
				'email' => '',
				'occupation' => '',
				'age' => '',
				'gender' => ''
			);

			if (!empty($user)) {
				$user_info['name'] = $user->name;
				$user_info['email'] = $user->email;
				$user_info['occupation'] = $user->occupation;
				$user_info['age'] = $user->age;
				$user_info['gender'] = $user->gender;
			}

			$table[] = array(
				'session' => $item->session,
				'category' => $item->category,
				'difficulty' => $item->difficulty,

				'city' => $item->city,
				'state' => $item->state,
				'zip' => $item->zip,
				'country' => $item->country
			) + $user_info;
		}

		return response()->json($table);
	}


	public function store(Request $request)
	{
		//  ... store data
	}

}
