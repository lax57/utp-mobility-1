@extends('forms.display.master')

@section('form-content')
    @component('forms.display.components.header')
        @slot('text') {{trans('forms.applicants_data')}} @endslot
    @endcomponent
        <!--    Applicants name and cedula  -->
    @component('forms.display.components.basic_data')
        @slot('name') {{$application->user->name}} {{$application->user->last_name}} @endslot
        @slot('cedula') {{$application->user->cedula}} @endslot
    @endcomponent
    
    <!--  Position  -->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.position')}}
        @endslot
        {{"Student"}}
    @endcomponent
    
    <!--  Organisational Unit  -->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.unit')}}
        @endslot
        {{$application->user->unit->name}}
    @endcomponent

    @component('forms.display.components.header')
        @slot('text') {{trans('forms.application_information')}} @endslot
    @endcomponent

    <!--  Status and date of application  -->
    @component('forms.display.components.application_status')
        @slot('status') {{$application->applicationStatus->name}} @endslot
        @slot('date') {{$application->date_of_solicitude}} @endslot
    @endcomponent


    <!--  Event name  -->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.event_name')}}
        @endslot
        {{$application->event_name}}
    @endcomponent

    <!--Presentation title-->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.presentation_title')}}
        @endslot
        {{$application->presentation_title}}
    @endcomponent

    <!--Presentation type-->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.presentation_type')}}
        @endslot
        {{$application->presentationType->name}}
    @endcomponent


    <!--Other authors-->
    @component('forms.display.components.authors',['authors'=>$application->authors])
        @slot('title')
            {{trans('forms.other_work_authors')}}
        @endslot
    @endcomponent

    <!--Scope of the event-->
    @component('forms.display.components.country_city')
        @slot('country') {{$application->country->name}} @endslot
        @slot('city') {{$application->city}} @endslot
    @endcomponent

    <!--Relation to event -->
    @component('forms.display.components.data')
        @slot('title')
            {{trans('forms.topic_function_relation')}}
        @endslot
        {{$application->topicFunctionRelationType->name}}
    @endcomponent

   <!--Mobility dates-->
    @component('forms.display.components.mobility_dates')
        @slot('start_date') {{$application->start_date}} @endslot
        @slot('finish_date') {{$application->finish_date}} @endslot
    @endcomponent
    
    <!--Justification RUTP-FV-1-->
    @component('forms.display.components.textarea')
        @slot('title') {{trans('forms.justification')}} @endslot
        @slot('content') {{$application->justification}} @endslot
    @endcomponent

    <!--Last time as representative-->
    @component('forms.display.components.date_field')
        @slot('title'){{trans('forms.last_representation')}}@endslot
        @slot('date') {{$application->last_time_as_representative}} @endslot
    @endcomponent

    <!--Organizators support-->
    @component('forms.display.components.organizators_support', ['types'=>$organisation_support_types, 'appOrgSupport'=>$appOrgSupport])
    @endcomponent

    <!--UTP support-->
    @component('forms.display.components.utp_support', ['types'=>$utp_support_types, 'utp_support'=>$utp_support, 'amounts'=>$amounts ])
        @slot('title') {{trans('forms.UTP_support')}} @endslot
    @endcomponent
    
    <!--Evaluation components-->
    @component('forms.display.all_evaluations', ['application'=>$application, 'minimum_requirements_all'=>$minimum_requirements_all, 'minimum_requirements_app'=>$minimum_requirements_app, 'utp_support'=>$utp_support, 'utp_support_types'=>$utp_support_types, 'amounts'=>$amounts,
                                                    'utp_support_granted'=>$utp_support_granted, 'amounts_granted'=>$amounts_granted, 'relevance_types'=>$relevance_types])
    @endcomponent
    

@endsection