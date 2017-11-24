<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function getLogout(){
    	Auth::logout();
    	return redirect()->route('main');
    }
}
