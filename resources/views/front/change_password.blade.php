@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')
<style>

#formpass{
  width: 50%;
  margin-left: 330px;
}
.pure-form{
  width: 50%;
  margin-left: 140px;
}
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;

}

/* Style the submit button */
input[type=submit] {
    background-color: #78ab47;
    color: white;
    width: 45%;
    margin-left: 10px;
}
input[type=button] {
    background-color: #78ab47;
    color: white;
    width: 45%;
    margin-left: 10px;
}
@media screen and (max-width: 700px) {
   .pure-form{
    width: 100%;
    margin-left: 0px;
    height: auto;
       }

   input[type=submit] {
       width: 45%;
}
#formpass{
  width: 100%;
  margin-left: 0px;
  height: auto;
}
}

</style>



 <script>
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;



function checkPass()
{
  //myFunction();
    //Store the password field objects into variables ...
    var pass1 = $('#password').val();
    var pass2 = $('#confirm_password').val();
    var currentPassword = $('#password1').val();
    //Store the Confimation Message Object ...
    var message = $('#confirmMessage').val();
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if(pass1 !='' && pass2 !=''){
      if(pass1 == pass2){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        // pass2.style.backgroundColor = goodColor;
        // message.style.color = goodColor;
        // message.innerHTML = "Passwords Match!";
        $.ajax({
      url : '{{ route('front-change-password') }}',
      type : 'get',
      data : {currentPassword:currentPassword,password : pass1},
      success : function(d){
        if(d=='success'){
           $('#confirmMessage').attr('style','color:green');
          // message.style.color = goodColor;
          $('#confirmMessage').text("Password Changed Successfully.");
        }else if (d=='Not Match'){
          $('#confirmMessage').attr('style','color:red');
          // message.style.color = badColor;
        $('#confirmMessage').text("Current password is wrong.");
        }else{
          $('#confirmMessage').attr('style','color:red');
          // message.style.color = badColor;
          $('#confirmMessage').text("Something Went Wrong.");
        }
      }
      });

    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        // pass2.style.backgroundColor = badColor;
        $('#confirmMessage').attr('style','color:red');
        // message.style.color = badColor;
        $('#confirmMessage').text("Passwords Do Not Match!");
    }
    }else{
        $('#confirmMessage').attr('style','color:red');
        $('#confirmMessage').text("All Fields are Required.");
    }
}


function myFunction()
{
var fields = $(".passclass");

$.each(fields,function(i,field){
  if (!field.value)
    alert(field.name + ' is required.');
});

}

function check() {
  var pass1 = $('#password').val();
    var pass2 = $('#confirm_password').val();
    var currentPassword = $('#password1').val();
    //Store the Confimation Message Object ...
    var message = $('#confirmMessage').val();
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    if(pass1!=''&&pass2&&currentPassword!=''){
        $.ajax({
      url : '{{ route('front-change-password') }}',
      type : 'get',
      data : {currentPassword:currentPassword,password : pass1.value},
      success : function(d){

      }
      });
    }
}




  </script>








 <div class="all-wrapper menu-side with-side-panel">
   <div class="layout-w">




<!--------------------------------------------------------------------------------------------------->

<div class="content-w" style="margin-top: -5px;">

    <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class="fa fa-table"></i>
              <span>Password Change</span></a>
            </li>
          </ul>
        </div>
      </div>


<!----------------------------------------------------------------------------------------------------------------->



<div class="element-box lined-primary shadow" style="margin-bottom: 10px;" id="formpass">

<!-- <form action="#" class="form m-b" method="post" accept-charset="utf-8" >

 <div class="col-md-8">
  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b></b></label><br>
  <label><b>Current Password</b></label>
  <input type="Password" name="" size="15" style="position: fixed;"><br>
  <label><b>New Password</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp

  <input type="Password" name="" size="15" style="position: fixed;"><br>
  <label><b>Confrm Password</b></label>&nbsp;<input type="Password" name="" size="15" style="position: fixed;"><br><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button class="btn-success" style="" onclick=""><i class=""></i><b>SAVE</b></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<button class="btn-success" style="" onclick=""><i class=""></i><b>CANCEL</b></button>
<br>
</div>
</form> -->




<form class="pure-form" action="#">
    <fieldset style="">
        <label>CURRENT PASSWORD</label>
        <input type="password" class="passclass" placeholder="Current Password" name="currentPassword" id="password1" required>
        <label>NEW PASSWORD</label>
        <input type="password" class="passclass" placeholder="New Password" name="newPassword" id="password" required>
        <label>CONFIRM PASSWORD</label>
        <input type="password" class="passclass" placeholder="Confirm Password" name="confirmPassword" id="confirm_password"  required>

        <!-- <button type="submit" class="" style="" onclick="">
          <b>Save</b></button>
        <button type="submit" style="" onclick="">
          <b>Cancel</b></button> -->

           <input type="button" value="SAVE" onclick="checkPass()">

            <!-- <input type="submit" onclick="cancelUrl()" value="CANCEL"> -->
          <span id="confirmMessage" class="confirmMessage"></span>
    </fieldset>
</form>
<script type="text/javascript">
  function cancelUrl(){
    console.log(location.url);
  }
</script>









</div>



<!----------------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------------------------------->
   </div>
 </div>
@endsection