<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\BiometricAttendance;
use App\Models\Student;
use DataTables;
use DB;
use Excel;
use Illuminate\Http\Request;
use PDF;

class BiometricController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;

	protected $pre = 'ba_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$stu = BiometricAttendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_bio_id', '=', 'biometric_attendances.ba_student');
		$arrStu = array();
		$stu = $stu->get();

		return view('view_biometric');
	}

	public function data(Request $r) {
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
		$stu = BiometricAttendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_bio_id', '=', 'biometric_attendances.ba_student')->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		// $stu = Student::join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		// dd($r->batch);
		if ($r->batch) {
			// dd('11');
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

		if ($r->startDate && $r->endDate) {
			$stu->where('biometric_attendances.ba_student.ba_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
			$stu->where('biometric_attendances.ba_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		if ($r->startDate && empty($r->endDate)) {
			$stu->where('biometric_attendances.ba_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		if (empty($r->startDate) && $r->endDate) {
			$stu->where('biometric_attendances.ba_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		// $stu = $stu->get();
		$arrStu = [];
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			$date = date('d', strtotime($value->ba_date));
			$arrStu[$stu_id]['Full Name'] = $value->stu_first_name . ' ' . $value->stu_last_name;
			$arrStu[$stu_id][$date] = ($value->att_result) ? 'P' : 'A';
		}
		$temp = $arrStu;
		$arrStu = [];
		foreach ($temp as $value) {
			$arrStu[] = $value;
		}

		$arrStu = (array) $arrStu;

		// return json_encode($arrStu);
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
		return view('create_biometric');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		$url = 'public/Employee_Punch_Monitor.xls';
		// dd(asset('public/Employee_Punch_Monitor.xls'));
		$reader = Excel::load($url, function ($reader) {})->get();
		$data = \Excel::load($url)->toArray();
		foreach ($data as $key => $value) {
			$preAt = BiometricAttendance::join('students', 'students.stu_bio_id', 'biometric_attendances.ba_student')->where('ba_date', "'" . $r->date . "'")->where('ba_student', "'" . trim($value['emp_code']) . "'")->first();
			if (!$preAt) {
				$d = $this->changeKeys($this->pre, $r->all());
				BiometricAttendance::create([
					'ba_attendence' => ($value['status'] != '' && $value['status'] == 'Present') ? 1 : 0, 'ba_date' => $r->date, 'ba_student' => trim($value['emp_code'])]) ? 'success' : 'error';
			} else {
				if ($preAt->att_result != $r->result) {
					BiometricAttendance::where('ba_student', "'" . trim($value['emp_code']) . "'")->update(['ba_attendence' => ($value['status'] != '' && $value['status'] == 'Present') ? 1 : 0]) ? 'success' : 'error';
				}
			}
		}
		return 'success';
	}

	public function generateReport(Request $r) {
		$stu = BiometricAttendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_bio_id', '=', 'biometric_attendances.ba_student')->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		if ($r->batch) {
			// dd('11');
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

		if ($r->startDate && $r->endDate) {
			$stu->where('biometric_attendances.ba_student.ba_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
			$stu->where('biometric_attendances.ba_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		if ($r->startDate && empty($r->endDate)) {
			$stu->where('biometric_attendances.ba_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		if (empty($r->startDate) && $r->endDate) {
			$stu->where('biometric_attendances.ba_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		$stu = $stu->get();
		$arrStu = [];
		$arrColumns = array('Full Name');
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			$date = date('d', strtotime($value->ba_date));
			$arrStu[$stu_id]['Full Name'] = $value->stu_first_name . ' ' . $value->stu_last_name;
			$arrStu[$stu_id][$date] = ($value->ba_attendence) ? 'P' : 'A';
			array_push($arrColumns, $date);
		}
		$arrColumns = array_unique($arrColumns);
		$temp = $arrStu;
		$arrStu = [];
		foreach ($temp as $value) {
			$arrStu[] = $value;
		}

		$arrStu = (array) $arrStu;
		if (empty($arrStu)) {
			$arrColumns = array();
		}
		return view('reports.attendance', compact('arrStu', 'arrColumns'));
		$pdf = PDF::loadView('reports.attendance', compact('arrStu', 'arrColumns'))->setPaper('a4', 'landscape')->setWarnings(false);
		$pdf_name = 'attendance-' . date('Y-m-d h:i:s') . '.pdf';
		return $pdf->download($pdf_name);
		// return json_encode($arrStu);
		// return view('reports.attendances', compact('i'));
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

	public function readExcel(Request $r) {

		$url = 'public/Employee_Punch_Monitor.xls';
		// dd(asset('public/Employee_Punch_Monitor.xls'));
		$reader = Excel::load($url, function ($reader) {})->get();
		$reader = \Excel::load($url)->toArray();
		dd($reader);
		return redirect()->back()->with('reader', $reader);
		$data = array(
			array("SNo." => 1, "Emp Code " => "T25", "" => null, "Name" => "1", "Last Punch" => "13:07", "" => null, "Direction" => null, "Punch Records" => "13:07,", "" => null, "Status" => "Present", "Date" => "20-Aug-2018"),
			array("SNo." => 2, "Emp Code " => "T30", "" => null, "Name" => "ajay", "Last Punch" => "", "" => null, "Direction" => null, "Punch Records" => "", "" => null, "Status" => "Not Present", "Date" => ""),
			array("SNo." => 3, "Emp Code " => "T35", "" => null, "Name" => "Test Employee 1", "Last Punch" => "", "" => null, "Direction" => null, "Punch Records" => "", "" => null, "Status" => "Not Present", "Date" => ""));
		$preAt = Attendance::join('students', 'students.stu_id', '=', 'attendances.att_student')->where('att_added', '=', $r->added)->where('att_student', $r->student)->where('att_subject', $r->subject)->first();
		// dd($preAt);
		if (!$preAt) {
			$d = $this->changeKeys($this->pre, $r->all());
			return Attendance::create($d) ? 'success' : 'error';
		} else {
			if ($preAt->att_result != $r->result) {
				return Attendance::where('att_student', $r->student)->update(['att_result' => $r->result]) ? 'success' : 'error';
			}
		}
		foreach ($data as $key => $value) {

		}

	}
}