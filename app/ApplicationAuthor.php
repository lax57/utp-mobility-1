<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationAuthor extends Model
{
    public $timestamps = false;

    public function application()
    {
        return $this->belongsTo('App\Application');
    }

}
