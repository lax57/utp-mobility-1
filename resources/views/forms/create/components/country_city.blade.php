<div class="form-group bg-light rounded p-2">
    <label>{{trans('forms.specify_place')}}</label>
    <div class="row">
        <div class="col-3">
            <select name="country" class="form-control h-100 flags" placeholder="{{trans('forms.country_placeholder')}}" value="{{ Request::old('country') }}" >
            @foreach($countries as $country)
                <option class="flag flag-{{$country->code}}" 
                        @if($country->code=="pa" && Request::old('country')==null) selected="$country->name" @endif
                        @if($country->name==Request::old('country')) selected="$country->name" @endif 
                >{{$country->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="custom-control col-3">
            <input type="text" class="form-control {{$errors->has('city_of_mobility')? 'border-danger' : ''}}" name="city_of_mobility" id="city_of_mobility" placeholder="{{trans('forms.city_placeholder')}}" value="{{ Request::old('city_of_mobility') }}" required />
        </div>
    </div>
</div>