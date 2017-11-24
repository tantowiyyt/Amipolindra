<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    protected $table = 'hak_akses';
    public function jurusans(){
    	return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }
}
