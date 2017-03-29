<?php

namespace App\Http\Controllers\Ems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Employee;
use App\Emp_leave; 
use Session;
use Storage;

class LeaveController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    
    public function store(Request $request)
    {
        //validate
        $this->validate($request,array(
            'employee_id'=>'required|max:50',
            'ground'=>'required|max:100',
            'from_date'=>'required'
            ));
        //store
        $emp=new Emp_leave;
        
        $emp->employee_id=$request->employee_id;
        $emp->leave_type=$request->leave_type;
        $emp->from_date=$request->from_date;
        $emp->to_date=$request->to_date;
        $emp->no_of_days=$request->no_of_days;
        $emp->ground=$request->ground;
        
                
        $emp->save();

        //Test if subjects will be added while creating students 
        
        Session::flash('success','Your Leave request is Successfully submitted!');

        //redirect to another page
        return redirect()->route('ems.leave.view',$emp->employee_id); 
      

    }


    public function leave($id)
    {
        
        $emp=Employee::find($id);
        $emp_leave=Emp_leave::where('status', '=', 'Approved')->where('employee_id', '=', $id)->sum('no_of_days');
        

        return view('ems.leave.show')->withEmployee($emp)->withEmp_leave($emp_leave);
    }

    
    public function show($id)
    {
        $emp=Employee::find($id);
        

        return view('ems.leave.show')->withEmployee($emp)->withEmp_leave($leave);
    }

    public function view($id)
    {

        $eid=Employee::where('id', $id)->value('id');

        $nos=Emp_leave::where('employee_id', $eid)->where('view', '=', 0)->count('id');

        if($nos > 0)
        {
            $leaveId=Emp_leave::where('employee_id', $eid)->where('view', '=', 0)->value('id');
            $employee=Employee::find($id);
           
            $leave=Emp_leave::find($leaveId);
            
          
            return view('ems.leave.view',  ['howmany' => $nos])
                            ->withEmp_leave($leave)
                            ->withEmployees($employee);
        }
        else
        {
            return view('ems.leave.view',  ['howmany' => $nos]);
        }
    }

    
    public function pending($id)
    {
        $nos = Emp_leave::where('status', 'Pending')->count('status');
        
        if($nos > 0)
        {
        $leave = Emp_leave::where('status', '=', 'Pending')->get();
        $eid = Emp_leave::where('status', 'Pending')->pluck('employee_id');
        $employee = Employee::whereIn('id', $eid)->get();
        $id = Emp_leave::where('status', 'Pending')->pluck('id');

        
            return view('ems.leave.pending', ['howmany' => $nos])
                        ->withEmp_leave($leave)
                        ->withEmployees($employee);
        }
        else
        {
            return view('ems.leave.pending',  ['howmany' => $nos]);
        }

    }


    public function lists($id)
    {

        $m=date('m');
        $y=date('Y'); 
        $leave=Emp_leave::where('employee_id', $id)->where('status', '=', 'Pending')->get();
        $employee=Employee::find($id);
        $month=Emp_leave::whereMonth('created_at','=', $m)->where('employee_id', '=', $id)->where('status', '=', 'Approved')->count('created_at');
        $year=Emp_leave::whereYear('created_at', '=', $y)->where('employee_id', '=', $id)->where('status', '=', 'Approved')->count('created_at');
               
        return view('ems.leave.list')
                        ->withEmp_leave($leave)
                        ->withMonths($month)
                        ->withYear($year)
                        ->withEmployees($employee);
    }


    public function confirm(Request $request, $id)
    {

        
        $this->validate($request, array(
            
            'view'=>'required'
            ));

        $emp=Emp_leave::find($id);
       
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

        $emp=Emp_leave::find($id);
        
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

        $emp=Emp_leave::find($id);
        
        $emp->comment=$request->input('comment');
        $emp->status=$request->input('status');
        $emp->authority=$request->input('authority');

        $emp->save();


        return redirect()->route('ems.dashboard');
    }

    
    public function destroy($id)
    {
        
        $emp_leave=Emp_leave::find($id);
       

        $emp_leave->delete();

        Session::flash('success','Your Leave request is Successfully deleted!');
        return redirect()->route('ems.dashboard');
    }

}


