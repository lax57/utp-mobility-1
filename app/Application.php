<?php

namespace App;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = false;

    public function presentationType()
    {
        return $this->belongsTo('App\PresentationType');
    }

    public function eventType()
    {
        return $this->belongsTo('App\EventType');
    }

    public function trainingAreaType()
    {
        return $this->belongsTo('App\TrainingAreaType');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function topicFunctionRelationType()
    {
        return $this->belongsTo('App\TopicFunctionRelationType');
    }

    public function applicationType()
    {
        return $this->belongsTo('App\ApplicationType');
    }

    public function applicationStatus()
    {
        return $this->belongsTo('App\ApplicationStatus');
    }
    
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function authors()
    {
        return $this->hasMany('App\ApplicationAuthor');
    }
    
    public function comissionEvaluation()
    {
        return $this->hasOne('App\ComissionEvaluation');
    }
    
    public function rectoriaEvaluation()
    {
        return $this->hasOne('App\RectoriaEvaluation');
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    
    public function inform()
    {
        return $this->hasOne('App\Inform');
    }
    
    public function organisationSupportTypes()
    {
        return $this->belongsToMany('App\OrganisationSupportType');
    }
    
    public function personnelTypes()
    {
        return $this->belongsToMany('App\PersonnelType');
    }
    
    public function utpSupportSolicitudeTypes()
    {
        return $this->belongsToMany('App\UtpSupportType','application_utp_support_solicitude_type','application_id','utp_support_type_id')->withPivot('amount_solicitude');
    }
    
    public function utpSupportGrantedTypes()
    {
        return $this->belongsToMany('App\UtpSupportType','application_utp_support_granted_type','application_id','granted_support_type_id')->withPivot('amount_granted');
    }
    
    public function withinDeadline(){
        $today = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
        $mobilityFinishDate = DateTime::createFromFormat('Y-m-d', $this->finish_date);
        $interval = $mobilityFinishDate->diff($today)->format("%r%a");
        return (int)$interval  >= 15 || (int)$interval <= 0 ? false : true;
    }
    
    
    public function changeStatus($newStatusId, $user_id){
        $this->applicationStatus != null ? $oldStatusId = $this->applicationStatus->id : $oldStatusId = null;
        $this->application_status_id = $newStatusId;
        $this->save();
        $notification = new Notification();
        $notification->createNewNotification($this->id, $oldStatusId, $newStatusId, $user_id);
    }

}
