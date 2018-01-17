<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="col-4 py-1">
            <span class="custom-control-description active">{{trans('forms.mobility_date')}}</span>
        </div>
        <div class="col-3">
            <div class='input-group date' id='mobility_start_date'>
                <input type="text" id="start_datepicker" class="form-control datepicker {{$errors->has('start_date')? 'border-danger' : ''}}" name="start_date" placeholder="{{trans('forms.start')}}" value="{{ Request::old('start_date') }}" required/ />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
        <div class="col-3 ">
            <div class='input-group date' id='mobility_finish_date'>
                <input type='text' id="finish_datepicker" class="form-control datepicker {{$errors->has('finish_date')? 'border-danger' : ''}}" name="finish_date" placeholder="{{trans('forms.finish')}}" value="{{ Request::old('finish_date') }}" required />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>