<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Prospectus;
use App\Course;
use App\Category;
use App\Community;
use Session;
use Cache;

class ProspectusController extends Controller
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
        $prospectuses=Prospectus::orderBy('id','desc')->paginate(8);
        //return
        return view('reception.prospectuses.index')->withCourses($courses)->withProspectuses($prospectuses);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

        $courses=Course::pluck('name','id');
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        return view('reception.prospectuses.create')
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withCommunities($communities);
    }



    public function search(Request $request)
    {
        
        $prospectuses=Prospectus::where('id','>',0);
        if($request->has('name'))
            $prospectuses=$prospectuses->where('firstname','like','%'.$request->name.'%');
        if($request->has('course_id'))
        {
            $prospectuses=$prospectuses->where('course_id','=',$request->course_id);
        }
        if($request->has('from'))
           {$prospectuses=$prospectuses->where('receipt_date','>=',$request->from);
           } 
        if($request->has('to'))
           {$prospectuses=$prospectuses->where('receipt_date','<=',$request->to);
           }    

        $prospectuses=$prospectuses->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('reception.prospectuses.index')
                    ->withCourses($courses)
                    ->withProspectuses($prospectuses);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //

        $prospectus=new Prospectus;
        $prospectus->appln_no=$request->appln_no;
        $prospectus->firstname=$request->firstname;
        $prospectus->father=$request->father;
        $prospectus->phone=$request->phone;
        $prospectus->gender=$request->gender;
        $prospectus->qualification=$request->qualification;
        $prospectus->course_id=$request->course_id;
        $prospectus->category_id=$request->category_id;
        $prospectus->receipt_no=$request->receipt_no;
        $prospectus->receipt_date=$request->receipt_date;
        $prospectus->address=$request->address;
        $prospectus->dd_number=$request->dd_number;
        $prospectus->dd_amount=$request->dd_amount;
        $prospectus->dd_bank=$request->dd_bank;
        $prospectus->dd_date=$request->dd_date;
        $prospectus->remarks=$request->remarks;
        $prospectus->save();
        Session::flash('success','Successfully saved!');
        return redirect()->route('reception.prospectuses.show',$prospectus->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //

        $prospectus=Prospectus::find($id);

        return view('reception.prospectuses.show')->withProspectus($prospectus);
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
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        //find the particular prospectus
        $prospectus=Prospectus::find($id);
        return view('reception.prospectuses.edit')->withProspectus($prospectus)
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withCommunities($communities);
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

        $prospectus=Prospectus::find($id);

        $prospectus->appln_no=$request->input('appln_no');
        $prospectus->firstname=$request->input('firstname');
        $prospectus->father=$request->input('father');
        $prospectus->phone=$request->input('phone');
        $prospectus->gender=$request->input('gender');
        $prospectus->qualification=$request->input('qualification');
        $prospectus->course_id=$request->input('course_id');
        $prospectus->category_id=$request->input('category_id');
        $prospectus->receipt_no=$request->input('receipt_no');
        $prospectus->receipt_date=$request->input('receipt_date');
        $prospectus->address=$request->input('address');
        $prospectus->dd_number=$request->input('dd_number');
        $prospectus->dd_amount=$request->input('dd_amount');
        $prospectus->dd_bank=$request->input('dd_bank');
        $prospectus->dd_date=$request->input('dd_date');
        $prospectus->remarks=$request->input('remarks');
        $prospectus->save();

        Session::flash('success','Prospectus updated successfully');
        return redirect()->route('reception.prospectuses.show',$prospectus->id);
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

         $prospectus=Prospectus::find($id);
         $appln_no=$prospectus->appln_no;
         $prospectus->delete();
        Session::flash('success','Prospectus , '.$appln_no.', Successfully deleted!');
        return redirect()->route('reception.prospectuses.index');
    }
}
