@extends('forms.create.master')

@section('form-content')
<form role="form" action="{{route('application_store')}}" method="post" id="mainform">
                            
    <!--RUTP-FV-4-->
    <!--Activity name-->
    @component('forms.create.components.event_name')
    @endcomponent

    <!--Activity type-->
    @component('forms.create.components.event_types', ['event_types' => $event_types])
    @endcomponent

    <!--Scope of the event-->
    @component('forms.create.components.country_city', ['countries' => $countries])
    @endcomponent


    <!--Mobility dates-->
    @component('forms.create.components.mobility_dates')
    @endcomponent

    <!--Organizators help-->
    @component('forms.create.components.organizators_support', ['organisation_support_types' => $organisation_support_types])
    @endcomponent

    <!--UTP support-->
    @component('forms.create.components.utp_support', ['utp_support_types' => $utp_support_types])
    @endcomponent

    <!--Justification RUTP-FV-2-->
    @component('forms.create.components.justification')
    @endcomponent

    <!--Buttons-->
    @component('forms.create.components.submit_buttons', ['application_type' => $application_type])
    @endcomponent
</form>
@endsection