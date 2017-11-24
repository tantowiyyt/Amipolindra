<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borang;
use App\Jawaban;
use Auth;
use DB;
use App\Standard;
use App\Full;
use Session;
use Storage;
use Input;
use File;
use PDF;
use App\Dokumen;
class UserBorangController extends Controller
{
    
    public function getBorang(){
    	$id_jurusan = Auth::user()->id_jurusan;
    	$borang = Borang::all();
    	$standard = Standard::all();  
    	return view('user.borang')->withBorangs($borang)->withStandards($standard);
    
    }

    public function showSelectedBorang($id){
    	$borang = Borang::find($id);
    	return view('user.showborang')->withBorang($borang); 
    }

    
    public function postBorang(Request $request){
        $this->validate($request, array(
            'isi' => 'required|max:20000'
        ));
        $thisYear = date('Y');
        $nomor_borang = $request->id_borang;
        $jurusan = Auth::user()->id_jurusan;
        $select = Jawaban::where('id_borang', $nomor_borang)->where('id_jurusan', $jurusan)->where('tahun', $thisYear)->first();
        if ($select == null) {
            $jawaban = new Jawaban;
            $jawaban->id_no_butir = $request->id_no_butir;
            $jawaban->id_borang = $nomor_borang;
            $jawaban->id_jurusan = $jurusan;
            $jawaban->pertanyaan = $request->pertanyaan;
            $jawaban->bobot = $request->bobot;
            $jawaban->isi = $request->isi;
            $jawaban->tahun = $thisYear;
            $jawaban->jenis_inputan = $request->jenis_inputan;
            $jawaban->save();
            Session::flash('success', 'Berhasil mengisi borang!');
            return redirect()->route('user.borang');
        }
        else{
            Session::flash('error', ' Nomor Borang yang anda isi sudah diisi');
            return redirect()->back();
        }
    }
    

    public function isianBorang(){
        return view('user.borang-isian');
    }

    public function tahunIsian($tahun){
        $jurusan = Auth::user()->id_jurusan;
        $jawaban = Jawaban::where('tahun', $tahun)->where('id_jurusan', $jurusan)->orderBy('id_borang', 'asc')->get();
        $nomor_butir = array();
        foreach ($jawaban as $butirs) {
            $nobut = $butirs->id_no_butir;
            array_push($nomor_butir, $nobut);                      
        }
        $nilai = array();
        foreach ($jawaban as $nilais) {
            $nonilai = $nilais->nilai;
            array_push($nilai, $nonilai);                      
        }
        /*$yourFirstChart["chart"] = array("type" => "spider-web");
        $yourFirstChart["title"] = array("text" => "Skor Per Nomor Butir");
        $yourFirstChart["xAxis"] = array("categories" => $nomor_butir);

        $yourFirstChart["series"] = [
            array("name" => "No Butir", "data" => $nilai)
        ];*/
        return view('user.isian-tahun')->withIsian($jawaban)->withTahun($tahun)->withNo_butir($nomor_butir)->withNilai($nilai);
    }

    public function tahunIsianChart($tahun){
        $jurusan = Auth::user()->id_jurusan;
        $jawaban = Jawaban::where('tahun', $tahun)->where('id_jurusan', $jurusan)->orderBy('id_borang', 'asc')->get();
        $nomor_butir = array();
        foreach ($jawaban as $butirs) {
            $nobut = $butirs->id_no_butir;
            array_push($nomor_butir, $nobut);                      
        }
        $nilai = array();
        foreach ($jawaban as $nilais) {
            $nonilai = $nilais->nilai;
            array_push($nilai, $nonilai);                      
        }
        /*$yourFirstChart["chart"] = array("type" => "spider-web");
        $yourFirstChart["title"] = array("text" => "Skor Per Nomor Butir");
        $yourFirstChart["xAxis"] = array("categories" => $nomor_butir);

        $yourFirstChart["series"] = [
            array("name" => "No Butir", "data" => $nilai)
        ];*/
        return view('user.isian-tahunchart')->withIsian($jawaban)->withTahun($tahun)->withNo_butir($nomor_butir)->withNilai($nilai);
    }

