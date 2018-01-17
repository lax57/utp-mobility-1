    @if(Auth::User()->isJefe() && $application->applicationStatus->name == App\ApplicationStatus::TO_BE_APPROVED_BY_JEFE)
        @component('forms.create.evaluations.jefe-actions', ['application_id'=>$application->id])
        @endcomponent
    @endif
    
    @if(Auth::User()->isComission() && $application->applicationStatus->name == App\ApplicationStatus::TO_BE_APPROVED_BY_COMISSION_DE_VIAJES)
        @component('forms.create.evaluations.comission-actions', ['application'=>$application, 'minimum_requirements_all'=>$minimum_requirements_all, 'relevance_types'=>$relevance_types])
        @endcomponent
    @endif
    

    @if($application->comissionEvaluation != null)
        @component('forms.display.evaluations.comission-evaluation', ['application'=>$application, 'minimum_requirements_all'=>$minimum_requirements_all, 'minimum_requirements_app'=>$minimum_requirements_app])
        @endcomponent
    @endif
                        
    @if(Auth::User()->isRectoria() && $application->applicationStatus->name == App\ApplicationStatus::TO_BE_APPROVED_BY_RECTORIA)
        @component('forms.create.evaluations.rectoria-actions', ['application'=>$application, 'utp_support'=>$utp_support, 'utp_support_types'=>$utp_support_types, 'amounts'=>$amounts])
        @endcomponent
    @endif
    
    @if($application->rectoriaEvaluation != null)
        @component('forms.display.evaluations.rectoria-evaluation', ['application'=>$application, 'utp_support_granted'=> $utp_support_granted, 'utp_support_types'=> $utp_support_types, 'amounts_granted'=>$amounts_granted])
        @endcomponent
    @endif