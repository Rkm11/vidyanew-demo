<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		if (Auth::user()->role == 3) {
			return view('front.dashboard');
		} else if (Auth::user()->role == 1) {
			return view('dashboard');
		}
	}
}
