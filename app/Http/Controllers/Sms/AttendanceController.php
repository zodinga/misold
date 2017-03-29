<?php

namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Student;
use App\Course;
use App\Attendance;
use Illuminate\Support\Facades\Input;
use Session;
use Cache;
use Excel;

class AttendanceController extends Controller
{
   

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $courses=Course::pluck('name','id');
        $attendances=Attendance::orderBy('id','desc')->paginate(8);
        //return
        return view('sms.attendances.index')->withCourses($courses)->withAttendances($attendances);
        

    }


   public function getExport(Request $request){
   }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        $courses=Course::pluck('name','id');

        return view('sms.attendances.create')
                            ->withCourses($courses);
                            


    }


    public function exportcsv(Request $request)
    {
        //


     $attendances=Student::join('courses', 'students.course_id', '=', 'courses.id')
                ->leftjoin('attendances','students.univ_reg_no','=','attendances.regn_no')
                ->join('registrations', function ($join) {
                    $join->on('students.id', '=', 'registrations.student_id')
                     ->where('registrations.year', '=', ''.date('Y'));
                    })
                ->select('attendances.id','students.name','students.univ_reg_no as regn_no','students.course_id','registrations.semester','attendances.m1','attendances.m2','attendances.m3','attendances.m4','attendances.m5');


    //$entranceArrays = [];
    //$entranceArrays[]=['id','appln_no','name','father','marks','course_id','session','remarks'];
    $title="Attendance";
        if($request->has('course_id'))
            {

            $attendances=$attendances->where('students.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title." ".$course->name;
            }
       
        if($request->has('semester'))
            {
 
            $attendances=$attendances->where('registrations.semester','like',''.$request->semester);
            
            $title=$title." ".$request->semester;      
            }

    $attendances=$attendances->orderBy('students.id','desc')->get();

  // foreach ($entrances as $entrance) {
   //     $entranceArrays[] = $entrance->toArray();
  //  }

        Excel::create(''.$title,function($excel) use($attendances){
             $excel->setTitle('Entrance Result');
             $excel->setCreator('MIS')
              ->setCompany('NIELIT');


            $excel->sheet('Attendance',function($sheet) use($attendances){
                $sheet->fromArray($attendances);
                $sheet->setOrientation('landscape');
                $sheet->setBorder('A1:J1', 'thin');
            });
        })->export('csv');

         return back();

    }

    public function importcsv(Request $request)
    {
       Excel::load(Input::file('import'),function($reader){

            $rd=$reader->toArray();

            $reader->each(function($sheet){
                
                
                $temp=Attendance::find($sheet->id);
                if($temp==NULL)
                {
                Attendance::firstOrCreate($sheet->toArray());
                   
                }
                else
                {
                    $temp->delete();
                    Attendance::firstOrCreate($sheet->toArray());
                  
                }
            });

        });
        Session::flash('success','Attendance Imported Successfully');
        return redirect()->route('sms.attendances.index');

    }

    public function search(Request $request)
    {
   
        $attendances=Attendance::where('id','>',0);
        if($request->has('semester'))
            $attendances=$attendances->where('semester','like',$request->semester);
        if($request->has('course_id'))
        {
            $attendances=$attendances->where('course_id','=',$request->course_id);
        }
    
        $attendances=$attendances->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('sms.attendances.index')
                    ->withCourses($courses)
                    ->withAttendances($attendances);
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
/*
        $candidate=new Candidate;
        $candidate->appln_no=$request->appln_no;
        $candidate->name=$request->name;
        $candidate->phone=$request->phone;
        $candidate->email=$request->email;
        $candidate->father=$request->father;
        $candidate->fphone=$request->fphone;
        $candidate->mother=$request->mother;
        $candidate->mphone=$request->mphone;
        $candidate->gender=$request->gender;
        $candidate->dateofbirth=$request->dateofbirth;
        $candidate->course_id=$request->course_id;
        $candidate->category_id=$request->category_id;
        $candidate->community_id=$request->community_id;
        $candidate->qualification=$request->qualification;
        $candidate->xboard=$request->xboard;
        $candidate->xpercent=$request->xboard;
        $candidate->xiiboard=$request->xiiboard;
        $candidate->xiistream=$request->xiistream;
        $candidate->xiipercent=$request->xiipercent;
        $candidate->uguniversity=$request->uguniversity;
        $candidate->ugstream=$request->ugstream;
        $candidate->ugpercent=$request->ugpercent;
        $candidate->otherdegree=$request->otherdegree;
        $candidate->otherpercent=$request->otherpercent;
        $candidate->per_street=$request->per_street;
        $candidate->per_city=$request->per_city;
        $candidate->per_district=$request->per_district;
        $candidate->per_state=$request->per_state;
        $candidate->per_pin=$request->per_pin;
        $candidate->receipt_no=$request->receipt_no;
        $candidate->receipt_date=$request->receipt_date;
        $candidate->address=$request->address;
        $candidate->save();
        Session::flash('success','Candidate Successfully saved!');
        return redirect()->route('reception.candidates.show',$candidate->id);
        */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        $attendance=Attendance::find($id);

        return view('sms.attendances.show')->withAttendance($attendance);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //


        $courses=Course::pluck('name','id');
        $attendance=Attendance::find($id);
        return view('sms.attendances.edit')->withAttendance($attendance)
                            ->withCourses($courses);
                            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //


        $attendance=Attendance::find($id);

        $attendance->appln_no=$request->input('appln_no');
        $attendance->name=$request->input('name');
        $attendance->father=$request->input('father');
        $attendance->marks=$request->input('marks');
        $attendance->course_id=$request->input('course_id');
        $attendance->session=$request->input('session');
        $attendance->remarks=$request->input('remarks');

        $attendance->save();

        Session::flash('success','Attendance updated successfully');
        return redirect()->route('reception.entrances.show',$entrance->id);
 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //

         $attendance=Attendance::find($id);
         $name=$attendance->name;
         $attendance->delete();
        Session::flash('success','Attendance , '.$name.', Successfully deleted!');
        return redirect()->route('sms.attendance.index');

    }
}
