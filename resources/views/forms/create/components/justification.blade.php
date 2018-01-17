<div class="form-group bg-light rounded p-2">
    <label for="justification">{{trans('forms.justification')}}</label>
    <textarea class="form-control {{$errors->has('justification')? 'border-danger' : ''}}" id="justification" name="justification" placeholder="Ingrese la justificion" required rows="5" required /> {{ Request::old('justification') }}</textarea>
</div>