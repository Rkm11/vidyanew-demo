<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Enquiry
 * 
 * @property int $enq_id
 * @property int $enq_student
 * @property int $enq_parent
 * @property int $enq_admission
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Enquiry extends Eloquent
{
	protected $primaryKey = 'enq_id';

	protected $casts = [
		'enq_student' => 'int',
		'enq_parent' => 'int',
		'enq_admission' => 'int'
	];

	protected $fillable = [
		'enq_student',
		'enq_parent',
		'enq_admission'
	];
}
