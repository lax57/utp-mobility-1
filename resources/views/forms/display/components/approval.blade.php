    <div class="form-group bg-light rounded p-2">
        <label>{{trans('forms.recommendation')}}: </label>
        <div class="d-block">
            @if($application->rectoriaEvaluation->approved)
                <div class="bg-success rounded p-1 pt-2 mt-1 mb-3 text-center  text-uppercase text-white">
                    <h5 >{{trans('forms.approved')}}</h5>
                </div>
            @else
                <div class="bg-danger rounded p-1 pt-2 mt-1 mb-3 text-center  text-uppercase text-white">
                    <h5 >{{trans('forms.notapproved')}}</h5>
                </div>
            @endif
        </div>
    </div>