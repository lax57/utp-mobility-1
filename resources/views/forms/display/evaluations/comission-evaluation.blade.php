        @component('forms.display.components.date_field')
            @slot('title'){{trans('forms.evaluation_date')}}@endslot
            @slot('date') {{$application->comissionEvaluation->evaluation_date}} @endslot
        @endcomponent


        @component('forms.display.components.header')
            @slot('text') {{trans('forms.comission_evaluation')}} @endslot
        @endcomponent
    
        @component('forms.display.components.data')
            @slot('title')
                {{trans('forms.specify_relevance')}}
            @endslot
            {{$application->comissionEvaluation->relevanceType->name}}
        @endcomponent
        
        @component('forms.display.components.minimum_requirements', ['minimum_requirements_all'=>$minimum_requirements_all, 'minimum_requirements_app'=>$minimum_requirements_app])
        @endcomponent
        
        @component('forms.display.components.textarea')
            @slot('title') {{trans('forms.observations')}} @endslot
            @slot('content') {{$application->comissionEvaluation->observations}} @endslot
        @endcomponent
        
        @component('forms.display.components.date_field')
            @slot('title'){{trans('forms.evaluation_date')}}@endslot
            @slot('date') {{$application->comissionEvaluation->evaluation_date}} @endslot
        @endcomponent

        
        @component('forms.display.components.recommendation', ['application'=>$application])
        @endcomponent 