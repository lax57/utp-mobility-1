    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.topic_function_relation')}}</label>
        <div class="d-block">
            @foreach($topic_function_relation_types as $key=>$type)
            <label class="custom-control custom-radio">
                <input id="relationToEvent1Radio{{$key+1}}" name="topic_function_relation" type="radio" class="custom-control-input" value="{{$type->name}}" {{ Request::old('topic_function_relation') == $type->name ? 'checked' : '' }} required/>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            @endforeach
        </div>
    </div>