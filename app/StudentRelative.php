<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 25 Oct 2017 12:13:58 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StudentRelative
 * 
 * @property int $sr_id
 * @property string $sr_relation
 * @property string $sr_full_name
 * @property string $sr_education
 * @property int $sr_age
 * @property \Carbon\Carbon $sr_created_at
 *
 * @package App\Models
 */
class StudentRelative extends Eloquent
{
	protected $primaryKey = 'sr_id';
	public $timestamps = false;

	protected $casts = [
		'sr_age' => 'int'
	];

	protected $dates = [
		'sr_created_at'
	];

	protected $fillable = [
		'sr_relation',
		'sr_student',
		'sr_full_name',
		'sr_education',
		'sr_age',
		'sr_created_at'
	];
	public function admission()
	{
		return $this->belongsTo(\App\Models\StudentRelative::class, 'sr_student');
	}
}
