<div class="form-group bg-light rounded p-2">
    <label for="observations">{{trans('forms.observations')}}:</label>
    <textarea class="form-control {{$errors->has('observations')? 'border-danger' : ''}}"  name="observations" placeholder="Ingrese los observaciones" required rows="5" required /> {{ Request::old('observations') }}</textarea>
</div>