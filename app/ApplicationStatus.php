<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    public $timestamps = false;
    protected $table = "application_statuses";
    
    const TO_BE_APPROVED_BY_JEFE = "To be approved by Jefe";
    const TO_BE_APPROVED_BY_COMISSION_DE_VIAJES = "To be approved by Comission de Viajes";
    const TO_BE_APPROVED_BY_RECTORIA = "To be approved by Rectoria";
    const REJECTED = "Rejected";
    const HISTORICAL = "Historical";
    const ACCEPTED = "Accepted";
    const FEEDBACK_REQUIRED = "Feedback required";
    

    
    public function applications()
    {
        return $this->hasMany('App\Application');
    }
    
    public function applicationTypes()
    {
        return $this->belongsToMany('App\ApplicationType')->withPivot('order_of_statuses');
    }
    
    public static function getStatusId($statusName){
        return ApplicationStatus::where('name', $statusName)->firstOrFail()->id;
    }
    
    

}
