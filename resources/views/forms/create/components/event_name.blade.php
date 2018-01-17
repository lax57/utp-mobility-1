
<div class="form-group bg-light rounded p-2">
    <label for="event_name">{{trans('forms.event_name')}}</label>
    <input class="form-control {{$errors->has('event_name')? 'border-danger' : ''}}" id="event_name" name="event_name" placeholder="{{trans('forms.event_name_placeholder')}}" value="{{ Request::old('event_name') }}" required />
</div>