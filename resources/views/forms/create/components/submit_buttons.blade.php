<input type="hidden" name="_token" value=" {{Session::token() }} " />
<input type="hidden" name="type" value=" {{$application_type}} " />

<button type="submit" class="btn btn-danger" style="display:none" id="submitButton">
    {{trans('forms.submit_button_text')}}
</button>
<input type="button" name="submitBtn" value="{{trans('forms.submit_button_text')}}" id="submitBtn" class="btn btn-danger" />