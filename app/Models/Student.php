<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:23 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Student
 *
 * @property int $stu_id
 * @property string $stu_uid
 * @property string $stu_first_name
 * @property string $stu_middle_name
 * @property string $stu_last_name
 * @property string $stu_email
 * @property int $stu_mobile
 * @property int $stu_alt_mobile
 * @property int $stu_parent
 * @property \Carbon\Carbon $stu_dob
 * @property bool $stu_gender
 * @property string $stu_address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\Models\ParentDetail $parent_detail
 *
 * @package App\Models
 */
class Student extends Eloquent {
	protected $primaryKey = 'stu_id';

	protected $casts = [
		'stu_parent' => 'int',
		'stu_gender' => 'bool',
	];

	// protected $dates = [
	// 	'stu_dob',
	// ];

	protected $fillable = [
		'stu_uid',
		'stu_first_name',
		'stu_middle_name',
		'stu_last_name',
		'stu_email',
		'stu_mobile',
		'stu_bio_id',
		'stu_alt_mobile',
		'stu_parent',
		'stu_dob',
		'stu_gender',
		'stu_address',
		'stu_picture',
	];

	public function parent_detail() {
		return $this->belongsTo(\App\Models\ParentDetail::class, 'stu_parent');
	}

	public function marksheets() {
		return $this->hasMany(\App\Models\Marksheet::class, 'mark_student')->with('subject');
	}
	public function test() {
		return $this->hasMany(\App\Models\Test::class, 'test_student')->with('test_no');
	}

	public function admission() {
		return $this->hasOne(\App\Models\AdmissionDetail::class, 'ad_student');
	}

	public function invoices() {
		return $this->hasMany(\App\Models\Invoice::class, 'in_student');
	}

	public function installments() {
		return $this->hasMany(\App\Models\Installment::class, 'install_student');
	}

	public function recentInstallment() {
		return $this->hasMany(\App\Models\Installment::class, 'install_student')->where('install_status', 0);
	}
}
