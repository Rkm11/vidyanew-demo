<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model {
	protected $primaryKey = 'id';

	protected $casts = [

		'test_no' => 'int',
	];

	protected $fillable = [
		'test_no',
		'test_name',
		'test_date',
		'test_subjects',
		'test_student',
		'test_batch',
		'test_medium',
		'test_standard',
		'test_outof',

	];

	public function student() {
		return $this->belongsTo(\App\Models\Student::class, 'test_student');
	}
	public function mark() {
		return $this->hasOne(\App\Models\Test::class, 'test_mark');
	}
}
