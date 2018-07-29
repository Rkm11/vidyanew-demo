<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Marksheet;
use App\Models\Student;
use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;

class MarksheetController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;

	protected $pre = 'mark_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('single_subject_marksheet');
	}

	public function all() {
		return view('all_subject_marksheet');
	}
	// public function allStudent()
	// {
	//     return view('view_all_marksheet');
	// }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('create_marksheet');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {

		if ($r->result > $r->outtmark) {
			return 'outbound';
		}
		$cur = $r->date;
		$preAt = Marksheet::where('mark_added', '=', $cur)->where('mark_student', $r->student)->where('mark_subject', $r->subject)->first();
		$tests = [];

		if (!$preAt) {
			$d = $this->changeKeys($this->pre, $r->all());
			$d['mark_test_' . $d['mark_test']] = $d['mark_result'];
			$d['mark_added'] = $d['mark_date'];
			$total = $r->result;
			$d['mark_total'] = $total;

			return Marksheet::create($d) ? $total : 'error';
		} else {
			$m = [];
			for ($i = 1; $i < 19; $i++) {
				if ($r->test != $i) {
					$m[] = 'mark_test_' . $i;
				}
			}

			$e = implode(' + ', $m);

			$ptotal = Marksheet::select(DB::raw('SUM(' . $e . ') as total'))->where('mark_id', $preAt->mark_id)->first()->total;

			$total = $ptotal + $r->result;

			if ($preAt->att_result != $r->result) {
				return Marksheet::where('mark_student', $r->student)->where('mark_subject', $r->subject)->update(['mark_test_' . $r->test => $r->result, 'mark_total' => $total, 'outof_test_' . $r->test => $r->outtmark]) ? $total : 'error';
			}
		}
	}

	public function data(Request $r) {

		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')->join('marksheets', 'marksheets.mark_student', '=', 'students.stu_id')->join('subjects', 'subjects.sub_id', '=', 'marksheets.mark_subject');

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
				$stu->whereRaw('FIND_IN_SET(' . $r->subject . ',ad_subjects)')->where('marksheets.mark_subject', $r->subject);
			}
		}
		$stu->where('admission_details.ad_status', 1)->get();
		return DataTables::of($stu)->filterColumn('stu_name', function ($query, $keyword) {
			$query->whereRaw("CONCAT(students.stu_first_name, \" \" , students.stu_last_name) like ?", ["%{$keyword}%"]);
		})->make(true);
	}

	public function dataMarksheet(Request $r) {
		$stu = Marksheet::join('students', 'students.stu_id', '=', 'marksheets.mark_student')->join('subjects', 'subjects.sub_id', '=', 'marksheets.mark_subject')->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');

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
				$stu->where('marksheets.mark_subject', $r->subject);
			}
		}
		$stu->get();
		return DataTables::of($stu)->make(true);
	}

	public function allMarksheet(Request $r) {
		$stu = Student::select(['*', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])->join('marksheets', 'marksheets.mark_student', '=', ' students.stu_id')->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id');

		// $stu = Student::with('marksheets')->join('admission_details', 'admission_details.ad_student','=','students.stu_id');

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
		$stu->get();

		return DataTables::of($stu)->make(true);
	}

	public function getTestData(Request $r) {
		return Marksheet::with('subject')->where('mark_student', $r->id)->get();
	}

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
		//
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
	public function allPDF($id) {
		//exit();
		$m = Student::with('marksheets')->where('stu_id', $id)->first();
		$pdf = PDF::loadView('reports.single-marksheet1', compact('m'))->setPaper('a4')->setWarnings(false);
		return $pdf->download($m->stu_first_name . '-' . $m->stu_last_name . '-Marksheet.pdf');
	}
	public function downloadPDF($id) {

		//$i = AdmissionDetail::with('student')->where('ad_student',$id)->first();
		$i = Marksheet::join('subjects', 'marksheets.mark_subject', '=', 'subjects.sub_id')
			->join('students', 'students.stu_id', '=', 'marksheets.mark_student')
			->join('admission_details', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
			->where('mark_student', $id)->get();

		if ($i->isEmpty()) {
			// return false;
		}
		// dd($i);

		//return gettype($i[0]->subject);//->student->stu_alt_mobile;
		//return view('reports.marksheet', compact('i'));
		$pdf = PDF::loadView('reports.marksheet', compact('i'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('marksheet.pdf');

		// return $pdf->download('admission.pdf');
		// return view('view_admissions');
	}
}
