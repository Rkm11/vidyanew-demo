<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\AdmissionDetail;
use App\Models\Marksheet;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Test;
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
		$stu = Test::select('test_subjects')
		// ->groupBy('stu_name')
			->get();
		$total_test = count($stu);
		// dd($total_test);
		return view('single_subject_marksheet', compact('total_test'));
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
		if ($r->total > $r->outtmark) {
			return 'outbound';
		}
		// dd($r->all());
		$objMarks = Marksheet::where('mark_student', $r->student)->where('mark_testid', $r->testid)->first();
		$tests = [];
		if (!empty($objMarks)) {
			$d = $this->changeKeys($this->pre, $r->all());
			// dd($objMarks);
			// dd($d);
			// $d['mark_test_' . $d['mark_test']] = $d['mark_result'];
			// $total = $d['mark_total'];
			// $d['mark_total'] = $total;
			Marksheet::where('mark_student', $r->student)->where('mark_testid', $r->testid)->where('mark_subject', $r->subject)->update(['mark_total' => $d['mark_total']]);
			return 'Success';

		} else {
			$d = $this->changeKeys($this->pre, $r->all());
			return Marksheet::create($d) ? 'success' : 'error';
		}
	}

	public function data(Request $r) {
		$stu = Student::select(['students.stu_id', 'mark_total', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->Join('marksheets', 'marksheets.mark_student', '=', 'students.stu_id');
		if ($r->subject) {
			if ($r->subject != '-1') {
				$stu->where('marksheets.mark_subject', $r->subject);
			}
		}
		if ($r->test_id != '') {
			$stu->where('marksheets.mark_testid', $r->test_id);
		}
		$stu->get();
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
		$stu = Student::select(['students.stu_id', 'tests.test_name', 'marksheets.mark_total', 'subjects.sub_name', 'admission_details.ad_subjects', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
			->leftJoin('tests', 'tests.test_standard', '=', 'admission_details.ad_standard')
			->leftJoin('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->leftJoin('marksheets', 'marksheets.mark_student', '=', 'students.stu_id')
			->leftJoin('subjects', 'subjects.sub_id', '=', 'marksheets.mark_subject');
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
		if ($r->test_name) {
			if ($r->test_name != '-1') {
				$stu->where('tests.id', $r->test_name);
			}
		}
		$stu->groupBy('stu_id');
		$stu->groupBy('stu_name');
		$stu->groupBy('subjects.sub_name');
		$stu->groupBy('students.stu_id');
		$stu->groupBy('marksheets.mark_total');
		$stu->groupBy('admission_details.ad_subjects');
		$stu->groupBy('tests.test_name');
		$stu->get();

		return DataTables::of($stu)->make(true);
		// // dd($stu->get());
		// $subjects = array();
		// if (!empty($stu)) {
		// 	foreach ($stu->get() as $key => $value) {
		// 		$arrSubjects = explode(',', $value->ad_subjects);
		// 		foreach ($arrSubjects as $sub) {
		// 			$subjects[] = $sub;
		// 		}
		// 	}
		// 	$subjects = array_unique($subjects);
		// 	$subjects = Subject::select(['sub_name'])->whereIn('sub_id', $subjects)->get();
		// }
		// $studentArray = array();
		// $studentArray[] = array('title' => 'Studnet Name');
		// foreach ($subjects as $key => $value) {
		// 	$studentArray[$key + 1]['title'] = $value->sub_name;
		// }

		// // $records = DataTables::of($stu)->make(true);
		// $records = array();
		// foreach ($stu->get() as $stuKey => $value) {
		// 	$records[$stuKey][] = $value->stu_name;
		// 	$marksheet = Marksheet::where('mark_student', $value->stu_id)
		// 		->Join('tests', 'tests.id', '=', 'marksheets.mark_testid')
		// 	// ->Join('subjects', 'subjects.sub_id', '=', 'tests.test_subject')
		// 	// ->orderBy('tests.test_subject')
		// 		->get();
		// 	$i = 0;
		// 	foreach ($marksheet as $markKey => $marks) {
		// 		// if($marks->mark_testid)
		// 		$records[$stuKey][] = $marks->mark_total;
		// 	}

		// }
		// // $records = array();
		// if (empty($records)) {
		// 	$studentArray = array();
		// 	$studentArray[] = array('title' => 'Studnet Name');
		// 	$records[] = array(0 => '-');
		// 	// foreach ($studentArray as $key => $value) {
		// 	// 	// dd($value['title']);
		// 	// 	$records[0][] = array('-');
		// 	// }
		// }
		// dd($marksheet);
		// dd($records);
		// $records = array();
		// foreach ($stu->get() as $key => $value) {
		// 	$records[$key]['stu_name'] = $value['stu_name'];
		// 	$records[$key]['stu_name'] = $value['stu_name'];
		// }
		$columns = array(array('Student Name'), array('Subject'), array('Test Name'), array('Marks'));
		$records = array();
		$records[0] = array('Rupesh', 'Englis', 'Xyz', '100');
		$records[1] = array('Rupesh', 'Englis', 'Xyz', '100');

		return array('records' => json_encode($records), 'columns' => json_encode($columns));
		// return $records;
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
	public function allPDF(Request $r) {
		$i = AdmissionDetail::with('student')
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->leftJoin('tests', 'tests.test_standard', '=', 'admission_details.ad_standard')
			->leftJoin('batches', 'batches.batch_id', '=', 'admission_details.ad_batch')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium');

		$subjects = Marksheet::select(['subjects.sub_name'])
			->join('tests', 'tests.id', '=', 'marksheets.mark_testid')
			->join('subjects', 'subjects.sub_id', '=', 'marksheets.mark_subject');
		$marks = Marksheet::select(['students.stu_id', 'marksheets.mark_total', 'subjects.sub_name', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('tests', 'tests.id', '=', 'marksheets.mark_testid')
			->join('students', 'students.stu_id', '=', 'marksheets.mark_student')
			->join('subjects', 'subjects.sub_id', '=', 'marksheets.mark_subject');
		$marks->groupBy('students.stu_id');
		$marks->groupBy('stu_name');
		$marks->groupBy('subjects.sub_name');
		$marks->groupBy('marksheets.mark_total');
		$marks->groupBy('tests.test_name');

		if ($r->batch) {
			if ($r->batch != '-1') {
				$i->where('admission_details.ad_batch', $r->batch);
				$subjects->where('tests.test_batch', $r->batch);
				$marks->where('tests.test_batch', $r->batch);
			}
		}
		if ($r->standard) {
			if ($r->standard != '-1') {
				$i->where('admission_details.ad_standard', $r->standard);
				$subjects->where('tests.test_standard', $r->standard);
				$marks->where('tests.test_standard', $r->standard);
			}
		}
		if ($r->medium) {
			if ($r->medium != '-1') {
				$i->where('admission_details.ad_medium', $r->medium);
				$subjects->where('tests.test_medium', $r->batch);
				$marks->where('tests.test_medium', $r->batch);
			}
		}
		if ($r->test_name) {
			if ($r->test_name != '-1') {
				$i->where('tests.id', $r->test_name);
				$subjects->where('tests.id', $r->test_name);
				$marks->where('tests.id', $r->test_name);
			}
		}
		$subjects->groupBy('subjects.sub_name');
		$i = $i->get();
		$subjects = $subjects->get();
		$marks = $marks->get();
		$temp = [];
		$temp = $marks;
		$marks = array();
		$marks['Subjects'] = array();
		$count = 0;
		foreach ($temp as $key => $value) {
			if (!in_array($value->sub_name, $marks['Subjects'])) {
				// $marks['Subjects'][] = $value->sub_name;
			}
			$marks[$value->stu_name]['stu_name'] = $value->stu_name;
			$marks[$value->stu_name]['subjects'][] = $value->mark_total;
			$count++;
		}
		$newArr = array();
		$count = 0;
		foreach ($marks as $key => $mark) {
			if ('Subjects' == $key) {
				continue;
			}
			if (array_key_exists('stu_name', $mark)) {
				$newArr[$count][] = $key;
				foreach ($mark['subjects'] as $Markkeys => $value) {
					$newArr[$count][] = $value;
				}
				// dd($mark);
			}
			$count++;
		}
		$marks = array();
		$marks = $newArr;
		// foreach ($marks as $key => $mark) {
		// 	foreach ($mark as $key => $value) {
		// 		echo $value;
		// 	}
		// 	// print_r($mark);
		// }
		// die;
		// dd($newArr);

		// ->where('ad_student', $id)
		// ->first();
		// return view('reports.single-marksheet', compact('i', 'subjects', 'marks'));
		$pdf = PDF::loadView('reports.single-marksheet', compact('i', 'subjects', 'marks'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('Marksheet.pdf');
		// return $pdf->download($m->stu_first_name . '-' . $m->stu_last_name . '-Marksheet.pdf');
	}
	public function downloadPDF($id) {
		$i = AdmissionDetail::with('student')
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')->where('ad_student', $id)
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
			->first();
		$marks = [];
		$arrSubjects = explode(',', $i->ad_subjects);
		$objMarksheets = Marksheet::join('tests', 'tests.id', '=', 'marksheets.mark_testid')
			->join('students', 'students.stu_id', '=', 'marksheets.mark_student')
			->join('admission_details', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
			->where('mark_student', $id)
			->get();
		$objTest = Test::select(['id'])->get();
		foreach ($objTest as $key => $value) {
			$testids[] = $value->id;
		}
		foreach ($objMarksheets as $key => $marksheet) {
			if (in_array($marksheet->mark_testid, $testids)) {
				$subject = Subject::where('sub_id', $marksheet->mark_subject)->first();
				$objMarksheets[$key]->sub_name = $subject->sub_name;
				$marks[$marksheet->test_name][] = $objMarksheets[$key];
			}

		}
		// dd($marks);
		// dd($objMarksheets);
		// foreach ($arrSubjects as $sub) {
		// 	$marksheet = Marksheet::join('tests', 'tests.id', '=', 'marksheets.mark_testid')
		// 		->join('students', 'students.stu_id', '=', 'marksheets.mark_student')
		// 		->join('admission_details', 'students.stu_id', '=', 'admission_details.ad_student')
		// 		->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
		// 		->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
		// 	// ->join('subjects', 'subjects.sub_id', '=', 'tests.test_subject')
		// 		->where('mark_student', $id)
		// 		->whereIn('test_subject', $sub)->get();
		// 	// print_r($marksheet);
		// 	if (!empty($marksheet)) {
		// 		$marks[$sub]['sub_name'] = (isset($marksheet[0]['sub_name'])) ? $marksheet[0]['sub_name'] : '';
		// 		$marks[$sub]['marks'] = $marksheet;
		// 	}
		// }
		// dd($objMarksheets);
		// return view('reports.marksheet', compact('i', 'marks'));
		$pdf = PDF::loadView('reports.marksheet', compact('i', 'marks'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('marksheet.pdf');

		// return $pdf->download('admission.pdf');
		// return view('view_admissions');
	}

	public function viewMarksheet($id) {
		$i = AdmissionDetail::with('student')
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')->where('ad_student', $id)
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
			->first();
		$marks = [];
		$arrSubjects = explode(',', $i->ad_subjects);
		$objMarksheets = Marksheet::join('tests', 'tests.id', '=', 'marksheets.mark_testid')
			->join('students', 'students.stu_id', '=', 'marksheets.mark_student')
			->join('admission_details', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('mediums', 'mediums.med_id', '=', 'admission_details.ad_medium')
		// ->join('subjects', 'subjects.sub_id', '=', 'tests.test_subject')
			->where('mark_student', $id)
		// ->whereIn('test_subjects', $arrSubjects)
			->get();
		$objTest = Test::select(['id'])->get();
		foreach ($objTest as $key => $value) {
			$testids[] = $value->id;
		}
		// dd($objMarksheets);
		foreach ($objMarksheets as $key => $marksheet) {
			// echo $marksheet;
			if (in_array($marksheet->mark_testid, $testids)) {
				$subject = Subject::where('sub_id', $marksheet->mark_subject)->first();
				$objMarksheets[$key]->sub_name = $subject->sub_name;
				$marks[$marksheet->test_name][] = $objMarksheets[$key];
			}

		}
		return view('reports.marksheet', compact('i', 'marks'));
	}
}
