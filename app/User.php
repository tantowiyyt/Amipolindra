<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function roles(){

        return $this->belongsTo('App\Role', 'role_id');
    }

    public function jurusans(){
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function hasAnyRole($roles)
    {
       
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('nama', $role)->first()) {
            return true;
        }
        return false;
    }
}
