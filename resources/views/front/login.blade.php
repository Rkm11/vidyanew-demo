@extends('layouts.front-master')

@section('content')
<div class="main-w3layouts wrapper" >
    <h1><b>Parent Login</b></h1>
    <div class="main-agileinfo" style="border: 3px solid #f1f1f1">
      <div class="agileits-top">
        <form  action="{{ route('login') }}" method="post">
        	                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input  placeholder="Email Id" id="email" type="email" class="text" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" placeholder="Password" type="password" class="text" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

						<input type="submit" value="LOGIN">
<!--           <input class="text" type="text" name="Username" placeholder="Username" required="">

          <br>

          <input class="text" type="password" name="password" placeholder="Password" required=""> -->


          <!-- <input type="submit" value="LOGIN" onclick=""> -->
        </form>
        <p style="font-size: 20px;"><a href="{{route('forgot-password')}}">Forget Password?</a></p>
      </div>
    </div>

  </div>
@endsection