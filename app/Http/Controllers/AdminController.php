<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Role;

use Session;

class AdminController extends Controller
{
    public function postAssign(Request $request){

    	$user=User::find($request['id']);
    	$user->roles()->detach();

    	if($request['role_reception']){
    		$user->roles()->attach(Role::where('name','Reception')->first());
    	}
    	if($request['role_admin']){
    		$user->roles()->attach(Role::where('name','Admin')->first());
    	}

    	if($request['role_coordinator']){
    		$user->roles()->attach(Role::where('name','Coordinator')->first());
    	}

    	if($request['role_faculty']){
    		$user->roles()->attach(Role::where('name','Faculty')->first());
    	}

        if($request['role_lab']){
            $user->roles()->attach(Role::where('name','Lab')->first());
        }

        if($request['role_clerical']){
            $user->roles()->attach(Role::where('name','Clerical')->first());
        }

        if($request['role_account']){
            $user->roles()->attach(Role::where('name','Account')->first());
        }

    	Session::flash('success','Roles assigned successfully!!');

    	return redirect()->back();
    } 
}
