    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.UTP_support')}}</label>
        @foreach($utp_support_types as $key=>$type)
        <div class="d-block d-block row ml-0">
            <label class="custom-control custom-checkbox col-3">
                <input  name="utp_support[]" type="checkbox" value="{{$type->name}}" class="custom-control-input amount-possible" @if(is_array(old('utp_support')) && in_array($type->name, old('utp_support'))) checked @endif />
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">{{$type->name}}</span>
            </label>
            <label class="custom-control pl-0 col-3" @if($type->amount_possible==0) style="display:none" @endif>
                <span class="custom-control-description mt-1 mr-3">{{trans('forms.amount')}}:</span>
                <input type="text" placeholder="0.00" class="form-control amount-input {{$errors->has('support_solicitude.'.$key)? 'border-danger' : ''}}" name="support_solicitude[]" value="{{Request::old('support_solicitude')[$key] }}" {{ Request::old('support_solicitude')[$key] !=null ?  : 'readonly'}}/>
            </label>
        </div>
        @endforeach
    </div>