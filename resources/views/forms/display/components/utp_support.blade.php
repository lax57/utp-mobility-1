<div class="form-group bg-light rounded p-2">
    <label>{{$title}}:</label>
    @foreach($types as $type)
    <div class="d-block d-block row ml-0">
        <label class="custom-control custom-checkbox col-3">
            <input type="checkbox" class="custom-control-input amount-possible" {{ in_array($type->name,$utp_support) ? 'checked' : ''}} onclick="return false;"/>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$type->name}}</span>
        </label>
        <label class="custom-control pl-0 col-3" @if($type->amount_possible==0) style="display:none" @endif>
            <span class="custom-control-description mt-1 mr-3">{{trans('forms.amount')}}:</span>
            <input type="text" placeholder="0.00" class="form-control amount-input" value="{{ in_array($type->name,$utp_support) ?  $amounts[array_search($type->name, $utp_support)] : '' }}" readonly/>
        </label>
    </div>
    @endforeach
</div>