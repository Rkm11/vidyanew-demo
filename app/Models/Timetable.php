<?php

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

class Timetable extends Eloquent {
	protected $primaryKey = 'id';

	protected $fillable = [
		'time_end',
		'time_start',
		'time_date',
		'time_subject',
		'time_batch',
		'time_medium',
		'time_standard',

	];

}
