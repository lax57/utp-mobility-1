<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    const JEFE = "Jefe";
    const COMISSION_DE_VIAJES = "Comission de Viajes";
    const RECTORIA = "Rectoria";


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
