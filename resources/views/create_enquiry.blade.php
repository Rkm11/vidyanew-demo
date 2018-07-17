@extends('layouts.master')
@php
$ID = 'enquiry';
$ID2 = 'previous';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
	ID2 = '{{ $ID2 }}';
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
	<section class="box " style="background-color:#9ddac0;">
		<br/>

		<div class="content-body" style="background-color:#9ddac0;">
			<form id="{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Student Name<span style="color:red;">*</span>:</label>
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
									<input type="text" title="Enter Your Middle Name" class="form-control" name="stu[middle_name]" placeholder="Middle Name" pattern="[a-zA-Z]+" required>
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
								<label class="form-label">Email:</label>

								<div class="controls">
									<input type="email"  title="Enter Valid Mail" id = "email" class="form-control" name="stu[email]" placeholder="Email Id">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mobile<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter your number" class="form-control" name="stu[mobile]" placeholder = "Mobile Number" maxlength="10"  pattern="[0-9]{10}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter Your Parent Name" class="form-control" name="p[first_name]" placeholder="Parent Name" pattern="[a-z A-Z]+" required>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Number 1<small>(optional)</small><span style="color:red;"></span>:</label>
								<div class="controls">
									<input type="text" title="Enter your parent mobile number" maxlength="10"  pattern="[0-9]{10}" class="form-control" name="p[mobile]" placeholder="Parent Number" >
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Parent Number 2<small>(optional)</small><span style="color:red;"></span>:</label>
								<div class="controls">
									<input type="text" title="Enter your parent mobile number" maxlength="10"  pattern="[0-9]{10}" class="form-control" name="p[alt_mobile]" placeholder="Parent Number">
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
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Batch
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" id = "batch" name="ad[batch]" required>
										<option value="">--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										<option value = "{{ $b->batch_id }}">{{ $b->batch_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Medium
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<select class="form-control" id = "medium" name="ad[medium]" required>
										<option value="">--Select--</option>
										@forelse (App\Models\Medium::get() as $m)
										<option value = "{{ $m->med_id }}">{{ $m->med_name }}</option>
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
									<input type="text" title="This must be a %" class="form-control" name="ad[pre_percent]" placeholder="Previous Year" id = "previousYear">
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
				<div id = "{{ $ID }}Msg" class="text-center"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="form-label">School Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title="Enter Your School Name" name="ad[school]" class="form-control" placeholder="School Name" pattern="[a-z A-Z 0-9]+" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 ">
					<div class="form-group">
						<label class="form-label">Address
							<span style="color:red;">*</span>:
						</label>
						<div class="controls">
							<textarea title="Enter Address" cols="3" rows="4" class="form-control" name="stu[address]" required ></textarea>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 ">
					<div class="form-group">
						<label class="form-label">Who refer you?:
						</label>
						<div class="controls">
							<input type="text" title="Who refer you" name="ad[reffered_by]" class="form-control" placeholder="Who refer you">
						</div>
					</div>
				</div>
								<div class="col-xs-6 col-sm-6 ">
					<div class="form-group">
						<label class="form-label">Preferred batch timing:
						</label>
						<div class="controls">
							<input type="text" title="Preferred batch timing" name="ad[preffered_batches]" class="form-control" placeholder="Preferred batch timing">
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

	</section>
</div>
<!-- SHOW INSERTED DATA-->
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
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{});
	CRUD.formSubmission("{{ route($ID2.'.store') }}", 0,{}, '333');
	var find = "{{ route('find-school') }}",
	schoolUrl = "{{ route('school.store') }}";
	// en = '{{ route('enquiry.index') }}';

	$('#standard').on({
		'change' : function(){
			getSubject(this.value);
		}
	});
	function getSubject(id){
		$.ajax({
			url : '{{ route('subject-data') }}',
			type : 'post',
			data : {id : id},
			success : function(d){
				var val = [];
				if(d.length > 0){
					$.each(d, function(k,v){

						val.push('<div class="col-sm-6"><li><input type="checkbox" name = "subject[]" value="'+v.sub_id+'" class="skin-square-green"><label class="icheck-label form-label">'+v.sub_name+'</label></li></div>');
					});
				}else{
					val.push('<div class = "alert alert-danger text-center">No Subject Found</div>');
				}

				$('#subject-box').show();
				$('#subjectsBox').html(val);
				iCheck();
			}
		});
	}

		function prev_year_per(){
		$('#myModal').modal('show');
	}


		$('#standardPre').on({
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
	$('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                alert("Checkbox is checked.");
            }
            else if($(this).prop("checked") == false){
                alert("Checkbox is unchecked.");
            }
        });

</script>
@endpush