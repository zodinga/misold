<?php

namespace App\Http\Controllers\Sms;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Course;
use App\Student;
use App\Student_subject;

use App\Category;
use App\Status;
use App\Community;
use Session;
use Excel;

class ReportController extends Controller
{
    public function getStudent(){
        $courses=Course::pluck('name','id');
         $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');
        return view('sms.reports.student')->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }

    public function getSubPlan(){
    	$courses=Course::pluck('name','id');

    	return view('sms.reports.subplan')->withCourses($courses);
    }


    public function getRegistration(){
        $courses=Course::pluck('name','id');

        return view('sms.reports.registration')->withCourses($courses);
    }

    public function getInternal(){
    	$courses=Course::pluck('name','id');

    	return view('sms.reports.internal')->withCourses($courses);
    }

    public function getResult(){

    	$courses=Course::pluck('name','id');
    	$categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');

    	return view('sms.reports.result')
    						->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }

    public function getExportRegistration(Request $request){

    	$students=Student::join('categories', 'students.category_id', '=', 'categories.id')
				            ->join('courses', 'students.course_id', '=', 'courses.id')
				            ->join('communities', 'students.community_id', '=', 'communities.id')
				            ->join('statuses', 'students.status_id', '=', 'statuses.id')
				            ->leftJoin('registrations','students.id','=','registrations.student_id')
			->select('students.id','students.name','students.phone','students.email','students.sex',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','statuses.name as status',
				'registrations.semester','registrations.session','registrations.year','registrations.receipt_no','registrations.remarks');

			/*
			->select('students.id','students.name','students.aadhaar','students.eid','students.phone','students.email',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','students.fathers_me','students.mothers_me','students.parents_phone',
				'students.guardian_me','students.guardian_phone','students.dob','students.sex','categories.name as category',
				'communities.name as community','students.per_street','students.per_city','students.per_district','students.per_state',
				'students.per_pin','students.pre_street','students.pre_city','students.pre_district','students.pre_state',
				'students.pre_pin','statuses.name as status','students.status_update_date','students.photo');
			*/

    	//->where('id','>',0);
    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

        $students=$students->orderBy('id','desc')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Registrations $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:R1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }

