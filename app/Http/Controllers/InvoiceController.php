<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\AdmissionDetail;
use App\Models\BalanceSheet;
use App\Models\Installment;
use App\Models\Invoice;
use App\Models\Student;
use DataTables;
use DB;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;
	protected $pre = 'in_';
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('view_invoices');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('create_invoice');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		$n = $this->changeKeys($this->pre, $r->all());
		if ($r->install) {
			$ins = Installment::where('install_id', $r->install)->first();
			$ad = AdmissionDetail::where('ad_student', $ins->install_student)->first();
			if ($ins->install_amount != $n['in_paid_amount']) {
				$remaining = $ins->install_amount - $n['in_paid_amount'];
				$p = $ins->install_sequence;
				$pre = Installment::where('install_sequence', $p)->first();
				$upTotal = $pre->install_amount + $remaining;
				$pre = Installment::where('install_sequence', $p)->update(['install_amount' => $upTotal]);
			}
			Installment::where('install_id', $r->install)->update(['install_amount' => $n['in_paid_amount'], 'install_status' => $r['install_status']]);
		}

		if (isset($ad) && !empty($ad->ad_remaining_fees)) {
			$total = $ad->ad_remaining_fees;
		} else {
			$total = $n['in_fees'];
		}
		if ($r['install_status'] != 0) {
			$remaining = $total - $n['in_paid_amount'];
			AdmissionDetail::where('ad_student', $n['in_student'])->update(['ad_remaining_fees' => $remaining]);
		}
		$stu = Student::find($n['in_student']);
		if ($r['formtype'] == 'payment') {
			BalanceSheet::create(['bs_particular' => $stu->stu_first_name . ' ' . $stu->stu_last_name . ' ( ' . $n['in_receipt_no'] . ' )', 'bs_date' => $n['in_add_date'], 'bs_purpose' => $n['in_type'], 'bs_credit' => $n['in_paid_amount']]);
		}
		$in = Invoice::create($n)->in_id;

		if ($r->install) {
			return Installment::where('install_id', $r->install)->update(['install_invoice' => $in]) ? 'success' : 'error';
		} else {
			return 'success';
		}
		return 'error';

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
	public function edit($id, Request $r) {
		// dd($r);
		// $last_in = Invoice::orderBy('in_created_at', 'desc')->first();
		// $a = sprintf('%04d',$last_in->in_receipt_no+1);

		$last_in = Invoice::orderBy('in_created_at', 'desc')->first();
		if (!empty($last_in)) {
			$a = sprintf('%04d', $last_in->in_receipt_no + 1);
		} else {
			$a = sprintf('%04d', 1);
		}

		$in = isset($r->install) ? Installment::find($r->install) : '';
		$input = $r->all();

		return view('create_invoice')->with(['stu' => Student::find($id), 'install' => $in, 'invoice_last' => $a]);

	}

	public function getAll() {
		return Invoice::all();
	}

	public function data(Request $r) {
		$ad = AdmissionDetail::select(['students.stu_id', 'students.stu_uid', 'students.stu_first_name', 'students.stu_last_name', 'students.stu_mobile', 'parent_details.parent_id', 'parent_details.parent_mobile', 'admission_details.ad_school', 'standards.std_name', 'admission_details.ad_status', 'admission_details.ad_id', 'admission_details.ad_fees', 'admission_details.ad_remaining_fees', 'admission_details.ad_status', 'admission_details.created_at', DB::raw('CONCAT(students.stu_first_name, " " , students.stu_last_name) AS stu_name')])
			->join('students', 'students.stu_id', '=', 'admission_details.ad_student')
			->join('standards', 'standards.std_id', '=', 'admission_details.ad_standard')
			->join('parent_details', 'parent_details.parent_id', '=', 'students.stu_parent')
			->where('admission_details.ad_status', 1)
			->get();

		return DataTables::of($ad)->make(true);
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

	// public function t(){
	//     $this->downloadReceipt($i->invoices()->first()->in_id);
	// }
	public function downloadPDF($id) {
		$invoice = Student::join('admission_details', 'admission_details.ad_student', '=', 'students.stu_id')->where('stu_id', $id)->first();
		// dd($invoice->invoices()->first());
		// $this->downloadReceipt($i->invoices()->first()->in_id);
		// return view('reports.invoice', compact('invoice'));
		//return $invoice;
		//return phpinfo();
		$pdf = PDF::loadView('reports.invoice', compact('invoice'))->setPaper('a4')->setWarnings(false);
		$pdf_date = 'Fee-Structure-' . date('d-m-Y h:i:s') . '.pdf';
		return $pdf->download($pdf_date);

	}

	public function downloadReceipt($id) {

		$invoice = Invoice::find($id);
		$pdf = PDF::loadView('reports.receipt', compact('invoice'))->setPaper('a4')->setWarnings(false);
		return $pdf->download('Reciept-' . date('d-m-Y h:i:s') . '.pdf');
	}
}
