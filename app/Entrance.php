<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    //
     public function course(){
    	return $this->belongsTo('App\Course');
    }


    protected $fillable=['id','appln_no','name','father','marks','course_id','session','remarks'];
}
