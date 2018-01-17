@extends('layouts.dashboard')

@section('page-level-plugins')
<link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" />
@endsection

@section('page-content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item active">{{trans('navbar.my_applications')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> {{trans('navbar.my_applications')}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(Session::has('msg') > 0)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bg-light rounded p-2 mb-2 text-success text-center">
                            {{ Session::get('msg') }}
                        </div>
                    </div>
                </div>
                @endif
                @if(count($errors) > 0)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bg-light rounded p-2 mb-2 ">
                               <ul class="text-danger">
                                   @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                   @endforeach
                               </ul>
                        </div>
                    </div>
                </div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>{{trans('applications.activity_name')}}</th>
                            <th>{{trans('applications.country')}}</th>
                            <th>{{trans('applications.city')}}</th>
                            <th>{{trans('applications.status')}}</th>
                            <th>{{trans('applications.upload_inform')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-light">
                            
                            <th>{{trans('applications.activity_name')}}</th>
                            <th>{{trans('applications.country')}}</th>
                            <th>{{trans('applications.city')}}</th>
                            <th>{{trans('applications.status')}}</th>
                            <th>{{trans('applications.upload_inform')}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($applications as $application)
                        <tr >
                            
                            <td class="align-middle"> <a href="{{route('display_application',['application_id'=>$application->id])}}">{{$application->event_name}} </a></td>
                            <td class="align-middle">{{$application->country->name }}</td>
                            <td class="align-middle">{{$application->city}}</td>
                            <td class="align-middle">{{$application->applicationStatus->name}}</td>
                            <td class="py-2 align-middle">
                                @component('inform_upload.upload_buttons', ['application'=>$application])
                                    
                                @endcomponent
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

@component('inform_upload.modal')

@endcomponent

@endsection

@section('page-level-scripts')
<script src="{{URL::asset('js/sb-admin-datatables.min.js')}}"></script>

<script>
    
    var token = '{{ Session::token() }}';
    var applicationId;
    
    $('.upload-in-btn').click(function (event) {
        event.preventDefault();
        applicationId = $(event.target).data('application');
        $("#inform_app_id").attr('value', applicationId); 
        $("#uploadModal").modal();
    });
    
//    $('#downloadInformeBtn').click(function (event) {
//        applicationId = $(event.target).data('application');
//        $.ajax({
//            method: 'POST',
//            url: url,
//            data: { applicationId: applicationId, _token: token }
//        })
//        .done(function (msg){
//            console.log(msg['message']);
//        });
//
//    });
    
    


</script>
@endsection