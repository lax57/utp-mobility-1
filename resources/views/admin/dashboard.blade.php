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
        <li class="breadcrumb-item active"> {{trans('navbar.portal_administration')}}  </li>
    </ol>

</div>



@endsection

@section('page-level-scripts')

@endsection