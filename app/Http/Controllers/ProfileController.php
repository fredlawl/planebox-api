<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class ProfileController extends Controller {

	private $userRepository;

	public function __construct (UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo 'index';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user_created = $this->userRepository->create($request->all());

		if ($user_created instanceof MessageBag) {
			return response()
				->json($user_created)
				->setStatusCode(412, 'Invalid User');
		}

		$id = $user_created->id;
		return response()
			->json([
				'id' => $id,
				'uri' => url('profile', [
					'id' => $id
				])
			])
			->setStatusCode(201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user_created = $this->userRepository->update($request->all());

		if ($user_created instanceof MessageBag) {
			return response()
				->json($user_created)
				->setStatusCode(412, 'Invalid User');
		}

		return response()->json(['userId' => $user_created->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
