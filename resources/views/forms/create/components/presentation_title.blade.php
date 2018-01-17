    <div class="form-group bg-light rounded p-2">
        <label for="presentation_title">{{trans('forms.presentation_title')}}</label>
        <input class="form-control {{$errors->has('presentation_title')? 'border-danger' : ''}}" id="presentation_title" name="{{trans('forms.presentation_title_placeholder')}}" placeholder="Ingrese el titulo" value="{{ Request::old('presentation_title') }}" required />
    </div>