@component('forms.display.components.header')
    @slot('text') {{trans('forms.rectoria_evaluation')}} @endslot
@endcomponent

<form action='{{route('evaluate_rectoria')}}' method='post'>
<!--Observations -->
@component('forms.create.components.observations')
@endcomponent

<!--UTP help-->
@component('forms.create.components.utp_support_granted', ['utp_support_types'=>$utp_support_types, 'utp_support'=>$utp_support, 'amounts'=>$amounts ])
@endcomponent

<!--Approval -->
@component('forms.create.components.approval_rectoria')
@endcomponent

<input hidden name='application_id' value="{{$application->id}}">
{{ csrf_field() }}

<button type="submit" class="btn btn-danger">
    {{trans('forms.submit')}}
</button>
</form>