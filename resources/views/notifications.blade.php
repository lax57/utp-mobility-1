@extends('layouts.dashboard')

@section('page-level-plugins')
<link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" />
@endsection

@section('page-content')

<div class="container-fluid">
    <!--     Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item active">{{trans('navbar.notifications')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> {{trans('navbar.notifications')}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light small">
                            <th >{{trans('notifications.status_update')}}</th>
                            <th>{{trans('notifications.application')}}</th>
                            <th>{{trans('notifications.old_status')}}</th>
                            <th>{{trans('notifications.new_status')}}</th>
                            <th>{{trans('notifications.date')}}</th>
                            <th>{{trans('notifications.updated_by')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-light small">
                            <th>{{trans('notifications.status_update')}}</th>
                            <th>{{trans('notifications.application')}}</th>
                            <th>{{trans('notifications.old_status')}}</th>
                            <th>{{trans('notifications.new_status')}}</th>
                            <th>{{trans('notifications.date')}}</th>
                            <th>{{trans('notifications.updated_by')}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($notifications as $notification)
                        <tr class="small {{ !$notification->seen ? 'bg-light ' : ''}}">
                            <td class="text-center font-weight-bold align-middle">
                                @if($notification->newStatus->name != App\ApplicationStatus::REJECTED)
                                <i class="fa fa-arrow-up fa-2x text-success mx-auto"></i>
                                @elseif($notification->newStatus->name == App\ApplicationStatus::REJECTED)
                                <i class="fa fa-arrow-down fa-2x text-danger mx-auto"></i>
                                @endif
                            </td>
                            <td >
                                @if(!$notification->seen)
                                <i class="fa fa-fw fa-exclamation new-notification" data-notification="{{$notification->id}}"></i>
                                @endif
                                <a href="{{route('display_application',['application_id'=>$notification->application_id])}}">{{$notification->application->event_name}} </a>
                                
                            </td>
                            <td >
                                @if($notification->oldStatus)
                                {{$notification->oldStatus->name}}
                                @endif
                            </td>
                            <td >{{$notification->newStatus->name}}</td>
                            <td >{{$notification->date_of_update}}</td>
                            <td >
                                @if($notification->user)
                                {{$notification->user->name}}  {{$notification->user->last_name}}
                                @endif
                            </td>
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

<script>
    var token = '{{ Session::token() }}';
    var notifications = '{{ $notifications }}';
    var url ='{{route("notifications_mark_as_read")}}'
    
    $(".new-notification").each(function(event){
        id = $(this).data('notification');
        $.ajax({
            method: 'POST',
            url: url,
            data: { notification_id: id, _token: token }
        })
        .done(function (msg){
            console.log(msg['msg']);
        });
    });
    

</script>
@endsection

