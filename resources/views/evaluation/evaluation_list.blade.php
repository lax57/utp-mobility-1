@extends('layouts.dashboard')

@section('page-level-plugins')
<link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" />
@endsection

@section('page-content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('evaluate_list')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item active">{{trans('navbar.evaluate_applications')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> {{trans('applications.applications_for_evaluation')}}
        </div>
        <div class="card-body">
                @if(Session::has('msg') > 0)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bg-light rounded p-2 mb-2 text-success text-center">
                            {{ Session::get('msg') }}
                        </div>
                    </div>
                </div>
                @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>{{trans('applications.activity_name')}}</th>
                            <th>{{trans('applications.start_date')}}</th>
                            <th>{{trans('applications.finish_date')}}</th>
                            <th>{{trans('applications.country')}}</th>
                            <th>{{trans('applications.city')}}</th>
                            <th>{{trans('applications.status')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-light">
                            <th>{{trans('applications.activity_name')}}</th>
                            <th>{{trans('applications.start_date')}}</th>
                            <th>{{trans('applications.finish_date')}}</th>
                            <th>{{trans('applications.country')}}</th>
                            <th>{{trans('applications.city')}}</th>
                            <th>{{trans('applications.status')}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td> <a href="{{route('show_application_evaluation',['$application_id'=>$application->id])}}">{{$application->event_name}} </a></td>
                            <td>{{$application->start_date}}</td>
                            <td>{{$application->finish_date}}</td>
                            <td>{{$application->country->name }}</td>
                            <td>{{$application->city}}</td>
                            <td>{{$application->applicationStatus->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>


@endsection

@section('page-level-scripts')
<script src="{{URL::asset('js/sb-admin-datatables.min.js')}}"></script>
@endsection