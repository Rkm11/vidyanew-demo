<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 22:44:02 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Setting
 *
 * @property int $set_id
 * @property string $class_name
 * @property string $class_adderss
 * @property string $moblie1
 * @property string $moblie2
 * @property string $emailid
 * @property string $website
 *
 * @package App\Models
 */
class Setting extends Eloquent {
	protected $primaryKey = 'set_id';
	public $timestamps = false;

	protected $casts = [];

	protected $dates = [];

	protected $fillable = [
		'set_class_name',
		'set_class_address',
		'set_mobile1',
		'set_mobile2',
		'set_emailid',
		'set_website',
	];
}
