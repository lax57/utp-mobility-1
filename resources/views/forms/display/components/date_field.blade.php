<div class="form-group bg-light rounded p-2">
    <div class="form-row">
        <div class="w-auto py-2 px-2">
            <span class="custom-control-description active ">{{$title}}: </span>
        </div>
        <div class="col-3 py-0">
            <div class='input-group date' id='mobility_start_date'>
                <input type="text" class="form-control" readonly value="{{ $date}}" />
                <span class="input-group-addon">
                    <span class="fa fa-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>