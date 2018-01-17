<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComissionEvaluation extends Model
{
    public $timestamps = false;
    
    public function minimumRequirements()
    {
        return $this->belongsToMany('App\MinimumRequirement');
    }

    public function relevanceType()
    {
        return $this->belongsTo('App\RelevanceType');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'evaluated_by_id');
    }
    
    public function application()
    {
        return $this->belongsTo('App\Application');
    }
    
    
}
