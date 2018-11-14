@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')
<script src="{{ asset('public/assets/plugins/datepicker/js/datepicker.js') }}" type="text/javascript"></script>
<div class="content-w" id="Attendance_R" style="margin-top: -5px;">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class=" fa fa-table"></i>
              <span>Timetable</span></a>
            </li>
          </ul>
        </div>
      </div>




<!----------------------------------------------------------------------------------------------------------------->

 <div class="element-box lined-primary shadow" style="margin-bottom: 70px;">
       <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class=""></i>
              <span>View Timetable</span></a>
            </li>
          </ul>
        </div>
      </div>

    <div class="table-responsive" style="margin-bottom: 10px;">

      <table  class="display" style="width:100%">

              <thead>
                <tr>
                   <th>DATE</th>
                  <th>Subject</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                </tr>
                </thead>

                <tbody id="att-details">
                  @if(!empty($timetable))
                  @foreach($timetable as $value)
                 <tr>
                    <td>{{$value->time_date}}</td>
                    <td>{{$value->sub_name}}</td>
                    <td>{{$value->time_start}}</td>
                    <td>{{$value->time_end}}</td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="4">No records Found</td>
                    </tr>
                  @endif
            </tbody>
          </table>
     </div>
   </div>
<br>
</div>
@endsection