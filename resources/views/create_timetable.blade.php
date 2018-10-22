@extends('layouts.master')
@section('page-title')
Create Timetable
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
$ID = 'timetable';
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
			<div class="col-md-12">
			<form id = "{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-3">
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

						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Medium<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" required="" name="medium" id = "medium">
										<option value="">--Select--</option>
										@forelse (App\Models\Medium::get() as $m)
										<option value = "{{ $m->med_id }}">{{ $m->med_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>


						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" required="" name="standard" id = "standard">
										<option value="">--Select--</option>
										@forelse (App\Models\Standard::get() as $st)
										<option value = "{{ $st->std_id }}">{{ $st->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
						<div class="form-group">
							<label class="form-label">Subjects<span style="color:red;">*</span>:</label>
							<div class="controls">
								<select class="form-control" name="subject" id = "subject" required>
									<option value="">--Select--</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Date
									<span style="color:red;">*</span>:
								</label>
								<div class="controls">
									<input type="text"  class="form-control datepicker" id="date" data-format="yyyy-mm-dd" name="date" placeholder="Date" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Start Time<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" required="" name="start_time" id = "start_time">
										<?php
$start = "00:00"; //you can write here 00:00:00 but not need to it
$end = "23:30";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;
while ($tNow <= $tEnd) {
	echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
	$tNow = strtotime('+30 minutes', $tNow);
}
?>
									</select>
								</div>
							</div>
						</div>
												<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">End Time<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" required="" name="end_time" id = "end_time">
										<?php
$start = "00:00"; //you can write here 00:00:00 but not need to it
$end = "23:30";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;
while ($tNow <= $tEnd) {
	echo '<option value="' . date("H:i", $tNow) . '">' . date("H:i", $tNow) . '</option>';
	$tNow = strtotime('+30 minutes', $tNow);
}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label class="form-label">&nbsp;</label>
							<div class="controls">
						<div class="text-center">
							<button type="submit" class="btn btn-success" >Create</button>
						</div>
					</div>
					</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center">
				</div>
				<div class="clearfix"></div>
			</form>
	</div>
		</div>
	</section>
</div>
<h1><center>View Timetable</center></h1>
<hr>
<div class="col-lg-13">
	<section class="box ">

		<div class="content-body" style="background-color:#9ddac0;">
			<input type="hidden" name="base_url" id="base_url"  value="<?php echo url('/'); ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Batch<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="batches" id = "batches">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Batch::get() as $b)
										<option value = "{{ $b->batch_id }}">{{ $b->batch_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Medium<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="mediums" id = "mediums">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Medium::get() as $m)
										<option value = "{{ $m->med_id }}">{{ $m->med_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="standards" id = "standards">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Standard::get() as $st)
										<option value = "{{ $st->std_id }}">{{ $st->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Subjects<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="subjects" id = "subjects">
										<option value="-1">--Select--</option>
									</select>
								</div>
							</div>
						</div> -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">

						<div class="col-sm-3">
							<div class="form-group">
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="dd-mm-yyyy" name="startDate" id="startDate" class="form-control datepicker">
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">End Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="dd-mm-yyyy" name="endDate" id="endDate" class="form-control datepicker">
								</div>
							</div>
						</div> -->
					</div>
					</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="timetable-table" >
							<thead style="background-color:#fff;">
								<tr>
									<th>Date</th>
									<th>Standard</th>
									<th>Batch</th>
									<th>Subjects</th>
									<th>Start Time</th>
									<th>End Time</th>

								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@push('footer')
<script>
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);
</script>
<script type="text/javascript">

	function updateAttendance(id, val, test){
		if($('#subject').val()=='' ||$('#batch').val()=='' ||$('#date').val()=='' ||$('#medium').val()==''
		||$('#standard').val()==''||$('#medium').val()==''|| $('#end_time').val()|| $('#start_time').val()){
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
				$('#subject_div').show();
				var val = [];
				if(d.length > 0){
					// val.push('<option value="">--Select--</option>');
					$.each(d, function(k,v){
						val.push('<option value="'+v.sub_id+'">'+v.sub_name+'</option>');
						// val.push('&nbsp<input type="checkbox" id="subject" name="subject[]"  value="'+v.sub_id+'">'+v.sub_name+'&nbsp');
					});
					$('#subject' ).html(val);
				}else{
					$('#subject').html('');
					val.push('<b>No Subjects available for this standard</b>');
					$('#subject').html(val);
				}
			}
		});
	}
</script>
<script type="text/javascript">
	$('#batches, #standard, #medium, #subjects, #startDate,#endDate').on({
		'change' : function(){
			$('#timetable-table').DataTable().destroy()
			timetableData();
		}
	});
	timetableData();
	function timetableData(){
		mesg="Are you sure you want to delete this test?";
		$('#timetable-table').DataTable({
			processing: true,
			//serverSide: true,
			searching: true,
			lengthChange: false,
			//destroy:true,
			ajax: {
			url : '{!! route('timetable.data') !!}',
			data : function(d){
					d.batch = $('#batches').val();
					d.subject = $('#subjects').val();
					d.standard = $('#standards').val();
					d.medium = $('#mediums').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
				}
			},
			columns: [
			{data : 'time_date' , name : 'time_date'},
			{data : 'std_name' , name : 'std_name'},
			{data : 'std_name' , name : 'std_name'},
			{data : 'batch_name' , name : 'batch_name'},
			{data: 'time_start', name: 'time_start'},
			{data: 'time_end', name: 'time_end'}
			],
			columnDefs: [
			],
			"order": [[ 1, "desc" ]]
		});
	}

	function pr(id){
		if(confirm('Are you sure delete test?')){
		window.location.href ="test/delete/"+id;
		}
		// return "test/delete/"+id;
	}
		function pr1(id){
		return "test/edit/"+id;
	}
	// var v = '{{ url('admission/') }}',
	// e = '{{ url('enquiry') }}';
	// function redA(id){
	// 	return v+'/confirm/'+id;
	// }
	var v = '{{ url('admission/') }}',
	e = '{{ url('enquiry') }}';
	function redA(id){
		return v+'/'+id+'/edit';
	}

		function edit(id){
		return e+'/'+id+'/edit';
	}
	//model
	function follow(id){
		var base_url=$('#base_url').val();
		$('#follow-id').val('');
		$('#testModal').modal('show');
		$('#follow-id').val(id);
            $.ajax({
                type : 'get',
                url:base_url+'/get-enquiry',
                data : {'id' : id},
                dataType: 'json',
                success : function(d){
                	var obj = JSON.parse(d);
                	console.log(obj.follow1);

                }
            });
        }

	// function edit1(id){
	// 		return e+'/'+id+'/';
	// }
</script>
@endpush
