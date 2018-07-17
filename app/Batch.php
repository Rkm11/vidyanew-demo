<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Batch
 * 
 * @property int $batch_id
 * @property string $batch_name
 *
 * @package App\Models
 */
class Batch extends Eloquent
{
	protected $primaryKey = 'batch_id';
	public $timestamps = false;

	protected $fillable = [
		'batch_name'
	];

	public function admission()
	{
		return $this->hasMany(\App\Models\AdmissionDetail::class, 'ad_batch');
	}
}
