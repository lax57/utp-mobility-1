    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.recommendation')}}</label>
        <div class="d-block">
            <label class="custom-control custom-radio">
                <input  name="recommendation" type="radio" class="custom-control-input" value="1" {{ Request::old('recommendation') == trans('form.recommended') ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{trans('forms.recommended')}}</span>
            </label>
            <label class="custom-control custom-radio">
                <input  name="recommendation" type="radio" class="custom-control-input" value="0" {{ Request::old('recommendation') == trans('form.notrecommended') ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{trans('forms.notrecommended')}}</span>
            </label>
        </div>
    </div>