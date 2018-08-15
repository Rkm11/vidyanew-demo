<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\Marksheet;
use App\Models\Student;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;
	protected $pre = 'test_';

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
		return view('create_test');
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

		if (!Test::where($this->pre . 'name', $r->name)->first()) {
			$n = $this->changeKeys($this->pre, $r->all());
			$n['test_name'] = $n['test_name'] . '-' . strtotime(date('Y-m-d H:i:s'));
			// dd($n);
			$stu = Student::select(['students.stu_id', 'admission_details.ad_subjects'])
				->leftJoin('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')
				->where('admission_details.ad_batch', $n['test_batch'])
				->where('admission_details.ad_standard', $n['test_standard'])
				->where('admission_details.ad_medium', $n['test_medium'])->get();
			$data = Test::create($n);
			foreach ($stu as $value) {
				$subjects = explode(',', $value->ad_subjects);
				if (in_array($n['test_subject'], $subjects)) {
					Marksheet::create([
						'mark_testid' => $data->id,
						'mark_student' => $value->stu_id,
						'mark_total' => 0,
					]);
				}
			}
			if ($data->id) {
				$data['test'] = Test::all();
				return $data;
			} else {
				return 'error';
			}
		} else {
			return 'exist';
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

	public function getData(Request $r) {
		$id = $r->id;
		$test = Test::select(['tests.id', 'tests.test_name', 'tests.test_date', 'tests.test_subject', 'tests.test_outof', 'subjects.sub_name', 'batch_name', 'med_name', 'std_name', 'batch_id', 'med_id', 'std_id'])
			->join('subjects', 'subjects.sub_id', '=', 'tests.test_subject')
			->join('batches', 'batches.batch_id', '=', 'tests.test_batch')
			->join('mediums', 'mediums.med_id', '=', 'tests.test_medium')
			->join('standards', 'standards.std_id', '=', 'tests.test_standard')
			->where('tests.id', $id)->get();
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
}
