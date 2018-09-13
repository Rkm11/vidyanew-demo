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
									<select class="form-control" onchange="fetchTest(this.value)" name="testid" id = "testid">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Test::orderBy('id',' DESC')->get() as $b)
										<option value = "{{ $b->id }}">{{ $b->test_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Test Date:</label>
								<div class="controls">
									<input type="text"   readonly="" placeholder="dd-mm-yy" id="exam_date" name="exam_date" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Out Of Mark:</label>
								<div class="controls">
									<input type="text" title=" Mark 0-100" readonly="" name="outtmark" id="outtmark" placeholder="e.g  out of 100" maxlenght="100" pattern="[0-9]{100}" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Subject:</label>
								<div class="controls">
									<select name="subject" id="subject">
										<option value="-1">Select</option>
									</select>
								</div>
							</div>
						</div>
						</div>
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Batch<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="Batch" name="batch_name" id="batch_name" readonly="" >
									<input type="hidden" placeholder="Batch" name="batch" id="batch" readonly="" >
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Medium<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="Medium" name="medium_name" id="medium_name" readonly="">
									<input type="hidden" placeholder="Medium" name="medium" id="medium" readonly="">
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="Standard" name="standard_name" id="standard_name" readonly="">
									<input type="hidden" placeholder="Standard" name="standard" id="standard" readonly="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<BUTTON  type="button" class="btn btn-primary pull-right" onclick="fetchStudents()">Fetch Students</BUTTON>
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
	function fetchStudents() {
		if('-1'!=$('#test').val() && '-1'!=$('#subject').val()&&$('#subject').val()!=null ){
			$('#marksheet-table').DataTable().destroy();
				data();
		}else{
						alert('Please Select all filters to fetch student details.');
			return false;
		}
	}
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
					d.test_id = $('#test').val();
					d.batch = $('#batch').val();
					d.subject = $('#subject').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					d.test_id = $('#testid').val();
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
					return '  <input  type="text" class="form-control" onkeyup = "updateAttendance('+full.stu_id+',this.value, 1);" value = "'+c(full.mark_total)+'">';

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
		fd.append('total',val);
		fd.append('testid',$('#testid').val());
		fd.append('added',$('#added').val());
		fd.append('outtmark', $('#outtmark').val());
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

function fetchTest(id){
		$.ajax({
			url : '{{ route('test-data') }}',
			type : 'post',
			data : {id : id},
			success : function(d){
				var val = [];
				// console.log(d.test_subjects_name);
				if(d){
					$('#subject').html('');
					val.push('<option value="-1">--Select--</option>');
					if(d.test_subjects_name.length > 0){
					$.each(d.test_subjects_name, function(k,v){
						// console.log(v);
						val.push('<option  value="'+v.sub_id+'">'+v.sub_name+'</option>');
						// val.push('&nbsp<input type="checkbox" id="subject" name="subject[]"  value="'+v.sub_id+'">'+v.sub_name+'&nbsp');
					});
					$('#subject' ).html(val);
				}else{
					$('#subject').html('');
					 val.push('<option value="-1">--Select--</option>');
					$('#subject').html(val);
				}
					ids=[];
					ids.push(d.test_subject);
					$('#exam_date').val(d.test_date);
					$('#sub').val(d.test_subjects_name);
					$('#subject').val(d.test_subjects);
					$('#medium_name').val(d.med_name);
					$('#standard_name').val(d.std_name);
					$('#outtmark').val(d.test_outof);
					$('#batch_name').val(d.batch_name);
					$('#medium').val(d.med_id);
					$('#standard').val(d.std_id);
					$('#batch').val(d.batch_id);
				}else{
					// alert('Invalid Test Name');
					// location.reload();
				}
			}
		});
	}
</script>
@endpush
