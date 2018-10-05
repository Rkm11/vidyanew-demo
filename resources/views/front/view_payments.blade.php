@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
@extends('layouts.front-master')

@section('content')
<div class="all-wrapper menu-side with-side-panel">
  <div class="layout-w">

<!---------------------------------------FORM HEADING------------------------------------------------------------>

<div class="content-w" style="margin-top: -5px;">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="nav nav-tabs upper">
            <li class="nav-item">
              <a class="nav-link active" href="#"><i class="fa fa-paypal"></i>
              <span>View Payment</span></a>
            </li>
          </ul>
        </div>
      </div>


<!-----------------------------------------------FORM 1------------------------------------------------------------------>

<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

<form action="#" class="form m-b" method="post" accept-charset="utf-8" >

  <h5 style="margin-left: 55px;color:#2d3e50;"><b>TOTAL PENDING FEES </b></h5><br>

 <div class="col-md-8">
  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>Addmission Fees</b></label><br>
  <label><b>Total Amount Rs. :50000/_</b></label><br>
  <label><b>Status:Paid</b></label><br>
  <label><b>Due Date &nbsp;:03-12-2012</b></label><br>
  <label><b>Paid Date &nbsp;:03-12-2012</b></label><br>


<button class="btn-success" style="float: right;" onclick=""><i class="fa fa-download"></i><b>PDF</b></button>
<br>
</div>
</form>

</div>

<!-- ------------------------------------------END FORM 1-------------------------------------------- -->
<!-- ----------------------------FORM 2---------------------------------------------------------------------------------- -->

<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

  <form action="#" class="form m-b" method="post" accept-charset="utf-8" >


<div class="col-md-8">

  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>Addmission Fees</b></label><br>
  <label><b>Total Amount Rs. :50000/_</b></label><br>
  <label><b>Status:Paid</b></label><br>
  <label><b>Due Date &nbsp;:03-12-2012</b></label><br>
  <label><b>Paid Date &nbsp;:03-12-2012</b></label><br>

<button class="btn-success" style="float: right;" onclick=""><i class="fa fa-download"></i><b>PDF</b></button>
<br>

</div>
</form>

</div>
<!-- -----------------------------------------------END FORM 2---------------------------------------- -->
<!-- -----------------------------------------------FORM 3----------------------------------------------------- -->

   <div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

  <form action="#" class="form m-b" method="post" accept-charset="utf-8" >


<div class="col-md-8">

  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>Addmission Fees</b></label><br>
  <label><b>Total Amount Rs. :50000/_</b></label><br>
  <label><b>Status:Paid</b></label><br>
  <label><b>Due Date &nbsp;:03-12-2012</b></label><br>
  <label><b>Paid Date &nbsp;:03-12-2012</b></label><br>

<!-- <button class="btn-success" style="float: right;" onclick=""><i class="fa fa-download"></i><b>PDF</b></button>
 --><br>
<br>
</div>
</form>

</div>




<!---------------------------------------END FORM 3-------------------------------------------------------------->


</div>


 <!---------------------------------------------------------------------------------------->
   </div>
 </div>
@endsection
