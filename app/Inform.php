<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inform extends Model
{
    public $timestamps = false;
    
    const DEADLINE = 15;
    
    public function application()
    {
        return $this->belongsTo('App\Application');
    }
    
}
