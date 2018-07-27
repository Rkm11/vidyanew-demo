<?php
date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
// echo date('d-m-Y H:i:s');die;
?>
@extends('layouts.master')

@php
$ID = 'admission';
$ID2 = 'previous';
$ID3 = 'relative';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
	ID2 = '{{ $ID2 }}';
	ID3 = '{{ $ID3 }}';
</script>
@endpush

@section('page-title')
<div class="pull-left">
	Create {{ ucfirst($ID) }}
</div>
<div class="pull-right">
	<a href = "{{ route($ID.'.index') }}" class="btn btn-danger">Back</a>
</div>
@endsection
@section('content')
<div class="col-lg-12">
	<section class="box "  style="background-color:#9ddac0;">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<form id = "{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch No
									<span style="color:red;">*</span>:
								</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<select  class="form-control" name="ad[batch_year]" required>
										<option value="">--Select--</option>
										@for ($i = 14; $i < 24; $i++)
										@php
										$v = '20'.$i.'-'.(++$i);
										@endphp
										<option value="{{ $v }}">{{ $v }}</option>
										@php
										--$i;
										@endphp
										@endfor
									</select>
								</div>
							</div>
						</div>
						{{-- <div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">ID
									<span style="color:red;">*</span>:
								</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="stu[uid]" placeholder="ID" >
								</div>
							</div>
						</div> --}}
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Date
									<span style="color:red;">*</span>:
								</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" placeholder="Date" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Student Name
									<span style="color:red;">*</span>:
								</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Name" class="form-control" name="stu[first_name]" placeholder="First Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Parent Name" class="form-control" name="stu[middle_name]" placeholder="Middle Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Last Name" class="form-control" name="stu[last_name]" placeholder="Last Name" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Email
								</label>
								<div class="controls">
									<input type="email" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}" title="Enter Valid Mail" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}"  title="Enter Valid Email" class="form-control" name="stu[email]" placeholder="Email Id">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mobile
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text" title="Enter Your Number" class="form-control" name="stu[mobile]" placeholder="Mobile Number" maxlength="10"  pattern="[0-9]{10}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">DOB
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" name="stu[dob]" placeholder="Date of Birth" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="form-label">Gender
								<span style="color:red;">*</span>:
							</label>
							<br>
							<div class="col-sm-4">
								<ul class="list-unstyled">
									<li>
										<input tabindex="5" type="radio" id="square-radio-1" name="stu[gender]" class="skin-square-green" value = "1" required>
										<label class="iradio-label form-label" for="square-radio-1">Male</label>
									</li>
								</ul>
							</div>
							<div class="col-sm-4">
								<ul class="list-unstyled">
									<li>
										<input tabindex="5" type="radio" id="square-radio-1" name="stu[gender]" class="skin-square-green" value = "0">
										<label class="iradio-label form-label" for="square-radio-1">Female</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Mobile Number
									<span style="color:red;"></span>:
								</label>
								<div class="controls">
									<input type="text" title="Enter Parent Number" class="form-control" name="stu[alt_mobile]" placeholder="Phone Number 1" maxlength="10" pattern="[0-9]{10}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Standard
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" id = "standard" name="ad[standard]" required>
										<option value="">--Select--</option>
										@forelse (App\Models\Standard::get() as $s)
										<option value = "{{ $s->std_id }}">{{ $s->std_name }}</option>
										@empty
										{{-- empty expr --}}
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id = "subject-box" style = "display:none;">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<label class="form-label">Subjects<span style="color:red;">*</span>:</label>
							<ul class="list-unstyled" id = "subjectsBox">
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" name="ad[batch]" required>
										<option value="" \>--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										<option value = "{{ $b->batch_id }}">{{ $b->batch_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Medium
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" name="ad[medium]" required>
										<option value="">--Select--</option>
										@forelse (App\Models\Medium::get() as $med)
										<option value = "{{ $med->med_id }}">{{ $med->med_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="form-label">School Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter School Name" name = "ad[school]" class="form-control" placeholder="School Name" pattern="[a-z A-Z 0-9]+" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Address
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<textarea cols="3" rows="4" class="form-control" name="stu[address]" required></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Upload Image
									<small>&nbsp;(1.Student<span style="color:red;">*</span>)(2.Father,3.Mother - optional)</small>
								</label>
								<div class="controls">
									<input type="file" class="form-control" name="student_img" style="margin-bottom: 1px;" required="">
									<input type="file" class="form-control" name="father_img" style="margin-bottom: 1px;">
									<input type="file" class="form-control" name="mother_img">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Total Fees
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text" title="Enter Total Fees In Digit " class="form-control" name="ad[fees]" placeholder="Total Fees" pattern="[0-9]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Previous Year %
									<!-- <span style="color:red;">*</span>: -->
								</label>
								<div class="controls">
									<input type="text" title="This must be a %" class="form-control" name="ad[pre_percent]"  placeholder="Previous Year" id = "previousYear">
								</div>
							</div>
						</div>
					</div>
				</div>
					<div class="text-center">
						<button type="submit" onclick="validateSubject('validate')" id='save-admission' class="btn btn-warning">Save</button>
						<button type="button" class="btn btn-primary" id = "otherBtn" style="display: none;" onclick="form_hide();">Other Information
						</button>
						<a href = "{{ route('admission.index') }}" id = "finishBtn" class="btn btn-warning" style="display: none;">Finish</a>
					</div>
			</form>
		<div id = "{{ $ID }}Msg" class="text-center"></div>
	</section>
<!--code-->
<div id="show_otherinfo" class="col-lg-12" style="display: none;">
	<section class="box">
		<!-- <div class="pull-right">
			<a href = "{{ route($ID.'.index') }}" class="btn btn-danger">Back</a>
		</div>
		<br> -->
		<div class="content-body">
			<form id="{{ $ID3 }}Form">
				<input type="hidden" id = "studentA" name="student">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalfile3" class="form-label">Relation With Student</label>
								<select id="modalfile3" required=""  required="" class="form-control" name = "relation">
									<option value="">--Select--</option>
									<option value="Brother">Brother</option>
									<option value="Sister">Sister</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalname1" class="form-label">Full Name</label>
								<input type="text" required="" class="form-control" id="modalname1" name="full_name" placeholder="Enter name">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalpw1" class="form-label">Education</label>
								<input type="text" required="" class="form-control" id="modalpw1" name="education" placeholder="Education">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalemail1" class="form-label">Age</label>
								<input type="number" min="1"  required="" name="age" class="form-control" id="modalemail1" placeholder="e.g. 7">
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-12">
						<div class="text-center">
							<button type="submit"  class="btn btn-warning">Save</button>
						</div>
					</div>
				</div>
				<div id = "{{ $ID3 }}Msg" class="text-center"></div>
			</form>

			<div id = "relative-table-box" class="content-body" style="display: none;">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<h2>Relative Details</h2>
							<table id = "relative-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Full Name</th>
										<th>Education</th>
										<th>Age</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- END CONTAINER -->

<!-- General section box modal start -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog animated bounceInDown">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
				</button>
				<h4 class="modal-title">Section Settings
				</h4>
			</div>
			<form id="{{ $ID2 }}Form">

				<div class="modal-body">
					<div class="row">
						<input type="hidden" id="validate_subject" name="validate_subject">
						<div class="col-xs-12 col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="form-label">STD
										<span style="color:red;">*
										</span>:
									</label>
									<div class="controls">
										<select name = "standard" id = "standardPre" class="form-control" required>
											<option value = "">-Select-</option>
											@forelse (App\Models\Standard::get() as $s)
											<option value="{{ $s->std_id }}">{{ $s->std_name }}</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="form-label">Medium
										<span style="color:red;">*
										</span>:
									</label>
									<div class="controls">
										<select name = "medium" class="form-control">
											<option value = "-1">-Select-</option>
											@forelse (App\Models\Medium::get() as $m)
											<option value="{{ $m->med_id }}">{{ $m->med_name }}</option>
											@empty
											@endforelse
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id = "subjectPre"></div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit">Submit Marks</button>
				</div>
				<div id = "{{ $ID2 }}Msg" class="text-center"></div>
			</form>
		</div>
	</div>
</div>

<!-- modal end -->

@endsection

@push('footer')

<script>

	CRUD.formSubmission("{{ route($ID2.'.store') }}", 0,{}, 'previous');

	CRUD.formSubmission("{{ route($ID3.'.store') }}", 0,{}, 'relative');

	$("#addmission_form").addClass("open");

	function form_hide(){
		$("#show_otherinfo").toggle();
	}

	function prev_year_per(){
		$('#myModal').modal('show');
	}

	var find = "{{ route('find-school') }}",
	schoolUrl = "{{ route('school.store') }}";
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);

	$('#standard, #standardPre').on({
		'change' : function(){
			getSubject(this.value, this.id);
		}
	});
	function getSubject(id, di){
		$.ajax({
			url : '{{ route('subject-data') }}',
			type : 'post',
			data : {id : id},
			success : function(d){
				var val = [];
				if(d.length > 0){
					$.each(d, function(k,v){
						if(di == 'standardPre'){
							val.push('<div class="row">'
								+'<div class="col-xs-12 col-sm-12">'
								+'<div class="col-sm-6">'
								+'<div class="form-group">'
								+'<label class="form-label">Subject'+(++k)
								+'<span style="color:red;">*'
								+'</span>:'
								+'</label>'
								+'<div class="controls">'
								+'<input type="text" class="form-control" value="'+v.sub_name+'" disabled>'
								+'</div>'
								+'</div>'
								+'</div>'
								+'<div class="col-sm-6">'
								+'<div class="form-group">'
								+'<label class="form-label">Marks'
								+'<span style="color:red;">*'
								+'</span>:'
								+'</label>'
								+'<div class="controls">'
								+'<input type="number" class="form-control" name="mark['+v.sub_id+']" placeholder ="Mark">'
								+'</div>'
								+'</div>'
								+'</div>'
								+'</div>'
								+'</div>');
						}else{

							val.push('<div class="col-sm-6"><li><input type="checkbox" name = "subject[]" value="'+v.sub_id+'" class="skin-square-green"><label class="icheck-label form-label">'+v.sub_name+'</label></li></div>');
						}
					});
				}else{
					val.push('<div class = "alert alert-danger text-center">No Subject Found</div>');
				}
				if(di == 'standardPre'){
					$('#subjectPre').html(val);
				}else{
					$('#subject-box').show();
					$('#subjectsBox').html(val);
				}
				iCheck();
			}
		});
	}

</script>
@endpush