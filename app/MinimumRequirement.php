<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MinimumRequirement extends Model
{
    public $timestamps = false;

    public function comissionEvaluations()
    {
        return $this->belongsToMany('App\ComissionEvaluation');
    }
}
