<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen;
use Session;
use Storage;

class DokumenController extends Controller
{
    public function index(){
    	$dokumen = Dokumen::orderBy('nama', 'asc')->get();
    	return view('admin.dokumen-index')->withDokumens($dokumen);
    }
    public function create(){
    	return view('admin.dokumen-create');
    }
    public function store(Request $request){
    	$this->validate($request, [
    		'nama' => 'required|max:100',
    		'file' => 'file|max:10000|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
    	]);
    	$dokumen = new Dokumen;
    	$dokumen->nama = $request->nama;
    	if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = 'dokumen';
            $file->move($location, $filename);
            $dokumen->file = $filename;
        }
        $dokumen->save();
        Session::flash('success', " Berhasil Menambah Dokumen!");
        return redirect()->route('dokumen.index');
    }
    public function edit($id){
    	$dokumen = Dokumen::find($id);
    	return view('admin.edit-dokumen')->withDokumen($dokumen);
    }
    public function update(Request $request, $id){
    	$this->validate($request, [
    		'nama' => 'required|max:100',
    		'file' => 'file|max:10000|mimes:doc,docx,pdf,ppt,pptx,xls,xlsx'
    	]);
    	$dokumen = Dokumen::find($id);
    	$dokumen->nama = $request->nama;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = 'dokumen';
            $file->move($location, $filename);
            $fileLama = $dokumen->file;
            Storage::delete($location.'/'.$fileLama);
            $dokumen->file = $filename;
        }
        $dokumen->save();
        Session::flash('success', " Berhasil Mengedit Dokumen!");
        return redirect()->route('dokumen.index');
    }
    public function delete($id){
    	$dokumen = Dokumen::find($id);
    	$location = 'dokumen';
    	$fileLama = $dokumen->file;
    	Storage::delete($location.'/'.$fileLama);
    	$dokumen->delete();
    	Session::flash('success', " Berhasil Menghapus Dokumen!");
        return redirect()->route('dokumen.index');	
    }
}