    public function editIsian($id){
        $jawaban = Jawaban::find($id);
        return view('user.edit-isian')->withJawaban($jawaban);
    }

    public function updateIsian(Request $request, $id){
        $this->validate($request, array(
            'isi' => 'required|max:20000'
        ));
        $jawaban = Jawaban::find($id);
        $jawaban->isi = $request->isi;
        $jawaban->save();
        Session::flash('success', ' Isian borang berhasil diedit!');
        return redirect()->route('isian.tahun', $jawaban->tahun);
    }

    public function postFileBorang(Request $request){
        $date = date('Y');
        $this->validate($request, [
            'isi' => 'required|file|max:10000|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
        ]);
        $nomor_borang = $request->id_borang;
        $jurusan = Auth::user()->id_jurusan;
        $select = Jawaban::where('id_borang', $nomor_borang)->where('id_jurusan', $jurusan)->where('tahun', $date)->first();
        if ($select == null) {
            $jawaban = new Jawaban;
            $jawaban->id_no_butir = $request->id_no_butir;
            $jawaban->id_borang = $nomor_borang;
            $jawaban->id_jurusan = $jurusan;
            $jawaban->pertanyaan = $request->pertanyaan;
            $jawaban->bobot = $request->bobot;
            if ($request->hasFile('isi')) {
                $isi = $request->file('isi');
                $filename = time().'.'.$isi->getClientOriginalExtension();
                $location = 'isianfile';
                $isi->move($location, $filename);
                $jawaban->isi = $filename;
            }
            $jawaban->tahun = $date;
            $jawaban->jenis_inputan = $request->jenis_inputan;
            $jawaban->save();
            Session::flash('success', 'Berhasil mengisi borang');
            return redirect()->route('user.borang');
        }
        else{
            Session::flash('error', ' Nomor Borang yang anda isi sudah diisi');
            return redirect()->back();
        }    
    }

    public function editIsianFile($id){
        $jawaban = Jawaban::find($id);
        return view('user.edit-isianfile')->withJawaban($jawaban);
    }

