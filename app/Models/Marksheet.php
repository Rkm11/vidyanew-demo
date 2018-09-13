<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Marksheet
 *
 * @property int $mark_id
 * @property int $mark_subject
 * @property int $mark_student
 * @property int $mark_test_1
 * @property int $mark_test_2
 * @property int $mark_test_3
 * @property int $mark_test_4
 * @property int $mark_test_5
 * @property int $mark_test_6
 * @property int $mark_test_7
 * @property int $mark_test_8
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Marksheet extends Eloquent {
	protected $primaryKey = 'mark_id';

	protected $casts = [
		'mark_student' => 'int',
		'mark_total' => 'int',
	];

	protected $fillable = [
		'mark_student',
		'mark_total',
		'mark_added',
		'mark_testid',
		'mark_subject',
	];

	public function student() {
		return $this->belongsTo(\App\Models\Student::class, 'mark_student');
	}

	public function subject() {
		return $this->belongsTo(\App\Models\Subject::class, 'mark_subject');
	}
}
