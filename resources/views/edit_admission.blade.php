@extends('layouts.master')

@php
function chkN($v){
	return (!is_null($v)) ? $v : '';
}
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
	Complete {{ ucfirst($ID) }} of {{ $a->stu_first_name. ' '. $a->stu_last_name }}
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
				<input type="hidden" name="sid" value="{{ $a->ad_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch No
									<span style="color:red;">*</span>:
								</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">

									<select class="form-control" name="ad[batch_year]" required>
										<option value="">--Select--</option>
										<option value="FC Road" <?php echo ('FC Road' == $a->ad_batch_year) ? 'selected' : ''; ?>>FC Road</option>
										<option value="Karve nagar" <?php echo ('Karve nagar' == $a->ad_batch_year) ? 'selected' : ''; ?>>Karve nagar</option>
										<option value="Kothrud" <?php echo ('Kothrud' == $a->ad_batch_year) ? 'selected' : ''; ?>>Kothrud</option>
										<option value="MIT" <?php echo ('MIT' == $a->ad_batch_year) ? 'selected' : ''; ?>>MIT</option>
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
									<input type="text" class="form-control" name="stu[uid]" placeholder="ID" value = "{{ chkN($a->stu_uid) }}" required>
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
									<input type="text" class="form-control datepicker" name="ad[date]" data-format="dd/mm/yyyy" value="{{(isset($a->ad_date))?$a->ad_date:date('d-m-Y')}}" required>
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
									<input type="text" title="Enter Your Name" class="form-control" name="stu[first_name]" placeholder="First Name"  value = "{{ chkN($a->stu_first_name) }}" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Parent Name" class="form-control" name="stu[middle_name]" placeholder="Middle Name" value = "{{ chkN($a->stu_middle_name) }}" pattern="[a-zA-Z]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Name" class="form-control" name="stu[last_name]" placeholder="Last Name" value = "{{ chkN($a->stu_last_name) }}" pattern="[a-zA-Z]+" required>
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
									<input type="email" pattern="(?!(^[.-].*|[^@]*[.-]@|.*\.{2,}.*)|^.{254}.)([a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@)(?!-.*|.*-\.)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,15}" title="Enter Valid Mail"  class="form-control" name="stu[email]" placeholder="Email Id"  value = "{{ chkN($a->stu_email) }}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mobile
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text" class="form-control" name="stu[mobile]" placeholder="Mobile Number" value = "{{ chkN($a->stu_mobile) }}" maxlength="10" pattern="[0-9]{10}" required>
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
									<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ $a->stu_dob }}" name="stu[dob]" placeholder="Date of Birth" required>
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
										<input tabindex="5" type="radio" id="square-radio-1" name="stu[gender]" class="skin-square-green" required value = "1" {{ ($a->stu_gender) ? 'checked' : ''}}>
										<label class="iradio-label form-label" for="square-radio-1">Male</label>
									</li>
								</ul>
							</div>
							<div class="col-sm-4">
								<ul class="list-unstyled">
									<li>
										<input tabindex="5" type="radio" id="square-radio-1" name="stu[gender]" class="skin-square-green" value = "0" {{ ($a->stu_gender) ? '' : ''}}>
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
									<input type="text" title="Enter Parent Number" class="form-control" name="stu[alt_mobile]" placeholder="Phone Number 1" value = "{{ chkN($a->stu_alt_mobile) }}" maxlength="10" pattern="[0-9]{10}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch Time
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" name="ad[batch]">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										<option value = "{{ $b->batch_id }}" {{ ($a->ad_batch != '') ? (($a->ad_batch == $b->batch_id) ? 'selected' : '') : '' }}>{{ $b->batch_name }}</option>
										@empty
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
							<label class="form-label">Courses<span style="color:red;">*</span>:</label>
							<ul class="list-unstyled" id = "subjectsBox">
							</ul>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}EMsg" class="text-center">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="form-label" style="float:left;">School Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="ad[school]" id = "school-name"  value = "{{ chkN($a->ad_school) }}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" style="float:left;">Address
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<textarea cols="3" rows="4" class="form-control" name="stu[address]" required>{{ $a->stu_address }}</textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" style="float:left;">Upload Image
									<small>&nbsp;(1.Student)(2.Father,3.Mother - optional)</small>
									:
								</label>
								<div class="controls">
									<input type="file" class="form-control" name="student_img" style="margin-bottom: 1px;" >
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
								<label class="form-label" style="float:left;">Previous Year %
								</label>
								<div class="controls">
									<input type="text" class="form-control" name="ad[pre_percent]" placeholder="Previous Year" id = "previousYear" value = "{{ chkN($a->ad_pre_percent) }}">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" style="float:left;">Total Fees
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text" title="Enter Total Fees" class="form-control" name="ad[fees]" placeholder="Total Fees" value = "{{ chkN($a->ad_fees) }}" pattern="[0-9]+" required>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-12">
						<div class="" align="center" id="buttons">
							<button type="submit" id = "saveBtn" class="btn btn-primary">Save</button>
							 <button type="button" class="btn btn-primary" id = "otherBtn"  onclick="form_hide();">Other Information</button>
							<a href = "{{ route('admission.index') }}" id = "finishBtn" class="btn btn-warning" >Finish</a>
						</div>
					</div>
				</div>
			</form>
		</div>

		</div>
	</section>
