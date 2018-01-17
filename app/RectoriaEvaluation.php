<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RectoriaEvaluation extends Model
{
    public $timestamps = false;
    

    public function user()
    {
        return $this->belongsTo('App\User', 'evaluated_by_id');
    }
    
    public function application()
    {
        return $this->belongsTo('App\Application');
    }
    
    
}
