@component('forms.display.components.header')
    @slot('text') {{trans('forms.rectoria_evaluation')}} @endslot
@endcomponent

@component('forms.display.components.date_field')
    @slot('title'){{trans('forms.evaluation_date')}}@endslot
    @slot('date') {{$application->rectoriaEvaluation->evaluation_date}} @endslot
@endcomponent

@component('forms.display.components.textarea')
    @slot('title') {{trans('forms.observations')}} @endslot
    @slot('content') {{$application->rectoriaEvaluation->observations}} @endslot
@endcomponent
            
<!--UTP support-->
@component('forms.display.components.utp_support', ['types'=>$utp_support_types, 'utp_support'=>$utp_support_granted, 'amounts'=>$amounts_granted ])
    @slot('title') {{trans('forms.support_offered')}} @endslot
@endcomponent

@component('forms.display.components.approval', ['application'=>$application])
@endcomponent 
