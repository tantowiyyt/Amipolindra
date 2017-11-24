<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Borang;
use App\Jurusan;
use App\Standard;
use Auth;
use App\Role;
use Session;
use Hash;
use App\Akses;

class AdminController extends Controller
{
    public function AdminHome(){
    	$borang = Borang::all();
    	$users = User::all();
    	$jurusans = Jurusan::all();
        $standard = Standard::all();
    	return view('admin.index')->withUsers($users)->withBorangs($borang)->withJurusans($jurusans)->withStandards($standard);
    } 

    public function showUser(){
        $id = Auth::user()->id;
    	$users = User::all()->except('id', $id);
    	return view('admin.users')->withUsers($users);
    }

    public function showJurusan(){
    	$jurusan = Jurusan::all();
    	return view('admin.jurusan')->withJurusans($jurusan);
    }
    public function addAuditor(){
        $jurusan = Jurusan::all();
        $jurusan2 = array();
        foreach ($jurusan as $data) {
            $jurusan2[$data->id] = $data->nama_jurusan;
        }
        return view('admin.tambah-auditor')->withJurusan($jurusan2);
    }
    public function addUser(){
        $jurusans = Jurusan::all();
        $jurusan2 = array();
        foreach ($jurusans as $jurusan) {
            $jurusan2[$jurusan->id] = $jurusan->nama_jurusan;
        }
        return view('admin.tambah-user')->withJurusan($jurusan2);
    }
    public function storeAuditor(Request $request){
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255'
        ));
        $getAuditor = Role::where('nama', 'Auditor')->first();
        $user = new User;
        $user->role_id = $getAuditor->id;
        $user->id_jurusan = $request->id_jurusan;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('success', ' Berhasil Menambah Auditor!');
        return redirect()->route('admin.users'); 
    }

    public function storeUser(Request $request){
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255'
        ));
        $getUser = Role::where('nama', 'User')->first();
        $user = new User;
        $user->role_id = $getUser->id;
        $user->id_jurusan = $request->id_jurusan;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('success', ' Berhasil Menambah User!');
        return redirect()->route('admin.users'); 
    }
    public function editAuditor($id){
        $user = User::find($id);
        $jurusans = Jurusan::all();
        $jurusan2 = array();
        foreach ($jurusans as $jurusan) {
            $jurusan2[$jurusan->id] = $jurusan->nama_jurusan;
        }
        return view('admin.edit-auditor')->withUser($user)->withJurusan($jurusan2);
    }
    public function editUser($id){
        $user = User::find($id);
        $jurusans = Jurusan::all();
        $jurusan2 = array();
        foreach ($jurusans as $jurusan) {
            $jurusan2[$jurusan->id] = $jurusan->nama_jurusan;
        }
        return view('admin.edit-user')->withUser($user)->withJurusan($jurusan2);
    }
    public function updateAuditor(Request $request, $id){
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));
        $user = User::find($id);
        $user->name = $request->name;
        $user->id_jurusan = $request->id_jurusan;
        $user->save();
        Session::flash('success', ' Berhasil Mengedit Auditor!');
        return redirect()->route('admin.users');
    }
    public function updateUser(Request $request, $id){
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));
        $user = User::find($id);
        $user->id_jurusan = $request->id_jurusan;
        $user->name = $request->name;
        $user->save();
        Session::flash('success', ' Berhasil Mengedit User!');
        return redirect()->route('admin.users');
    }
    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        Session::flash('success', ' Berhasil Menghapus User!');
        return redirect()->route('admin.users');
    }
    public function tambahJurusan(){
        return view('admin.tambah-jurusan');
    }
    public function storeJurusan(Request $request){
        $this->validate($request, [
            'nama_jurusan' => 'required|max:255'
        ]);
        $jurusan = new Jurusan;
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->save();
        Session::flash('success', ' Berhasil Menambah Jurusan!');
        return redirect()->route('admin.jurusan');
    }
    public function editJurusan($id){
        $jurusan = Jurusan::find($id);
        return view('admin.editjurusan')->withJurusan($jurusan); 
    }
    public function updateJurusan(Request $request, $id){
        $this->validate($request, [
            'nama_jurusan' => 'required|max:255'
        ]);
        $jurusan = Jurusan::find($id);
        $jurusan->nama_jurusan = $request->nama_jurusan;
        $jurusan->save();
        Session::flash('success', 'Jurusan Berhasil diedit!');
        return redirect()->route('admin.jurusan');
    }
    public function deleteJurusan($id){
        $jurusan = Jurusan::find($id);
        $jurusan->delete();
        Session::flash('success', ' Berhasil Menghapus Jurusan!');
        return redirect()->route('admin.jurusan');
    }
    public function profil(){
        return view('admin.profil');
    }
    public function profilEdit($id){
        $user = User::find($id);
        return view('admin.editprofil')->withUser($user);
    }
    public function profilUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $user = User::find($id);
        $user->name =  $request->name;
        $user->save();
        Session::flash('success', ' Berhasil Mengedit Profil');
        return redirect()->route('admin.profil');
    }
    public function editPassword($id){
        $user = User::find($id);
        return view('admin.editpassword')->withUser($user);
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
            return redirect()->route('admin.profil');
        }else{
            Session::flash('error', ' Password Lama Salah');
            return redirect()->route('admin.editpassword', $id);
        }
    }
    public function hakAksesAuditor(){
        $jurusan = Jurusan::all();
        return view('admin.hak-akses-auditor')->withJurusans($jurusan);
    }
    public function hakAksesAuditorId($id){
        $akses = Akses::where('akses_jurusan', $id)->get();
        $jurusan = Jurusan::where('id', $id)->get();
        return view('admin.detail-hak-akses')->withAkses($akses)->withJurusans($jurusan)->withId($id);
    }
    public function hakAksesAuditorTambah($id){
        $nampil = Jurusan::where('id', $id)->get();
        $all = Jurusan::all();
        $jurusan_akses = array();
        foreach ($all as $jurusan) {
            $jurusan_akses[$jurusan->id] = $jurusan->nama_jurusan;
        } 
        return view('admin.tambah-hak-akses')->withJurusans($nampil)->withId($id)->withDataakses($jurusan_akses);
    }
    public function hakAksesAuditorSimpan(Request $request){
        $select = Akses::where('id_jurusan', '=', $request->id_jurusan)->where('akses_jurusan', '=', $request->akses_jurusan)->first();
        if ($select == NULL) {
            $akses = new Akses;
            $akses->id_jurusan = $request->id_jurusan;
            $akses->akses_jurusan = $request->akses_jurusan;
            $akses->save(); 
            Session::flash('success', 'Data Hak Akses Berhasil ditambah');
            return redirect()->route('admin.haksesauditorid',$request->akses_jurusan);
        }else{
            Session::flash('error', 'Data Hak Akses Sudah Ada');
            return redirect()->route('admin.haksesauditorid',$request->akses_jurusan);
        }
    }
    public function hakAksesAuditorHapus(Request $request, $id_akses){
        $akses = Akses::where('id', $id_akses)->delete();
        Session::flash('success', ' Berhasil Menghapus Hak Akses');
        return redirect()->route('admin.haksesauditorid', $request->id); 
    }
}
