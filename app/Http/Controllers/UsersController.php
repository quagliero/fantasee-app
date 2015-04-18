<?php namespace Fantasee\Http\Controllers;

use Fantasee\Http\Requests;
use Fantasee\Http\Requests\UpdateUserRequest;
use Fantasee\Http\Controllers\Controller;
use Fantasee\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @param	UserRepository	$users
	 * @return void
	 */
	public function __construct(User $users)
	{
		$this->users = $users;

		$this->middleware('auth', ['only' => ['create', 'edit', 'update', 'destroy']]);
		$this->middleware('superadmin', ['only' => ['index', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->users->get();

		return view('user.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user)
	{
		return view('user.show', compact('user'));
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
	public function update(User $user, UpdateUserRequest $request)
	{
		$user->fill($request->all())->save();

		return redirect()->route('user_path', [$user->id]);
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
