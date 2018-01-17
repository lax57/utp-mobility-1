<?php
namespace App\Http\Controllers;
use App\Inform;
use App\Application;
use App\Permission;
use App\ApplicationStatus;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class InformController extends Controller
{
    private $inform_folder = "informs";
    
    public function updateInform(Request $request, $application){
        $inform = $application->inform;
        Storage::delete($inform->file);
        
        $inform->date_inform = date("Y-m-d");
        $inform->file = $request->file('inform')->store($this->inform_folder);
        $inform->save();
        
        Session::flash('msg', "Inform successfully updated");
        
    }

    public function uploadNewInform(Request $request, $application){
        
        $inform = new Inform();
        $inform->application()->associate($application);
        $inform->date_inform = date("Y-m-d");
        $inform->file = $request->file('inform')->store($this->inform_folder);
        

        $today = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
        $mobilityFinishDate = DateTime::createFromFormat('Y-m-d', $application->finish_date);
        $interval = $mobilityFinishDate->diff($today)->format("%r%a");
        $interval  >= 15 || (int)$interval <= 0 ? $inform->within_deadline = 0 : $inform->within_deadline = 1;
        
        $inform->save();
        
        $newStatusId = $application->applicationType->nextStatusId($application->applicationStatus);
        $application->changeStatus($newStatusId, Auth::user()->id);
        
        Session::flash('msg', "Inform successfully uploaded");
        
    }



    public function uploadInform(Request $request){
        //TODO: check if the application belongs to logged in user 
        $this->validate($request, [
            'inform'=> 'required|file|max:1024|mimes:pdf'
        ]);
        
        $application = Application::where('id', $request['application_id'])->firstOrFail();
        
        if((($application->inform ==null && $application->withinDeadline()) || $application->withinDeadline() || $application->applicationStatus-> name == ApplicationStatus::FEEDBACK_REQUIRED) && Auth::user()->hasPermission(Permission::CREATE_APPLICATION)) 
        {
            if($application->inform == null ) $this->uploadNewInform($request, $application);
            else $this->updateInform($request, $application);
            return redirect()->back();
        }else {
            return redirect()->back();
        }
           
    }
    
    
    private function hasPermissionToDownloadInform($application){
        if(Auth::User()->isAdmin() || Auth::User()->isComission() || Auth::User()->isRectoria()){
            return true;
        }elseif(Auth::User()->isJefe()){
            return $application->unit_id == Auth::User()->unit_id ? true : false;
        //TODO check if users cedula and application cedula match
        }elseif(Auth::User()->isSolicitante()){
            return true;
        }else 
            return false;
    }
    
    public function downloadInform($application_id){
        $application = Application::where('id', $application_id)->firstOrFail();
        if($this->hasPermissionToDownloadInform($application)){
            $file = storage_path().'/app/'. $application->inform->file;
            return response()->download($file);
        }else 
            abort(404);
    }
    
}