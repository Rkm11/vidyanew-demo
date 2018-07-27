<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;

	protected $pre = 'att_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('view_attendance');
	}

	public function data(Request $r) {
		// return $r;
		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		// ->join('attendances','attendances.att_student','=','admission_details.ad_student');
		if ($r->batch) {
			if ($r->batch != '-1') {
				$stu->where('admission_details.ad_batch', $r->batch);
			}
		}
		if ($r->standard) {
			if ($r->standard != '-1') {
				$stu->where('admission_details.ad_standard', $r->standard);
			}
		}
		if ($r->medium) {
			if ($r->medium != '-1') {
				$stu->where('admission_details.ad_medium', $r->medium);
			}
		}
		if ($r->subject) {
			if ($r->subject != '-1') {
				$stu->whereRaw('FIND_IN_SET(' . $r->subject . ',ad_subjects)');
			}
		}

		$stu->where('admission_details.ad_status', 1)->get();
		// ->where('att_added','=',$r->date)
		return DataTables::of($stu)->filterColumn('stu_name', function ($query, $keyword) {
			$query->whereRaw("CONCAT(students.stu_first_name, \" \" , students.stu_last_name) like ?", ["%{$keyword}%"]);
		})->make(true);
	}

	public function dataAttendance(Request $r) {
		$stu = Attendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_id', '=', 'attendances.att_student')->join('subjects', 'subjects.sub_id', '=', 'attendances.att_subject');
		// $stu = Student::join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		if ($r->batch) {
			if ($r->batch != '-1') {
				$stu->where('attendances.att_batch', $r->batch);
			}
		}
		if ($r->standard) {
			if ($r->standard != '-1') {
				$stu->where('attendances.att_standard', $r->standard);
			}
		}
		if ($r->medium) {
			if ($r->medium != '-1') {
				$stu->where('attendances.att_medium', $r->medium);
			}
		}
		if ($r->subject) {
			if ($r->subject != '-1') {
				$stu->where('attendances.att_subject', $r->subject);
			}
		}

		if ($r->searchbydate) {
			$stu->where('attendances.att_added', date('d-m-Y', strtotime($r->searchbydate)))->get();
		}
		$stu->toSql();

		return DataTables::of($stu)->filterColumn('stu_name', function ($query, $keyword) {
			$query->whereRaw("CONCAT(students.stu_first_name, \" \" , students.stu_last_name) like ?", ["%{$keyword}%"]);
		})->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('create_attendance');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		// return $r->all();
		$cur = Carbon::now()->format('d-m-Y');
		$preAt = Attendance::where('att_added', '=', $cur)->where('att_student', $r->student)->where('att_subject', $r->subject)->first();
		if (!$preAt) {
			$d = $this->changeKeys($this->pre, $r->all());
			return Attendance::create($d) ? 'success' : 'error';
		} else {
			if ($preAt->att_result != $r->result) {
				return Attendance::where('att_student', $r->student)->update(['att_result' => $r->result]) ? 'success' : 'error';
			}
		}
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

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
