    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.training_area')}}</label>
        <div class="d-block">
            @foreach($training_area_types as $type)
            <label class="custom-control custom-radio">
                <input id="trainingAreaRadio1" name="training_area" type="radio" class="custom-control-input" value="{{$type->name}}" {{ request::old('training_area')== $type->name ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            @endforeach
        </div>
    </div>