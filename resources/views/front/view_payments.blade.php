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

@if(!empty($invoice->invoices()->first()))
<!-----------------------------------------------FORM 1------------------------------------------------------------------>

<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

<form action="#" class="form m-b" method="post" accept-charset="utf-8" >

  <!-- <h5 style="margin-left: 55px;color:#2d3e50;"><b>TOTAL PENDING FEES </b></h5><br> -->

 <div class="col-md-8">
  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>Addmission Fees</b></label><br>
  <label><b>Total Amount Rs. : {{ $invoice->invoices()->first()->in_paid_amount }}/_</b></label><br>
  <label><b>Status: Paid</b></label><br>
  <label><b>Paid Date &nbsp;: {{ Carbon\Carbon::parse($invoice->invoices()->first()->in_add_date)->format('d/m/y') }}</b></label><br>

@if(!empty($ins))
<a class="btn-success" style="float: right;" href="<?php echo 'download-receipt/' . $ins->install_invoice; ?>" ><i class="fa fa-download"></i><b>PDF</b></a>
@endif
<br>
</div>
</form>

</div>
@else
<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">
  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>No Record Found</b></label>
  </div>
@endif

<!-- ------------------------------------------END FORM 1-------------------------------------------- -->
<!-- ----------------------------FORM 2---------------------------------------------------------------------------------- -->

@if(!empty($invoice->installments()->get()))
@foreach($invoice->installments()->get() as $installment)
@php
$i=1;
@endphp
<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

  <form action="#" class="form m-b" method="post" accept-charset="utf-8" >


<div class="col-md-8">

  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>{{$installment->install_type}}</b></label><br>
  <label><b>Total Amount Rs. : {{$installment->install_amount}}/_</b></label><br>
  <label><b>Status: {{($installment->install_status==1)?'Paid':'Not Paid'}}</b></label><br>
  <label><b>Due Date &nbsp;: {{$installment->install_due_date}}</b></label><br>

<br>

</div>
</form>
</div>
@endforeach
@else
<div class="element-box lined-primary shadow" style="margin-bottom: 10px;">

  <form action="#" class="form m-b" method="post" accept-charset="utf-8" >


<div class="col-md-8">

  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>Installments</b></label><br>
  <label style="margin-left: 85px;color: #78ab4c;font-size: 15px;"><b>No Records Found</b></label>
  </div>
</form>
</div>
@endif


<!---------------------------------------END FORM 3-------------------------------------------------------------->


</div>


 <!---------------------------------------------------------------------------------------->
   </div>
 </div>
@endsection
