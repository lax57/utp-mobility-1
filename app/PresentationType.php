<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentationType extends Model
{
    public $timestamps = false;

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
}
