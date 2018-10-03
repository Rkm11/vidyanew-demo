@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $classDetais->set_class_name }}   @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon" />    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/assets/images/apple-touch-icon-57-precomposed.png') }}">    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/assets/images/apple-touch-icon-114-precomposed.png') }}">    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/assets/images/apple-touch-icon-72-precomposed.png') }}">    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/assets/images/apple-touch-icon-144-precomposed.png') }}">    <!-- For iPad Retina display -->
    <input type="hidden" value="<?php echo url('/'); ?>" name="base_url" id="base_url">

            <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/normalize.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/demo.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/component.css')}}" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

   <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- <link href="http://bootstrap-datepicker3.css" rel="stylesheet"> -->
    <!-- CORE CSS TEMPLATE - START -->
    <link href="{{ asset('public/assets/css/front-style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/front-style1.css') }}" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" charset="utf8" src="{{asset('public/assets/js/jquery-3.3.1.js')}}"></script>


    <!-- CORE CSS TEMPLATE - END -->
    @stack('header')
    <style type="text/css">
    .loader{
        position: fixed;
        z-index: 999999;
        background: #000000a8;
        width: 100%;
        height: 1000px;
        display: none;
    }
    .loader h1{
        color: white;
        margin-top: 20%;
    }
</style>
</head>
<body>
<!-- HEADER MENU------------------------------------------------------ -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <div id="mainmenu">

    <a href="{{url('/home')}}" style="">Dashboard</a>
    <a href="{{url('/view-marksheet')}}">Marksheet</a>
  <a href="{{url('/view-attendance')}}">Attendance</a>
  <a href="{{url('/')}}">Noticeboard</a>
  <a href="{{url('/view-fees')}}">Payment</a>
  <a href="{{url('/change-password')}}">PwdChange</a>
  <a href="{{url('/change-password')}}">Profile</a>
  <a href="{{url('/front-logout')}}">Logout</a>

  </div>

</div>


<div id="mainpage">

<span style="font-size:30px;cursor:pointer;color: white;margin-left: 5px;" onclick="openNav()">&#9776;</span>
 <span id="dopen"><a style="color: white;" href="{{url('/home')}}">DASHBOARD</a></span>
 <span id="dlogout"><a style="color: white;" href="{{url('/front-logout')}}">LOGOUT</a></span>

</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>


<!-- END HEADER MENU------------------------------------------------------------------------------- -->


