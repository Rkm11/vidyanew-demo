<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Medium
 * 
 * @property int $med_id
 * @property string $med_name
 *
 * @package App\Models
 */
class Medium extends Eloquent
{
	protected $table = 'mediums';
	protected $primaryKey = 'med_id';
	public $timestamps = false;

	protected $fillable = [
		'med_name'
	];

	public function admission()
	{
		return $this->hasMany(\App\Models\AdmissionDetail::class, 'ad_medium');
	}
}
