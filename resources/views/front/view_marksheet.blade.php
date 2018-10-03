@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')
<div class="content-w"  id="content-marksheet">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class="fa fa-table"></i>
              <span>Marks Details</span></a>
            </li>
          </ul>
        </div>
      </div>


    <div class="content-i" >
    <div class="content-box">
      <div class="element-wrapper">
      <form action="#" class="form m-b" method="post" accept-charset="utf-8" >



            <div class="col-md-8">
              <div class="form-group">
                <label class="gi" for=""><b>Subject:</b></label>
                  <select name="subject_id" onchange="filterMarksheet()" id="subject_id" class="form-control" required="">
                   <option value=""><b>Select</b></option>
                   @foreach ($subjectDetails as $subjects)
                   <option value="{{$subjects->sub_id}}">{{$subjects->sub_name}}</option>
                   @endforeach
                  </select>
              </div>
            </div>


            <div class="" >
               <div class="col-md-8" >
              <div class="table-responsive">
                <table  class="table table-lightborder" style="width: 100%;margin-top: -35px;" >

                     <tbody id="marksheet-details" style="border: 1px solid #d1d4e8;">
                      @if(!empty($marksDetails))
                      <br><br>
                      @foreach ($marksDetails as $subject => $marks)
                      <tr style="border: 3px solid #d1d4e8;">
                        <th>Subject :</th>
                        <th> {{$subject}}</th>
                        <th></th>
                      </tr>

                       <tr>
                        <th><b>Exams</b></th>
                        <th><b>Date</b></th>
                        <th><b>Marks</b></th>
                      </tr>
                      @foreach ($marks as $key => $value)

                    <tr>
                      @php
                      $test_name=explode('-',$value->test_name);
                      @endphp
                      <th>{{$test_name[0]}}</th>
                      <td>{{$value->test_date}}</td>
                      <td>{{$value->mark_total}}/{{$value->test_outof}}</td>
                    </tr>
                    @endforeach

                      @endforeach
                      @else
                      <br>
                      <br>
                      <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Date</th>
                      </tr>
                      <tr style="border: 3px solid #d1d4e8;">
                        <th colspan="3">No records Found</th>
                      </tr>
                      @endif
                    </tbody>


                  </table>
              </div>
            </div>
          </div>
        </form>
        </div>
        </div>
    </div>
   </div>
   <script type="text/javascript">
     function filterMarksheet(){

      if($('#subject_id').val()!=''){
        $.ajax({
      url : '{{ route('ajax-marksheet') }}',
      type : 'get',
      data : {subject_id:$('#subject_id').val()},
      success : function(d){
        $('#marksheet-details').html('');
        $('#marksheet-details').html(d);
      }
      });
      }

     }
   </script>
@endsection