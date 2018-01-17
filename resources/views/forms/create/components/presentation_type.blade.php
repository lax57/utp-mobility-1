    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.presentation_type')}}</label>
        <div class="d-block">
            @foreach($presentation_types as $type)
            <label class="custom-control custom-radio">
                <input id="presentationTypeRadio1" name="presentation_type" type="radio" class="custom-control-input" value="{{$type->name}}" {{ Request::old('presentation_type') == $type->name ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            @endforeach
        </div>
    </div>