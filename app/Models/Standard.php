<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:23 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Standard
 * 
 * @property int $std_id
 * @property string $std_name
 *
 * @package App\Models
 */
class Standard extends Eloquent
{
	protected $primaryKey = 'std_id';
	public $timestamps = false;

	protected $fillable = [
		'std_name'
	];

	public function admission()
	{
		return $this->hasMany(\App\Models\AdmissionDetail::class, 'ad_standard');
	}

	public function subjects(){
		return $this->hasMany(App\Models\Subject::class,'sub_std');
	}
}
