<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller {

	private $userRepository;

	public function __construct (UserRepository $repository) {
		$this->userRepository = $repository;
	}

	public function postLogin (Request $request) {
		$credentials = $request->only('email', 'password');

		$token = JWTAuth::attempt($credentials);
		if (!$token) {
			return response()
				->json('Incorrect username or password combination.', Response::HTTP_UNAUTHORIZED);
		}

		return response()
			->json(compact('token'));
	}

}
