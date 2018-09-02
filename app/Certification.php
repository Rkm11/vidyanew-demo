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
class Certification extends Eloquent {
	protected $table = 'certifications';
	protected $primaryKey = 'cer_id';
	public $timestamps = false;

	protected $fillable = [
		'cer_issued',
		'cer_sid',
		'cer_cid',
	];

}
