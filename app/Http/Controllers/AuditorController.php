<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jurusan; 
use App\Jawaban;
use Session;
use Auth;
use Hash;
Use App\User;
use PDF;
use App\Akses;
use App\Full;
use App\Dokumen;
 
class AuditorController extends Controller
{
    public function auditorHome(){
    	return view('auditor.index'); 
    }
    public function isianUser(){
        $id_jurusan = Auth::user()->id_jurusan;
    	$hak_akses = Akses::where('akses_jurusan', $id_jurusan)->get();
        $akses_array = array();
        foreach ($hak_akses as $akses) {
            $no_akses = $akses->id_jurusan;
            array_push($akses_array, $no_akses);
        }
        $jurusan = Jurusan::whereIn('id', $akses_array)->get();
        return view('auditor.isian-boranguser')->withJurusans($jurusan);    	
    }
    public function isianUserDetil($id_jurusan, $tahun){
    	$jawabans = Jawaban::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->orderBy('id_borang', 'asc')->get();
    	$jurusans = Jurusan::where('id', $id_jurusan)->get();
    	return view('auditor.isian-userdetail')->withJawabans($jawabans)->withJurusan($jurusans)->withTahun($tahun);
    }
    public function isianUserDetailFull($id_jurusan, $tahun){
        $full = Full::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->get();
        $jurusans = Jurusan::where('id', $id_jurusan)->get();
        return view('auditor.isian-user-full')->withIsian($full)->withJurusan($jurusans)->withTahun($tahun);
    }
    public function isianUserDetailChart($id_jurusan, $tahun){
        $jawabans = Jawaban::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->orderBy('id_borang', 'asc')->get();
        $jurusans = Jurusan::where('id', $id_jurusan)->get();

        $nilai = array();
        foreach ($jawabans as $nilais) {
            $nonilai = $nilais->nilai;
            array_push($nilai, $nonilai);                      
        }
        return view('auditor.isian-userdetailchart')->withJawabans($jawabans)->withJurusan($jurusans)->withTahun($tahun)->withNilai($nilai);
    }
    public function inputSkor($id){
        $jawabans = Jawaban::find($id);
        $skor = array();
        $skor['4'] = '4';
        $skor['3'] = '3';
        $skor['2'] = '2';
        $skor['1'] = '1';
        $skor['0'] = '0';
        return view('auditor.input-skor')->withJawaban($jawabans)->withSkor($skor);
    }
    public function simpanSkor(Request $request, $id){
        $jawaban = Jawaban::find($id);
        $jawaban->nilai = $request->skor;
        $jawaban->save();
        Session::flash('success', ' Berhasil menambahkan skor!');
        return redirect()->route('auditor.isianuserdetail', ['id_jurusan' => $jawaban->id_jurusan, 'tahun' => $jawaban->tahun]);
    }
    public function editSkor($id){
        $jawaban = Jawaban::find($id);
        $skor = array();
        $skor['4'] = '4';
        $skor['3'] = '3';
        $skor['2'] = '2';
        $skor['1'] = '1';
        $skor['0'] = '0';
        return view('auditor.edit-skor')->withJawaban($jawaban)->withSkor($skor); 
    }
    public function updateSkor(Request $request, $id){
        $jawaban = Jawaban::find($id);
        $jawaban->nilai = $request->skor;
        $jawaban->save();
        Session::flash('success', ' Berhasil mengedit skor!');
        return redirect()->route('auditor.isianuserdetail', ['id_jurusan' => $jawaban->id_jurusan, 'tahun' => $jawaban->tahun]);
    }
    public function profil(){
        return view('auditor.profil');
    }
    public function profilEdit($id){
        $user = User::find($id);
        return view('auditor.editprofil')->withUser($user);
    }
    public function profilUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $user = User::find($id);
        $user->name =  $request->name;
        $user->save();
        Session::flash('success', ' Berhasil Mengedit Profil');
        return redirect()->route('auditor.profil');
    }
    public function editPassword($id){
        $user = User::find($id);
        return view('auditor.editpassword')->withUser($user);
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
            return redirect()->route('auditor.profil');
        }else{
            Session::flash('error', ' Password Lama Salah');
            return redirect()->route('auditor.editpassword', $id);
        }
    }
    public function isianUserSinglePage($id){
        $jawaban = Jawaban::find($id);
        return view('auditor.isian-single-page')->withJawaban($jawaban);
    }
    public function isianUserKomentar($id){
        $jawaban = Jawaban::find($id);
        return view('auditor.isiankomentar')->withJawaban($jawaban);
    }
    public function isianUserKomentarSimpan(Request $request, $id){
        $this->validate($request, [
            'komentar' => 'required'
        ]);
        $jawaban = Jawaban::find($id);
        $jawaban->komentar = $request->komentar;
        $jawaban->save();
        Session::flash('success', ' Berhasil menambah komentar!');
        return redirect()->route('auditor.isianusersinglepage', $id);
    }

    public function nyetakPdf($id_jurusan, $tahun){
        $jawabans = Jawaban::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->orderBy('id_borang', 'asc')->get();
        $jurusans = Jurusan::where('id', $id_jurusan)->get();
        $pdf = PDF::loadView('auditor.cetak', ['jawabans' => $jawabans, 'jurusan'=> $jurusans, 'tahun' => $tahun]);
        return $pdf->download('nilai_akhir_isian_borang.pdf');
    }
    public function getDokumen(){
        $dokumen = Dokumen::orderBy('nama', 'asc')->get();
        return view('auditor.dokumen-ami')->withDokumens($dokumen); 
    }    
}
