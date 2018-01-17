@extends('layouts.dashboard')

@section('page-level-plugins')


@endsection

@section('page-content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('show_accounts')}}">{{trans('admin.portal_administration')}}</a>
        </li>
        <li class="breadcrumb-item active"> {{trans('admin.register_account')}}  </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Fill in the form
        </div>
        <div class="card-body mx-5 ">
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
            <form action="{{route('register_new_account')}}" method="post">
                    <div class="form-group bg-light rounded p-2">
                        <label for="InputEmail1">Email address</label>
                        <input class="form-control {{$errors->has('email')? 'border-danger' : ''}}" name="email" type="email" placeholder="{{trans('admin.email')}}" value="{{ Request::old('email') }}" required />
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label for="inputPassword">Password</label>
                        <input class="form-control {{$errors->has('password')? 'border-danger' : ''}}" name="password" type="password" placeholder="{{trans('admin.password')}}"  required/>
                        <input class="form-control mt-1 {{$errors->has('password')? 'border-danger' : ''}}" name="password_confirmation" type="password" placeholder="{{trans('admin.confirm_password')}}" required />
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label for="inputName">Name</label>
                        <input class="form-control {{$errors->has('name')? 'border-danger' : ''}}" name="name" type="text" placeholder="{{trans('admin.name')}}" value="{{ Request::old('name') }}" required/>
                        <input class="form-control mt-1 {{$errors->has('last_name')? 'border-danger' : ''}}" name="last_name" type="text" placeholder="{{trans('admin.last_name')}}" value="{{ Request::old('last_name') }}" required />
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label>{{trans('admin.select_unit')}}</label>
                        <select name="unit" class="form-control py-0"  value="{{ Request::old('unit') }}" >
                        @foreach($units as $unit)
                            <option selected="{{Request::old('unit')}}">{{$unit->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label>{{trans('admin.select_roles')}}</label>
                        <div class="d-block">
                            @foreach($roles as $key=>$role)
                            <label class="custom-control custom-checkbox">
                                <input value="{{$role->name}}" name="user_roles[]" type="checkbox" class="custom-control-input" @if(is_array(old('user_roles')) && in_array($role->name, old('user_roles'))) checked @endif />
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{$role->name}}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary w-100" type="submit">{{trans('admin.register')}}</a>
            </form>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>
</div>



@endsection

@section('page-level-scripts')

@endsection