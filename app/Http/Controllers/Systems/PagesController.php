<?php

namespace App\Http\Controllers\Systems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\Prospectus;
use App\Course;
use Session;
use Cache;

class PagesController extends Controller{

	public function getIndex(){
		

		//return view('pages.welcome');
									
	}

	
	public function getDashboard()
	{
		
		return view('systems.home.dashboard');
	}

	public function getStudents($id)
	{
	

		//return view('students.index');
	}
}