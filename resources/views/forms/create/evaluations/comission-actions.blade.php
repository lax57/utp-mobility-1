@component('forms.display.components.header')
    @slot('text') {{trans('forms.comission_evaluation')}} @endslot
@endcomponent


<form action='{{route('evaluate_comission')}}' method='post'>
<!--Minimum Requirements-->
@component('forms.create.components.minimum_requirements', ['minimum_requirements_all' => $minimum_requirements_all])
@endcomponent

<!--Relevance Types-->
@component('forms.create.components.relevance_types', ['relevance_types' => $relevance_types])
@endcomponent

<!--Observations -->
@component('forms.create.components.observations')
@endcomponent

<!--Recommendacion-->
@component('forms.create.components.recommendation')
@endcomponent

<input hidden name='application_id' value="{{$application->id}}">
{{ csrf_field() }}

<a  href="{{route('show_applicants_history',['cedula'=>$application->user->id])}}" class="btn btn-warning text-white">
    {{trans('forms.see_history')}}
</a>

<button type="submit" class="btn btn-danger float-right">
    {{trans('forms.submit')}}
</button>

</form>