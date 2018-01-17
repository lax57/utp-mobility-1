<div class=" form-group bg-light rounded p-2">
    <div class="form-row m-2">
        <span class="custom-control-description  col-1 pr-2 py-2">{{trans('forms.country')}}: </span>
        <input type="text" class="form-control col-2"  value="{{ $country }}" readonly />
        <span class="custom-control-description text-right col-1 pr-2 py-2">{{trans('forms.city')}}: </span>
        <input type="text" class="form-control col-2" value="{{ $city }}" readonly />
    </div>
</div>