@extends('layouts.master')
@section('page-title')
Create Marksheet
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

@endpush
@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<form>
				<div class="row">
						<div class="col-sm-12">
						<div class="col-sm-3">

							<div class="form-group">
								<label class="form-label">Test<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="test" id = "test">
										<option value="">--Select--</option>
										@forelse (App\Models\Test::get() as $b)
										<option value = "{{ $b->id }}">{{ $b->test_no }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text"  class="datepicker" placeholder="dd-mm-yy" id="exam_date" name="exam_date" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Out Of Mark<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" title=" Mark 0-100" name="outtmark" id="outtmark" placeholder="e.g  out of 100" maxlenght="100" pattern="[0-9]{100}" required>
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
									<select class="form-control" name="medium" id = "medium">
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
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="standard" id = "standard">
										<option value="">--Select--</option>
										@forelse (App\Models\Standard::get() as $st)
										<option value = "{{ $st->std_id }}">{{ $st->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Subjects Offered<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="subject" id = "subject">
										<option value="">--Select--</option>
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>

				<header class="panel_header" style="background-color:#9ddac0;">
					<h2 class="col-sm-4 title pull-left" style="padding-left: 0px;">Create Marksheet Sheet</h2>
					<div class="col-sm-6 save" id = "msg"></div>
				</header>
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="marksheet-table" class="table table-striped display">
								<thead style="background-color:#fff;">

									<tr >
										<th>Student Name</th>
										<th>Obt_mark</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="clearfix"></div><br>


					</div>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</section>
</div>
@endsection

@push('footer')
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
</script>
@endpush