</div>
<!--code-->
<div id="show_otherinfo" class="col-lg-12" style="display: none;">
	<section class="box ">
		<br>
		<div class="content-body">
			<form id="{{ $ID3 }}Form">
				<input type="hidden" name="student" value = "{{ $a->stu_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalfile3" class="form-label">Relation With Student<span style="color:red;">*</span></label>
								<select id="modalfile3" required=""  required="" class="form-control" name = "relation">
									<option value="">--Select--</option>
									<option value="Brother">Brother</option>
									<option value="Sister">Sister</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalname1" class="form-label">Full Name<span style="color:red;">*</span></label>
								<input type="text" required="" class="form-control" id="modalname1" name="full_name" placeholder="Enter name">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalpw1" class="form-label">Education<span style="color:red;">*</span></label>
								<input type="text" required="" class="form-control" id="modalpw1" name="education" placeholder="Education">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="modalemail1" class="form-label">Age<span style="color:red;">*</span></label>
								<input type="number" min="1"  required="" name="age" class="form-control" id="modalemail1" placeholder="e.g. 7">
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-12">
						<div class="text-center">
							<button type="submit" class="btn btn-primary">Save</button> |
							<a href = "{{ route('admission.index') }}" class="btn btn-success">Finish</a>
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
						<div class="col-xs-12 col-sm-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="form-label">STD
										<span style="color:red;">*
										</span>:
									</label>
									<div class="controls">
										<select name = "standard" id = "standardPre" class="form-control">
											<option value = "-1">-Select-</option>
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
											<option>-Select-</option>
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
					<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
					<button class="btn btn-success" type="submit">Save changes</button>
				</div>
				<div id = "{{ $ID2 }}Msg" class="text-center">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal end -->

@endsection

@push('footer')

<script>


	$("#addmission_form").addClass("open");



	CRUD.formSubmission("{{ route($ID2.'.store') }}", 0,{}, 'previous');

	CRUD.formSubmission("{{ route($ID3.'.store') }}", 0,{}, 'relative');

	$("#addmission_form").addClass("open");

	function form_hide(){
		$("#show_otherinfo").toggle();
	}

	function prev_year_per()
	{

		$('#myModal').modal('show');

	}

	var find = "{{ route('find-school') }}",
	schoolUrl = "{{ route('school.store') }}";

	CRUD.formSubmission("{{ route($ID.'.index') }}", 2, {});

	$('#standard, #standardPre').on({
		'change' : function(){
			getSubject(this.value, this.id);
		}
	});
	function getSubject(id, di){
		$.ajax({
url : '{{ route('standard-data') }}',
			type : 'get',
			data : {},
			success : function(d){
				var val = [];
				if(d.length > 0){
					$.each(d, function(k,v){
							chk = '';
							var subs = '{{ $a->ad_subjects }}'.split(',');
							for(var i=0; i<subs.length;i++) {
								subs[i] = +subs[i];
							}
							chk = ($.inArray(v.std_id, subs) >= 0) ? 'checked' : '';

							val.push('<div class="col-sm-3"><li><input type="checkbox" name = "subjects[]" value="'+v.std_id+'" '+chk+' class="skin-square-green"><label class="icheck-label form-label">'+v.std_name+'</label></li></div>');
					});
				}else{
					val.push('<div class = "alert alert-danger text-center">No Course Found</div>');
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

	getSubject();
</script>
@endpush