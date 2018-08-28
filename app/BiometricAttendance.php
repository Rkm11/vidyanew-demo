<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Attendance
 *
 * @property int $ba_id
 * @property int $ba_attendence
 * @property int $ba_date
 * @property int $ba_student
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class BiometricAttendance extends Eloquent {
	protected $primaryKey = 'ba_id';

	protected $casts = [
		'ba_attendane' => 'bool',
	];

	protected $fillable = [
		'ba_attendence',
		'ba_date',
		'ba_student',
	];
}