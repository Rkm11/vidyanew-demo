<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\AdmissionDetail;
use App\Models\Marksheet;
use App\Models\ParentDetail;
use App\Models\Student;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;

//ini_set('max_execution_time', 180);
class AdmissionController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;

	protected $pre = 'ad_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('view_admissions');
	}

	public function data(Request $r) {
		$enq = AdmissionDetail::select(['students.stu_id', 'students.stu_uid', 'students.stu_first_name', 'students.stu_last_name', 'students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id', 'admission_details.ad_school', 'admission_details.created_at',
			DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')
		// ->join('marksheets', 'marksheets.mark_student', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')
			->where('admission_details.ad_status', 1)
		// ->orderBy('created_at','desc')
			->get();

		return DataTables::of($enq)->make(true);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('create_admission');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		date_default_timezone_set('Asia/Calcutta');
		$data = ['msg' => 'success'];

		// return $data;
		$path = "images/";
		$new = uniqid() . ".jpeg";
		$s = $r->all()['stu'];
		$ad = $r->all()['ad'];
		$father_picture = '';
		$mother_picture = '';
		// return $r->all();
		if ($r->hasFile('father_img')) {
			$r->file('father_img')->move($path, 'f-' . $new);
			$father_picture = $path . 'f-' . $new;
			$this->resizeImage($father_picture);
		}
		if ($r->hasFile('student_img')) {
			$r->file('student_img')->move($path, 's-' . $new);
			$s['picture'] = $path . 's-' . $new;
			$this->resizeImage($s['picture']);
		}
		if ($r->hasFile('mother_img')) {
			$r->file('mother_img')->move($path, 'm-' . $new);
			$mother_picture = $path . 'm-' . $new;
			$this->resizeImage($mother_picture);
		}

		// return $r->all();
		// return $s;
		$cur = Carbon::now()->format('d-m-Y');
		// dd($cur);die;
		$parent = ParentDetail::create([
			'parent_first_name' => $s['middle_name'],
			'parent_last_name' => $s['last_name'],
			'parent_email' => '',
			'parent_mobile' => 0,
			'parent_alt_mobile' => 0,
			'parent_education' => '',
			'parent_father_picture' => $father_picture,
			'parent_mother_picture' => $mother_picture,
		])->parent_id;

		if ($parent) {
			$n = $this->changeKeys('stu_', $s);

			$n['stu_parent'] = $parent;
			if (isset($ad['batch'])) {
				$bat = $ad['batch'];
			}
			$n['stu_uid'] = $this->autoId($bat, $ad['medium'], $ad['standard']);
			$student = Student::create($n)->stu_id;
			if ($student) {
				$d = $this->changeKeys('ad_', $ad);
				$d['ad_student'] = $student;
				$d['ad_subjects'] = implode(',', $r->all()['subject']);
				$d['ad_status'] = 1;
				$d['ad_remaining_fees'] = $d['ad_fees'];
				$data['s'] = $student;
				$cur = Carbon::now()->format('d-m-Y');

				foreach ($r->all()['subject'] as $key => $value) {
					if (!Marksheet::where('mark_subject', $value)->where('mark_student', $student)->first()) {
						Marksheet::create([
							'mark_subject' => $value,
							'mark_student' => $student,
							'mark_added' => $cur,
						]);
					}
				}

				return AdmissionDetail::create($d) ? $data : 'error';
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

		$ad = AdmissionDetail::join('students', 'students.stu_id', '=', 'admission_details.ad_student')->find($id);
		return view('edit_admission')->with(['a' => $ad]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, $id) {
		$path = "images/";
		$new = uniqid() . ".jpeg";
		$s = $r->all()['stu'];
		$ad = $r->all()['ad'];
		$father_picture = '';
		$mother_picture = '';
		// return $r->all();
		if ($r->hasFile('father_img')) {
			$r->file('father_img')->move($path, 'f-' . $new);
			$father_picture = $path . 'f-' . $new;
			$this->resizeImage($father_picture);
		}
		if ($r->hasFile('student_img')) {
			$r->file('student_img')->move($path, 's-' . $new);
			$s['picture'] = $path . 's-' . $new;
			$this->resizeImage($s['picture']);
		}
		if ($r->hasFile('mother_img')) {
			$r->file('mother_img')->move($path, 'm-' . $new);
			$mother_picture = $path . 'm-' . $new;
			$this->resizeImage($mother_picture);
		}

		$adm = $this->changeKeys($this->pre, $ad);

		$adm['ad_subjects'] = implode(',', $r->all()['subject']);
		$adm['ad_status'] = 1;
		$adm['ad_remaining_fees'] = $adm['ad_fees'];
		$st = $this->changeKeys('stu_', $s);
		// $par = $this->changeKeys('parent_', $p);

		$student = AdmissionDetail::find($id)->ad_student;
		// return $r->all();
		dd($adm);
		if (AdmissionDetail::where('ad_id', $id)->update($adm)) {
			ParentDetail::where('parent_id', Student::find($student)->stu_parent)->update([
				'parent_first_name' => $st['stu_middle_name'],
				'parent_last_name' => $st['stu_last_name'],
				'parent_father_picture' => $father_picture,
				'parent_mother_picture' => $mother_picture,
			]);
			$cur = Carbon::now()->format('d-m-Y');

			foreach ($r->all()['subject'] as $key => $value) {
				if (!Marksheet::where('mark_subject', $value)->where('mark_student', $student)->first()) {
					Marksheet::create([
						'mark_subject' => $value,
						'mark_student' => $student,
						'mark_added' => $cur,
					]);
				}
			}
			return (Student::where('stu_id', $student)->update($st)) ? 'successU' : 'error';
		}

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

	public function downloadPDF($id) {

		$i = AdmissionDetail::with('student')->where('ad_student', $id)->first();

		// return view('reports.admission', compact('i'));
		$pdf = PDF::loadView('reports.admission', compact('i'))->setPaper('a4')->setWarnings(false);
		$pdf_name = 'admission-' . date('Y-m-d h:i:s') . '.pdf';
		return $pdf->download($pdf_name);

		// return $pdf->download('admission.pdf');
		// return view('view_admissions');
	}
}
