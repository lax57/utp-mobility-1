<div class="form-group bg-light rounded p-2">
    <label>{{trans('forms.organizators_support')}}</label>
    <div class="d-block">
        @foreach($types as $type)
        <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" {{ in_array($type->name,$appOrgSupport) ? 'checked' : ''}} onclick="return false;"/>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$type->name}} </span>
        </label>
        @endforeach
    </div>
</div>