<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\AdmissionDetail;
use App\Models\Enquiry;
use App\Models\Installment;
use App\Models\Invoice;
use App\Models\ParentDetail;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Telecalling;
use Auth;
use Charts;
use DataTables;
use DB;
use Illuminate\Http\Request;

class EnquiryController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;

	protected $pre = 'enq_';

	public function index() {
		return view('view_enquiries');
	}
	public function e_cout() {
		if (Auth::user()->role == 3) {
			return view('front.dashboard');
		} else if (Auth::user()->role == 1) {
			$ecout = Enquiry::join('admission_details', 'enquiries.enq_student', '=', 'admission_details.ad_student')
				->where('ad_status', '=', 0)->count();
			$acout = AdmissionDetail::where('ad_status', '=', 1)->count();
			$pcout = Payment::sum('pay_amount');
			$icout = Invoice::sum('in_paid_amount');
			$r_bal = $icout - $pcout;
			$tcout = Telecalling::count();

			$enquiry = Enquiry::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
			$admission = AdmissionDetail::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();

			// $chart = Charts::database($enquiry,'bar', 'highcharts')
			//                 ->colors(['#ff0000', '#00ff00', '#0000ff'])
			//                 ->title("Monthly Enquiry")
			//                 ->elementLabel("Total Enquiry")
			//                 ->dimensions(200,200)
			//                 ->responsive(true)
			//                 ->groupByMonth(date('Y'), true);

			$chart = Charts::multiDatabase('bar', 'material')
				->dataset('Enquiry', AdmissionDetail::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))
						->where('admission_details.ad_status', '=', 0)
						->get())

				->dataset('Admissions', AdmissionDetail::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))
						->where('admission_details.ad_status', '=', 1)
						->get())
				->colors(['#ff0000', '#00ff00', '#0000ff'])
				->title("Monthly Enquiry & Admissions")
			// ->dimensions(600,200)
				->responsive(true)
				->groupByMonth(date('Y'), true);

			$tomorrow = date('d-m-Y');
			$tomorrow = date('d-m-Y', strtotime($tomorrow . ' +1 day'));
			$installment_list = Installment::select(['students.stu_first_name', 'install_id', 'students.stu_last_name', 'stu_mobile', 'install_type',
				'install_due_date', 'install_amount', 'install_status', 'install_student'])
				->join('students', 'installments.install_student', '=', 'students.stu_id')
				->where('installments.install_due_date', '=', $tomorrow)
				->where('installments.install_status', '=', 0)
				->get();
			// dd($installment_list);
			return view('dashboard', compact('ecout', 'acout', 'pcout', 'tcout', 'r_bal', 'icout', 'chart', 'installment_list'));
		}

		// return view('dashboard')->with(compact('ecout','acout','pcout','tcout','r_bal','icout','chart','installment_list'));
	}

	public function data(Request $r) {
		$enq = Enquiry::select(['students.stu_id', 'students.stu_uid', 'students.stu_first_name', 'students.stu_last_name', 'students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'admission_details.ad_school', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id', 'admission_details.ad_fees', 'admission_details.ad_remaining_fees', 'enquiries.enq_id', 'enquiries.created_at', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_id', '=', 'enquiries.enq_admission')
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')
			->orderBy('enquiries.created_at', 'desc')
			->where('admission_details.ad_status', 0)
			->get();

		return DataTables::of($enq)->make(true);
	}

	public function stuData(Request $r) {
		$enq = Enquiry::select(['students.stu_id', 'students.stu_uid', 'students.stu_first_name', 'students.stu_last_name', 'students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_first_name', 'parent_details.parent_mobile', 'admission_details.ad_school', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id', 'admission_details.ad_fees', 'admission_details.ad_remaining_fees', 'enquiries.enq_id', 'enquiries.created_at', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('admission_details', 'admission_details.ad_id', '=', 'enquiries.enq_admission')
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')
			->where('admission_details.ad_status', 1)
			->get();

		return DataTables::of($enq)->make(true);
	}

	public function create() {
		return view('create_enquiry');
	}

	public function store(Request $r) {
		$s = $r->all()['stu'];
		$p = $r->all()['p'];
		$ad = $r->all()['ad'];
		$p['parent_last_name'] = $s['last_name'];
		$parent = ParentDetail::create($this->changeKeys('parent_', $p))->parent_id;
		if ($parent) {
			$n = $this->changeKeys('stu_', $s);
			$n['stu_parent'] = $parent;
			$n['stu_uid'] = $this->autoId($ad['batch'], $ad['medium'], $ad['standard']);

			$student = Student::create($n)->stu_id;

			if ($student) {
				$d = $this->changeKeys('ad_', $ad);
				$d['ad_student'] = $student;
				$d['ad_status'] = 0;
				$d['ad_reffered_by'] = $ad['reffered_by'];
				$d['ad_preffered_batches'] = $ad['preffered_batches'];
				$d['ad_subjects'] = implode(',', $r->all()['subject']);
				$admi = AdmissionDetail::create($d)->ad_id;
				if ($admi) {
					return Enquiry::create([
						'enq_parent' => $parent,
						'enq_student' => $student,
						'enq_admission' => $admi,
					]) ? 'success' : 'error';
				}
			}
		}
		return 'error';

	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$en = Enquiry::join('admission_details', 'admission_details.ad_id', '=', 'enquiries.enq_admission')->join('students', 'students.stu_id', '=', 'admission_details.ad_student')->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')->where('enquiries.enq_id', $id)->first();
		return view('edit_enquiry')->with(['en' => $en]);
	}

	public function update(Request $r, $id) {
		$enq = Enquiry::find($id);

		$s = $r->all()['stu'];
		$ad = $r->all()['ad'];
		$p = $r->all()['p'];

		$adm = $this->changeKeys('ad_', $ad);
		if ($r->subject) {
			$adm['ad_subjects'] = implode(',', $r->all()['subject']);
		}
		$st = $this->changeKeys('stu_', $s);
		$par = $this->changeKeys('parent_', $p);
		Student::where('stu_id', $enq->enq_student)->update($st);
		ParentDetail::where('parent_id', $enq->enq_parent)->update($par);
		return (AdmissionDetail::where('ad_id', $enq->enq_admission)->update($adm)) ? 'successU' : 'error';
	}

	public function destroy($id) {
		//
	}
	public function addUserData(request $request) {
		$d['name'] = $request->uname;
		$d['email'] = $request->emailId;
		$d['role'] = 2;
		$d['question_id'] = 0;
		$d['password'] = bcrypt($request->pwd);
		$user = User::create($d);
		return redirect()->route('users.index');
	}

	public function updateUserData(request $request) {
		$id = $request->uid;
		$user = User::findOrFail($id);
		$d['name'] = $request->uname;
		$d['email'] = $request->emailId;
		if (!empty($request->pwd)) {
			$d['password'] = bcrypt($request->pwd);
		}
		$user->update($d);
		return redirect()->route('users.index');

	}

	public function deleteUser($id) {
		$user = User::findOrFail($id);
		$user->delete();

		return redirect()->route('users.index');
	}
}
