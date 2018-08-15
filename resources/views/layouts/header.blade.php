<!DOCTYPE html>
<html class=" ">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('class_name') }}   @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}" type="image/x-icon" />    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/assets/images/apple-touch-icon-57-precomposed.png') }}">	<!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/assets/images/apple-touch-icon-114-precomposed.png') }}">    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/assets/images/apple-touch-icon-72-precomposed.png') }}">    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/assets/images/apple-touch-icon-144-precomposed.png') }}">    <!-- For iPad Retina display -->
    <input type="hidden" value="<?php echo url('/'); ?>" name="base_url" id="base_url">

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{ asset('public/assets/plugins/jquery-ui/smoothness/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.1.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/icheck/skins/minimal/white.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{ asset('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.1.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!--header file -->


    <!-- CORE CSS FRAMEWORK - START -->
    <link href="{{ asset('public/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/plugins/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- FOR CHECK BOX - START -->
    <link href="{{ asset('public/assets/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- FOR CHECKBOX - END -->

    <!-- FOR DATEPICKER - START -->
    <link href="{{ asset('public/assets/plugins/jquery-ui/smoothness/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- FOR DATEPICKER - END -->


    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - DATATABLE -->
    <link href="{{ asset('public/assets/plugins/datatables/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ asset('public/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END DATATABLE -->


    <!-- CORE CSS TEMPLATE - START -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/responsive.css') }}" rel="stylesheet" type="text/css"/>
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
<!-- END HEAD -->

<body class=" ">
    <div class="text-center loader">
        <h1>Generating Report, Please wait</h1>
    </div>

    <div class='page-topbar ' style="background-color:#424a5d;">
      <a class="navbar-brand" href="" style="color:#fff;"><span><b>{{ env('class_name') }} </b></span></a>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>

                    <li class="notify-toggle-wrapper">
                        <ul class="dropdown-menu notifications animated fadeIn">
                            <li class="total">
                                <span class="small">
                                    You have <strong>3</strong> new notifications.
                                    <a href="javascript:;" class="pull-right">Mark all as Read</a>
                                </span>
                            </li>
                            <li class="list">

                                <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                    <li class="unread available"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>Server needs to reboot</strong>
                                                    <span class="time small">15 mins ago</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="unread away"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>45 new messages</strong>
                                                    <span class="time small">45 mins ago</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class=" busy"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>Server IP Blocked</strong>
                                                    <span class="time small">1 hour ago</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class=" offline"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>10 Orders Shipped</strong>
                                                    <span class="time small">5 hours ago</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class=" offline"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>New Comment on blog</strong>
                                                    <span class="time small">Yesterday</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class=" available"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>Great Speed Notify</strong>
                                                    <span class="time small">14th Mar</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class=" busy"> <!-- available: success, warning, info, error -->
                                        <a href="javascript:;">
                                            <div class="notice-icon">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div>
                                                <span class="name">
                                                    <strong>Team Meeting at 6PM</strong>
                                                    <span class="time small">16th Mar</span>
                                                </span>
                                            </div>
                                        </a>
                                    </li>

                                </ul>

                            </li>

                            <li class="external">
                                <a href="javascript:;">
                                    <span>Read All Notifications</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class='pull-right' style="margin-right: 8%;">
                <ul class="info-menu right-links list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle">
                            <img src="{{ asset('public/data/profile/logo.png') }}" alt="user-image" class="img-circle img-inline">
                            <span><i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">


                            <li class="last">

                                <a href="{{url('/changepassword')}}">
                                            <i class="fa fa-lock"></i>
                                            Change Password
                                        </a>

                                </a>

                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-lock"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <!-- END TOPBAR -->

    <!-- End header file -->


    <!-- BEGIN BODY Which is in header-->

    <!-- START CONTAINER -->
    <div class="page-container row-fluid container-fluid">

      <!-- End left-sidebar file -->

      @include('layouts.left-sidebar')

      <!-- End left-sidebar file -->

      <!-- START CONTENT -->
      <section id="main-content" class=" ">
        <section class="wrapper main-wrapper row" style=''>

            <div class='col-xs-12'>
                <div class="page-title">
                    <!-- PAGE HEADING TAG - START -->
                    <h1 class="title">@yield('page-title')</h1>
                    <!-- PAGE HEADING TAG - END -->
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- CORE JS FRAMEWORK - START -->
<script src="{{ asset('public/assets/js/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/js/jquery.easing.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/plugins/viewport/viewportchecker.js') }}" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="{{ asset('public/assets/js/jquery-1.12.4.min.js') }}"><\/script>');</script>
<!-- CORE JS FRAMEWORK - END -->



                    <!-- MAIN CONTENT AREA STARTS -->