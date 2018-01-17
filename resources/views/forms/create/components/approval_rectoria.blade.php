    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.recommendation')}}</label>
        <div class="d-block">
            <label class="custom-control custom-radio">
                <input  name="approval_rectoria" type="radio" class="custom-control-input" value="1" {{ Request::old('approval_rectoria') == trans('form.approved') ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{trans('forms.approved')}}</span>
            </label>
            <label class="custom-control custom-radio">
                <input  name="approval_rectoria" type="radio" class="custom-control-input" value="0" {{ Request::old('approval_rectoria') == trans('form.notapproved') ? 'checked' : '' }} required />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{trans('forms.notapproved')}}</span>
            </label>
        </div>
    </div>