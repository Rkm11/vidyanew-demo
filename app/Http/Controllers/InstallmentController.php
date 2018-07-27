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
		date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
		$data = [];
		$n = $this->changeKeys($this->pre, $r->all());
		if (isset($n['install_installment_id'])) {
			Installment::where('install_id', $n['install_installment_id'])->update(['install_amount' => $n['install_amount'], 'install_due_date' => $n['install_due_date'], 'install_pdc_no' => $n['install_pdc_no'], 'install_pdc_date' => $n['install_pdc_date'], 'install_bank_name' => $n['install_bank_name']]);
			$data['msg'] = 'success';
			return $data;
		} else {
			$ins = Installment::where('install_student', $n['install_student'])->orderBy('install_id', 'DESC')->get();
			$count = (count($ins) + 1);
			$n['install_sequence'] = $count;
			if (Installment::create($n)) {
				$in = Installment::where('install_student', $n['install_student'])->get();

				$data['installment_count'] = $n['install_sequence'] + 1;
				$data['s'] = $in;
				$data['msg'] = 'success';
				return $data;
			} else {
				return 'error';
			}
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
		if (isset($_GET['install'])) {
			//edit Installment
			$users = DB::table('installments')
				->join('students', 'installments.install_student', '=', 'students.stu_id')
				->where('installments.install_student', '=', $id)
				->where('installments.install_id', '=', $_GET['install'])
				->orderBy('installments.install_id', 'desc')
				->first();
			return view('edit_installment')->with(['stu' => Student::find($id)])->with('stud', $users);
		} else {
			//create Installment
			$users = DB::table('installments')
				->join('students', 'installments.install_student', '=', 'students.stu_id')
				->where('installments.install_student', '=', $id)
				->orderBy('installments.install_id', 'desc')
				->first();
			return view('create_installment')->with(['stu' => Student::find($id)])->with('stud', $users);
		}
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
