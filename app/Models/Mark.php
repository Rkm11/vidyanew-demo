<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
 

        protected $primaryKey = 'id';

     protected $casts = [
     	 
     	 'test_no' => 'int',
     	 'obt_marks' => 'int',
     	 'out_of_marks' => 'int'
     ];

     protected $fillable = [
     	 'test_no',
     	 'obt_marks',
     	 'out_of_marks',
     	 'test_date',
     	 
     ];

     public function test()
     {
     	return $this->belongsTo(\App\Models\Student::class, 'mark_test');
     }
}
