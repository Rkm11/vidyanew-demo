<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 22:44:02 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Payment
 * 
 * @property int $pay_id
 * @property string $pay_voucher
 * @property \Carbon\Carbon $pay_add_date
 * @property string $pay_first_name
 * @property string $pay_last_name
 * @property int $pay_amount
 * @property string $pay_given_for
 * @property string $pay_cheque_number
 * @property \Carbon\Carbon $pay_cheque_date
 * @property \Carbon\Carbon $pay_created_at
 *
 * @package App\Models
 */
class Payment extends Eloquent
{
	protected $primaryKey = 'pay_id';
	public $timestamps = false;

	protected $casts = [
		'pay_amount' => 'int'
	];

	protected $dates = [
		//'pay_add_date',
		//'pay_cheque_date',
		'pay_created_at'
	];

	protected $fillable = [
		'pay_voucher',
		'pay_add_date',
		'pay_first_name',
		'pay_last_name',
		'pay_amount',
		'pay_given_for',
		'pay_cheque_number',
		'pay_cheque_date',
		'pay_created_at'
	];
}
