    <div class="form-group bg-light rounded p-2">
        <label for="other_work_authors">{{trans('forms.other_work_authors')}}</label>
        <div id="authorsContainer">
        @if(is_array(old('other_work_authors')))
        @foreach(old('other_work_authors') as $key=>$author)
            <div class="row mt-2">
                <div class="col-3">
                    <input class="form-control {{$errors->has('other_work_authors.'.$key)? 'border-danger' : ''}}" name="other_work_authors[]" value="{{$author}}" placeholder="{{trans('forms.cedula_placeholder')}}" required>
                </div>
                <div class="col-5">
                    <input class="form-control" readonly />
                </div>
                <div class="col-3">
                    <i class="deleteAuthor fa fa-minus btn btn-danger" id="deleteAuthor" ></i>
            </div>
        </div>
        @endforeach
        @endif

        </div>
        <i class="btn btn-success fa fa-plus mt-2" id="addAuthor"></i>
        <div class="row mt-2" id="authorsRow" style="display:none">
                <div class="col-3">
                    
                </div>
                <div class="col-5">
                    <input class="form-control" readonly />
                </div>
                <div class="col-3">
                    <i class="deleteAuthor fa fa-minus btn btn-danger" id="deleteAuthor"></i>
                </div>
        </div>
    </div>
<!--<input class="form-control {{$errors->has('other_work_authors')? 'border-danger' : ''}}" name="" placeholder="Ingrese la cedula" />-->