<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Session;
use Cache;

class HomeController extends Controller{

	public function getIndex(){
		return view('home.welcome');
									
	}

	public function getAbout(){
	
		return view('home.about');
	}

	public function getContact(){
		
		return view('home.contact');
	}

	public function postContact(Request $request){

		$this->validate($request,array(
			'email'=>'required|email',
			'message'=>'min:10',
			'subject'=>'min:3'
			));

		$data = array(
			'email' => $request->email ,
			'subject'=> $request->subject,
			'bodyMessage'=>$request->message );
		Mail::send('emails.contact',$data,function($message) use ($data){
			$message->from($data['email']);
			$message->to('chleumas@gmail.com');
			$message->subject($data['subject']);
		});

		Session::flash('success','Your email was sent!!');

		return redirect('/');
	}

	public function getDashboard()
	{
		return view('home.dashboard');
	}
}