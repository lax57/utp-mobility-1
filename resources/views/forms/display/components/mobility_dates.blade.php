<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="col-4 py-1">
            <span class="custom-control-description active">{{trans('forms.mobility_date')}}</span>
        </div>
        <div class="col-3">
            <div class='input-group date' id='mobility_start_date'>
                <input type="text" class="form-control" value="{{$start_date}}" readonly/ />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
        <span class="mx-3 py-1">a</span>
        <div class="col-3 ">
            
            <div class='input-group date' id='mobility_finish_date'>
                <input type='text' class="form-control" value="{{ $finish_date }}" readonly />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>