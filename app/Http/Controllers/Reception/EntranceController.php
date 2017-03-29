<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Candidate;
use App\Course;
use App\Entrance;
use Illuminate\Support\Facades\Input;
use Session;
use Cache;
use Excel;

class EntranceController extends Controller
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
        $entrances=Entrance::orderBy('id','desc')->paginate(8);
        //return
        return view('reception.entrances.index')->withCourses($courses)->withEntrances($entrances);

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

        return view('reception.entrances.create')
                            ->withCourses($courses);

    }


    public function exportcsv(Request $request)
    {
        //


     $entrances=Candidate::join('courses', 'candidates.course_id', '=', 'courses.id')
                ->leftjoin('entrances','candidates.appln_no','=','entrances.appln_no')
                ->select('entrances.id','candidates.appln_no','candidates.name','candidates.father','entrances.marks','candidates.course_id','candidates.session','entrances.remarks');


    //$entranceArrays = [];
    //$entranceArrays[]=['id','appln_no','name','father','marks','course_id','session','remarks'];
    $title="Export";
        if($request->has('course_id'))
            {
            $entrances=$entrances->where('candidates.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title." ".$course->name;
            }
        if($request->has('session'))
            {
            $entrances=$entrances->where('candidates.session','like',''.$request->session); 
            $title=$title." ".$request->session;      
            }

    $entrances=$entrances->orderBy('candidates.id','desc')->get();

  // foreach ($entrances as $entrance) {
   //     $entranceArrays[] = $entrance->toArray();
  //  }

        Excel::create(''.$title,function($excel) use($entrances){
             $excel->setTitle('Entrance Result');
             $excel->setCreator('MIS')
              ->setCompany('NIELIT');


            $excel->sheet('Entrance',function($sheet) use($entrances){
                $sheet->fromArray($entrances);
                $sheet->setOrientation('landscape');
                $sheet->setBorder('A1:H1', 'thin');
            });
        })->export('csv');

         return back();

    }

    public function importcsv(Request $request)
    {
       Excel::load(Input::file('import'),function($reader){

            $rd=$reader->toArray();

            $reader->each(function($sheet){
                Entrance::firstOrCreate($sheet->toArray());
            });

        });
        Session::flash('success','Entrance Marks Imported Successfully');
        return redirect()->route('reception.candidates.index');

    }

    public function search(Request $request)
    {
   
        $entrances=Entrance::where('id','>',0);
        if($request->has('session'))
            $entrances=$entrances->where('session','like',$request->session);
        if($request->has('course_id'))
        {
            $entrances=$entrances->where('course_id','=',$request->course_id);
        }
    
        $entrances=$entrances->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('reception.entrances.index')
                    ->withCourses($courses)
                    ->withEntrances($entrances);
    
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
        
        $entrance=Entrance::find($id);

        return view('reception.entrances.show')->withEntrance($entrance);
        
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
        $entrance=Entrance::find($id);
        return view('reception.entrances.edit')->withEntrance($entrance)
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


        $entrance=Entrance::find($id);

        $entrance->appln_no=$request->input('appln_no');
        $entrance->name=$request->input('name');
        $entrance->father=$request->input('father');
        $entrance->marks=$request->input('marks');
        $entrance->course_id=$request->input('course_id');
        $entrance->session=$request->input('session');
        $entrance->remarks=$request->input('remarks');

        $entrance->save();

        Session::flash('success','Entrance updated successfully');
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

         $entrance=Entrance::find($id);
         $name=$entrance->name;
         $entrance->delete();
        Session::flash('success','Entrance , '.$name.', Successfully deleted!');
        return redirect()->route('reception.entrance.index');

    }
}
