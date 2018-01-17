<div class="form-group bg-light rounded p-2">
    <label>{{trans('forms.minimum_requirements')}}:</label>
    <div class="d-block">
        @foreach($minimum_requirements_all as $requirement)
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" {{ in_array($requirement->name,$minimum_requirements_app) ? 'checked' : ''}} onclick="return false;"/>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$requirement->name}} </span>
        </label>
        @endforeach
    </div>
</div>