<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //

         public function course(){
    	return $this->belongsTo('App\Course');
    }

    protected $fillable=['id','name','regn_no','course_id','semester','m1','m2','m3','m4','m5'];
}
