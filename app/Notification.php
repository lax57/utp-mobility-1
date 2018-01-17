<?php

namespace App;

use App\ApplicationStatus;
use App\Mail\StatusChanged;
use App\Role;
use Illuminate\Support\Carbon;
use App\Mail\ApplicationEvaluation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    
    public function oldStatus()
    {
        return $this->belongsTo('App\ApplicationStatus','old_status');
    }
    
    public function newStatus()
    {
        return $this->belongsTo('App\ApplicationStatus','new_status');
    }
    
    public function application()
    {
        return $this->belongsTo('App\Application');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createNewNotification($application_id, $oldStatus_id, $newStatus_id, $user_id){
        $this->application_id = $application_id;
        $this->old_status = $oldStatus_id;
        $this->new_status = $newStatus_id;
        $this->updated_by = $user_id;
        $this->date_of_update = date("Y-m-d h:i:s");
        $this->seen = 0;
        $this->save();
        //TODO:: send email to correct user!
        $this->sendEmails($application_id, $newStatus_id);
        
        
    }
    
    public function sendEmails($application_id, $newStatus_id){
        $application = Application::find($application_id);
        
        $this->sendEmailToApplicant("solicitanteutp@gmail.com", $application, $this);
        
        $newStatusName = ApplicationStatus::where('id',$newStatus_id)->firstOrFail()->name;
        
        if($newStatusName == ApplicationStatus::TO_BE_APPROVED_BY_JEFE){
            $users = Role::where('name', Role::JEFE )->firstOrFail()->users;
            $jefeUnit = $application->unit_id;
            $jefes = $users->filter(function ($value ) use ($jefeUnit){
                return $value->unit_id == $jefeUnit;
            });
            $this->sendEmailToEvaluator($jefes, $application);
        }
        
        if($newStatusName == ApplicationStatus::TO_BE_APPROVED_BY_COMISSION_DE_VIAJES){
            $users = Role::where('name', Role::COMISSION_DE_VIAJES )->firstOrFail()->users;
            $this->sendEmailToEvaluator($users, $application);
        }
        
        if($newStatusName == ApplicationStatus::TO_BE_APPROVED_BY_RECTORIA){
            $users = Role::where('name', Role::RECTORIA )->firstOrFail()->users;
            $this->sendEmailToEvaluator($users, $application);
        }
    }
    
    public function sendEmailToEvaluator($recipients, $application){
        foreach($recipients as $recipient){
            Mail::to($recipient)->queue(new ApplicationEvaluation($application));
        }
    }
    
    public function sendEmailToApplicant($recipient, $application, $notification){
        Mail::to($recipient)->queue(new StatusChanged($application));
    }
    
}
