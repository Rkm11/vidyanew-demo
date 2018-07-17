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
		'mark_subject' => 'int',
		'mark_student' => 'int',
		'mark_test_1' => 'int',
		'mark_test_2' => 'int',
		'mark_test_3' => 'int',
		'mark_test_4' => 'int',
		'mark_test_5' => 'int',
		'mark_test_6' => 'int',
		'mark_test_7' => 'int',
		'mark_test_8' => 'int',
		'mark_test_9' => 'int',
		'mark_test_10' => 'int',
		'mark_test_11' => 'int',
		'mark_test_12' => 'int',
		'mark_test_13' => 'int',
		'mark_test_14' => 'int',
		'mark_test_15' => 'int',
		'mark_test_16' => 'int',
		'mark_test_17' => 'int',
		'mark_test_18' => 'int',
		'mark_test_19' => 'int',
		'mark_test_20' => 'int',
		'mark_total' => 'int',
	];

	protected $fillable = [
		'mark_subject',
		'mark_student',
		'mark_test_1',
		'mark_test_2',
		'mark_test_3',
		'mark_test_4',
		'mark_test_5',
		'mark_test_6',
		'mark_test_7',
		'mark_test_8',
		'mark_test_9',
		'mark_test_10',
		'mark_test_11',
		'mark_test_12',
		'mark_test_13',
		'mark_test_14',
		'mark_test_15',
		'mark_test_16',
		'mark_test_17',
		'mark_test_18',
		'mark_test_19',
		'mark_test_20',
		'mark_total',
		'mark_added',
	];

	public function student() {
		return $this->belongsTo(\App\Models\Student::class, 'mark_student');
	}

	public function subject() {
		return $this->belongsTo(\App\Models\Subject::class, 'mark_subject');
	}
}
