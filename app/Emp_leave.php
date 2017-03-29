<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_leave extends Model
{
	protected $fillable=['employee_id','from_date', 'to_date', 'leave_type','no_of_days', 'ground', 'status', 'comment', 'authority', 'view',];

    public function employee(){
    	return $this->belongsTo('App\Employee'); 
    }
}