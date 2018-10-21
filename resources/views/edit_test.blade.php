@extends('layouts.master')
@section('page-title')
Update Test
@endsection

@push('header')
<style type="text/css">
#marksheet-table input{
	width: 51px!important;
}
#marksheet-table th{
	width: 80px!important;
}
.dataTable{
	width: 969px!important;
}

</style>
@php
$ID = 'test';
@endphp
@endpush
<script>
	ID = '{{ $ID }}';
	</script>
@section('content')
<div class="pull-right">
	<a href = "javascript:void(0);" onclick="window.history.back()" class="btn btn-danger">Back</a>
</div>
<div class="col-lg-12">
	<section class="box ">


		<div class="content-body" style="background-color:#9ddac0;">
			<form id = "{{ $ID }}Form">
				<div class="row">
						<div class="col-sm-12">
						<div class="col-sm-3">

							<div class="form-group">
								<label class="form-label">Test Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									@php
									$test_name=explode('-',$test->test_name);
									$test_name=$test_name[0];
									@endphp
									<input type="text" class="form-control" value="{{$test_name}}"   placeholder="Test Name" id="name" name="name" required>
									<input type="hidden" value="{{$test->id}}"   placeholder="Test Name" id="test_id" name="test_id" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control datepicker" placeholder="dd-mm-yy" id="date" name="date" value="{{$test->test_date}}" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Out Of Mark<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" title=" Mark 0-100" name="outof" id="outtmark" placeholder="e.g  out of 100" maxlength="100" value="{{$test->test_outof}}" required>
								</div>
							</div>
						</div>
						</div>
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="batch" id = "batch" required>
										<option value="">--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										@php
										$bChk = ($b->batch_id == $test->test_batch) ? 'selected' : '';
										@endphp
										<option value = "{{ $b->batch_id }}" {{ $bChk }}>{{ $b->batch_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Medium<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="medium" id = "medium">
										<option value="">--Select--</option>
										@forelse (App\Models\Medium::get() as $m)
										@php
										$bChk = ($m->med_id == $test->test_medium) ? 'selected' : '';
										@endphp
										<option value = "{{ $m->med_id }}" {{ $bChk }}>{{ $m->med_name }}</option>
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
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="standard" id = "standard">
										<option value="">--Select--</option>
										@forelse (App\Models\Standard::get() as $st)
										@php
										$bChk = ($st->std_id == $test->test_standard) ? 'selected' : '';
										@endphp
										<option value = "{{ $st->std_id }}" {{$bChk}}>{{ $st->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6" id="subject_div" style="display:none;">
							<div class="form-group">
								<label class="form-label">Subjects Offered<span style="color:red;">*</span>:</label>
								<div class="controls" id="subject">
								<ul class="list-unstyled" id = "subjectsBox">
							</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-sm-12">
						<div class="text-center">
							<button type="submit" class="btn btn-success">Update</button>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</section>
</div>
@endsection

@push('footer')
<script>
	CRUD.formSubmission("{{ route('test.store') }}", 0,{}, ID);
</script>
<script type="text/javascript">
	function c(v) {
		return (v == null) ? 0 : v;
	}
	$('#batch, #standard, #medium, #subject, #test').on({
		'change' : function(){
			if($('#subject').val() != ''){
				$('#marksheet-table').DataTable().destroy();
				data();
			}
		}
	});
	function data() {
		$('#marksheet-table').removeAttr('width').DataTable({
			scrollY:"969px",
			scrollX:true,
			scrollCollapse:true,
			paging:false,
			processing: true,
			//serverSide: true,
			ajax: {
				url : '{!! route('marksheet.data') !!}',
				type : 'get',
				data : function(d){
					d.batch = $('#batch').val();
					d.subject = $('#subject').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
				}
			},
			columns: [
			{width: '12px', data: 'stu_name', name: 'stu_name'},
			{}
			],
			columnDefs: [{

				'targets': 1,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					// var t = c(full.mark_test_1);
					return '  <input  type="text" class="form-control" onkeyup = "updateAttendance('+full.stu_id+',this.value, 1);" value = "'+c(full.mark_test_1)+'">';

				}
			}
			],fixedColumns: true
		});
	}

	function updateAttendance(id, val, test){
		if($('#subject').val()=='' ||$('#outtmark').val()=='' ||$('#exam_date').val()=='' ||$('#medium').val()==''
		||$('#standard').val()==''||$('#medium').val()==''||$('#batch').val()==''){
					alert('All filters are required before entering marks.');
				}else{
		var fd = new FormData();
		fd.append('subject',$('#subject').val());
		fd.append('student',id);
		fd.append('result',val);
		fd.append('test',$('#test').val());
		fd.append('outtmark',$('#outtmark').val());
		fd.append('date',$('#exam_date').val());
		$.ajax({
			url : '{{ route('marksheet.store') }}',
			data : fd,
			type : 'post',
			processData : false,
			contentType : false,
			success : function(data){
				if(data=='outbound'){
					alert('Obtain marks should be less than out of marks');
					return false;
				}
				// console.log(data);
				$('#total-'+id).val(data);
				$('#msg').html('Saving data Automatically...');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			},error : function(xhr){

				$('#msg').html('<p style = "color:red;">Something Went Wrong!! Please Re-Enter Previous Mark</p>');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			}
		}).error(function(xhr){
			$('#msg').html('<p style = "color:red;">Something Went Wrong!! Please Re-Enter Previous Mark</p>');
			window.setTimeout(function () {
				$('#msg').html('');
			},800);
		});
		}
	}
	$('#standard').on({
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
				$('#subject_div').show();
				var val = [];
				if(d.length > 0){
					// val.push('<option value="">--Select--</option>');
					$.each(d, function(k,v){
						chk = '';
							@if ($test->test_subjects)
							var subs = '{{ $test->test_subjects }}'.split(',');
							for(var i=0; i<subs.length;i++) {
								subs[i] = +subs[i];
							}
							chk = ($.inArray(v.sub_id, subs) >= 0) ? 'checked' : '';
							@endif
						// val.push('<option value="'+v.sub_id+'">'+v.sub_name+'</option>');
						val.push('&nbsp<input type="checkbox" id="subject" name="subject[]" '+chk+' value="'+v.sub_id+'">'+v.sub_name+'&nbsp');
					});
					// $('#subject' ).html(val);
										$('#subject-box').show();
					$('#subjectsBox').html(val);
				}else{
					// $('#subject').html('');
					val.push('<b>No Subjects available for this standard</b>');
					$('#subjectsBox').html(val);
				}
			}
		});
	}
		@if ($test->test_standard)
	getSubject('{{ $test->test_standard }}','standard');
	@endif
</script>
@endpush
