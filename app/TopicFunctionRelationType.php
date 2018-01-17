<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicFunctionRelationType extends Model
{
    public $timestamps = false;

    public function applications()
    {
        return $this->hasMany('App\Application');
    }

}
