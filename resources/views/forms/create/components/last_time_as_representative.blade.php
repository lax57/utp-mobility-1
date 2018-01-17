<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="col-6 py-2">
            <span class="custom-control-description active ">{{trans('form.last_representation')}}</span>
        </div>
        <div class="col-3 py-1">
            <div class='input-group date' id='mobility_start_date'>
                <input type="text" id="last_representation_date" name="date_of_last_mobility" class="form-control datepicker" placeholder="{{trans('form.date')}}" required value="{{ Request::old('date_of_last_mobility') }}" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>