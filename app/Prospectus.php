<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospectus extends Model
{
     public function category(){
    	return $this->belongsTo('App\Category');
    }
    public function course(){
    	return $this->belongsTo('App\Course');
    }
}
