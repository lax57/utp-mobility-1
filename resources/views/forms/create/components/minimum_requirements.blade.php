<div class="form-group bg-light rounded p-2">
    <label>{{trans('forms.minimum_requirements')}}:</label>
    <div class="d-block">
        @foreach($minimum_requirements_all as $key=>$requirement)
        <label class="custom-control custom-checkbox">
            <input value="{{$requirement->name}}" name="minimum_requirements[]" type="checkbox" class="custom-control-input" @if(is_array(old('minimum_requirements')) && in_array($requirement->name, old('minimum_requirements'))) checked @endif />
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$requirement->name}}</span>
        </label>
        @endforeach
    </div>
</div>