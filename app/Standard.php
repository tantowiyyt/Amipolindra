<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{

    public function borangs(){

    	return $this->hasMany('App\Borang', 'id_standard');
    }
}
