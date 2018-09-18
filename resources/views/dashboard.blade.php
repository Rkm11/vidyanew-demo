@extends('layouts.master')

@push('header')

@endpush
@section('page-title')
Dashboard
@endsection
@section('content')
<div class="col-lg-12">
	<section class="box nobox marginBottom0">
		<div class="content-body">
			<div class="row">
			<form method="GET" action="{{ route('enquiry.e_cout') }}">

			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
					<div class="stats">
						<h4><strong>{{$ecout}}</strong></h4>
						<span>Enquiries</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-accent'></i>
					<div class="stats">
						<h4><strong>{{$acout}}</strong></h4>
						<span>Admissions</span>
					</div>
				</div>
			</div>
			<!-- all amount -->
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-inr icon-md icon-rounded icon-purple'></i>
					<div class="stats">
						<h4><strong>{{$icout}}</strong></h4>
						<span>Total amount</span>
					</div>
				</div>
			</div>

<!-- 			<div class="col-lg-3 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-inr icon-md icon-rounded icon-secondary'></i>
					<div class="stats">
						<h4><strong>{{$pcout}}</strong></h4>
						<span>Paid amt</span>
					</div>
				</div>
			</div> -->
			<!-- Remain balance -->
			<div class="col-lg-4 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-inr icon-md icon-rounded icon-purple'></i>
					<div class="stats">
						<h4><strong>{{$icout}}.00</strong><span> Total amount</span></h4>
						<center><h1>-</h1></center>
						<h4><strong>{{$pcout}}.00</strong><span> Paid amount</span></h4>
						<hr>
						<h4 style="color: red"><strong>{{$r_bal}}.00</strong><span> Remaining amount</span></h4>
					</div>
				</div>
			</div>

			<!-- graph here -->
			<div class="col-md-8 col-sm-6 col-xs-12">
				<div class="panel panel-default">
				    <div class="panel-body">
				        {!! $chart->html() !!}
				    </div>
				</div>
			</div>
			{!! Charts::scripts() !!}
			{!! $chart->script() !!}

			<div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				<div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4 row hidden-sm hidden-xs">
					<h5 style="color: #fff">Students whose fees due date is tomorrow</h5>
				</div>

				<div class=" row hidden-md hidden-lg">
					<h5 style="color: #fff;text-align: center;">Students whose fees due date is tomorrow</h5>
				</div>
				<div  style="overflow-x:auto;overflow-y:auto;">
				<table class="table table-striped table-hover table-condensed">
					<tr>
						<th>id</th>
						<th>Student name</th>
						<th>Student number</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
					<?php $i = 1;?>
					@foreach ($installment_list as $user)
					<tr class="danger">
						<td>{{$i++}}</td>
						<td>{{$user->stu_first_name}} {{$user->stu_last_name}}</td>
						<td>{{$user->stu_mobile}}</td>
						<td>{{ $user->install_amount }}</td>
						<td>{{$user->install_type}}</td>
						<td>
							<?php $url = url('/invoice') . '/' . $user->install_student . '/edit?install=' . $user->install_id . '&type=2';?>
							<a href ="{{$url}}" class = "btn btn-warning col-sm-offset-2 col-sm-8">Pay Now</a>
						</td>
					</tr>
					@endforeach
				</table>
				</div>
			</div>



			</form>
		</div> <!-- End .row -->
	</div>
</section></div>
<!-- <div class="col-xs-12">
	<section class="box ">
		<header class="panel_header">
			<h2 class="title pull-left">Today Visitors</h2>
			<div class="actions panel_actions pull-right">
				<a class="box_toggle fa fa-chevron-down"></a>
				<a class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></a>
				<a class="box_close fa fa-times"></a>
			</div>
		</header>
		<div class="content-body">    <div class="row">
			<div class="col-xs-12">
				<div class="chart-container">
					<div class="chart has-fixed-height" style="height:200px" id="page_views_today_bar"></div>
				</div>
			</div>
		</div> End .row
	</div>
</section></div> -->


<!-- MAIN CONTENT AREA ENDS -->
</section>
</section>
@endsection

@push('footer')
<!--For Active Class -->
<script>
	$("#dashboard").addClass("open");
</script>
<!--/End For Active Class -->

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<script src="public/assets/plugins/echarts/echarts-all.js" type="text/javascript"></script>
<script src="public/assets/js/chart-echarts.js" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->

<script src="public/assets/plugins/jvectormap/jquery-jvectormap-2.0.1.min.js" type="text/javascript"></script>
<script src="public/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="public/assets/js/dashboard.js" type="text/javascript"></script>
<script src="public/assets/plugins/echarts/echarts-custom-for-dashboard.js" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

@endpush