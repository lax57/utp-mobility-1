<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $table = "countries";

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    
    public function continent()
    {
        return $this->belongsTo('App\Continent');
    }

}
