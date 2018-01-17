@extends('layouts.master')

@section('title')
{{trans('navbar.title')}}
@endsection

@section('body')

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">{{trans('auth.login')}}</div>
            <div class="card-body">
                @if(count($errors) > 0)
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bg-light rounded p-2 mb-2">
                               <ul class="text-danger mb-0">
                                   @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                   @endforeach
                               </ul>
                        </div>
                    </div>
                </div>
                @endif
                <form method="post" action="{{ route('user_login')}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('auth.email_address')}}</label>
                        <input class="form-control" name="email" type="email" aria-describedby="emailHelp" placeholder="{{trans('auth.enter_email')}}" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('auth.password')}}</label>
                        <input class="form-control" name="password" type="password" placeholder="{{trans('auth.password')}}" />
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="remember" type="checkbox" />{{trans('auth.remember_password')}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label>{{trans('auth.login_role')}}:</label>
                        <div class="d-block">
                            @foreach($personnelTypes as $type)
                            <label class="custom-control custom-radio">
                                <input id="presentationTypeRadio1" name="personel_type" type="radio" class="custom-control-input" value="{{$type->name}}" {{ Request::old('personel_type') == $type->name ? 'checked' : '' }} required />
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{$type->name}}</span>
                            </label> <br>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary btn-block" type="submit">{{trans('auth.login')}}</a>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection
