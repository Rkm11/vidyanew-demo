<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller {
	public function __construct() {
		$this->middleware('guest');
	}

	public function resetpassword(Request $request) {

		$validatedData = $request->validate([
			'password1' => 'required|string|min:6|',
		]);
		$user = User::where('email', strtolower($request->email))->first();
		// dd($request["question"]);
		if (!empty($user->id)) {

		} else {
			return redirect()->back()->with("Error", "Email address not matched with our database");
			die("Email address not matched with our database");
		}
		if ($request["password1"] === $request["password_confirmation"]) {

		} else {
			return redirect()->back()->with("Error", "New Password Can Not Match With Confirmed Password :(");
			die("New Password Can Not Match With Confirmed Password :(");
		}
		if ($request["question"] == $user->question_id) {

		} else {
			return redirect()->back()->with("Error", "Wrong Question Selected.");
		}
		if ($request["answer"] === $user->answer) {

		} else {
			return redirect()->back()->with("Error", "Wrong answer entered.");
			die("Wrong Question answer entered. :(");
		}

		//Change Password
		$users = [];
		$users['password'] = bcrypt($request->get('password1'));
		User::where('email', $request->email)->update($users);

		return redirect()->back()->with("success", "Password changed successfully !");

	}

	public function forgotPassword() {
		return view('forgot_password');
	}

}