    public function getExportInternal(Request $request){

    		$students=Student_subject::join('students','student_subject.student_id','=','students.id')
    								->join('internals','student_subject.id','=','internals.student_subject_id')
    								->join('subjects','student_subject.subject_id','=','subjects.id')
    								->join('courses', 'students.course_id', '=', 'courses.id')
    								->join('statuses', 'students.status_id', '=', 'statuses.id')
    			->select('students.id','students.name','students.sex',
    			'courses.name as course','students.batch','statuses.name as status','students.doj as yoj',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no',
				'subjects.subject_code','subjects.name as subject','subjects.revised_year','subjects.ia_fullmark',
				'internals.attendance','internals.mark','internals.remarks');

    	/*$students=Student::join('categories', 'students.category_id', '=', 'categories.id')
				            ->join('courses', 'students.course_id', '=', 'courses.id')
				            ->join('communities', 'students.community_id', '=', 'communities.id')
				            ->join('statuses', 'students.status_id', '=', 'statuses.id')
				            ->join('student_subject','students.id','=','student_subject.student_id')
				            ->join('internals','student_subject.id','=','internals.student_subject_id')
				            ->join('subjects','student_subject.subject_id','=','subjects.id')
			->select('students.id','students.name','students.doj as yoj','courses.name as course','students.batch',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','statuses.name as status',
				'subjects.name','subjects.subject_code','subjects.semester','internals.attendance','internals.mark','internals.remarks');
				*/
			

			/*
			->select('students.id','students.name','students.aadhaar','students.eid','students.phone','students.email',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','students.fathers_me','students.mothers_me','students.parents_phone',
				'students.guardian_me','students.guardian_phone','students.dob','students.sex','categories.name as category',
				'communities.name as community','students.per_street','students.per_city','students.per_district','students.per_state',
				'students.per_pin','students.pre_street','students.pre_city','students.pre_district','students.pre_state',
				'students.pre_pin','statuses.name as status','students.status_update_date','students.photo');
			*/

    	//->where('id','>',0);
    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('students.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

        $students=$students->orderBy('id','desc')->orderBy('subjects.id')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Internals $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:Q1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }

    public function getExportResult(Request $request){

    		$students=Student_subject::join('students','student_subject.student_id','=','students.id')
    								->join('results','student_subject.id','=','results.student_subject_id')
    								->join('subjects','student_subject.subject_id','=','subjects.id')
    								->join('courses', 'students.course_id', '=', 'courses.id')
    								->join('statuses', 'students.status_id', '=', 'statuses.id')
    			->select('students.id','students.name','students.sex',
    			'courses.name as course','students.batch','statuses.name as status','students.doj as yoj',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no',
				'subjects.subject_code','subjects.name as subject','subjects.revised_year','subjects.ia_fullmark',
				'results.sessional','results.semester','results.total','results.grade','results.grade_points','results.gp_earned','results.remarks');

    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('students.name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('students.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

            if($request->has('category_id'))
            {
            	$students=$students->where('category_id','=',$request->category_id);
            	$category=Category::find($request->category_id);
            	$title=$title.$category->name." ";
            }

        if($request->has('community_id'))
            {
            	$students=$students->where('community_id','=',$request->community_id);
            	$community=Community::find($request->community_id);
            	$title=$title.$community->name." ";
            }

        if($request->has('status_id'))
            {
            	$students=$students->where('status_id','=',$request->status_id);
            	$status=Status::find($request->status_id);
            	$title=$title.$status->name;
            }

        $students=$students->orderBy('id','desc')->orderBy('subjects.id')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Results $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }



       public function getExportSubPlan(Request $request){

        if($request->has('type'))
        {
            $totalsubplan=array();
            //get type
            $type=$request->type;


            $mtot=0;
            $ftot=0;
            $mst=0;
            $fst=0;
            $msc=0;
            $fsc=0;
            $mobc=0;
            $fobc=0;
            $mgen=0;
            $fgen=0;

            $j=1;
            //sc/st sub plan
            $year=date("Y");
            if($request->has('year'))
             {
                $year=$request->year;
             }

             $courses=Course::All();


            if($type=='1')
            {
            $totalsubplan[0]=array('Year','Course','ST Male','ST Female','SC Male','SC Female','OBC Male','OBC Female','Gen Male','Gen Female','Total Male','Total Female');

             foreach($courses as $course)
             {

             //check whether a student takes that course or not
             $exist=Student::where('doj',$year)->where('course_id',$course->id)->count(); 

             if($exist>0)
             {

            //Total
            $mtot=Student::where('doj',$year)->where('course_id',$course->id)->where('sex','M')->count();
            $ftot=Student::where('doj',$year)->where('course_id',$course->id)->where('sex','F')->count();  
              
             //ST
            $mst=Student::where('doj',$year)->where('category_id',1)->where('course_id',$course->id)->where('sex','M')->count();
            $fst=Student::where('doj',$year)->where('category_id',1)->where('course_id',$course->id)->where('sex','F')->count();

            //SC
            $msc=Student::where('doj',$year)->where('category_id',2)->where('course_id',$course->id)->where('sex','M')->count();
            $fsc=Student::where('doj',$year)->where('category_id',2)->where('course_id',$course->id)->where('sex','F')->count();

            //OBC
            $mobc=Student::where('doj',$year)->where('category_id',3)->where('course_id',$course->id)->where('sex','M')->count();
            $fobc=Student::where('doj',$year)->where('category_id',3)->where('course_id',$course->id)->where('sex','F')->count();

            //GEN
            $mgen=Student::where('doj',$year)->where('category_id',4)->where('course_id',$course->id)->where('sex','M')->count();
            $fgen=Student::where('doj',$year)->where('category_id',4)->where('course_id',$course->id)->where('sex','F')->count();

            $totalsubplan[$j]=array($year,$course->name,$mst,$fst,$msc,$fsc,$mobc,$fobc,$mgen,$fgen,$mtot,$ftot);

            //increment the array
            $j++;
             }

            }
           

        Excel::create("MIS $year",function($excel) use($totalsubplan){
             $excel->setTitle('MIS Report');
             $excel->setCreator('Admin')
              ->setCompany('NIELIT');


            $excel->sheet('MIS',function($sheet) use($totalsubplan){
                $sheet->fromArray($totalsubplan, null, 'A1', false, false);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->setBorder('A1:L1', 'thin');
            });
        })->export('xlsx');
        }

         if($type=='2')
            {
            $totalsubplan[0]=array('Year','Course','ST Male','ST Female','SC Male','SC Female','Total Male','Total Female');

             foreach($courses as $course)
             {

             //check whether a student takes that course or not
             $exist=Student::where('doj',$year)->where('course_id',$course->id)->count(); 

             if($exist>0)
             {

             
             //ST
            $mst=Student::where('doj',$year)->where('category_id',1)->where('course_id',$course->id)->where('sex','M')->count();
            $fst=Student::where('doj',$year)->where('category_id',1)->where('course_id',$course->id)->where('sex','F')->count();

            //SC
            $msc=Student::where('doj',$year)->where('category_id',2)->where('course_id',$course->id)->where('sex','M')->count();
            $fsc=Student::where('doj',$year)->where('category_id',2)->where('course_id',$course->id)->where('sex','F')->count();

            $totalsubplan[$j]=array($year,$course->name,$mst,$fst,$msc,$fsc,$mst+$msc,$fst+$fsc);

            //increment the array
            $j++;
             }

            }
           

        Excel::create("SC ST $year",function($excel) use($totalsubplan){
             $excel->setTitle('SC ST Report');
             $excel->setCreator('Admin')
              ->setCompany('NIELIT');


            $excel->sheet('SC ST',function($sheet) use($totalsubplan){
                $sheet->fromArray($totalsubplan, null, 'A1', false, false);
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->setBorder('A1:H1', 'thin');
            });
        })->export('xlsx');
        }

        return back();




        }
        else
        {
        Session::flash('unsuccess','Error: ! Select Report Type !');
        return redirect()->back();
        }




        //categories 1- ST,2-SC,3-OBC,4-GEN

        //community 1-Christian,2-Hindu,3-Mushlim,4-others,5-buddhist
       }
}
