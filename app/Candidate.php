<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    //
 	public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function course(){
    	return $this->belongsTo('App\Course');
    }

    public function community(){
    	return $this->belongsTo('App\Community');
    }
}
