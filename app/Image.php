<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Image
 * 
 * @property int $img_id
 * @property string $img_title
 * @property string $img_path
 * @property int $img_belongs_to
 *
 * @package App\Models
 */
class Image extends Eloquent
{
	protected $primaryKey = 'img_id';
	public $timestamps = false;

	protected $casts = [
		'img_belongs_to' => 'int'
	];

	protected $fillable = [
		'img_title',
		'img_path',
		'img_belongs_to'
	];
}
