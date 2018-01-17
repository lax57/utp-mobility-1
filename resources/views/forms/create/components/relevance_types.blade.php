    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.specify_relevance')}}:</label>
        <div class="d-block">
            @foreach($relevance_types as $type)
            <label class="custom-control custom-radio">
                <input id="presentationTypeRadio1" name="relevance_type" type="radio" class="custom-control-input" value="{{$type->name}}" {{ Request::old('relevance_type') == $type->name ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            @endforeach
        </div>
    </div>