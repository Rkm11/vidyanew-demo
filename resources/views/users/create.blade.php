@extends('layouts.master')
@php
$ID = 'users';
@endphp
@section('content')
    <h3 class="page-title">Create User</h3>
    <form  id="Form" action="{{url('/insert-data')}}" method="get">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class ="control-label">Name*</label>
                    <input type="text" name="uname" class="form-control" placeholder="Name" required="">
                    <p class="help-block"></p>
                    @if($errors->has('uname'))
                        <p class="help-block">
                            {{ $errors->first('uname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class ="control-label">Email*</label>
                    <input type="email" name="emailId" class="form-control" placeholder="Email Id" required="">
                    <p class="help-block"></p>
                    @if($errors->has('emailId'))
                        <p class="help-block">
                            {{ $errors->first('emailId') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label></label>
                    <label class ="control-label">Password*</label>
                    <input type="password" name="pwd" class="form-control" placeholder="Password" required="">
                    <p class="help-block"></p>
                    @if($errors->has('pwd'))
                        <p class="help-block">
                            {{ $errors->first('pwd') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <input type="submit" name="submit" class="btn btn-danger">
</form>
    @endsection
@push('footer')
<script>
function submitData(){
    uname=$('#uname').val();
    emailId=$('#emailId').val();
    pwd=$('#pwd').val();
        $.ajax({
            url : '{{ route('insert-data') }}',
            type : 'post',
            data : {uname : uname,emailId:emailId,pwd:pwd},
            success : function(d){
                if('Success'==d){
                    window.location.url=window.location.'users';
                }else{
                    alert('Something went wrong please try again.');
                    window.location.url=window.location.'create';
                }
            }
        });
    }
    </script>

