<?php

namespace App\Http\Controllers;

use App\Telecalling;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TelecallingController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		$telecall = DB::table('telecallings')
			->orderBy('id', 'desc')
			->paginate(10);
		// return view('index_telecalling',compact('telecall'));
		return view('view_telecalling', compact('telecall'));
	}
	public function getdata(Request $request) {
		$from = $request->input('fromdate');
		$to = $request->input('todate');

		if ($from >= $to) {

			return view('view_telecalling')->with('message', 'To date is greater than From date');
		}
		$telecall = DB::table('telecallings')
			->where('updated_at', '>=', $from)
			->where('updated_at', '<=', $to)
			->orderBy('id', 'desc')
			->paginate(10);
		// return view('index_telecalling',compact('telecall'));
		return view('view_telecalling', compact('telecall'));
	}
	public function getFollowdata(Request $request) {
		$id = $request->input('id');
		if ($id) {
			$followup = DB::table('telecallings')
				->where('followup_id', $id)->first();
		}
		return json_encode(array('follow1' => $followup->follow1, 'follow2' => $followup->follow2, 'follow3' => $followup->follow3, 'follow4' => $followup->follow4));
	}

	public function create() {
		return view('create_telecalling');
	}
	public function store(Request $req) {

		$telecall = new Telecalling;
		$telecall->student_name = $req->input('student_name');
		$telecall->mobile = $req->input('mobile');
		$telecall->follow1 = $req->input('follow1');
		$telecall->save();
		return redirect()->intended('/telecalling');
	}
	public function show(Request $r) {

		$enq = teleEnquiry::select(['telecalling.student_name', 'telecalling.mobile', 'telecalling.follow1', 'telecalling.follow2', 'telecalling.follow3', 'telecalling.follow4', 'telecalling.follow5'])
			->orderBy('telecalling.created_at', 'desc')
			->get();

		return DataTables::of($enq)->make(true);

	}

	public function edit($id) {
		$tcall = Telecalling::find($id);
		return view('edit_telecalling', compact('tcall'));
	}
	public function update(Request $req, $id) {

		$telecall = Telecalling::find($id);
		$telecall->student_name = $req->input('student_name');
		$telecall->mobile = $req->input('mobile');
		$telecall->follow1 = $req->input('follow1');
		if ($req->input('follow2') != null) {
			$telecall->follow2 = $req->input('follow2');
		}

		if ($req->input('follow3') != null) {
			$telecall->follow3 = $req->input('follow3');
		}

		if ($req->input('follow4') != null) {
			$telecall->follow4 = $req->input('follow4');
		}

		if ($req->input('follow5') != null) {
			$telecall->follow5 = $req->input('follow5');
		}

		$telecall->save();
		return redirect()->intended('/telecalling');
	}
	public function destroy($id) {
		$telecall = Telecalling::find($id);
		$telecall->delete();

		return redirect('/telecalling');
	}
	public function downloadPDF($id) {

		//$i = AdmissionDetail::with('student')->where('ad_student',$id)->first();
		// $i=  Marksheet::join('subjects',  'marksheets.mark_subject', '=', 'subjects.sub_id')->join('students', 'students.stu_id', '=', 'marksheets.mark_student')->join('admission_details','students.stu_id', '=', 'admission_details.ad_student')->where('mark_student',$id)->get();
		$i = Telecalling::find($id);
		// echo $telecall; exit();
		//return gettype($i[0]->subject);//->student->stu_alt_mobile;
		// return view('reports.marksheet');//, compact('i'));
		$pdf = PDF::loadView('reports.followup', compact('i'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('followup.pdf');

		// return $pdf->download('admission.pdf');
		// return view('view_admissions');
	}
	public function downloadAllPDF($id) {

		//$i = AdmissionDetail::with('student')->where('ad_student',$id)->first();
		echo "hello";exit();
		//return $i;//->student->stu_alt_mobile;
		//return view('reports.admission', compact('i'));
		$pdf = PDF::loadView('reports.admission', compact('i'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('admission.pdf');

		// return $pdf->download('admission.pdf');
		// return view('view_admissions');
	}

	public function checkEmailID(Request $r) {
		$emailId = $r->emailId;
		$email = User::where('email', $emailId)->first();
		if (!empty($email)) {
			return 'existEmail';
		}
		return 'new';
	}
}
