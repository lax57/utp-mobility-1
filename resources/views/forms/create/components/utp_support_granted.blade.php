<div class="form-group bg-light rounded p-2">
    <div class='row'>
        <label class='col-5'>{{trans('forms.UTP_support')}}:</label>
        <label class='col-6'>{{trans('forms.support_offered')}}:</label>
    </div>
    
    @foreach($utp_support_types as $key => $type)
    <div class="d-block d-block row ml-0">
        <label class="custom-control custom-checkbox col-3">
            <input type="checkbox" class="custom-control-input amount-possible" {{ in_array($type->name,$utp_support) ? 'checked' : ''}} onclick="return false;"/>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$type->name}}</span>
        </label>
        <label class="custom-control pl-0 col-2" >
            <span class="custom-control-description mt-1 mr-3" @if($type->amount_possible==0) style="display:none" @endif>{{trans('forms.amount')}}:</span>
            <input type="text" placeholder="0.00" class="form-control amount-input" @if($type->amount_possible==0) style="display:none" @endif value="{{ in_array($type->name,$utp_support) ?  $amounts[array_search($type->name, $utp_support)] : '' }}" readonly/>
        </label>
        @if(in_array($type->name,$utp_support))
        <label class="custom-control custom-checkbox col-3">
            <input  name="utp_support_offered[]" type="checkbox" value="{{$type->name}}" class="custom-control-input amount-possible" />
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{$type->name}}</span>
        </label>
        <label class="custom-control pl-0 col-3" @if($type->amount_possible==0) style="display:none" @endif>
            <span class="custom-control-description mt-1 mr-3">{{trans('forms.amount')}}:</span>
            <input type="text" placeholder="0.00" class="form-control amount-input {{$errors->has('support_solicitude.'.$key)? 'border-danger' : ''}}" name="support_amount_offered[]" value="0.00"/>
        </label>
        @endif
    </div>
    @endforeach
</div>