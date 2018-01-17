<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="col-9">
            <span class="custom-control-description active">{{trans('forms.status')}}: </span>
            <div class='input-group date'>
                <input type="text" class="form-control" value="{{$status}}" readonly />
            </div>
        </div>
        <div class="col-3 ">
            <span class="custom-control-description active">{{trans('forms.application_date')}}: </span>
            <div class='input-group date'>
                <input type='text' class="form-control" value="{{ $date }}" readonly />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>