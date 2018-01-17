<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonnelType extends Model
{
    public $timestamps = false;
    const EVALUATOR = "Evaluator";

    public function applications()
    {
        return $this->belongsToMany('App\Application');
    }
}
