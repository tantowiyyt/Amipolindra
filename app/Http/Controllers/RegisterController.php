<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
class RegisterController extends Controller
{

    public function store(Request $request){
    		

    	$user = new User();
    	$user->name = $request->name;
    	$user->role_id = $request->role;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();


    	Session::flash('success', 'Sukses Menambahkan Data!');
    	return redirect('/');

    }
}
