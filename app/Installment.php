<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Oct 2017 22:30:12 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Installment
 *
 * @property int $install_id
 * @property string $install_type
 * @property \Carbon\Carbon $install_due_date
 * @property int $install_amount
 * @property string $install_pdc_no
 * @property \Carbon\Carbon $install_pdc_date
 * @property string $install_bank_name
 * @property bool $install_status
 * @property \Carbon\Carbon $install_created_at
 *
 * @package App\Models
 */
class Installment extends Eloquent {
	protected $primaryKey = 'install_id';
	// public $timestamps = false;
	protected $dateFormat = 'd-m-Y';
	protected $casts = [
		'install_amount' => 'int',
		'install_student' => 'int',
		'install_status' => 'bool',
	];

	protected $dates = [
		// 'install_due_date',
		// 'install_pdc_date',
		'install_created_at',
	];

	protected $fillable = [
		'install_type',
		'install_student',
		'install_due_date',
		'install_amount',
		'install_pdc_no',
		'install_pdc_date',
		'install_bank_name',
		'install_status',
		'install_sequence',
		'install_invoice',
		'install_created_at',
	];

	public function student() {
		return $this->belongsTo(\App\Models\Student::class, 'install_student');
	}
	public function invoice() {
		return $this->belongsTo(\App\Models\Invoice::class, 'install_invoice');
	}
}
