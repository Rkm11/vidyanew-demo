@extends('layouts.master')
@section('page-title')
All Student Certification
@endsection
@push('header')
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
								<label class="form-label">Batch<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="batch" id = "batch">
										<option value="-1">--Select--</option>
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
										<option value="-1">--Select--</option>
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
									<select class="form-control" name="standard" id = "standard">
										<option value="-1">--Select--</option>
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
									<select class="form-control" name="subject" id = "subject">
										<option value="-1">--Select--</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Start Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="dd-mm-yyyy" name="startDate" id="startDate" class="form-control datepicker">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">End Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="dd-mm-yyyy" name="endDate" id="endDate" class="form-control datepicker">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label"></label>
								<div class="controls">
							<a href="javascript:void(0);" onclick="generateReport()" class="btn">Generate Report</a>
						</div>
						</div>
						</div>
					</div>
					</div>

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
									</tr>
								</thead>
								<tbody id="cer-data">
									@php
									@if (!empty($arrStu))
									@else
									<tr>
										<td colspan="2">No Records Found</td>
									</tr>
									@endPhp
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

<script type="text/javascript">

	$('#batch, #standard, #medium, #subject, #startDate,#endDate').on({
		'change' : function(){
			$('#attendance-table').DataTable().destroy()
			data();
		}
	});

    data();
	function data() {
		$.ajax({
			url : '{{ route('certification.data') }}',
			type : 'get',
			data : {},
			success : function(d){
			}
		});
	}

</script>
@endpush