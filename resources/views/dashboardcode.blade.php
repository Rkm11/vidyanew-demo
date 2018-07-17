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
			
			<div class="col-lg-3 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
					<div class="stats">
						<h4><strong>{{$ecout}}</strong></h4>
						<span>Enquiries</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-accent'></i>
					<div class="stats">
						<h4><strong>{{$acout}}</strong></h4>
						<span>Admissions</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
					<div class="stats">
						<h4><strong>{{$pcout}}</strong></h4>
						<span>Payment vouchers</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12">
				<div class="r4_counter db_box">
					<i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
					<div class="stats">
						<h4><strong>{{$tcout}}</strong></h4>
						<span>Telecallings</span>
					</div>
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
<script src="assets/plugins/echarts/echarts-all.js" type="text/javascript"></script>
<script src="assets/js/chart-echarts.js" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 

<script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.1.min.js" type="text/javascript"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="assets/js/dashboard.js" type="text/javascript"></script>
<script src="assets/plugins/echarts/echarts-custom-for-dashboard.js" type="text/javascript"></script>
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

@endpush