@extends('layouts.master')

@section('content')
    <h3 class="page-title">Update User Details</h3>

     <form  id="Form" action="{{url('/update-data')}}" method="get">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class ="control-label">Name*</label>
                    <input type="text" name="uname" value="{{$user->name}}" class="form-control" placeholder="Name" required="">
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
                    <input type="email" name="emailId" value="{{$user->email}}" class="form-control" placeholder="Email Id" required="">
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
                    <label class ="control-label">Password</label>
                    <input type="password" name="pwd" class="form-control" placeholder="Password" >
                    <input type="hidden" name="uid" value="{{$user->id}}"  >
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
@stop

