
<div class="form-group bg-light rounded p-2">
    <label>{{trans('forms.organizators_support')}}</label>
    <div class="d-block">
        @foreach($organisation_support_types as $key=>$type)
        <label class="custom-control custom-checkbox">
            <input value="{{$type->name}}" name="organisators_support[]" type="checkbox" class="custom-control-input" @if(is_array(old('organisators_support')) && in_array($type->name, old('organisators_support'))) checked @endif />
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$type->name}}</span>
        </label>
        @endforeach
    </div>
</div>