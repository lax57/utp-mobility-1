<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisationSupportType extends Model
{
    public $timestamps = false;

    public function applications()
    {
        return $this->belongsToMany('App\Application');
    }
}
