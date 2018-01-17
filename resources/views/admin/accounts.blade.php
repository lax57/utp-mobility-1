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
        <li class="breadcrumb-item active">{{trans('admin.portal_administration')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> User accounts
        </div>
        <div class="card-body">

            <a class="btn btn-success mb-3" href="{{route('register_account_view')}}">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Add new account
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>{{trans('admin.email')}}</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.unit')}}</th>
                            <th>{{trans('admin.role')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-light">
                            <th>{{trans('admin.email')}}</th>
                            <th>{{trans('admin.name')}}</th>
                            <th>{{trans('admin.unit')}}</th>
                            <th>{{trans('admin.role')}}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($accounts as $account)
                        <tr>
                            <td>{{$account->email}}</td>
                            <td>{{$account->name}} {{$account->last_name}}</td>
                            <td>{{$account->unit->name }}</td>
                            <td> 
                            @foreach($account->roles as $role)
                                {{$role->name}}<br>
                            @endforeach
                            </td>
                            
                            <td><a class="btn btn-danger delete-user" data-userid="{{$account->id}}" href="{{route('delete_account',['post_id'=>$account->id])}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Delete account?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{trans('admin.delete_account')}}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="" method="post" id="deleteForm">
                    {{ csrf_field() }}
                    <button class="btn btn-danger" id="modalConfirmButton" type="submit">Delete</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-level-scripts')
<script src="{{URL::asset('js/sb-admin-datatables.min.js')}}"></script>


<script>
    var user_id;
    
    var $myForm = $('#mainform');
    $('.delete-user').click(function () {
       event.preventDefault();
       var deleteLink = $(event.target).attr('href');
       $('#deleteForm').attr('action', deleteLink);
       $('#deleteModal').modal();
    });
    

</script>
@endsection
