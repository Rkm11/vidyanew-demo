<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\GetData;
use App\Models\Setting;
use Illuminate\Http\Request;

class ChangeSettingController extends Controller {
	use GetData;
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		$settings = Setting::first();
		return view('/changesetting', compact('settings'));
	}

	public function store(Request $r) {
		$set = Setting::find($r->id);
		if ($set) {
			$s = $this->changeKeys('set_', $r->all());
			// dd($s);
			Setting::where('set_id', $r->id)->update($s);
			return 'successU';
		} else {
			return 'error';
		}
	}

}