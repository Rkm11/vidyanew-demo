<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Invoice
 * 
 * @property int $in_id
 * @property string $in_type
 * @property \Carbon\Carbon $in_add_date
 * @property string $in_receipt_no
 * @property int $in_student
 * @property string $in_receiver_name
 * @property int $in_paid_amount
 * @property int $in_remaining_fees
 * @property string $in_payment_mode
 * @property string $in_cheque_number
 * @property \Carbon\Carbon $in_cheque_date
 * @property string $in_cheque_bank
 * @property string $in_account_type
 * @property string $in_admission_incharge
 * @property \Carbon\Carbon $in_created_at
 *
 * @package App\Models
 */
class Invoice extends Eloquent
{
	protected $primaryKey = 'in_id';
	public $timestamps = false;

	protected $casts = [
		'in_student' => 'int',
		'in_paid_amount' => 'int',
		'in_remaining_fees' => 'int'
	];

	protected $dates = [
		'in_add_date',
		'in_cheque_date',
		'in_created_at'
	];

	protected $fillable = [
		'in_type',
		'in_add_date',
		'in_receipt_no',
		'in_student',
		'in_receiver_name',
		'in_paid_amount',
		'in_remaining_fees',
		'in_payment_mode',
		'in_cheque_number',
		'in_dd_number',
		'in_cheque_date',
		'in_cheque_bank',
		'in_account_type',
		'in_admission_incharge',
		'in_created_at'
	];	

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class, 'in_student');
	}

	public function Installment()
	{
		return $this->hasMany(\App\Models\Installment::class, 'install_invoice');
	}	
}
