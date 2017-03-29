<?php

namespace App\Http\Controllers\Ems;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Employee;
use App\Emp_outpass;  
use Session;
use Storage;

class OutpassController extends Controller
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
        //
    }

    public function search(Request $request)
    {
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'employee_id'=>'required|max:50',
            'ground'=>'required|max:100',
            'out_date'=>'required'
            ));
                //store

        
        $outpass=new Emp_outpass;
        
        $outpass->employee_id=$request->employee_id;
        $outpass->out_date=$request->out_date;
        $outpass->out_time=$request->out_time;
        $outpass->in_time=$request->in_time;
        $outpass->ground=$request->ground;
        
                
        $outpass->save();

        //Test if subjects will be added while creating students 
        
        Session::flash('success','Your Outpass request is Successfully submitted!');

        //redirect to another page
        return redirect()->route('ems.outpass.view',$outpass->employee_id);
    }


    public function leave($id)
    {
        
        $emp=Employee::find($id);
        $emp_leave=Emp_outpass::where('status', '=', 'Approved')->where('employee_id', '=', $id)->count('status');
        
        return view('ems.outpass.show')->withEmployee($emp)->withEmp_leave($emp_leave);
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
        
        
        return view('ems.outpass.show')->withEmployee($emp)->withEmp_leave($leave);
    }

    public function view($id)
    {

        $eid=Employee::where('id', $id)->value('id');

        $nos=Emp_outpass::where('employee_id', $eid)->where('view', '=', 0)->count('id');
        if($nos > 0)
        {
            $leaveId=Emp_outpass::where('employee_id', $eid)->where('view', '=', 0)->value('id');
            $employee=Employee::find($id);
           
            $leave=Emp_outpass::find($leaveId);
            
          
            return view('ems.outpass.view',  ['howmany' => $nos])
                            ->withEmp_outpass($leave)
                            ->withEmployees($employee);
        }
        else
        {
            return view('ems.outpass.view',  ['howmany' => $nos]);
        }
    }

    

    
    public function pending($id)
    {
        $nos = Emp_outpass::where('status', 'Pending')->count('status');
        
        if($nos > 0)
        {
        $leave = Emp_outpass::where('status', '=', 'Pending')->get();
        $eid = Emp_outpass::where('status', 'Pending')->pluck('employee_id');
        $employee = Employee::whereIn('id', $eid)->get();
        $id = Emp_outpass::where('status', 'Pending')->pluck('id');

        
        return view('ems.outpass.pending', ['howmany' => $nos])
                        ->withEmp_outpass($leave)
                        ->withEmployees($employee);
        }
        else
        {
            return view('ems.outpass.pending',  ['howmany' => $nos]);
        }

    }


    public function lists($id)
    {

        $m=date('m');
        $y=date('Y');
        $leave=Emp_outpass::where('employee_id', $id)->where('status', '=', 'Pending')->get();
        $employee=Employee::find($id);
        $month=Emp_outpass::whereMonth('out_date','=', $m)->where('employee_id', '=', $id)->where('status', '=', 'Approved')->count('out_date');
        $year=Emp_outpass::whereYear('out_date', '=', $y)->where('employee_id', '=', $id)->where('status', '=', 'Approved')->count('out_date');
        
        return view('ems.outpass.list')
                        ->withEmp_outpass($leave)
                        ->withMonths($month)
                        ->withYear($year)
                        ->withEmployees($employee);
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

    public function confirm(Request $request, $id)
    {

        $this->validate($request, array(
            
            'view'=>'required'
            ));

        $emp=Emp_outpass::find($id);
       
        $emp->view=$request->input('view');
        
        $emp->save();


        return redirect()->route('ems.dashboard');
    }


    public function approve(Request $request, $id)
    {
        
        $this->validate($request, array(
            'status'=>'required',
            'authority'=>'required'
            ));

        $emp=Emp_outpass::find($id);
        
        $emp->comment=$request->input('comment');
        $emp->status=$request->input('status');
        $emp->authority=$request->input('authority');

        $emp->save();


        return redirect()->route('ems.dashboard');
    }

    public function reject(Request $request, $id)
    {
        
        $this->validate($request, array(
            'comment'=>'required',
            'authority'=>'required'
            ));

        $emp=Emp_outpass::find($id);
        
        $emp->comment=$request->input('comment');
        $emp->status=$request->input('status');
        $emp->authority=$request->input('authority');

        $emp->save();

        
        return redirect()->route('ems.dashboard');
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $emp_leave=Emp_outpass::find($id);
        
        $emp_leave->delete();

        Session::flash('success','Your Outpass request is Successfully deleted!');
        return redirect()->route('ems.dashboard');
    }

 
    
}


