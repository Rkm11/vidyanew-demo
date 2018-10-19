@php
use App\Models\Certification;
$ID = 'certification';
@endphp
@extends('layouts.master')
@section('page-title')
All Student Certification
@endsection
@push('header')
<style type="text/css">
.status  text-center {

    font-weight: 600;
}
.status.text-center.success{
	font-weight: 600;
	color: green;
	}
	.status.text-center.error{
	font-weight: 600;
	color: red;
	}
	.status.text-center.wait{
	font-weight: 600;
	color: yellow;
	}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0">
			<input type="hidden" name="base_url" id="base_url"  value="<?php echo url('/'); ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Educational Qualification:</label>
								<div class="controls">
									<select class="form-control" name="medium" onchange="data()" id = "medium">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Medium::get() as $m)
										<option value = "{{ $m->med_id }}">{{ $m->med_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Course:</label>
								<div class="controls">
									<select onchange="data()" class="form-control" name="standard" id = "standard">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Standard::get() as $st)
										<option value = "{{ $st->std_id }}">{{ $st->std_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>

				</div>
				<div class="status text-center" id="message" style="display: none;">
					</div>
				<header class="panel_header"  style="background-color:#9ddac0;">
					<h2 class="col-sm-4 title pull-left" style="padding-left: 0px;">Certification</h2>
				</header>
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="certification-table" class="table table-striped  display">
								<thead >
									<tr>
										<th class="col-sm-3">Name</th>
										<th class="col-sm-9">Courses</th>
										<th class="col-sm-9">Action</th>
									</tr>
								</thead>
								<tbody id="cer-data">
									<?php if (!empty($stu)) {?>
									@foreach ($stu as $details)
									<tr>
										<td>{{$details->stu_name}}</td>
										<td>
										@foreach($details->courses as $courses)
										<!-- <div class="col-md-4"> -->
											@php
											$course = Certification::select(['*'])->where('cer_cid', $courses->std_id)
											->where('cer_sid', $details->stu_id)->first();
											$isChecked=(1==$course->cer_issued)?'checked=""':'';
											@endphp
											&nbsp;&nbsp;<input {{$isChecked}} type="checkbox" onclick="updateData('{{$courses->std_id}}','{{$details->stu_id}}')" value="{{$courses->std_id}}">&nbsp;&nbsp;{{$courses->std_name}}
										<!-- </div> -->
										@endforeach
										</td>
										<td><a class="btn btn-warning" href = "{{url('/certification/print/')}}/{{$details->stu_id}}">Print</a>'</td>
									</tr>
									@endforeach
									<?php } else {?>
									<tr>
										<td colspan="2">No Records Found</td>
									</tr>
									<?php }?>
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

	function data() {
		$.ajax({
			url : '{{ route('filtered-certification-data') }}',
			type : 'post',
			data : { standard : $('#standard').val(),medium:$('#medium').val()},
			success : function(d){
				console.log(d);
				$('#cer-data').html('');
				$('#cer-data').html(d);
			}
		});
	}

	function updateData(course_id,student_id) {
		$('#message').removeClass();
		$('#message').addClass('status text-center wait');
		$('#message').text('Updating record please wait......');
		$('#message').show();
		$('.loader').text('Updating record please wait......');
		$('.loader').show();
		$.ajax({
			url : '{{ route('certification.data') }}',
			type : 'get',
			data : {cer_cid:course_id,cer_sid:student_id},
			success : function(d){
				$('.loader').hide();
				if(d=='successU'){
					$('#message').hide();
					$('#message').removeClass();
					$('#message').addClass('status text-center success');
					$('#message').text('Updated Successfuly...');
					$('#message').show();
				}else{
					$('#message').hide();
					$('#message').removeClass();
					$('#message').addClass('status text-center wait');
					$('#message').text('Something went wrong......');
					$('#message').show();
				}
				 setTimeout(function () {
                     $('#message').hide();
                 }, 1000);
			}
		});
	}
	function print(id){
		return e+'/print/'+id;
	}
</script>
@endpush
