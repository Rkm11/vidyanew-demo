<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;


/**
 * Class AdmissionDetail
 *
 * @property int $ad_id
 * @property int $ad_student
 * @property string $ad_batch_year
 * @property int $ad_batch
 * @property int $ad_school
 * @property int $ad_standard
 * @property int $ad_medium
 * @property string $ad_subjects
 * @property int $ad_fees
 * @property string $ad_pre_percent
 * @property bool $ad_status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class AdmissionDetail extends Eloquent {
	protected $primaryKey = 'ad_id';

	protected $casts = [
		'ad_student' => 'int',
		'ad_batch' => 'int',
		'ad_standard' => 'int',
		'ad_medium' => 'int',
		'ad_fees' => 'int',
		'ad_status' => 'bool',
	];

	protected $fillable = [
		'ad_student',
		'ad_batch_year',
		'ad_batch',
		'ad_school',
		'ad_date',
		'ad_standard',
		'ad_medium',
		'ad_subjects',
		'ad_fees',
		'ad_remaining_fees',
		'ad_pre_percent',
		'ad_reffered_by',
		'ad_preffered_batches',
		'ad_status',
	];

	public function student() {
		return $this->belongsTo(\App\Models\Student::class, 'ad_student');
	}

	public function batch() {
		return $this->belongsTo(\App\Models\Batch::class, 'ad_batch');
	}
	public function medium() {
		return $this->belongsTo(\App\Models\Medium::class, 'ad_medium');
	}
	public function standard() {
		return $this->belongsTo(\App\Models\Standard::class, 'ad_standard');
	}
	public function relatives() {
		return $this->hasMany(\App\Models\StudentRelative::class, 'sr_student');
	}
}
