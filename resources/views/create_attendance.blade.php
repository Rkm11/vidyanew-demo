@extends('layouts.master')
@push('header')
<style type="text/css">
.radio{
	width: 23px!important;
	height: 23px!important;
}
</style>
@endpush
@section('page-title')
Create Attendances
@endsection
@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12 col-sm-12 ">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label">Batch<span style="color:red;">*</span>:</label>
							<div class="controls">
								<select class="form-control" name="batch" id = "batch" required>
									<option value="">--Select--</option>
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
							<label class="form-label">Medium<span style="color:red;">*</span>:</label>
							<div class="controls">
								<select class="form-control" name="medium" id = "medium" required>
									<option value="">--Select--</option>
									@forelse (App\Models\Medium::get() as $m)
									<option value = "{{ $m->med_id }}">{{ $m->med_name }}</option>
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
							<label class="form-label">Standard<span style="color:red;">*</span>:</label>
							<div class="controls">
								<select class="form-control" name="standard" id = "standard" required>
									<option value="">--Select--</option>
									@forelse (App\Models\Standard::get() as $st)
									<option value = "{{ $st->std_id }}">{{ $st->std_name }}</option>
									@empty
									@endforelse
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="form-label">Subjects<span style="color:red;">*</span>:</label>
							<div class="controls">
								<select class="form-control" name="subject" id = "subject" required>
									<option value="">--Select--</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="form-label">Date
								<span style="color:red;">*</span>:
							</label>
							<span class="desc">&nbsp;</span>
							<div class="controls">
								<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" id = "date" name = "date"/ required>
							</div>
						</div>
					</div>
				</div>
			</div>

			<header class="panel_header" style="background-color:#9ddac0;">
				<h2 class="col-sm-3 title pull-left" style="padding: 0px;">Attendance Sheet</h2>
				<div class="col-sm-9 save" id = "msg"></div>
			</header>

			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="table-responsive">
						<table id="attendance-table" class="table table-striped dt-responsive display">
							<thead style="background-color:#fff;">
								<tr>
									<th>ID</th>
									<th>Student Name</th>
									<th>Present</th>
									<th>Absent</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div><br>

					<div class="row">
						<div class="col-xs-12">
							<div class="pull-right">
								<a href = "{{ route('attendance.index') }}" class="btn btn-success">Confirm</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</section>
</div>
@endsection

@push('footer')
<script type="text/javascript">

	$('#batch, #standard, #medium, #subject').on({
		'change' : function(){
			if($('#subject').val() != '-1'){
				// console.log(this.value);
				$('#attendance-table').DataTable().destroy();
				data();
			}
		}
	});
	// data();
	function data() {
		$('#attendance-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url : '{!! route('attendance.data') !!}',
				type : 'get',
				data : function(d){
					d.batch = $('#batch').val();
					d.subject = $('#subject').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					// d.date = $('#date').val();
				}
			},
			columns: [
			{data: 'stu_id', name: 'students.stu_id'},
			{data: 'stu_name', name: 'stu_name'},
			{},
			{}
			],
			columnDefs: [{
				'targets': 2,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					// iCheck();

					return '<input tabindex="5" data-stu = "'+full.stu_id+'" type="radio" id="square-radio-2" name="att'+full.stu_id+'" class="skin-square-green radio" onclick = "updateAttendance('+full.stu_id+', 1);">';
				}
			},{
				'targets': 3,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					return '<input tabindex="5" type="radio" id="square-radio-1" name="att'+full.stu_id+'" class="skin-square-red radio" data-stu = "'+full.stu_id+'" onclick = "updateAttendance('+full.stu_id+', 0);">';
				}
			}
			]
		});

	}

	function updateAttendance(id, val){
		var fd = new FormData();
		fd.append('batch',$('#batch').val());
		fd.append('subject',$('#subject').val());
		fd.append('standard', $('#standard').val());
		fd.append('medium',$('#medium').val());
		fd.append('student',id);
		fd.append('result',val);
		fd.append('added',$('#date').val());
	if(''==$('#batch').val() || ''==$('#date').val() ||''==$('#medium').val() || ''==$('#standard').val()||''==$('#subject').val()){
		alert('Please Select all parameters.');
		$('input[name="att'+id+'"]').attr('checked', false);
		return false;
	}
		$.ajax({
			url : '{{ route('attendance.store') }}',
			data : fd,
			type : 'post',
			processData : false,
			contentType : false,
			success : function(data){

				$('#msg').html('Saving data Automatically...');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			},error : function(xhr){

				$('#msg').html('<p style = "color:red;">Something Went Wrong!! Please Re-Enter select previous Attendance</p>');
				window.setTimeout(function () {
					$('#msg').html('');
				},800);
			}
		}).error(function(xhr){
			$('#msg').html('<p style = "color:red;">Something Went Wrong!! Please Re-Enter select previous Attendance</p>');
			window.setTimeout(function () {
				$('#msg').html('');
			},800);
		});
	}
	function getTrail(){
		$('.iradio_square-green').each(function(k,v){
			var st = $(this).find('input').attr('data-stu');
			// $(this).attr('onclick','updateAttendance('+st+', 1);');
			$(this).attr('onclick','console.log("hi");');
		});
		$('.iradio_square-red').each(function(k,v){
			var st = $(this).find('input').attr('data-stu');
			$(this).attr('onclick','updateAttendance('+st+', 0);');
		});
	}
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
					val.push('<option value="">--Select--</option>');
					$.each(d, function(k,v){
						val.push('<option value="'+v.sub_id+'">'+v.sub_name+'</option>');
					});
					$('#subject').html(val);
				}
			}
		});
	}
	// updateAttendance(id, val);
</script>
@endpush
