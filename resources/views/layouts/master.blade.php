<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>


    <!-- Bootstrap core CSS-->
    <link href="{{URL::asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link href="{{URL::asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template-->
    <link href="{{URL::asset('css/sb-admin.css')}}" rel="stylesheet" />
    <!-- Page level plugin CSS-->
    @yield('page-level-plugins')
</head>
@yield('body')
</html>