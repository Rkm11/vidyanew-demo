@extends('layouts.master')
@php
$ID = 'enquiry';
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
		<br/>

		<div class="content-body" style="background-color:#9ddac0;">
			<form id="{{ $ID }}EForm">
			<input type="hidden" name="sid" value = "{{ $en->enq_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Student Name<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Name" value = "{{ $en->stu_first_name }}" class="form-control" name="stu[first_name]" placeholder="First Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Middle Name" value = "{{ $en->stu_middle_name }}" class="form-control" name="stu[middle_name]" placeholder="Middle Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Last Name" value = "{{ $en->stu_last_name }}" class="form-control" name="stu[last_name]" placeholder="Last Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Email:</label>

								<div class="controls">
									<input type="email" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}" title="Enter Valid Mail" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}"  id = "email" value = "{{ $en->stu_email }}" class="form-control" name="stu[email]" placeholder="Email Id" >
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mobile<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter Your Mobile Number" class="form-control" value = "{{ $en->stu_mobile }}" name="stu[mobile]" placeholder = "Mobile Number" maxlength="10" pattern="^[789]\d{9}$">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter Your Parent Name" class="form-control" value = "{{ $en->parent_first_name }}" name="p[first_name]" placeholder="Parent Name" pattern="[a-z A-Z]+" required>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Number 1<small>(optional)</small><span style="color:red;"></span>:</label>
								<div class="controls">
									<input type="text" title="Enter Number" value = "{{ $en->parent_mobile }}" class="form-control" name="p[mobile]" placeholder="Parent Number" maxlength="10" pattern="[0-9]{10}" >
								</div>
							</div>
						</div>
					</div>
				</div> -->

				<!-- <div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Number 2<small>(optional)</small><span style="color:red;"></span>:</label>
								<div class="controls">
									<input type="text" title="Enter Number" value = "{{ $en->parent_alt_mobile }}" class="form-control" name="p[alt_mobile]" placeholder="Parent Number" maxlength="10" pattern="[0-9]{10}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Standard
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" id = "standard" name="ad[standard]">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Standard::get() as $s)
										<option value = "{{ $s->std_id }}" {{ ($en->ad_standard == $s->std_id) ? 'selected' : ''}}>{{ $s->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div> -->

				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Batch Time
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" id = "batch" name="ad[batch]" required>
										<option value="-1">--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										<option value = "{{ $b->batch_id }}" {{ ($en->ad_batch != '') ? (($en->ad_batch == $b->batch_id) ? 'selected' : '') : '' }}>{{ $b->batch_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Education Qualification
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" name="ad[medium]">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Medium::get() as $med)
										<option value = "{{ $med->med_id }}" {{ ($en->ad_medium != '')?(($en->ad_medium == $med->med_id) ? 'selected' : '') : '' }}>{{ $med->med_name }}</option>
										@empty
										@endforelse

									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Previous Year %
									<!-- <span style="color:red;">*</span>: -->
								</label>
								<div class="controls">
									<input type="text" title="This must be a %" class="form-control" name="ad[pre_percent]" placeholder="Previous Year" id = "previousYear" value = "{{($en->ad_pre_percent) }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id = "subject-box">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<label class="form-label">Courses<span style="color:red;">*</span>:</label>
							<ul class="list-unstyled" id = "subjectsBox">
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="form-label">School Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name="ad[school]" value = "{{ $en->ad_school }}" class="form-control" placeholder="School Name">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12">
						<!-- <div class="col-sm-12"> -->
							<div class="form-group">
								<label class="form-label">Address
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<textarea cols="3" rows="4" class="form-control" name="stu[address]" required>{{ $en->stu_address }}</textarea>
								</div>
							</div>
						</div>
					</div>
						<div class="col-xs-6 col-sm-6 ">
					<div class="form-group">
						<label class="form-label">Who refer you?:
						</label>
						<div class="controls">
							<input type="text" title="Who refer you" value="{{ $en->ad_reffered_by }}" name="ad[reffered_by]" class="form-control" placeholder="Who refer you">
						</div>
					</div>
				</div>
								<div class="col-xs-6 col-sm-6 ">
					<div class="form-group">
						<label class="form-label">Preferred batch timing:
						</label>
						<div class="controls">
							<input type="text" title="Preferred batch timing" value="{{ $en->ad_preffered_batches }}" name="ad[preffered_batches]" class="form-control" placeholder="Preferred batch timing">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-sm-12">
						<div class="text-center">
							<button type="submit" class="btn btn-warning">Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div id = "{{ $ID }}EMsg" class="text-center"></div>
	</section>
</div>
<!-- SHOW INSERTED DATA-->
@endsection

@push('footer')
<script>
	var find = "{{ route('find-school') }}",
	schoolUrl = "{{ route('school.store') }}",
	en = '{{ route('enquiry.index') }}',
	edit = "{{ url($ID) }}";
	CRUD.formSubmission(edit, 2,{});

	$('#standard').on({
		'change' : function(){
			getSubject(this.value);
		}
	});
	getSubject();
	function getSubject(id){
		$.ajax({
url : '{{ route('standard-data') }}',
			type : 'get',
			data : {},
			success : function(d){
				var val = [];
				if(d.length > 0){
					$.each(d, function(k,v){
							chk = '';
							var subs = '{{ $en->ad_subjects }}'.split(',');
							for(var i=0; i<subs.length;i++) {
								subs[i] = +subs[i];
							}
							chk = ($.inArray(v.std_id, subs) >= 0) ? 'checked' : '';

							val.push('<div class="col-sm-3"><li><input type="checkbox" name = "subjects[]" value="'+v.std_id+'" '+chk+' class="skin-square-green"><label class="icheck-label form-label">'+v.std_name+'</label></li></div>');
					});
				}else{
					val.push('<div class = "alert alert-danger text-center">No Course Found</div>');
				}
					$('#subject-box').show();
					$('#subjectsBox').html(val);

				iCheck();
			}
		});
	}
</script>
@endpush
