<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;
use Tymon\JWTAuth\Facades\JWTAuth;

class DataController extends Controller {

	private $userRepository;

	public function __construct (UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}


	public function index()
	{
		// ... data
		echo 'Logged in dude!';
	}


	public function store(Request $request)
	{
		//  ... store data
	}

}
