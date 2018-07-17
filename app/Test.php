<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
          protected $primaryKey = 'id';

     protected $casts = [
     	 
     	 'test_no' => 'int'
     ];

     protected $fillable = [
     	 'test_no'
     	 
     ];

     public function student()
     {
     	return $this->belongsTo(\App\Models\Student::class, 'test_student');
     }
     public function mark()
	{
		return $this->hasOne(\App\Models\Test::class, 'test_mark');
	}
}
