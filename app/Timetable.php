<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model {
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
