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
        <li class="breadcrumb-item active">{{trans('navbar.new_mobility')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-telegram"></i>  Choose your mobility type
        </div>
        <div class="card-body">
            <div class="panel-group m-2" id="accordion">
                @foreach($applicationTypes as $key=>$type)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <button class="btn btn-primary w-100" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}">
                                {{$type->full_name}} <strong class="text-uppercase">({{$type->name}})</strong>
                            </button>
                        </h4>
                    </div>
                    <div id="collapse{{$key+1}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div>
                                {{$type->description}}
                            </div>
                            <a class="btn float-right btn-danger mb-3" href="{{route('application_form', ['application_type'=> $type->name])}}">
                                <ul class="navbar-nav w-100 d-inline-block align-content-center">
                                    <li class="float-left">Apply</li>
                                    <li class="float-right">
                                        <i class="fa fa-fw fa-arrow-circle-right"></i>
                                    </li>
                                </ul>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>
</div>

@endsection