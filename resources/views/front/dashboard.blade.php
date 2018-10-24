@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')

<!-- START THE DASHBOARD CONTENT------------------------------------------------------------------------ -->

  <div class="content-w" style="margin-top: -5px;">

        <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class=""></i>
              <span><h5>WELCOME TO {{ $classDetais->set_class_name }}</h5></span></a>
            </li>
          </ul>
        </div>
      </div>


<div class="content-i">


<div class="grid-container">



  <div class="grid-item" style="background-color: #2d3e40"><a href="{{url('/view-marksheet')}}"> Marksheet</a></div>
  <div class="grid-item" style="background-color: #78ab47"><a href="{{url('/view-attendance')}}"> Attendance</a></div>
  <!-- <br> -->
  <!-- <div class="grid-item" style="background-color: #800080"><a href="{{url('/')}}"> Noticeboard</a></div> -->
  <div class="grid-item" style="background-color: #008080"><a href="{{url('/view-fees')}}"> Fees Details</a></div>
  <!-- <br> -->
  <div class="grid-item" style="background-color: #E9967A"><a href="{{url('/change-password')}}"> Change Password</a></div>
  <div class="grid-item" style="background-color: #B8860B"><a href="{{url('/front-logout')}}"> Logout</a></div>


</div>



</div>



 </div>
</body>
@endsection