    public function updateIsianFile(Request $request, $id){
           
        $this->validate($request, [
            'isi' => 'required|file|max:10000|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
        ]);
        $jawaban = Jawaban::find($id);
        if ($request->hasFile('isi')) {
            $isi = $request->file('isi');
            $filename = time().'.'.$isi->getClientOriginalExtension();
            $location = 'isianfile';
            $isi->move($location, $filename);
            $fileLama = $jawaban->isi;
            Storage::delete($location.'/'.$fileLama);
            $jawaban->isi = $filename;
        }
        $jawaban->save();
        Session::flash('success', ' Isian borang berhasil diedit!');
        return redirect()->route('isian.tahun', $jawaban->tahun);
    }
    public function detailIsian($id){
        $jawaban = Jawaban::find($id);
        return view('user/isian-detail')->withJawabans($jawaban);
    }
    public function pdf($tahun){
        $id_jurusan = Auth::user()->id_jurusan;
        $jawaban = Jawaban::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->orderBy('id_borang', 'asc')->get();
        $pdf = PDF::loadView('user.pdf', ['jawabans' => $jawaban, 'tahun' => $tahun]);
        return $pdf->download('nilai_akhir_isian_borang.pdf');
    }
    public function getBorangForm(){
        return view('user.borang-full-form');
    }
    public function postFullBorang(Request $request){
        $this->validate($request, [
            'file' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
        ]);
        $id_jurusan = Auth::user()->id_jurusan;
        $select = Full::where('id_jurusan', $id_jurusan)->where('tahun', 2016)->get();
        if ($select == null) {
            $isian_full = new Full;
            $isian_full->id_jurusan = $id_jurusan;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $location = 'isianfull';
                $file->move($location, $filename);
                $isian_full->file = $filename;
            }
            $isian_full->tahun = '2016';
            $isian_full->save();
            Session::flash('success', " berhasil mengupload isian borang");
            return redirect()->route('user.borangfullform');
        }else{
            Session::flash('error', " Isian Borang Sudah Di Upload");
            return redirect()->back();
        }
    }
    public function getBorangFullEdit($id){
        $full = Full::find($id);
        return view('user.edit-isian-full')->withFull($full); 
    }
    public function BorangFullUpdate(Request $request, $id){
        $this->validate($request, [
            'file' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
        ]);
        $isian_full = Full::find($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = 'isianfull';
            $file->move($location, $filename);
            $fileLama = $isian_full->file;
            Storage::delete($location.'/'.$fileLama);
            $isian_full->file = $filename;
        }
        $isian_full->save();
        Session::flash('success', ' Isian borang berhasil diedit!');
        return redirect()->route('isian.tahunfull', $isian_full->tahun);   
    }
    public function tahunIsianFull($tahun){
        $id_jurusan = Auth::user()->id_jurusan;
        $borang = Full::where('id_jurusan', $id_jurusan)->where('tahun', $tahun)->get();
        return view('user.isian-full')->withIsian($borang)->withTahun($tahun);    
    }
    public function getDokumen(){
        $dokumen = Dokumen::orderBy('nama', 'asc')->get();
        return view('user.dokumen-ami')->withDokumens($dokumen); 
    }
    public function getMultipleBorang($golongan){
        $borang = Borang::where('golongan', $golongan)->get();
        return view('user.borang-golongan')->withBorangs($borang)->withGolongan($golongan);
    }
    public function postMultipleBorang(Request $request, $golongan){
        /*golongan 1*/
        if ($golongan == 1) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 1*/
        /*golongan 2*/
        elseif ($golongan == 2) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 2*/
        /*golongan 3*/
        elseif ($golongan == 3) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 3*/
        /*golongan 4*/
        elseif ($golongan == 4) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 4*/
        /*golongan 5*/
        elseif ($golongan == 5) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    $jawaban5 = new Jawaban;
                    $jawaban5->id_borang = $request->id_borang5;
                    $jawaban5->id_jurusan = $id_jurusan;
                    $jawaban5->id_no_butir = $request->id_no_butir5;
                    $jawaban5->pertanyaan = $request->pertanyaan5;
                    $jawaban5->bobot = $request->bobot5;
                    $jawaban5->isi = $filename;
                    $jawaban5->tahun = $thisYear;
                    $jawaban5->jenis_inputan = $request->jenis_inputan5;
                    $jawaban5->save();
                    $jawaban6 = new Jawaban;
                    $jawaban6->id_borang = $request->id_borang6;
                    $jawaban6->id_jurusan = $id_jurusan;
                    $jawaban6->id_no_butir = $request->id_no_butir6;
                    $jawaban6->pertanyaan = $request->pertanyaan6;
                    $jawaban6->bobot = $request->bobot6;
                    $jawaban6->isi = $filename;
                    $jawaban6->tahun = $thisYear;
                    $jawaban6->jenis_inputan = $request->jenis_inputan6;
                    $jawaban6->save();
                    $jawaban7 = new Jawaban;
                    $jawaban7->id_borang = $request->id_borang7;
                    $jawaban7->id_jurusan = $id_jurusan;
                    $jawaban7->id_no_butir = $request->id_no_butir7;
                    $jawaban7->pertanyaan = $request->pertanyaan7;
                    $jawaban7->bobot = $request->bobot7;
                    $jawaban7->isi = $filename;
                    $jawaban7->tahun = $thisYear;
                    $jawaban7->jenis_inputan = $request->jenis_inputan7;
                    $jawaban7->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 5*/
        /*golongan 6*/
        if ($golongan == 6) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 6*/
        /*golongan 7*/
        elseif ($golongan == 7) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    $jawaban5 = new Jawaban;
                    $jawaban5->id_borang = $request->id_borang5;
                    $jawaban5->id_jurusan = $id_jurusan;
                    $jawaban5->id_no_butir = $request->id_no_butir5;
                    $jawaban5->pertanyaan = $request->pertanyaan5;
                    $jawaban5->bobot = $request->bobot5;
                    $jawaban5->isi = $filename;
                    $jawaban5->tahun = $thisYear;
                    $jawaban5->jenis_inputan = $request->jenis_inputan5;
                    $jawaban5->save();
                    $jawaban6 = new Jawaban;
                    $jawaban6->id_borang = $request->id_borang6;
                    $jawaban6->id_jurusan = $id_jurusan;
                    $jawaban6->id_no_butir = $request->id_no_butir6;
                    $jawaban6->pertanyaan = $request->pertanyaan6;
                    $jawaban6->bobot = $request->bobot6;
                    $jawaban6->isi = $filename;
                    $jawaban6->tahun = $thisYear;
                    $jawaban6->jenis_inputan = $request->jenis_inputan6;
                    $jawaban6->save();
                    $jawaban7 = new Jawaban;
                    $jawaban7->id_borang = $request->id_borang7;
                    $jawaban7->id_jurusan = $id_jurusan;
                    $jawaban7->id_no_butir = $request->id_no_butir7;
                    $jawaban7->pertanyaan = $request->pertanyaan7;
                    $jawaban7->bobot = $request->bobot7;
                    $jawaban7->isi = $filename;
                    $jawaban7->tahun = $thisYear;
                    $jawaban7->jenis_inputan = $request->jenis_inputan7;
                    $jawaban7->save();
                    $jawaban8 = new Jawaban;
                    $jawaban8->id_borang = $request->id_borang8;
                    $jawaban8->id_jurusan = $id_jurusan;
                    $jawaban8->id_no_butir = $request->id_no_butir8;
                    $jawaban8->pertanyaan = $request->pertanyaan8;
                    $jawaban8->bobot = $request->bobot8;
                    $jawaban8->isi = $filename;
                    $jawaban8->tahun = $thisYear;
                    $jawaban8->jenis_inputan = $request->jenis_inputan8;
                    $jawaban8->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 7*/
        /*golongan 8*/
        elseif ($golongan == 8) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 8*/
        /*golongan 9*/
        elseif ($golongan == 9) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    $jawaban5 = new Jawaban;
                    $jawaban5->id_borang = $request->id_borang5;
                    $jawaban5->id_jurusan = $id_jurusan;
                    $jawaban5->id_no_butir = $request->id_no_butir5;
                    $jawaban5->pertanyaan = $request->pertanyaan5;
                    $jawaban5->bobot = $request->bobot5;
                    $jawaban5->isi = $filename;
                    $jawaban5->tahun = $thisYear;
                    $jawaban5->jenis_inputan = $request->jenis_inputan5;
                    $jawaban5->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 9*/
        /*golongan 10*/
        elseif ($golongan == 10) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 10*/
        /*golongan 11*/
        elseif ($golongan == 11) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    $jawaban5 = new Jawaban;
                    $jawaban5->id_borang = $request->id_borang5;
                    $jawaban5->id_jurusan = $id_jurusan;
                    $jawaban5->id_no_butir = $request->id_no_butir5;
                    $jawaban5->pertanyaan = $request->pertanyaan5;
                    $jawaban5->bobot = $request->bobot5;
                    $jawaban5->isi = $filename;
                    $jawaban5->tahun = $thisYear;
                    $jawaban5->jenis_inputan = $request->jenis_inputan5;
                    $jawaban5->save();
                    $jawaban6 = new Jawaban;
                    $jawaban6->id_borang = $request->id_borang6;
                    $jawaban6->id_jurusan = $id_jurusan;
                    $jawaban6->id_no_butir = $request->id_no_butir6;
                    $jawaban6->pertanyaan = $request->pertanyaan6;
                    $jawaban6->bobot = $request->bobot6;
                    $jawaban6->isi = $filename;
                    $jawaban6->tahun = $thisYear;
                    $jawaban6->jenis_inputan = $request->jenis_inputan6;
                    $jawaban6->save();
                    $jawaban7 = new Jawaban;
                    $jawaban7->id_borang = $request->id_borang7;
                    $jawaban7->id_jurusan = $id_jurusan;
                    $jawaban7->id_no_butir = $request->id_no_butir7;
                    $jawaban7->pertanyaan = $request->pertanyaan7;
                    $jawaban7->bobot = $request->bobot7;
                    $jawaban7->isi = $filename;
                    $jawaban7->tahun = $thisYear;
                    $jawaban7->jenis_inputan = $request->jenis_inputan7;
                    $jawaban7->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 11*/
        /*golongan 12*/
        elseif ($golongan == 12) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 12*/
        /*golongan 13*/
        if ($golongan == 13) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 13*/
        /*golongan 14*/
        elseif ($golongan == 14) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 14*/
        /*golongan 15*/
        elseif ($golongan == 15) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    $jawaban5 = new Jawaban;
                    $jawaban5->id_borang = $request->id_borang5;
                    $jawaban5->id_jurusan = $id_jurusan;
                    $jawaban5->id_no_butir = $request->id_no_butir5;
                    $jawaban5->pertanyaan = $request->pertanyaan5;
                    $jawaban5->bobot = $request->bobot5;
                    $jawaban5->isi = $filename;
                    $jawaban5->tahun = $thisYear;
                    $jawaban5->jenis_inputan = $request->jenis_inputan5;
                    $jawaban5->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 15*/
        /*golongan 16*/
        if ($golongan == 16) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                $jawaban3 = new Jawaban;
                $jawaban3->id_borang = $request->id_borang3;
                $jawaban3->id_jurusan = $id_jurusan;
                $jawaban3->id_no_butir = $request->id_no_butir3;
                $jawaban3->pertanyaan = $request->pertanyaan3;
                $jawaban3->bobot = $request->bobot3;
                $jawaban3->isi = $request->isi;
                $jawaban3->tahun = $thisYear;
                $jawaban3->jenis_inputan = $request->jenis_inputan3;
                $jawaban3->save();
                $jawaban4 = new Jawaban;
                $jawaban4->id_borang = $request->id_borang4;
                $jawaban4->id_jurusan = $id_jurusan;
                $jawaban4->id_no_butir = $request->id_no_butir4;
                $jawaban4->pertanyaan = $request->pertanyaan4;
                $jawaban4->bobot = $request->bobot4;
                $jawaban4->isi = $request->isi;
                $jawaban4->tahun = $thisYear;
                $jawaban4->jenis_inputan = $request->jenis_inputan4;
                $jawaban4->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 16*/
        /*golongan 17*/
        elseif ($golongan == 17) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 17*/
        /*golongan 18*/
        if ($golongan == 18) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                $jawaban3 = new Jawaban;
                $jawaban3->id_borang = $request->id_borang3;
                $jawaban3->id_jurusan = $id_jurusan;
                $jawaban3->id_no_butir = $request->id_no_butir3;
                $jawaban3->pertanyaan = $request->pertanyaan3;
                $jawaban3->bobot = $request->bobot3;
                $jawaban3->isi = $request->isi;
                $jawaban3->tahun = $thisYear;
                $jawaban3->jenis_inputan = $request->jenis_inputan3;
                $jawaban3->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 18*/
        /*golongan 19*/
        if ($golongan == 19) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                $jawaban3 = new Jawaban;
                $jawaban3->id_borang = $request->id_borang3;
                $jawaban3->id_jurusan = $id_jurusan;
                $jawaban3->id_no_butir = $request->id_no_butir3;
                $jawaban3->pertanyaan = $request->pertanyaan3;
                $jawaban3->bobot = $request->bobot3;
                $jawaban3->isi = $request->isi;
                $jawaban3->tahun = $thisYear;
                $jawaban3->jenis_inputan = $request->jenis_inputan3;
                $jawaban3->save();
                $jawaban4 = new Jawaban;
                $jawaban4->id_borang = $request->id_borang4;
                $jawaban4->id_jurusan = $id_jurusan;
                $jawaban4->id_no_butir = $request->id_no_butir4;
                $jawaban4->pertanyaan = $request->pertanyaan4;
                $jawaban4->bobot = $request->bobot4;
                $jawaban4->isi = $request->isi;
                $jawaban4->tahun = $thisYear;
                $jawaban4->jenis_inputan = $request->jenis_inputan4;
                $jawaban4->save();
                $jawaban5 = new Jawaban;
                $jawaban5->id_borang = $request->id_borang5;
                $jawaban5->id_jurusan = $id_jurusan;
                $jawaban5->id_no_butir = $request->id_no_butir5;
                $jawaban5->pertanyaan = $request->pertanyaan5;
                $jawaban5->bobot = $request->bobot5;
                $jawaban5->isi = $request->isi;
                $jawaban5->tahun = $thisYear;
                $jawaban5->jenis_inputan = $request->jenis_inputan5;
                $jawaban5->save();
                $jawaban6 = new Jawaban;
                $jawaban6->id_borang = $request->id_borang6;
                $jawaban6->id_jurusan = $id_jurusan;
                $jawaban6->id_no_butir = $request->id_no_butir6;
                $jawaban6->pertanyaan = $request->pertanyaan6;
                $jawaban6->bobot = $request->bobot6;
                $jawaban6->isi = $request->isi;
                $jawaban6->tahun = $thisYear;
                $jawaban6->jenis_inputan = $request->jenis_inputan6;
                $jawaban6->save();
                $jawaban7 = new Jawaban;
                $jawaban7->id_borang = $request->id_borang7;
                $jawaban7->id_jurusan = $id_jurusan;
                $jawaban7->id_no_butir = $request->id_no_butir7;
                $jawaban7->pertanyaan = $request->pertanyaan7;
                $jawaban7->bobot = $request->bobot7;
                $jawaban7->isi = $request->isi;
                $jawaban7->tahun = $thisYear;
                $jawaban7->jenis_inputan = $request->jenis_inputan7;
                $jawaban7->save();
                $jawaban8 = new Jawaban;
                $jawaban8->id_borang = $request->id_borang8;
                $jawaban8->id_jurusan = $id_jurusan;
                $jawaban8->id_no_butir = $request->id_no_butir8;
                $jawaban8->pertanyaan = $request->pertanyaan8;
                $jawaban8->bobot = $request->bobot8;
                $jawaban8->isi = $request->isi;
                $jawaban8->tahun = $thisYear;
                $jawaban8->jenis_inputan = $request->jenis_inputan8;
                $jawaban8->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 19*/
        /*golongan 20*/
        if ($golongan == 20) {
            $this->validate($request, [
                'isi' => 'required|max:20000'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                $jawaban1 = new Jawaban;
                $jawaban1->id_borang = $request->id_borang;
                $jawaban1->id_jurusan = $id_jurusan;
                $jawaban1->id_no_butir = $request->id_no_butir;
                $jawaban1->pertanyaan = $request->pertanyaan;
                $jawaban1->bobot = $request->bobot;
                $jawaban1->isi = $request->isi;
                $jawaban1->tahun = $thisYear;
                $jawaban1->jenis_inputan = $request->jenis_inputan;
                $jawaban1->save();
                $jawaban2 = new Jawaban;
                $jawaban2->id_borang = $request->id_borang2;
                $jawaban2->id_jurusan = $id_jurusan;
                $jawaban2->id_no_butir = $request->id_no_butir2;
                $jawaban2->pertanyaan = $request->pertanyaan2;
                $jawaban2->bobot = $request->bobot2;
                $jawaban2->isi = $request->isi;
                $jawaban2->tahun = $thisYear;
                $jawaban2->jenis_inputan = $request->jenis_inputan2;
                $jawaban2->save();
                Session::flash('success', " Berhasil mengisi borang!");
                return redirect()->route('user.borang');    
            }else{
                Session::flash('error', " Borang sudah terisi sebelumnya!");
                return redirect()->back();
            } 
        }
        /*end of golongan 20*/
        /*golongan 21*/
        elseif ($golongan == 21) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 21*/
        /*golongan 22*/
        elseif ($golongan == 22) {
            $this->validate($request, [
                'isi' => 'required|file|max:20480|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
            ]);
            $id_jurusan = Auth::user()->id_jurusan;
            $thisYear = date('Y');
            $select = Jawaban::where('id_borang', $request->id_borang)->where('id_jurusan', $id_jurusan)->where('tahun', $thisYear)->first();
            if ($select == null) {
                if ($request->hasFile('isi')) {
                    $file = $request->file('isi');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $location = 'isianfile';
                    $file->move($location, $filename);
                    $jawaban1 = new Jawaban;
                    $jawaban1->id_borang = $request->id_borang;
                    $jawaban1->id_jurusan = $id_jurusan;
                    $jawaban1->id_no_butir = $request->id_no_butir;
                    $jawaban1->pertanyaan = $request->pertanyaan;
                    $jawaban1->bobot = $request->bobot;
                    $jawaban1->isi = $filename;
                    $jawaban1->tahun = $thisYear;
                    $jawaban1->jenis_inputan = $request->jenis_inputan;
                    $jawaban1->save();
                    $jawaban2 = new Jawaban;
                    $jawaban2->id_borang = $request->id_borang2;
                    $jawaban2->id_jurusan = $id_jurusan;
                    $jawaban2->id_no_butir = $request->id_no_butir2;
                    $jawaban2->pertanyaan = $request->pertanyaan2;
                    $jawaban2->bobot = $request->bobot2;
                    $jawaban2->isi = $filename;
                    $jawaban2->tahun = $thisYear;
                    $jawaban2->jenis_inputan = $request->jenis_inputan2;
                    $jawaban2->save();
                    $jawaban3 = new Jawaban;
                    $jawaban3->id_borang = $request->id_borang3;
                    $jawaban3->id_jurusan = $id_jurusan;
                    $jawaban3->id_no_butir = $request->id_no_butir3;
                    $jawaban3->pertanyaan = $request->pertanyaan3;
                    $jawaban3->bobot = $request->bobot3;
                    $jawaban3->isi = $filename;
                    $jawaban3->tahun = $thisYear;
                    $jawaban3->jenis_inputan = $request->jenis_inputan3;
                    $jawaban3->save();
                    $jawaban4 = new Jawaban;
                    $jawaban4->id_borang = $request->id_borang4;
                    $jawaban4->id_jurusan = $id_jurusan;
                    $jawaban4->id_no_butir = $request->id_no_butir4;
                    $jawaban4->pertanyaan = $request->pertanyaan4;
                    $jawaban4->bobot = $request->bobot4;
                    $jawaban4->isi = $filename;
                    $jawaban4->tahun = $thisYear;
                    $jawaban4->jenis_inputan = $request->jenis_inputan4;
                    $jawaban4->save();
                    Session::flash('success', " Berhasil mengisi borang!");
                    return redirect()->route('user.borang');    
                }else{
                    Session::flash('error', " Borang sudah terisi sebelumnya!");
                    return redirect()->back();
                }
            }
        }
        /*end of golongan 22*/
    }
}
