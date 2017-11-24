<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class AuthController extends Controller
{
    public function __construct(){
    	$this->middleware('guest');
    }
    public function postLogIn(Request $request){
    	if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
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
        
        Session::flash('error', 'Email atau Password Salah!');
    	return redirect()->back();
    }
}
