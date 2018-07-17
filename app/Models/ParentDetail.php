<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ParentDetail
 * 
 * @property int $parent_id
 * @property string $parent_first_name
 * @property string $parent_last_name
 * @property string $parent_email
 * @property int $parent_mobile
 * @property int $parent_alt_mobile
 * @property string $parent_education
 * @property \Carbon\Carbon $parent_created_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $students
 *
 * @package App\Models
 */
class ParentDetail extends Eloquent
{
	protected $primaryKey = 'parent_id';
	public $timestamps = false;
	
	protected $dates = [
		'parent_created_at'
	];

	protected $fillable = [
		'parent_first_name',
		'parent_last_name',
		'parent_email',
		'parent_mobile',
		'parent_alt_mobile',
		'parent_education',
		'parent_created_at',
		'parent_father_picture',
		'parent_mother_picture'
	];

	public function students()
	{
		return $this->hasMany(\App\Models\Student::class, 'stu_parent');
	}
}
