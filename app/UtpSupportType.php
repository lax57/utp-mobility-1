<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtpSupportType extends Model
{
    public $timestamps = false;

    public function solicitudeApplications()
    {
        return $this->belongsToMany('App\Application', 'application_utp_support_solicitude_type','application_id','utp_support_type_id')->withPivot('amount_solicitude');
    }
    
    public function grantedApplications()
    {
        return $this->belongsToMany('App\Application', 'application_utp_support_granted_type','application_id','granted_support_type_id')->withPivot('amount_granted');
    }
}
