<?php

namespace App\Http\Controllers\Ems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
use App\Student;
use App\Employee;
use App\Course;
use Session;
use Cache;

class PagesController extends Controller{

	public function getIndex(){
									
	}

	
	public function getDashboard()
	{
	  

		return view('ems.home.dashboard');
	}


}