<?php
namespace App\Http\Controllers;
use App\Application;
use App\ApplicationAuthor;
use App\ApplicationStatus;
use App\EventType;
use App\ApplicationType;
use App\PresentationType;
use App\TopicFunctionRelationType;
use App\OrganisationSupportType;
use App\UtpSupportType;
use App\TrainingAreaType;
use App\Country;
use App\Unit;
use App\Notification;
use App\MinimumRequirement;
use App\RelevanceType;
use App\ComissionEvaluation;
use App\RectoriaEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class ApplicationController extends Controller
{
    private $cedula = "20-57-4151";
    private $aplicants_name = "Mateusz";
    private $aplicants_surname = "Antczak";
    private $organizational_unit_id = 1;
    private $position = "Student";
    private $carrera = "Gestion Administrativa";


    public function getApplicationCreateView($application_type)
    {
        if (ApplicationType::where('name', '=', $application_type)->exists()) {
            $presentationTypes = PresentationType::all();
            $topicFunctionRelationTypes = TopicFunctionRelationType::all();
            $organisationSupportTypes = OrganisationSupportType::all();
            $utpSupportTypes = UtpSupportType::all();
            $eventTypes = EventType::all();
            $trainingAreaTypes = TrainingAreaType::all();
            $countries = Country::orderBy('name')->get();
            
            return view('forms.create.' . $application_type, ['application_type' => $application_type,
                'presentation_types' => $presentationTypes,
                'topic_function_relation_types' => $topicFunctionRelationTypes,
                'organisation_support_types' => $organisationSupportTypes,
                'utp_support_types' => $utpSupportTypes,
                'event_types' => $eventTypes,
                'training_area_types'=>$trainingAreaTypes,
                'countries'=>$countries
                ]);
        } else {
            abort(404);
        }
    }

    private function saveOrganizatorsHelp($application, $request){
        foreach($request["organisators_support"] as $support){
            $type = OrganisationSupportType::where('name', $support)->firstOrFail();
            $application->organisationSupportTypes()->attach($type);
        }
    }
    
    private function saveFinancialSolicitude($application, $request){
        $amounts =[];
        foreach($request['support_solicitude'] as $amount){
            if($amount!=null) array_push($amounts, $amount);
        }
        foreach($request["utp_support"] as $key=>$support){
            $type = UtpSupportType::where('name', $support)->firstOrFail();
            $application->utpSupportSolicitudeTypes()->attach($type, ['amount_solicitude'=> $amounts[$key]]);
        }
    }
    
    private function lastParticipationDate($application, $request){
        $historicalStatusId = ApplicationStatus::getStatusId(ApplicationStatus::HISTORICAL);
        
        $applicationLastDate = Application::where([
                ['user_id', '=', Auth::user()->id],
                ['application_status_id', '=', $historicalStatusId],
            ])->orderBy('finish_date', 'desc')->first();
        
        if($applicationLastDate!=null)
            $application->last_time_as_representative=$applicationLastDate->finish_date;
        else
            $application->last_time_as_representative=null;
    }
    
    private function saveOtherAuthors($application, $request){
        foreach($request["other_work_authors"] as $key=>$author){
            $otherAuthor = new ApplicationAuthor();
            $otherAuthor->author_cedula = $author;
            $otherAuthor->application()->associate($application);
            $otherAuthor->save();
        }
    }
    
    private function storeApplication(Request $request){

        $this->validate($request, [
            'event_name'=> 'required|max:150|min:2',
            'presentation_title'=>'max:200|min:2',
            'country'=>'required',
            'city_of_mobility'=>'min:2|max:60',
            'other_work_authors.*'=>'min:2|max:10|required',
            'start_date'=>'required|date|after:today',
            'finish_date'=>'required|date|after_or_equal:start_date',
            'support_solicitude.*'=>'nullable|numeric|between:0,10000',
            'justification'=>'required|min:2|max:500',
        ]);
        
        $application = new Application();
        
        //Parameters ALWAYS saved with application (no matter application type)
        //TODO: Get current logged in cedula and assign it to the application
        $application->user_id=Auth::user()->id;
        $application->date_of_solicitude= date("Y-m-d");
        $this->lastParticipationDate($application, $request);
        
        
        
        //Parameters from different forms
        if(isset($request["event_name"]))
            $application->event_name=$request["event_name"];
        if(isset($request["presentation_title"]))
            $application->presentation_title=$request["presentation_title"];
        if(isset($request["city_of_mobility"]))
            $application->city=$request["city_of_mobility"];
        if(isset($request["start_date"]))
            $application->start_date=$request["start_date"];
        if(isset($request["finish_date"]))
            $application->finish_date=$request["finish_date"];
        if(isset($request["justification"]))
            $application->justification=$request["justification"];
        

        if(isset($request["presentation_type"])){
            $presentationType = PresentationType::where('name', $request["presentation_type"])->firstOrFail();
            $application->presentationType()->associate($presentationType);
        }
        
        if(isset($request["event_type"])){
            $eventType = EventType::where('name', $request["event_type"])->firstOrFail();
            $application->eventType()->associate($eventType);
        }
        
        if(isset($request["training_area"])){
            $trainingAreaType = TrainingAreaType::where('name', $request["training_area"])->firstOrFail();
            $application->trainingAreaType()->associate($trainingAreaType);
        }
        
        if(isset($request['country'])){
            $country = Country::where('name', $request['country'])->firstOrFail();
            $application->country()->associate($country);
        }
        
        if(isset($request["topic_function_relation"])){
            $topicFunctionRelation = TopicFunctionRelationType::where('name', $request["topic_function_relation"])->firstOrFail();
            $application->topicFunctionRelationType()->associate($topicFunctionRelation);
        }
        
        if(isset($request["type"])){
            $applicationType = ApplicationType::where('name', $request["type"])->firstOrFail();
            $application->applicationType()->associate($applicationType);
        }
        
        
        $firstStatusId = $application->applicationType->firstStatusId();
        
        DB::beginTransaction();
        
        $application->save();

        //Related tables parameters
        if(isset($request["organisators_support"])) 
            $this->saveOrganizatorsHelp($application, $request);
        if(isset($request["utp_support"]))
            $this->saveFinancialSolicitude($application, $request);
        if(isset($request["other_work_authors"])) 
            $this->saveOtherAuthors($application, $request);
        
        
        $application->changeStatus($firstStatusId, Auth::user()->id);
        
        DB::commit();
        
    }

    public function store(Request $request)
    {
        if(ApplicationType::where('name', $request['type'])->exists()){
            $this->storeApplication($request);
            return redirect()->route('my_applications');
        }else{
            return abort(404);
        }
    }
    

    public function getUserApplications(){
        $applications;
        if(Auth::user()->isAdmin()) {
            $applications = Application::all();
        }elseif(Auth::user()->isJefe()){
            $unitId = Auth::user()->unit->id; 
            $applications = Unit::find($unitId)->applications;
        }elseif(Auth::user()->isComission()){
            $applications = Application::all();
        }elseif(Auth::user()->isRectoria()) {
            $applications = Application::all();
        }elseif(Auth::user()->isSolicitante()){
            //TODO: only applications of applicant!!
            $applications = Application::where('user_id', Auth::user()->id)->get();
        }
        return view('myapplications',['applications'=>$applications]);
    }
    
    public function showApplicantsHistory($user_id){
        $applications;
        $historicalStatusId = ApplicationStatus::getStatusId(ApplicationStatus::HISTORICAL);
        $rejectedStatusId = ApplicationStatus::getStatusId(ApplicationStatus::REJECTED);
        if(Auth::user()->isComission()) {
            $applications = Application::where([
                ['application_status_id', '=', $historicalStatusId],
                ['user_id','=',$user_id]])->orWhere([
                ['application_status_id', '=', $rejectedStatusId], 
                ['user_id','=',$user_id]
                ])->get();
        return view('myapplications',['applications'=>$applications]);
        } else 
            abort(404);
    }
    
    
    
    public function getApplicationsForEvaluation(){
        $applications;

        
        if(Auth::user()->isAdmin()) {
            $applications = Application::all();
        }elseif(Auth::user()->isJefe()){
            $unitId = Auth::user()->unit->id; 
            $applications = Unit::find($unitId)->applications->filter(function ($app) {
                return $app->application_status_id == 
                        ApplicationStatus::getStatusId(ApplicationStatus::TO_BE_APPROVED_BY_JEFE);
            });
        }elseif(Auth::user()->isComission()){
            $applications = Application::where('application_status_id',
                    ApplicationStatus::getStatusId(ApplicationStatus::TO_BE_APPROVED_BY_COMISSION_DE_VIAJES))->get();
        }elseif(Auth::user()->isRectoria()) {
            $applications = Application::where('application_status_id',
                    ApplicationStatus::getStatusId(ApplicationStatus::TO_BE_APPROVED_BY_RECTORIA))->get();
        }
        return view('evaluation.evaluation_list',['applications'=>$applications]);
    }
    
    private function hasPermissionToSeeApplication($application){
        if(Auth::User()->isAdmin()){
            return true;
        }elseif(Auth::User()->isJefe()){
            if(Auth::User()->unit_id == $application->user->unit_id){
                return true;
            }
            //TODO: Comission have access to all applications because of history! 
        }elseif(Auth::User()->isComission()){
            return true;
        }elseif(Auth::User()->isRectoria()){
            return true;
        }elseif (Auth::User()->isSolicitante()){
            //TODO: check if cedula match with cedula of application
            return $application->user_id == Auth::user()->id;
        }else {
            return false; 
        }
    }
    
    
    public function showApplication($application_id){
        $application = Application::where('id', $application_id)->firstOrFail();
        if($this->hasPermissionToSeeApplication($application)){
            $application = Application::findOrFail($application_id);
            $organisationSupportTypes = OrganisationSupportType::all();
            $utpSupportTypes = UtpSupportType::all();
        
            $appOrgSupport =[];
            if($application->utpSupportSolicitudeTypes!=null){  
                foreach($application->organisationSupportTypes as $org){
                    array_push($appOrgSupport, $org->name);
                }
            }

            $utpSupport =[];
            $amounts =[];
            if($application->utpSupportSolicitudeTypes!=null){      
                foreach($application->utpSupportSolicitudeTypes as $utpS){
                    array_push($utpSupport, $utpS->name);
                    array_push($amounts,$utpS->pivot->amount_solicitude);
                }
            }

            $minimum_requirements_all = MinimumRequirement::all();
            $minimum_requirements_app =[];
            if($application->comissionEvaluation!=null){        
                foreach($application->comissionEvaluation->minimumRequirements as $min){
                array_push($minimum_requirements_app, $min->name);
                }
            }
            
            $amounts_granted =[];
            $utp_support_granted =[];
            if($application->utpSupportGrantedTypes!=null){      
                foreach($application->utpSupportGrantedTypes as $utpSG){
                    array_push($utp_support_granted, $utpSG->name);
                    array_push($amounts_granted,$utpSG->pivot->amount_granted);
                }
            }

            $relevanceTypes = RelevanceType::all();

            return view('forms.display.'.$application->applicationType->name,
                    ['application'=>$application,
                    'organisation_support_types' => $organisationSupportTypes,
                    'utp_support_types' => $utpSupportTypes,
                    'appOrgSupport'=>$appOrgSupport,
                    'utp_support'=>$utpSupport,
                    'amounts'=>$amounts,
                    'minimum_requirements_all'=>$minimum_requirements_all,
                    'minimum_requirements_app'=>$minimum_requirements_app,
                    'relevance_types'=>$relevanceTypes,
                    'amounts_granted'=>$amounts_granted,
                    'utp_support_granted'=>$utp_support_granted
                        ]);
        }else {
            return abort(404);
        }
    }
    
    public function evaluateApplicationJefe(Request $request){
        // TODO: check if application is from correct unit 
        $application = Application::where('id',$request['application_id'])->firstOrFail();
        if(Auth::User()->isJefe() && Auth::User()->unit == $application->user->unit  
                && $application->applicationStatus->name == ApplicationStatus::TO_BE_APPROVED_BY_JEFE){
            
            $newStatusId;
            if($request['approved'] == 1)
                $newStatusId = $application->applicationType->nextStatusId($application->applicationStatus);
            else 
                $newStatusId = ApplicationStatus::where('name', ApplicationStatus::REJECTED)->firstOrFail()->id;
            
            $application->changeStatus($newStatusId, Auth::user()->id);

            Session::flash('msg', "Application status successfuly updated");
            
            return redirect()->route('evaluate_list');
        }else{
            return redirect()->back();
        }
    }
    
    public function evaluateApplicationComission(Request $request){
        
        $application = Application::where('id',$request['application_id'])->firstOrFail();
        if(Auth::User()->isComission() && $application->applicationStatus->name == ApplicationStatus::TO_BE_APPROVED_BY_COMISSION_DE_VIAJES){
            
            $newStatusId = $application->applicationType->nextStatusId($application->applicationStatus);
            
            $comission_evaluation = new ComissionEvaluation();
            
            if(isset($request["relevance_type"])){
                $relevanceType = RelevanceType::where('name', $request["relevance_type"])->firstOrFail();
                $comission_evaluation->relevanceType()->associate($relevanceType);
            }
            
            if(isset($request["recommendation"])){
                $comission_evaluation->recommendation = $request["recommendation"];
            }
            
            if(isset($request["observations"])){
                $comission_evaluation->observations = $request["observations"];
            }
            
            $comission_evaluation->user()->associate(Auth::user());
            $comission_evaluation->application()->associate($application);
            $comission_evaluation->evaluation_date=date("Y-m-d");
            
            DB::beginTransaction();
            $comission_evaluation->save();
            
            foreach($request["minimum_requirements"] as $requirement){
                $type = MinimumRequirement::where('name', $requirement)->firstOrFail();
                $comission_evaluation->minimumRequirements()->attach($type);
            }
            DB::commit();
            
            $application->changeStatus($newStatusId, Auth::user()->id);
            
            Session::flash('msg', "Application status successfuly updated");
            return redirect()->route('evaluate_list');
        }else{
            return redirect()->back();
        }
    }
    
    public function evaluateApplicationRectoria(Request $request){
        
        $this->validate($request, [
            'approval_rectoria'=> 'required',
            'support_amount_offered.*'=>'nullable|numeric|between:0,10000',
        ]);
        
        $application = Application::where('id',$request['application_id'])->firstOrFail();
        if(Auth::User()->isrectoria() && $application->applicationStatus->name == ApplicationStatus::TO_BE_APPROVED_BY_RECTORIA){
            
            $newStatusId;
            if($request['approval_rectoria'] == 1)
                $newStatusId = $application->applicationType->nextStatusId($application->applicationStatus);
            else 
                $newStatusId = ApplicationStatus::where('name', ApplicationStatus::REJECTED)->firstOrFail()->id;
            
            $rectoria_evaluation = new RectoriaEvaluation();
            $rectoria_evaluation->evaluation_date=date("Y-m-d");
            
            if(isset($request["approval_rectoria"])){
                $rectoria_evaluation->approved = $request["recommendation"];
            }
            
            if(isset($request["observations"])){
                $rectoria_evaluation->observations = $request["observations"];
            }
            
            $rectoria_evaluation->application()->associate($application);
            $rectoria_evaluation->user()->associate(Auth::user());
            $rectoria_evaluation->approved = $request['approval_rectoria'];
            
            DB::beginTransaction();
            $rectoria_evaluation->save();
            if(isset($request["utp_support_offered"])){
                foreach($request["utp_support_offered"] as $key=>$support){
                    $type = UtpSupportType::where('name', $support)->firstOrFail();
                    $application->utpSupportGrantedTypes()->attach($type, ['amount_granted'=> $request['support_amount_offered'][$key]]);
                }
            }
            DB::commit();
            
            $application->changeStatus($newStatusId, Auth::user()->id);

            Session::flash('msg', "Application status successfuly updated");
            return redirect()->route('evaluate_list');
        }else{
            return redirect()->back();
        }
    }
    
    public function getApplicationFormTypes(){
        //TODO: filter application depending on loggined in user
        
        $applicationTypes = ApplicationType::all();
        
        return view('newmobility', ['applicationTypes'=>$applicationTypes]);
    }
}