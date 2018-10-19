<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Marksheet;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Timetable;
use DataTables;
use Illuminate\Http\Request;

class TimetableController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;
	protected $pre = 'timetable_';

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('view_tests');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('create_timetable');
	}

	public function data(Request $r) {
		// return $r->all();
		$timetable = Timetable::join('batches', 'batches.batch_id', '=', 'timetables.time_batch')
			->join('mediums', 'mediums.med_id', '=', 'timetables.time_medium')
			->join('standards', 'standards.std_id', '=', 'timetables.time_standard')
			->join('subjects', 'subjects.sub_id', '=', 'timetables.time_subject');
		// dd($r->batch);
		if ($r->batch) {
			// dd('11');
			if ($r->batch != '-1') {
				$timetable->where('timetables.time_batch', $r->batch);
			}
		}
		if ($r->standard) {
			if ($r->standard != '-1') {
				$timetable->where('timetables.time_standard', $r->standard);
			}
		}
		if ($r->medium) {
			if ($r->medium != '-1') {
				$timetable->where('timetables.time_medium', $r->medium);
			}
		}
		if ($r->subject) {
			if ($r->subject != '-1') {
				$timetable->where('timetables.time_subject', $r->subject);
			}
		}

		if ($r->startDate && $r->endDate) {
			$timetable->where('timetables.time_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
			$stu->where('timetables.time_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		if ($r->startDate && empty($r->endDate)) {
			$timetable->where('timetables.time_date', '>=', date('d-m-Y', strtotime($r->startDate)))->get();
		}
		if (empty($r->startDate) && $r->endDate) {
			$timetable->where('timetables.time_date', '<=', date('d-m-Y', strtotime($r->endDate)))->get();
		}
		$timetable->get();
		return DataTables::of($timetable)->make(true);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		$data = [];
		$data['msg'] = 'successU';
		$n = $r->all();
		// dd($n);
		$timetable = Timetable::where('time_batch', $n['batch'])
			->where('time_medium', $n['medium'])
			->where('time_subject', $n['subject'])
			->where('time_date', $n['date'])
			->where('time_standard', $n['standard'])
			->where('time_end', $n['end_time'])
			->where('time_start', $n['start_time'])
			->get();
		if (count($timetable) <= 0) {
			$ds['time_medium'] = $n['medium'];
			$ds['time_subject'] = $n['subject'];
			$ds['time_date'] = $n['date'];
			$ds['time_standard'] = $n['standard'];
			$ds['time_end'] = $n['end_time'];
			$ds['time_start'] = $n['start_time'];
			// dd($ds);
			TimeTable::create([
				'time_medium' => $n['medium'],
				'time_batch' => $n['batch'],
				'time_subject' => $n['subject'],
				'time_date' => $n['date'],
				'time_standard' => $n['standard'],
				'time_end' => $n['end_time'],
				'time_start' => $n['start_time'],
			]);
			return 'successU';
		} else {
			return 'existing';
		}

		if (!empty($r->test_id)) {
			$test = Test::where('id', $r->test_id)->first();
			if (!empty($test->id)) {
				if (!empty($n['test_subject'])) {
					$arrSelectedSubjects = $n['test_subject'];
					$n['test_subjects'] = implode(',', $arrSelectedSubjects);
				} else {

					return 'error';
				}

				$old_name = $test->name;
				$old_name = explode('-', $old_name);
				$testDetails['test_name'] = $n['test_name'] . '-' . strtotime(date('Y-m-d H:i:s'));
				$testDetails['test_date'] = $n['test_date'];
				$testDetails['test_outof'] = $n['test_outof'];
				$testDetails['test_batch'] = $n['test_batch'];
				$testDetails['test_medium'] = $n['test_medium'];
				$testDetails['test_standard'] = $n['test_standard'];
				$testDetails['test_subjects'] = $n['test_subjects'];

				return 'successU';
			} else {
				return 'error';
			}
		} else {
			$n['test_name'] = $n['test_name'] . '-' . strtotime(date('Y-m-d H:i:s'));
			$stu = Student::select(['students.stu_id', 'admission_details.ad_subjects'])
				->leftJoin('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
				->where('admission_details.ad_batch', $n['test_batch'])
				->where('admission_details.ad_standard', $n['test_standard'])
				->where('admission_details.ad_medium', $n['test_medium'])->get();
			if (!empty($n['test_subject'])) {
				$arrSelectedSubjects = $n['test_subject'];
				$n['test_subjects'] = implode(',', $arrSelectedSubjects);
			} else {

				return 'error';
			}
			$data = Test::create($n);
			foreach ($stu as $value) {
				// $subjects = explode(',', $value->ad_subjects);
				foreach ($arrSelectedSubjects as $subjects) {
					Marksheet::create([
						'mark_testid' => $data->id,
						'mark_student' => $value->stu_id,
						'mark_subject' => $subjects,
						'mark_total' => 0,
					]);
				}
			}
			if ($data->id) {
				$data['test'] = Test::all();
				return 'success';
			} else {
				return 'error';
			}
		}
		// dd($n);

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
		$test = Test::where('id', $id)->first();
		return view('edit_test')->with(['test' => $test]);
	}

	public function getData(Request $r) {
		$id = $r->id;
		$test = Test::select(['tests.id', 'tests.test_name', 'tests.test_date', 'tests.test_subjects', 'tests.test_outof', 'batch_name', 'med_name', 'std_name', 'batch_id', 'med_id', 'std_id'])
		// ->join('subjects', 'subjects.sub_id', '=', 'tests.test_subjects')
			->join('batches', 'batches.batch_id', '=', 'tests.test_batch')
			->join('mediums', 'mediums.med_id', '=', 'tests.test_medium')
			->join('standards', 'standards.std_id', '=', 'tests.test_standard')
			->where('tests.id', $id)->first();
		if (!empty($test)) {
			$subjects = explode(',', $test->test_subjects);
			$allSubjects = Subject::whereIN('sub_id', $subjects)->get();
			foreach ($allSubjects as $key => $value) {
				$test_subjects[] = $value->sub_name;
			}
			if (!empty($test_subjects)) {
				$test->test_subjects_name = $allSubjects;
			}
		}
		return $test;
	}

	public function testNameData(Request $r) {
		$standard = $r->standard;
		// $standard = 15;
		$test = Test::select(['tests.id', 'tests.test_name'])
			->where('tests.test_standard', $standard)->get();
		// foreach ($test as $key => $value) {
		// 	$test_name = explode('-', $value->test_name);
		// 	$test_name = $test_name[0];
		// 	$test{$key}->test_name = $test_name;
		// }
		return $test;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		dd($id);
		//
	}
	public function deleteData($id) {
		if (Marksheet::where('mark_testid', $id)->get()) {
			Marksheet::where('mark_testid', $id)->delete();
		}
		if (Test::where('id', $id)->get()) {
			Test::where('id', $id)->delete();
		}

		return redirect()->route('test.index');
	}
}
