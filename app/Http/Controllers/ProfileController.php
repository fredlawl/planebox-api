<?php

namespace App\Http\Controllers;

class ProfileController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function postCreate () {

	}

}
