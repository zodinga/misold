<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=[ 
    'name','doj', 'updated_at', 'title', 'Sname', 'Fname', 'Mname', 'gender', 'f_name', 'm_name', 'addressline1', 'addressline2', 'postalcode',
    'city', 'state', 'community_id', 'category_id', 'dob', 'pan', 'stdcode', 'landline', 'mobile', 'email', 'fax', 'designation', 'appointment', 'gros_pay',
    'appointment_type', 'faculty_type', 'payscale', 'programme', 'course', 'salarymode', 'pf_number', 'payband', 'ug_degree', 'other_qualification',
    'specialization', 'teaching_exp', 'eid',
    ];

    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function course(){
    	return $this->belongsTo('App\Course');
    }

    public function community(){
    	return $this->belongsTo('App\Community');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }

    public function subjects(){
        return $this->belongsToMany('App\Subject')->orderBy('semester');
    }

    public function registrations(){
        return $this->hasMany('App\Registration')->orderBy('semester','DESC');
    }
    
    public function documents(){
        return $this->hasMany('App\Emp_Doc');
    }

    public function leaves(){
        return $this->hasMany('App\Emp_leave');
    }

    public function outpass(){
        return $this->hasMany('App\Emp_outpass');
    }
}
