<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


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

	public function postReset (Request $request, PasswordBroker $broker) {
		$credentials = $request->only('email');

		Validator::make($credentials, [
			'email' => 'required|email'
		]);

		$response = $broker->sendResetLink($credentials, function($m) {
			$m->subject('Reset Password');
		});

		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
				return response()->json('Password reset sent.');

			case PasswordBroker::INVALID_USER:
				return response()
					->json(trans($response))
					->setStatusCode(412, 'Invalid User');
		}
	}


	public function putPassword (Request $request) {
		$credentials = $request->only('email', 'password', 'password_confirmation', 'token');

		$validator = Validator::make($credentials, [
			'email'	=> 'required|email|max:255',
			'password' => 'required|confirmed|min:6',
			'token' => 'required'
		]);

		if ($validator->fails()) {
			return response()
				->json($validator->messages())
				->setStatusCode(412, 'Invalid Passwords');
		}

		$response = Password::reset($credentials, function ($user, $password) {
			$this->resetPassword($user, $password);
		});

		switch ($response) {
			case Password::PASSWORD_RESET:
				return response()->json('Password successfuly reset!');

			default:
				return response()
					->json(trans($response))
					->setStatusCode(412, 'Invalid Passwords');
		}

	}

}
