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
								<label class="form-label">Subjects Offered<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="subject" id = "subject">
										<option value="-1">--Select--</option>
									</select>
								</div>
							</div>
						</div>
					</div>
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
										<th>Student Name</th>
										<th>Subject</th>
										<th>Total Mark</th>
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

	$('#batch, #standard, #medium, #subject').on({
		'change' : function(){

			$('#marksheet-table').DataTable().destroy();
			data();
		}
	});
	data();
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
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					d.subject = $('#subject').val();
				}
			},
			columns: [
			{data: 'stu_name', name: 'stu_name'},
			{data: 'sub_name', name: 'subjects.sub_name'},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{}/*,
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{}*/
			],
			columnDefs: [{
				'width': '5%',
				'targets': 2,
				'render': function (data, type, full, meta){
					return full.mark_test_1;
				}
			},{
				'width': '5%',
				'targets': 3,
				'render': function (data, type, full, meta){
					return full.mark_test_2;
				}
			},{
				'width': '5%',
				'targets': 4,
				'render': function (data, type, full, meta){
					return full.mark_test_4;
				}
			},{
				'width': '5%',
				'targets': 5,
				'render': function (data, type, full, meta){
					return full.mark_test_4;
				}
			},{
				'width': '5%',
				'targets': 6,
				'render': function (data, type, full, meta){
					return full.mark_test_5;
				}
			},{
				'width': '5%',
				'targets': 7,
				'render': function (data, type, full, meta){
					return full.mark_test_6;
				}
			},{
				'width': '5%',
				'targets': 8,
				'render': function (data, type, full, meta){
					return full.mark_test_7;
				}
			},{
				'width': '5%',
				'targets': 9,
				'render': function (data, type, full, meta){
					return full.mark_test_8;
				}
			/*},{
				'width': '5%',
				'targets': 22,
				'render': function (data, type, full, meta){
					return full.mark_test_9;
				}
			},{
				'width': '5%',
				'targets':11,
				'render': function (data, type, full, meta){
					return full.mark_test_10;
				}
			},{
				'width': '5%',
				'targets': 12,
				'render': function (data, type, full, meta){
					return full.mark_test_11;
				}
			},{
				'width': '5%',
				'targets': 13,
				'render': function (data, type, full, meta){
					return full.mark_test_12;
				}
			},{
				'width': '5%',
				'targets': 14,
				'render': function (data, type, full, meta){
					return full.mark_test_13;
				}
			},{
				'width': '5%',
				'targets': 15,
				'render': function (data, type, full, meta){
					return full.mark_test_14;
				}
			},{
				'width': '5%',
				'targets': 16,
				'render': function (data, type, full, meta){
					return full.mark_test_15;
				}
			},{
				'width': '5%',
				'targets': 17,
				'render': function (data, type, full, meta){
					return full.mark_test_16;
				}
			},{
				'width': '5%',
				'targets': 18,
				'render': function (data, type, full, meta){
					return full.mark_test_17;
				}
			},{
				'width': '5%',
				'targets': 19,
				'render': function (data, type, full, meta){
					return full.mark_test_18;
				}
			},{
				'width': '5%',
				'targets': 20,
				'render': function (data, type, full, meta){
					return full.mark_test_19;
				}
			},{
				'width': '5%',
				'targets': 21,
				'render': function (data, type, full, meta){
					return full.mark_test_20;
				}*/
			},{
				'width': '5%',
				'targets': 10,
				'render': function (data, type, full, meta){
					return full.mark_total;
				}
			}
			],fixedColumns: true,
			dom: 'Bfrtip',
			buttons: [
			{
				text: 'Print',
				extend: 'pdfHtml5',
				message: '',
				orientation: 'Landscape',
				exportOptions: {
					columns: ':visible'
				},

				title : '{{ env('class_name') }} - All Marksheet',
				customize: function (doc) {

			        doc.defaultStyle.fontSize = 12;
			        doc.styles.tableHeader.fontSize = 12;
			        doc.styles.title.fontSize = 12;

			        // // Remove spaces around page title
			        doc.content[0].text = doc.content[0].text.trim();

			        // Styling the table: create style object

			    }
			}
			]
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
					val.push('<option value="-1">--Select--</option>');
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
