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
              <span>Attendance report</span></a>
            </li>
          </ul>
        </div>
      </div>

  <div class="content-i">
    <div class="content-box">
     <div class="element-wrapper">

          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label class="gi" for="">Start Date:</label>
                <div class='input-group datepicker' id='datepicker1' >
                    <input type="date" class="form-control1 datepicker" id="startDate" name="startDate" class="input-group-addon"/>
                 </div>
            </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                <label class="gi" for="">End Date:</label>
                <div class='input-group datepicker' id='datepicker1' >
                    <input type="date" id="endDate" name="endDate" class="form-control1 datepicker"  class="input-group-addon"/>
                 </div>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                <label class="gi" for="">Subject:</label>
                   <select name="subject_id" id="subject_id" class="form-control" >
                   <option value="">Select</option>
                   @php
                   $i=0;
                   @endphp
                   @foreach ($subjectDetails as $subjects)
                   @php
                    $selected=($selectedId==$subjects->sub_id)?'selected=""':'';
                   @endphp
                   <option value="{{$subjects->sub_id}}" {{$selected}}>{{$subjects->sub_name}}</option>
                   @endforeach
                   </select>
              </div>
            </div>

            <script type="text/javascript">
            // $(function () {
            //     $('#datepicker1').datepicker();
            // });
        </script>


            <div class="col-sm-2">
              <div class="form-group">
                <button onclick="filterAtt()" class="btn btn-rounded btn-success btn-upper" style="margin-top:20px"><span>Generate</span></button>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>




<!----------------------------------------------------------------------------------------------------------------->

 <div class="element-box lined-primary shadow" style="margin-bottom: 70px;">
       <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class=""></i>
              <span>View Attendance</span></a>
            </li>
          </ul>
        </div>
      </div>

    <div class="table-responsive" style="margin-bottom: 10px;">

      <table  class="display" style="width:100%">

              <thead>
                <tr>
                   <th>DATE</th>
                  <th>PRESENT / ABSENT</th>
                </tr>
                </thead>

                <tbody id="att-details">
                  @if(!empty($attendanceDetails))
                  @foreach($attendanceDetails as $value)
                 <tr>
                    <td>{{$value->att_added}}</td>
                    @php
                    $attendance=($value->att_result)?'PRESENT':'ABSENT';
                    @endphp
                    <td>{{$attendance}}</td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="2">No records Found</td>
                    </tr>
                  @endif
            </tbody>
          </table>
     </div>
   </div>
<br>
</div>
<script type="text/javascript">
     function filterAtt(){

      if($('#subject_id').val()!=''){
        $.ajax({
      url : '{{ route('ajax-attendance') }}',
      type : 'get',
      data : {subject_id:$('#subject_id').val(),endDate:$('#endDate').val(),startDate:$('#startDate').val()},
      success : function(d){
        if(d){
        $('#att-details').html('');
        $('#att-details').html(d);
        }else{
          var html='';
              html+='<tr><td colspan="2">No Records Found</td></tr>';
        $('#att-details').html('');
          $('#att-details').html(html);
        }
      }
      });
      }

     }
   </script>
@endsection