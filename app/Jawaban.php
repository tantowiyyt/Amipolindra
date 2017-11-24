<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
	protected $table = "jawabans";
	
    public function jurusans(){

    	return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }
    public function butir(){
    	return $this->belongsTo('App\Butir', 'id_no_butir');
    }

}
