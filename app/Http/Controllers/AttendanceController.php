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
		$stu = Attendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_id', '=', 'attendances.att_student')->join('subjects', 'subjects.sub_id', '=', 'attendances.att_subject');
		$arrStu = array();
		$stu = $stu->get();
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			// $arrStu[$stu_id] = $value;
		}

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
		// dd($r->batch);
		if ($r->batch) {
			// dd('11');
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

		if ($r->startDate && $r->endDate) {
			$stu->where('attendances.att_added', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
			$stu->where('attendances.att_added', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		if ($r->startDate && empty($r->endDate)) {
			$stu->where('attendances.att_added', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		$stu = $stu->get();

		$arrStu = [];
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			$date = date('d', strtotime($value->att_added));
			$arrStu[$stu_id]['Full Name'] = $value->stu_first_name . ' ' . $value->stu_last_name;
			$arrStu[$stu_id][$date] = ($value->att_result) ? 'P' : 'A';
		}

		$temp = $arrStu;
		$arrStu = [];
		foreach ($temp as $value) {
			$arrStu[] = $value;
		}

		$arrStu = (array) $arrStu;

		return json_encode($arrStu);
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
		$preAt = Attendance::where('att_added', '=', $r->added)->where('att_student', $r->student)->where('att_subject', $r->subject)->first();
		// dd($preAt);
		if (!$preAt) {
			$d = $this->changeKeys($this->pre, $r->all());
			return Attendance::create($d) ? 'success' : 'error';
		} else {
			if ($preAt->att_result != $r->result) {
				return Attendance::where('att_student', $r->student)->update(['att_result' => $r->result]) ? 'success' : 'error';
			}
		}
	}

	public function createReport() {
		$stu = Attendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_id', '=', 'attendances.att_student')->join('subjects', 'subjects.sub_id', '=', 'attendances.att_subject');
		$arrStu = array();
		$stu = $stu->get();
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			$arrStu[$stu_id] = $value;
		}
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			// dd($value->att_result);
			$arrStu[$stu_id][$value->att_added] = $value->att_result;
		}
		return view('reports.attendances', compact('i'));
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
