<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Attendance;
use App\Models\Certification;
use App\Models\Standard;
use App\Models\Student;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;

class CertificationController extends Controller {
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

		$stu = [];

		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
			->get();
		foreach ($stu as $key => $data) {
			$subjects = $data->ad_subjects;
			$arrSubjects = explode(',', $subjects);
			$courses = Standard::whereIn('std_id', $arrSubjects)->get();
			$stu[$key]->courses = !empty($courses) ? $courses : null;

		}
		// dd($stu);
		return view('view_certification', compact('stu'));
	}

	public function filteredData(Request $r) {
		$stu = [];

		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		if ($r->standard) {
			if ($r->standard != '-1') {
				$sub = $r->standard;
				// dd($med);
				$stu->whereRaw("find_in_set($sub,admission_details.ad_subjects)");
			}
		}
		if ($r->medium) {
			if ($r->medium != '-1') {
				$stu->where('admission_details.ad_medium', $r->medium);
			}
		}
		$stu = $stu->get();
		foreach ($stu as $key => $data) {
			$subjects = $data->ad_subjects;
			$arrSubjects = explode(',', $subjects);
			$courses = Standard::whereIn('std_id', $arrSubjects)->get();
			$stu[$key]->courses = !empty($courses) ? $courses : null;

		}

		return view('view_fitered_certification', compact('stu'));
	}

	public function data(Request $r) {
		$courses = Certification::select(['*'])->where('cer_cid', $r->cer_cid)
			->where('cer_sid', $r->cer_sid)->first();
		// dd($courses);
		if (!empty($courses)) {
			$cer_issued = (1 == $courses->cer_issued) ? 0 : 1;
			if (Certification::where('cer_cid', $r->cer_cid)
				->where('cer_sid', $r->cer_sid)->update(['cer_issued' => $cer_issued])) {
				return 'successU';
			} else {
				return 'error';
			}
		}
		// dd($stu);
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
		return view('certification_details', compact('certification_details'));
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
			$stu->where('attendances.att_added', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		if (empty($r->startDate) && $r->endDate) {
			$stu->where('attendances.att_added', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		// $stu = $stu->get();
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

	public function generateReport(Request $r) {
		$stu = Attendance::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('students', 'students.stu_id', '=', 'attendances.att_student')->join('subjects', 'subjects.sub_id', '=', 'attendances.att_subject');
		// $stu = Student::join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
		// dd($r->all());
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
			$stu->where('attendances.att_added', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		if (empty($r->startDate) && $r->endDate) {
			$stu->where('attendances.att_added', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		$stu = $stu->get();
		$arrStu = [];
		$arrColumns = array('Full Name');
		foreach ($stu as $key => $value) {
			$stu_id = $value->stu_id;
			$date = date('d', strtotime($value->att_added));
			$arrStu[$stu_id]['Full Name'] = $value->stu_first_name . ' ' . $value->stu_last_name;
			$arrStu[$stu_id][$date] = ($value->att_result) ? 'P' : 'A';
			array_push($arrColumns, $date);
		}
		$arrColumns = array_unique($arrColumns);
		$temp = $arrStu;
		$arrStu = [];
		foreach ($temp as $value) {
		}

		$arrStu = (array) $arrStu;
		if (empty($arrStu)) {
			$arrColumns = array();
		}
		// return view('reports.attendance', compact('arrStu', 'arrColumns'), compact('arrStu'));
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

	public function print($id) {
		$stu = [];

		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
			->where('students.stu_id', $id)
			->get();
		foreach ($stu as $key => $data) {
			$subjects = $data->ad_subjects;
			$arrSubjects = explode(',', $subjects);
			$courses = Standard::whereIn('std_id', $arrSubjects)->get();
			$stu[$key]->courses = !empty($courses) ? $courses : null;

		}
		$i = $stu[0];
		// dd($i);
		// return view('reports.certification', compact('i'));
		$pdf = PDF::loadView('reports.certification', compact('i'))->setPaper('a4')->setWarnings(false);
		$pdf_name = 'Certification-' . date('Y-m-d h:i:s') . '.pdf';
		return $pdf->download($pdf_name);
	}
	public function printAll(Request $r) {
		$stu = [];

		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');
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
		$stu = $stu->get();
		foreach ($stu as $key => $data) {
			$subjects = $data->ad_subjects;
			$arrSubjects = explode(',', $subjects);
			$courses = Standard::whereIn('std_id', $arrSubjects)->get();
			$stu[$key]->courses = !empty($courses) ? $courses : null;

		}
		$students = $stu;
		// foreach ($students as $i) {
		// 	dd($i->stu_middle_name);
		// }
		// die;
		// return view('reports.certification-all-student', compact('students'));
		$pdf = PDF::loadView('reports.certification-all-student', compact('students'))->setPaper('a4')->setWarnings(false);
		$pdf_name = 'Certification-' . date('Y-m-d h:i:s') . '.pdf';
		return $pdf->download($pdf_name);
	}
}
