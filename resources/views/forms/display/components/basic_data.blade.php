<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="col-1 pt-2">
            <span class="custom-control-description active">{{trans('forms.name')}}: </span>
        </div>
        <div class="col-5">
            <div class='input-group date'>
                <input type="text" class="form-control" value="{{$name}}" readonly />
            </div>
        </div>
        <div class="col-2 pt-2">
            <span class="custom-control-description active float-right">{{trans('forms.cedula')}}: </span>
        </div>
        <div class="col-3 ">
            <div class='input-group date'>
                <input type='text' class="form-control" value="{{ $cedula }}" readonly />
            </div>
        </div>
    </div>
</div>