    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.event_type')}}</label>
        <div class="d-block">
            @foreach($event_types as $key=>$type)
            <label class="custom-control custom-radio">
                <input id="eventTypeRadio{{$key+1}}" name="event_type" type="radio" class="custom-control-input" value="{{$type->name}}" {{ Request::old('event_type')== $type->name ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            @endforeach
        </div>
    </div>