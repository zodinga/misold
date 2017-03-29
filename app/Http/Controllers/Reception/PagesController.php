<?php

namespace App\Http\Controllers\Reception;
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
		if(!Session::has('tot_prospectus'))
		{
		//first create array
		$totprospectus=array();

		for($i=2008,$j=0;$i<date("Y");$i++,$j++)
			{
			//mca 4,bca 3,dcse 5,dete 6
			$total=Prospectus::whereYear('receipt_date','=',$i)->count();
			$mca=Prospectus::whereYear('receipt_date','=',$i)->where('course_id','=',4)->count();
			$bca=Prospectus::whereYear('receipt_date','=',$i)->where('course_id','=',3)->count();
			$dcse=Prospectus::whereYear('receipt_date','=',$i)->where('course_id',5)->count();
			$dete=Prospectus::whereYear('receipt_date','=',$i)->where('course_id',6)->count();
			$others=$total-($mca+$bca+$dcse+$dete);

			//mca,bca,dcse,dete,others,total
			$totprospectus[$j]=array($i,$mca,$bca,$dcse,$dete,$others,$total);
			}
		 Session::put('tot_prospectus',$totprospectus);

		}
		else
		{
			$totprospectus=Session::get('tot_prospectus');
		}


		return view('reception.home.dashboard')->withProspectus($totprospectus);
	}

	public function getStudents($id)
	{
	

		//return view('students.index');
	}
}