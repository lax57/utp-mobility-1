<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    public function applications()
    {
        return $this->hasManyThrough('App\Application', 'App\User');
    }

}
