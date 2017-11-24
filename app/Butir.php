<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Butir extends Model
{
    protected $table = 'no_butir';
    public function borangs(){
		return $this->hasMany('App\Borang', 'id_no_butir');
    }
    public function jawabans(){
		return $this->hasMany('App\Jawaban', 'id_no_butir');
    }
}
