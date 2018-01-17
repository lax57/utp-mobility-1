@extends('layouts.dashboard')

@section('page-level-plugins')
<!-- DateTimePicker-->
<link href="{{URL::asset('vendor/bootstrap/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{URL::asset('vendor/country-select/css/country-select.css')}}" rel="stylesheet" />
@endsection

@section('page-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('new_mobility')}}">{{trans('navbar.new_mobility')}}</a>
        </li>
        <li class="breadcrumb-item active"> {{trans('applications.'.$application_type)}}  </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Fill in the form
        </div>
        <div class="card-body">
            <div class="container-fluid">
                @if(count($errors) > 0)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bg-light rounded p-2 mb-2">
                               <ul class="text-danger">
                                   @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                   @endforeach
                               </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        @yield('form-content')
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>
</div>

<!-- Confirmation Modal-->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Ready to submit?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{trans('forms.submit_notification')}}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{trans('forms.cancel_button_text')}}</button>
                <button class="btn btn-danger" id="submitBtnModal">{{trans('forms.submit_button_text')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-level-scripts')
<script src="{{URL::asset('vendor/bootstrap/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('vendor/country-select/js/country-select.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
       $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
        });
    });
</script>


<script>
    var $myForm = $('#mainform');
    $('#submitBtn').click(function () {
       
        if (!$myForm[0].checkValidity()) {
            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            $myForm.find(':submit').click();
        } else {
            $("#confirmationModal").modal();
        }

        /*$('#submitButton').click();
        */
    });

    $('#submitBtnModal').click(function () {
        $myForm.find(':submit').click();
    });
</script>

<script type='text/javascript'>
    
        $("#addAuthor").on("click", function(event){
            var nextElement = $("#authorsRow").clone();
            nextElement.css( "display", "" );
            nextElement.removeAttr('id');
            nextElement.find("div:first").append("<input class='form-control' name='other_work_authors[]' placeholder='Ingrese la cedula' required>");
            $("#authorsContainer").append(nextElement);
        });
    
        $("#authorsContainer").on("click","#deleteAuthor", function(event){
            event.preventDefault();
            event.target.parentNode.parentNode.remove();
        });
        
        $(".amount-possible").on("click", function(event){
            var inputAmount = $(event.target.parentNode.parentNode).find(":input").last();
            if($(event.target).is(":checked")){
                inputAmount.val("0.00");
                inputAmount.prop('readonly', false);
            }else {
                inputAmount.val('');
                inputAmount.prop('readonly', true);
            }
        });
        

  </script>


@endsection