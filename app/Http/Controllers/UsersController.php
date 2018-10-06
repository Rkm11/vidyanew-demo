<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
	/**
	 * Display a listing of User.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$users = User::where('role', 2)->get();
		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating new User.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		return view('users.create', compact('roles'));
	}

	/**
	 * Store a newly created User in storage.
	 *
	 * @param  \App\Http\Requests\StoreUsersRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreUsersRequest $request) {
		$d['name'] = $request->name;
		$d['email'] = $request->email;
		$d['role'] = 2;
		$d['question_id'] = 0;
		$d['password'] = bcrypt($request->password);
		// dd($d);
		$user = User::create($d);

		return redirect()->route('users.index');
	}

	/**
	 * Show the form for editing User.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::findOrFail($id);

		return view('users.edit', compact('user', 'roles'));
	}

	/**
	 * Update User in storage.
	 *
	 * @param  \App\Http\Requests\UpdateUsersRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUsersRequest $request, $id) {
		$user = User::findOrFail($id);
		$d['name'] = $request->name;
		$d['email'] = $request->email;
		$d['password'] = bcrypt($request->password);
		$user->update($d);

		return redirect()->route('users.index');
	}

	/**
	 * Remove User from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::findOrFail($id);
		$user->delete();

		return redirect()->route('users.index');
	}

	/**
	 * Delete all selected User at once.
	 *
	 * @param Request $request
	 */
	public function massDestroy(Request $request) {
		if ($request->input('ids')) {
			$entries = User::whereIn('id', $request->input('ids'))->get();

			foreach ($entries as $entry) {
				$entry->delete();
			}
		}
	}

}
