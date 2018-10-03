@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')
<div class="content-w" style="margin-top: -5px;">

        <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class=""></i>
              <span><h5>View Profile</h5></span></a>
            </li>
          </ul>
        </div>
      </div>



    <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper">
      <form action="#" class="form m-b" method="post" accept-charset="utf-8" style="">


            <div class="col-md-8">
              <div class="form-group">

                <div col-md-8>

                <form action="" class="form m-b" method="post" accept-charset="utf-8" style="">


                <table id="example" class="display" style="width: 100%;">

                    <tr>
                      <td><b>Name:</b></td>
                      <td ><i>{{$studentDetails->stu_first_name}} {{$studentDetails->stu_middle_name}} {{$studentDetails->stu_last_name}}</i></td>
                    </tr>

                    <tr>
                      <td><b>DOB:</b></td>
                      <td>{{$studentDetails->stu_dob}}</td>
                    </tr>

                     <tr>
                       <td><b>Gender:</b></td>
                       <td ><i>{{($studentDetails->stu_gender==1)?'Male':'Female'}}</i></td>
                     </tr>

                     <tr>
                       <td><b>Batch:</b></td>
                       <td ><i>{{$studentDetails->batch_name}}</i></td>
                     </tr>

                   <tr>
                     <td><b>Medium:</b></td>
                     <td><i>{{$studentDetails->med_name}}</i></td>
                   </tr>

                 <tr>
                   <td><b>Subject:</b></td>
                   <td><i>
                    <textarea style="size: 150px;width: 100%;font-family:cursive;" readonly="readonly">{{$strSubject}}</textarea></i>
                   </td>
                 </tr>



                   <tr>
                     <td><b>Mobile No.1:</b></td>
                     <td>{{$studentDetails->stu_mobile}}</td>
                   </tr>

                   <tr>
                     <td><b>Mobile No.2:</b></td>
                     <td>{{($studentDetails->stu_alt_mobile)?$studentDetails->stu_alt_mobile:'N/A'}}</td>
                   </tr>

                   <tr>
                     <td><b>Address:</b></td>
                     <td><i>{{$studentDetails->stu_address}}</i></td>
                   </tr>

                </table>

                </form>

                </div>

              </div>
            </div>


        </form>
        </div>
        </div>
    </div>





 </div>
@endsection