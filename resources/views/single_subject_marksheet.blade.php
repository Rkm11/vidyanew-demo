@extends('layouts.master')
@section('page-title')
View Marksheets
@endsection

@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
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
						<div class="col-sm-6">
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
							<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Select Test<span style="color:red;">*</span>:</label>
								<div class="controls">
							<select class="form-control" name="test_name" id = "test_name">
										<option value="-1">--Select--</option>
										@forelse (App\Models\Test::get() as $test)
										<option value = "{{ $test->id }}">{{ $test->test_name }}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="print-report-div" style ="display:none;">
					<a id="print-report" class="btn btn-primary">Print</a>
				</div>
				<div>
					<button style ="display:none;" class="btn btn-primary" onclick="data()" id="fetch-data" name="fetch-data">Submit</button>
				</div>
				<header class="panel_header" style="background-color:#9ddac0;">
					<h2 class="col-sm-4 title pull-left" style="padding: 0px;">Marksheet Sheet</h2>
				</header>

				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="marksheet-table" class="table table-striped display">
								<thead style="background-color:#fff;">
									<tr>
										<td>Name</td>
										<td>Subject</td>
										<td>Test Name</td>
										<td>Marks</td>
										<!-- <th>T-10</th>
										<th>T-11</th>
										<th>T-12</th>
										<th>T-13</th>
										<th>T-14</th>
										<th>T-15</th>
										<th>T-16</th>
										<th>T-17</th>
										<th>T-18</th>
										<th>T-19</th>
										<th>T-20</th>
										<th>Total_Mark</th>	-->
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="clearfix"></div>
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

{{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script> --}}
<script type="text/javascript">

	$('#batch, #standard, #medium,#test_name').on({
		'change' : function(){
			$('#marksheet-table').DataTable().destroy();
			data();
		}
	});

	data();
		function data() {
			$('#marksheet-table').DataTable({
                processing: true,
                //serverSide: true,
                searching: true,
                ajax:{
                	url:'{!! route('marksheet-view.alldata') !!}',
                type : 'get',
				data : function(d){
					d.batch = $('#batch').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					d.subject = $('#subject').val();
					d.test_name = $('#test_name').val();
				},
			},
                columns: [
                {data : 'stu_name' , name : 'stu_name'},
                {data : 'sub_name' , name : 'sub_name'},
                {data: 'test_name', name: 'test_name'},
                {data: 'mark_total', name: 'mark_total'}
                ]
            });
		}
	$('#standard').on({
		'change' : function(){
			getTest(this.value);
		}
	});
	$('#batch, #standard, #medium,#test_name').on({
		'change' : function(){
			if(	 $('#test_name').val()!='-1' &&
			 	$('#standard').val()!='-1'&& $('#medium').val()!='-1' &&
			 	 $('#batch').val()!='-1'){
				var test_name=$('#test_name').val();
				var standard=$('#standard').val();
				var medium=$('#medium').val();
				var subject=$('#subject').val();
				var batch=$('#batch').val();
				var url=$('#base_url').val()+'/download-all?batch='+batch+'&standard='+standard+'&test_medium='+medium+'&test_name='+test_name;
				$('#print-report').attr('href',url);
				$('#print-report-div').show();
			}else{
				$('#print-report').attr('href','');
				$('#print-report-div').hide();
			}
			// getTest(this.value);
		}
	});

	function getTest(id){
		$('#tests-name').hide();
		$('#fetch-data').hide();
		$.ajax({
			url : '{{ route('test-name-data') }}',
			type : 'get',
			data : {standard : id},
			success : function(d){
				var val = [];
				if(d.length > 0){
					val.push('<option value="-1">--Select--</option>');
					$.each(d, function(k,v){
					val.push('<option value="'+v.id+'">'+v.test_name+'</option>');
		});
					// $('#test_name').html(val);
					// $('#tests-name').show();
					// $('#btn_print').show();
	}else{
		// val.push('<option value="-1">--Select--</option>');
					// $('#test_name').html(val);
					// $('#tests-name').show();
	}
	console.log(val);
}
});
}
function printData () {

}

	// updateAttendance(id, val);
</script>
@endpush
