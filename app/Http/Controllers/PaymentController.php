<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetData;
use App\Models\BalanceSheet;
use App\Models\Installment;
use App\Models\Payment;
use App\Models\Student;
use Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	use GetData;
	protected $pre = 'pay_';

	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$last_pay = Payment::orderBy('pay_created_at', 'desc')->first();
		if (!empty($last_pay)) {
			$a = sprintf('%04d', $last_pay->pay_voucher + 1);
			return view('create_payment')->with(['payment_voucher' => $a]);
		} else {
			$a = sprintf('%04d', 1);
			return view('create_payment')->with(['payment_voucher' => $a]);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r) {
		$n = $this->changeKeys($this->pre, $r->all());
		BalanceSheet::create(['bs_particular' => $n['pay_first_name'] . ' ' . $n['pay_last_name'] . ' ( ' . $n['pay_voucher'] . ' )', 'bs_date' => $n['pay_add_date'], 'bs_purpose' => $n['pay_given_for'], 'bs_debit' => $n['pay_amount']]);
		return Payment::create($n) ? 'success' : 'error';
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

	public function fronPaymentdetails() {
		$emailID = Auth::user()->email;
		$invoice = Student::where('stu_email', $emailID)
			->join('admission_details', 'students.stu_id', '=', 'admission_details.ad_student')
			->first();
		$ins = Installment::where('install_student', $invoice->ad_student)->first();
		// $ins = Installment::where('install_student', $invoice->ad_student)->get();
		// dd($ins);
		return view('front.view_payments', compact('invoice', 'ins'));
	}
}
