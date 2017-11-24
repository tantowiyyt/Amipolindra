<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borang;
use App\Standard;
use Response;
use Session;
use App\Butir;
use Illuminate\Support\Facades\Input;

class BorangController extends Controller
{
    public function showBorang(){
    	$borang = Borang::all();
    	$standard = Standard::all();
    	return view('admin.borang')->withBorangs($borang)->withStandards($standard); 
    }

    public function showStandardBorang(){
    	$standard = Standard::all();
    	return view('admin.standard-borang')->withStandards($standard); 
    }

    public function editBorang($id){
    	$borang = Borang::find($id);
    	$standards = Standard::all();
        $no_butir = Butir::all();
    	$stands = array();
    	foreach ($standards as $standard) {
    		$stands[$standard->id] = $standard->nama_standard;
    	}
        $butir = array();
        foreach ($no_butir as $nomor_butir) {
            $butir[$nomor_butir->id] = $nomor_butir->no_butir;
        }
        $jenis = array();
        $jenis['Deskriptif'] = 'Deskriptif';
        $jenis['File'] = 'File';
    	return view('admin.editborang')->withBorang($borang)->withStandards($stands)->withJenisinput($jenis)->withButir($butir);

    }
    public function updateBorang(Request $request, $id){
        $this->validate($request, array(
            'borang' => 'required|max:1000',
            'id_standard' => 'required|integer',
            'bobot' => 'required'
        ));

    	$borang = Borang::find($id);
        $borang->id_no_butir = $request->id_no_butir;
    	$borang->id_standard = $request->id_standard;
        $borang->borang = $request->borang;
    	$borang->bobot = $request->bobot;
        $borang->jenis_inputan = $request->jenis_inputan;
    	$borang->save();
        Session::flash('success', ' Borang Berhasil diedit!');
        return redirect()->route('borang.show');
    }
    public function tambahStandardBorang(){
        return view('admin.tambah-standard');
    }
    public function simpanStandardBorang(Request $request){
        $this->validate($request, [
            'nama_standard' => 'required|max:255'
        ]);
        $standard = new Standard;
        $standard->nama_standard = strtoupper($request->nama_standard);
        $standard->save();
        Session::flash('success', ' Berhasil menambah Standard Borang');
        return redirect()->route('admin.standardborang');
    }
    public function editStandardBorang($id){
        $standard = Standard::find($id);
        return view('admin.editstandard')->withStandard($standard);
    }
    public function updateStandardBorang(Request $request, $id){
        $this->validate($request, [
            'nama_standard' => 'required|max:255'
        ]);
        $standard = Standard::find($id);
        $standard->nama_standard = strtoupper($request->nama_standard);
        $standard->save();
        Session::flash('success', ' Berhasil mengedit Standard Borang!');
        return redirect()->route('admin.standardborang');
    }
    public function hapusStandardBorang($id){
        $standard = Standard::find($id);
        $standard->delete();
        Session::flash('success', ' Berhasil menghapus Standard Borang!');
        return redirect()->route('admin.standardborang');
    }
}
