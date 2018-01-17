@extends('layouts.dashboard')

@section('page-level-plugins')
<!-- DateTimePicker-->
<link href="{{URL::asset('vendor/bootstrap/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{URL::asset('vendor/country-select/css/countrySelect.css')}}" rel="stylesheet" />
@endsection

@section('page-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.my_applications')}}</a>
        </li>
        <li class="breadcrumb-item active"> {{$application->event_name}} </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Application information
        </div>
        <div class="card-body">
            <div class="container-fluid">
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


@endsection

@section('page-level-scripts')

<script src="{{URL::asset('vendor/bootstrap/js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('vendor/country-select/js/countrySelect.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
       $('.datepicker').datepicker({
           format: 'yyyy-mm-dd'
        });
       
       
    });
</script>

<script>

    $("#country_selector").countrySelect({
        defaultCountry: "pa",
    });

</script>


@endsection