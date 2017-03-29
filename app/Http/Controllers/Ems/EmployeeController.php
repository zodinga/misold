<?php

namespace App\Http\Controllers\Ems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Student;
use App\Employee;
use App\Course;
use App\Community;
use App\Category;
use App\Status;
use App\Subject;
use App\Student_subject;
use App\Result;
use App\Emp_leave;
use Session;
use Image;
use Storage;

class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

 
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //For Syncing Subjects to student
        //$this->syncNew();


        //create a variable and store all the students
        $courses=Course::pluck('name','id');
        $employees=Employee::orderBy('id','Asc')->paginate(8);
        //return
        return view('ems.employees.index')->withCourses($courses)->withEmployees($employees);
    }

    public function search(Request $request)
    {
        
        $employees=Employee::where('id','>',0);
        if($request->has('name'))
            $employees=$employees->where('Fname','like','%'.$request->name.'%');
        
        if($request->has('year'))
            $employees=$employees->where('doj','=',$request->year);

        $employees=$employees->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('ems.employees.index')
                    ->withCourses($courses)
                    ->withEmployees($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses=Course::pluck('name','id');
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');
        return view('ems.employees.create')
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,array(
            'Fname'=>'required|max:50',
            'mobile'=>'alpha_dash',
            'email'=>'email',
            'photo'=>'sometimes|image',
            'doj'=>'required'
            ));
        //store
        $emp=new Employee;
        
        $emp->doj=$request->doj;
        $emp->title=$request->title;
        $emp->Sname=$request->Sname;
        $emp->Fname=$request->Fname;
        $emp->Mname=$request->Mname;
        $emp->gender=$request->gender;
        $emp->f_name=$request->f_name;
        $emp->m_name=$request->m_name;
        $emp->addressline1=$request->addressline1;
        $emp->addressline2=$request->addressline2;
        $emp->postalcode=$request->postalcode;
        $emp->city=$request->city;
        $emp->state=$request->state;
        $emp->community_id=$request->community_id;
        $emp->category_id=$request->category_id;
        $emp->dob=$request->dob;
        $emp->pan=$request->pan;
        $emp->stdcode=$request->stdcode;
        $emp->landline=$request->landline;
        $emp->mobile=$request->mobile;
        $emp->email=$request->email;
        $emp->fax=$request->fax;
        $emp->designation=$request->designation;
        $emp->appointment=$request->appointment;
        $emp->gross_pay=$request->gross_pay;
        $emp->appointment_type=$request->appointment_type;
        $emp->faculty_type=$request->faculty_type;
        $emp->payscale=$request->payscale;
        $emp->programme=$request->programme;
        $emp->course=$request->course;
        $emp->salarymode=$request->salarymode;
        $emp->pf_number=$request->pf_number;
        $emp->payband=$request->payband;
        $emp->ug_degree=$request->ug_degree;
        $emp->other_qualification=$request->other_qualification;
        $emp->specialization=$request->specialization;
        $emp->teaching_exp=$request->teaching_exp;
        $emp->eid=$request->eid;
        

        //save photo
        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            $filename=$emp->id.'.'. $photo->getClientOriginalExtension();

            $location=public_path('photo/'.$filename);

            Image::make($photo)->resize(413,531)->save($location);

            $emp->photo=$filename;
        }
        //end save photo

        $emp->save();

        //Test if subjects will be added while creating students 
        
        Session::flash('success','Successfully saved!');

        //redirect to another page
        return redirect()->route('ems.employees.show',$emp->id);
    }

    
    public function leave($id)
    {
        
        $emp=Employee::find($id);

        return view('ems.leave.show')->withEmployee($emp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp=Employee::find($id);

        return view('ems.employees.show')->withEmployee($emp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $community=Community::pluck('name','id');
        $category=Category::pluck('name','id');
        //find the post
        $employee=Employee::find($id);
 
        return view('ems.employees.edit')->withEmployee($employee)->withCommunities($community)->withCategories($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $emp=Employee::find($id);

            $this->validate($request,array(
            'Fname'=>'required|max:50',
            'mobile'=>'alpha_dash',
            'photo'=>'sometimes|image',
            'doj'=>'required'
            ));
        
        //dd($request->photo);
        //find
        $emp=Employee::find($id);
             
        $emp->doj=$request->input('doj');
        $emp->title=$request->input('title');
        $emp->Sname=$request->input('Sname');
        $emp->Fname=$request->input('Fname');
        $emp->Mname=$request->input('Mname');
        $emp->gender=$request->input('gender');
        $emp->f_name=$request->input('f_name');
        $emp->m_name=$request->input('m_name');
        $emp->addressline1=$request->input('addressline1');
        $emp->addressline2=$request->input('addressline2');
        $emp->postalcode=$request->input('postalcode');
        $emp->city=$request->input('city');
        $emp->state=$request->input('state');
        $emp->community_id=$request->input('community_id');
        $emp->category_id=$request->input('category_id');
        $emp->dob=$request->input('dob');
        $emp->pan=$request->input('pan');
        $emp->stdcode=$request->input('stdcode');
        $emp->landline=$request->input('landline');
        $emp->mobile=$request->input('mobile');
        $emp->email=$request->input('email');
        $emp->fax=$request->input('fax');
        $emp->designation=$request->input('designation');
        $emp->appointment=$request->input('appointment');
        $emp->gross_pay=$request->input('gross_pay');
        $emp->appointment_type=$request->input('appointment_type');
        $emp->faculty_type=$request->input('faculty_type');
        $emp->payscale=$request->input('payscale');
        $emp->programme=$request->input('programme');
        $emp->course=$request->input('course');
        $emp->salarymode=$request->input('salarymode');
        $emp->pf_number=$request->input('pf_number');
        $emp->payband=$request->input('payband');
        $emp->ug_degree=$request->input('ug_degree');
        $emp->other_qualification=$request->input('other_qualification');
        $emp->specialization=$request->input('specialization');
        $emp->teaching_exp=$request->input('teaching_exp');

        //photo
        if ($request->hasFile('photo')) {
            //add new photo
            $photo=$request->file('photo');
            $filename=$emp->id.'.'. $photo->getClientOriginalExtension();

            $location=public_path('photo/'.$filename);

            Image::make($photo)->resize(413,531)->save($location);

            $oldfilename=$emp->photo;
            //update database
            $emp->photo=$filename;
            //delete old photo
            Storage::delete($oldfilename);
        }
        //end photo

        $emp->save();

        //$this->resultClean($emp->id);

        Session::flash('success','Employee updated successfully');

        return redirect()->route('ems.employees.show',$emp->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $employee=Employee::find($id);
        $Fname=$employee->Fname;

        //delete photo
        Storage::delete($employee->photo);


        $employee->delete();

        Session::flash('success','Employee, '.$Fname.', Successfully deleted!');
        return redirect()->route('ems.employees.index');
    }

}


