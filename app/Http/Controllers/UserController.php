<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;
use Auth;
use App\User;
use Session;
use Hash;
class UserController extends Controller
{
    public function getHome(){
    	
    	
    	return view('user.index');
    }
    public function profil(){
    	return view('user.userprofil');
    }
    public function editProfil($id){
    	$user = User::find($id);
    	return view('user.editprofil')->withUsers($user);
    }
    public function updateProfil(Request $request, $id){
    	$this->validate($request, [
    		'name' => 'required|max:255'
    	]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->save();
    	Session::flash('success', ' Nama berhasil diganti!');
    	return redirect()->route('user.profil');
    }
    public function editPassword($id){
    	$user = User::find($id);
    	return view('user.editpassword')->withUser($user);
    }
    public function updatePassword(Request $request, $id){
    	$this->validate($request, [
    		'password' => 'required|max:255',
    		'newpassword' => 'required|max:255'
    	]);
    	$select = User::find($id);
    	if (Hash::check($request->password, $select->password)) {
    		$select->password = bcrypt($request->newpassword);
    		$select->save();
    		Session::flash('success', ' Password berhasil diedit!');
    		return redirect()->route('user.profil');
    	}else{
    		Session::flash('error', ' Password Lama Salah');
    		return redirect()->route('user.passwordedit', $id);
    	}
    }
}
