    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.recommendation')}}: </label>
        <div class="d-block">
            @if($application->comissionEvaluation->recommendation)
                <div class="bg-success rounded p-1 pt-2 mt-1 mb-3 text-center  text-uppercase text-white">
                    <h5 >{{trans('forms.recommended')}}</h5>
                </div>
            @else
                <div class="bg-danger rounded p-1 pt-2 mt-1 mb-3 text-center  text-uppercase text-white">
                    <h5 >{{trans('forms.notrecommended')}}</h5>
                </div>
            @endif
        </div>
    </div>