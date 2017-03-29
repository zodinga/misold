<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emp_doc extends Model
{
	protected $fillable=['employee_id','doc_name','file_name'];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}