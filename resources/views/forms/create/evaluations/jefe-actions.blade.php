@component('forms.display.components.header')
    @slot('text') {{trans('forms.jefe_evaluation')}} @endslot
@endcomponent

<div class="form-group bg-light rounded p-2">
    <label for="jefe_buttons">{{trans('forms.accept_question')}}</label>
        <div class="row">
            <form class="col-4 mx-auto" action='{{route('evaluateJefe')}}' method="post">
                <input hidden name='application_id' value="{{$application_id}}">
                <input hidden name='approved' value='1'>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success w-100">{{trans('forms.yes')}}</button>
            </form >
            <form class="col-4 mx-auto" action='{{route('evaluateJefe')}}' method="post">
                <input hidden name='application_id' value="{{$application_id}}">
                <input hidden name='approved' value='0'>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger w-100">{{trans('forms.no')}}</button>
            </form >
        </div>
</div>
