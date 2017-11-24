<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    public function users(){

    	return $this->hasMany('App\User', 'id_jurusan');
    }

    public function jawabans(){

    	return $this->hasMany('App\Jawaban', 'id_jurusan', 'id');
    }
    public function akses(){
    	return $this->hasMany('App\Akses', 'id_jurusan');
    }
}
