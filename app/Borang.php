<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borang extends Model
{

    public function standards(){
    	return $this->belongsTo('App\Standard', 'id_standard');
    }
    public function butir(){
    	return $this->belongsTo('App\Butir', 'id_no_butir');
    }

}
