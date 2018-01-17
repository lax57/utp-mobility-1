<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelevanceType extends Model
{
    public $timestamps = false;
    protected $table = "relevance_types";

    public function comissionEvaluations()
    {
        return $this->hasMany('App\ComissionEvaluation');
    }
}
