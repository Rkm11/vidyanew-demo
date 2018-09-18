<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 17:13:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Question
 *
 * @property int id
 * @property string $question_name
 *
 * @package App\Models
 */
class Question extends Eloquent {
	protected $table = 'questions';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'question_name',
	];
}
