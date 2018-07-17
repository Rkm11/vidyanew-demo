<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PreviousDetail
 * 
 * @property int $pd_id
 * @property int $pd_standard
 * @property int $pd_medium
 * @property string $pd_test
 *
 * @package App\Models
 */
class PreviousDetail extends Eloquent
{
	protected $primaryKey = 'pd_id';
	public $timestamps = false;

	protected $casts = [
		'pd_standard' => 'int',
		'pd_medium' => 'int'
	];

	protected $fillable = [
		'pd_standard',
		'pd_medium',
		'pd_test'
	];
}
