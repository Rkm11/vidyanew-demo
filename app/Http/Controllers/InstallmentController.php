<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Installment;
use App\Models\Student;
use DataTables;
use DB;
use Illuminate\Http\Request;

class InstallmentController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;
	protected $pre = 'install_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		// dd($r);
		date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
		$data = [];
		$n = $this->changeKeys($this->pre, $r->all());
		$ins = Installment::where('install_student', $n['install_student'])->get();
		// dd($n);
		$count = (count($ins) + 1);
		// return $n;
		$n['install_sequence'] = $count;
		if (Installment::create($n)) {
			$in = Installment::where('install_student', $n['install_student'])->get();

			$data['s'] = $in;
			$data['msg'] = 'success';
			return $data;
		} else {
			return 'error';
		}
	}

	public function data(Request $r) {
		$ins = Installment::where('install_student', $r->student)->get();
		// pr($ins);die;
		return DataTables::of($ins)->make(true);
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$users = DB::table('installments')
			->join('students', 'installments.install_student', '=', 'students.stu_id')
			->where('installments.install_student', '=', $id)
			->orderBy('installments.install_created_at', 'desc')
			->first();
		// return $users;
		return view('create_installment')->with(['stu' => Student::find($id)])->with('stud', $users);
		//return view('create_installment')->with(['stu' => Student::find($id)]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update($id) {
		return view('create_installment')->with(['stu' => Student::find($id)]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
