<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 24 Oct 2017 22:44:02 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BalanceSheet
 * 
 * @property int $bs_id
 * @property string $bs_particular
 * @property int $bs_debit
 * @property int $bs_credit
 * @property \Carbon\Carbon $bs_created_at
 *
 * @package App\Models
 */
class BalanceSheet extends Eloquent
{
	protected $primaryKey = 'bs_id';
	public $timestamps = false;

	protected $casts = [
		'bs_debit' => 'int',
		'bs_credit' => 'int'
	];

	protected $dates = [
		'bs_created_at'
	];

	protected $fillable = [
		'bs_particular',
		'bs_purpose',
		'bs_debit',
		'bs_credit',
		'bs_created_at'
	];
}
