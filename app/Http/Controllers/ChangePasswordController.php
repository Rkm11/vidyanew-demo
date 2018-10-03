<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller {

	public function changepassword(Request $request) {

		if (!(Hash::check($request->get('password'), Auth::user()->password))) {
			// The passwords matches
			return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
		}

		if (strcmp($request->get('password'), $request->get('password1')) == 0) {
			//Current password and new password are same
			return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
		}

		$validatedData = $request->validate([
			'password' => 'required',
			'password1' => 'required|string|min:6|',
		]);
		if ($request["password1"] === $request["password_confirmation"]) {

		} else {
			die("New Password Can Not Match With Confirmed Password :(");
		}

		//Change Password
		$users = Auth::user();
		$users->password = bcrypt($request->get('password1'));
		$users->question_id = strtolower($request->get('question'));
		$users->answer = strtolower($request->get('answer'));
		$users->save();

		return redirect()->back()->with("success", "Password changed successfully !");

	}
	public function showchangepassword() {
		return view('/changepassword');
	}

	public function __construct() {
		$this->middleware('auth');
	}

	public function forgotPassword() {
		return view('forgot_password');
	}
	public function changePass() {
		return view('front.change_password');
	}
	public function FrontchangePass(Request $request) {
		if (!(Hash::check($request->get('currentPassword'), Auth::user()->password))) {
			// The passwords matches
			return 'Not Match';
		}
		$users = Auth::user();
		$users->password = bcrypt($request->get('password'));
		// $users->question_id = strtolower($request->get('question'));
		$users->question_id = 0;
		// $users->answer = strtolower($request->get('answer'));
		$users->save();
		return "success";

	}

}