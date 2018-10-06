@extends('layouts.master')
@php
$ID = 'settings';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
</script>
@endpush

@section('page-title')
<div class="pull-left">
	Edit {{ ucfirst($ID) }}
</div>
<div class="pull-right">
	<a href = "javascript:void(0);" onclick="window.history.back()" class="btn btn-danger">Back</a>
</div>

@endsection

@section('content')

<div class="col-lg-12">
	<section class="box ">
		<br/>

		<div class="content-body" style="background-color:#9ddac0;">
			<form id="{{ $ID }}Form">
				<input type="hidden" name="sid" id="sid" value = "{{ $settings->set_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class=" col-sm-12">
							<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Class Name<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" required="" id="class_name" name="class_name" placeholder="name" value="{{$settings->set_class_name}}" >
								</div>
							</div>
						</div>
						<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Class Address<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<textarea class="form-control" id="class_address" required="" name="class_address" placeholder="name">{{$settings->set_class_address}}</textarea>
								</div>
							</div>
						</div>
						<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Primary Mobile No:<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" required="" id="mobile1" name="mobile1" placeholder="123456780" value="{{$settings->set_mobile1}}" >
								</div>
							</div>
						</div>
						<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Secondary Mobile No:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" id="mobile2" name="mobile2" placeholder="123456780" value="{{$settings->set_mobile2}}" >
								</div>
							</div>
						</div>
						<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Email Id:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="emailid" id="emailid" placeholder="xyz@abc.com" value="{{$settings->set_emailid}}" >
								</div>
							</div>
						</div>
						<div class=" col-sm-3">
							<div class="form-group">
								<label class="form-label">Website:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="website" id="website" placeholder="www.google.com" value="{{$settings->set_website}}" >
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-sm-12">
						<div class="text-center">
							<button type="button" onclick="saveData('{{$settings->set_id}}')" class="btn btn-success">Update</button>
						</div>
					</div>
				</div>
				<div id = "msg" style="font-weight: 600;background:#00ff04; "  class="text-center">
				</div>
			</form>
		</div>
	</section>
</div>
<!-- SHOW INSERTED DATA-->
@endsection

@push('footer')
<script>
	function saveData(id){
		var fd = new FormData();
		fd.append('id',$('#sid').val());
		fd.append('class_name',$('#class_name').val());
		fd.append('class_address',$('#class_address').val());
		fd.append('website',$('#website').val());
		fd.append('emailid', $('#emailid').val());
		fd.append('mobile2',$('#mobile2').val());
		fd.append('mobile1',$('#mobile1').val());
		$.ajax({
			url : '{{ route('settings.store') }}',
			data : fd,
			type : 'post',
			processData : false,
			contentType : false,
			success : function(data){

				$('#msg').html('Updated Data Successfully...');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			},error : function(xhr){

				$('#msg').html('<p style = "color:red;">Something Went Wrong!!</p>');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			}
		}).error(function(xhr){
			$('#msg').html('<p style = "color:red;">Something Went Wrong!!</p>');
			window.setTimeout(function () {
				$('#msg').html('');
			},800);
		});
	}
</script>
@endpush