<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
class WelcomeController extends Controller
{
    public function getSignIn(){
    	if (Auth::check()) {
    		if (Auth::user()->roles->nama == 'Admin') {
    			# code...
    			return redirect()->route('admin.home'); 
    		}
            
            if (Auth::user()->roles->nama == 'User') {
                # code...
                return redirect()->route('user.home');
            }

            if (Auth::user()->roles->nama == 'Auditor') {
                # code...
                return redirect()->route('auditor.home');
            }
    	}
    	else{
			return view('login');
    	}
    }

}
