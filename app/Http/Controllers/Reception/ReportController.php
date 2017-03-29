<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Course;
use App\Prospectus;
use App\Entrance;
use Session;
use Excel;

class ReportController extends Controller
{
    public function getProspectus(){
        $courses=Course::pluck('name','id');
        return view('reception.reports.prospectus')->withCourses($courses);
    }

    public function getCandidates(){
    	$courses=Course::pluck('name','id');
    	return view('reception.reports.candidates')->withCourses($courses);
    }


    public function getExportCandidates(Request $request){


         $entrances=Entrance::join('courses', 'entrances.course_id', '=', 'courses.id')
                  ->select('entrances.id','entrances.appln_no','entrances.name','entrances.father','entrances.marks','courses.name as course','entrances.session','entrances.remarks');

        $title="Candidate";
        if($request->has('course_id'))
            {
            $entrances=$entrances->where('course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
            }
        if($request->has('session'))
            {
            $entrances=$entrances->where('session','=',$request->session);
            $title=$title.$request->session." ";
            }   
        $entrances=$entrances->orderBy('entrances.id','desc')->get();



        Excel::create(''.$title,function($excel) use($entrances){
             $excel->setTitle('Entrance Result');
             $excel->setCreator('MIS')
              ->setCompany('NIELIT');


            $excel->sheet('Entrance',function($sheet) use($entrances){
                $sheet->fromArray($entrances);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->setBorder('A1:H1', 'thin');
            });
        })->export('xlsx');

         return back();
    }
   


       public function getExportProspectus(Request $request){
        //first create array
        $totprospectus=array();
        $total=0;
        $mca=0;
        $bca=0;
        $dcse=0;
        $dete=0;
        $others=0;

        $totprospectus[0]=array('Year','MCA','BCA','DCSE','DETE','OTHERS','TOTAL');
        if($request->has('year'))
        {
            $i=$request->year;
            $j=1;
            $total=Prospectus::whereYear('receipt_date','=',$i)->count();
            $mca=Prospectus::whereYear('receipt_date','=',$i)->where('course_id','=',4)->count();
            $bca=Prospectus::whereYear('receipt_date','=',$i)->where('course_id','=',3)->count();
            $dcse=Prospectus::whereYear('receipt_date','=',$i)->where('course_id',5)->count();
            $dete=Prospectus::whereYear('receipt_date','=',$i)->where('course_id',6)->count();
            $others=$total-($mca+$bca+$dcse+$dete);

            //mca,bca,dcse,dete,others,total
            $totprospectus[$j]=array($i,$mca,$bca,$dcse,$dete,$others,$total);


        }
        else
        {

        for($i=2008,$j=1;$i<date("Y");$i++,$j++)
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
           
        }

        Excel::create("Propectus",function($excel) use($totprospectus){
             $excel->setTitle('Prospectus Report');
             $excel->setCreator('Admin')
              ->setCompany('NIELIT');


            $excel->sheet('Prospectus',function($sheet) use($totprospectus){
                $sheet->fromArray($totprospectus, null, 'A1', false, false);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->setBorder('A1:G1', 'thin');
            });
        })->export('xlsx');


     
    }

       
}
