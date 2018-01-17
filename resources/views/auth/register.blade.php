@extends('layouts.master')

@section('title')
{{trans('navbar.title')}}
@endsection

@section('body')

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">{{trans('auth.register_new_account')}}</div>
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
                <form method="post" action="{{ route('user_register')}}">
                    <div class="form-group bg-light rounded p-2">
                        <label>{{trans('auth.email_address')}}</label>
                        <input class="form-control {{$errors->has('email')? 'border-danger' : ''}}" name="email" type="email" placeholder="{{trans('auth.email')}}" value="{{ Request::old('email') }}" required />
                    </div>
                    <div class="form-group bg-light rounded p-2">
                        <label>{{trans('auth.password')}}</label>
                        <input class="form-control {{$errors->has('password')? 'border-danger' : ''}}" name="password" type="password" placeholder="{{trans('auth.password')}}"  required/>
                        <input class="form-control mt-1 {{$errors->has('password')? 'border-danger' : ''}}" name="password_confirmation" type="password" placeholder="{{trans('auth.confirm_password')}}" required />
                    </div>


                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary btn-block" type="submit">{{trans('auth.register')}}</a>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection
