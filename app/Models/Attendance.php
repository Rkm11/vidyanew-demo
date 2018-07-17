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
 * @property int $att_id
 * @property int $att_batch
 * @property int $att_standard
 * @property int $att_medium
 * @property int $att_subject
 * @property int $att_student
 * @property bool $att_result
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Attendance extends Eloquent
{
	protected $primaryKey = 'att_id';

	protected $casts = [
		'att_batch' => 'int',
		'att_standard' => 'int',
		'att_medium' => 'int',
		'att_subject' => 'int',
		'att_student' => 'int',
		'att_result' => 'bool'
	];

	protected $fillable = [
		'att_batch',
		'att_standard',
		'att_medium',
		'att_subject',
		'att_student',
		'att_result',
		'att_added'
	];
}
