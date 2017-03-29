<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Candidate;
use App\Course;
use App\Category;
use App\Community;
use App\Prospectus;
use Session;
use Cache;
use StdClass;

class CandidateController extends Controller
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
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $candidates=Candidate::orderBy('id','desc')->paginate(8);
        //return
        return view('reception.candidates.index')->withCourses($courses)->withCategories($categories)
        ->withCommunities($communities)->withCandidates($candidates);

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
        $candidate=new Candidate;
        return view('reception.candidates.create')
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withCommunities($communities)
                            ->withCandidate($candidate);
                          
    }


    public function createsearch(Request $request)
    {
        //

       $prospectuses=Prospectus::where('appln_no','like',$request->appln);

        $courses=Course::pluck('name','id');
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $candidate=new Candidate;
        $prospectus=$prospectuses->first();
        if(count($prospectus) > 0)
        {
        //taking existing values from prospectus table
        $candidate->appln_no=$prospectus->appln_no; 
        $candidate->name=$prospectus->firstname; 
        $candidate->father=$prospectus->father;
        $candidate->phone=$prospectus->phone;
        $candidate->course_id==$prospectus->course_id;
        $candidate->category_id=$prospectus->category_id;
        $candidate->qualification=$prospectus->qualification;
        $candidate->receipt_no=$prospectus->receipt_no;
        $candidate->receipt_date=$prospectus->receipt_date;
        $candidate->address=$prospectus->address;
        }
        return view('reception.candidates.create')
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withCommunities($communities)
                            ->withCandidate($candidate);

    }


    public function search(Request $request)
    {
        
        $candidates=Candidate::where('id','>',0);
        if($request->has('name'))
            $candidates=$candidates->where('name','like','%'.$request->name.'%');
        if($request->has('course_id'))
        {
            $candidates=$candidates->where('course_id','=',$request->course_id);
        }
        if($request->has('session'))
           {
            $candidates=$candidates->where('session','like',$request->session);
           } 


        $candidates=$candidates->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('reception.candidates.index')
                    ->withCourses($courses)
                    ->withCandidates($candidates);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //

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
        $candidate->session=$request->session;
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

        $candidate=Candidate::find($id);

        return view('reception.candidates.show')->withCandidate($candidate);
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
        $candidate=Candidate::find($id);
        return view('reception.candidates.edit')->withCandidate($candidate)
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
     
        $candidate=Candidate::find($id);
        if(is_null($candidate))
        {
        Session::flash('Failure','Candidate not found');
        return redirect()->route('reception.candidates.index');
        }
        $candidate->appln_no=$request->input('appln_no');
        $candidate->name=$request->input('name');
        $candidate->phone=$request->input('phone');
        $candidate->email=$request->input('email');
        $candidate->father=$request->input('father');
        $candidate->fphone=$request->input('fphone');
        $candidate->mother=$request->input('mother');
        $candidate->mphone=$request->input('mphone');
        $candidate->gender=$request->input('gender');
        $candidate->dateofbirth=$request->input('dateofbirth');
        $candidate->course_id=$request->input('course_id');
        $candidate->category_id=$request->input('category_id');
        $candidate->community_id=$request->input('community_id');
        $candidate->session=$request->input('session');
        $candidate->qualification=$request->input('qualification');
        $candidate->xboard=$request->input('xboard');
        $candidate->xpercent=$request->input('xpercent');
        $candidate->xiiboard=$request->input('xiiboard');
        $candidate->xiistream=$request->input('xiistream');
        $candidate->xiipercent=$request->input('xiipercent');
        $candidate->uguniversity=$request->input('uguniversity');
        $candidate->ugstream=$request->input('ugstream');
        $candidate->ugpercent=$request->input('ugpercent');
        $candidate->otherdegree=$request->input('otherdegree');
        $candidate->otherpercent=$request->input('otherpercent');
        $candidate->per_street=$request->input('per_street');
        $candidate->per_city=$request->input('per_city');
        $candidate->per_district=$request->input('per_district');
        $candidate->per_state=$request->input('per_state');
        $candidate->per_pin=$request->input('per_pin');
        $candidate->receipt_no=$request->input('receipt_no');
        $candidate->receipt_date=$request->input('receipt_date');
        $candidate->address=$request->input('address');
        $candidate->save();

        Session::flash('success','Candidate updated successfully');
        return redirect()->route('reception.candidates.show',$candidate->id);
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

         $candidate=Candidate::find($id);
         $name=$candidate->name;
         $candidate->delete();
        Session::flash('success','Candidate , '.$name.', Successfully deleted!');
        return redirect()->route('reception.candidates.index');
    }
}
