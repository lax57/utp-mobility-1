@extends('forms.create.master')

@section('form-content')
<form role="form" action="{{route('application_store')}}" method="post" id="mainform">

    <!--RUTP-FV-2-->
    <!--Activity name assistant-->
    @component('forms.create.components.event_name')
    @endcomponent

    <!--Activity type-->
    @component('forms.create.components.event_types', ['event_types' => $event_types])
    @endcomponent

    <!--Training area-->
    @component('forms.create.components.training_area', ['training_area_types' => $training_area_types])
    @endcomponent

    <!--Scope of the event-->
    @component('forms.create.components.country_city', ['countries' => $countries])
    @endcomponent

    <!--Relation to event-->
    @component('forms.create.components.topic_function_relation', ['topic_function_relation_types' => $topic_function_relation_types])
    @endcomponent

    <!--Mobility dates-->
    @component('forms.create.components.mobility_dates')
    @endcomponent

    <!--Organizators help-->
    @component('forms.create.components.organizators_support', ['organisation_support_types' => $organisation_support_types])
    @endcomponent

    <!--UTP help-->
    @component('forms.create.components.utp_support', ['utp_support_types' => $utp_support_types])
    @endcomponent

    <!--Justification-->
    @component('forms.create.components.justification')
    @endcomponent
    
    <!--Buttons-->
    @component('forms.create.components.submit_buttons', ['application_type' => $application_type])
    @endcomponent


</form>
@endsection