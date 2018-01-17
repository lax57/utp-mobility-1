<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    public $timestamps = false;

    public function countries()
    {
        return $this->hasMany('App\Country');
    }

}
