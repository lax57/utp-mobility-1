<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    const CREATE_APPLICATION = "create_application";
    const MANAGE_WEBSITE = "manage_website";
    const EVALUATE_APPLICATIONS = "evaluate_application";
    
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Role');
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
