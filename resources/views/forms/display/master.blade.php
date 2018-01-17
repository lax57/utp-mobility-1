@extends('layouts.dashboard')

@section('page-level-plugins')
<!-- DateTimePicker-->
<link href="{{URL::asset('vendor/bootstrap/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
@endsection

@section('page-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.application')}}</a>
        </li>
        <li class="breadcrumb-item active"> {{$application->event_name}} </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Application information
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
                
                @if(Auth::User()->isJefe())
                <div class="row">
                    <div class="col-md-12">
                        @yield('jefe-actions')
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-level-scripts')

<script src="{{URL::asset('vendor/bootstrap/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
       $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
        });
       
       
    });
</script>



@endsection