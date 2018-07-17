
@extends('layouts.master')
@php
function chkN($v){
	return (!is_null($v)) ? $v : '';
}
$ID = 'parent';
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
	<a href = "{{ route($ID.'.index') }}" class="btn btn-danger">Back</a>
</div>
@endsection
@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<form id = "{{ $ID }}EForm">
				<input type="hidden" name="sid" value = "{{ $parent->parent_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Student ID<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="student" value = "{{ $stu->stu_uid }}" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Name<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="first_name" placeholder="First Name" value = "{{ chkN($parent->parent_first_name) }}" required>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="last_name" placeholder="Last Name" value = "{{ chkN($parent->parent_last_name) }}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Email<span style="color:red;">*</span>:</label>

								<div class="controls">
									<input type="email" class="form-control" name="email" placeholder="Email Id"  value = "{{ chkN($parent->parent_email) }}" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mobile<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter Number" class="form-control" name="mobile" placeholder ="Mobile Number" value = "{{ chkN($parent->parent_mobile) }}" maxlenght="10" pattern="[0-9]{10}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Alternate Mobile<span style="color:red;"></span>:</label>
								<div class="controls">
									<input type="text" title="Enter Valid Number" class="form-control" name="alt_mobile" placeholder ="Alternate Mobile Number" value = "{{ chkN($parent->parent_alt_mobile) }}" maxlenght="10" pattern="[0-9]{10}">
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Education<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="education" placeholder="Education" value = "{{ chkN($parent->parent_education) }}" required>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="clearfix"></div>

				<div class="row">	
					<div class="col-xs-12">
						<div class="text-center ">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
					</div>
				</div>

			</form>
		</div>
		<div id = "{{ $ID }}EMsg" class="text-center"></div>				

	</section>
</div>
@endsection
@push('footer')		

<script>
	var en = '{{ route('parent.index') }}';
	CRUD.formSubmission("{{ route($ID.'.index') }}", 2, {});	
</script>
@endpush