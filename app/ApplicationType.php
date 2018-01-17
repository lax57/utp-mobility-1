<?php

namespace App;

use App\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
    public $timestamps = false;
    
    const RUTP_FV_1 = "rutp-fv-1";
    const RUTP_FV_2 = "rutp-fv-2";
    const RUTP_FV_3 = "rutp-fv-3";
    const RUTP_FV_4 = "rutp-fv-4";
    const RUTP_FV_5 = "rutp-fv-5";
    

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    
    public function applicationStatuses()
    {
        return $this->belongsToMany('App\ApplicationStatus')->withPivot('order_of_statuses');
    }
    
    public function nextStatusId($oldStatus){
        $oldStatusOrderNumber = $this->applicationStatuses()->where('application_status_id', $oldStatus->id)->firstOrFail()->pivot->order_of_statuses;
        $next = $oldStatusOrderNumber+1;
        return $this->applicationStatuses()->where('order_of_statuses', $next)->firstOrFail()->id;
    }
    
    public function firstStatusId(){
        return $this->applicationStatuses()->where('order_of_statuses', 1)->firstOrFail()->id;
    }
    
}
