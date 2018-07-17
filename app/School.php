<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:23 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class School
 * 
 * @property int $school_id
 * @property string $school_name
 *
 * @package App\Models
 */
class School extends Eloquent
{
	protected $primaryKey = 'school_id';
	public $timestamps = false;

	protected $fillable = [
		'school_name'
	];
}
