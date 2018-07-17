<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:23 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Subject
 * 
 * @property int $sub_id
 * @property string $sub_name
 *
 * @package App\Models
 */
class Subject extends Eloquent
{
	protected $primaryKey = 'sub_id';
	public $timestamps = false;

	protected $fillable = [
		'sub_name',
		'sub_std'
	];

	public function standard(){
		return $this->belongsTo(App\Models\Standard::class,'sub_std');
	}
}
