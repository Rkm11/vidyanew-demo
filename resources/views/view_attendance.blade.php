@extends('layouts.master')
@section('page-title')
All Attendances
@endsection
@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<style type="text/css">
.table-responsive,
.table .table-striped .table-bordered .w-auto{-sm|-md|-lg|-xl overflow-x:auto;
}
/*.dataTables_wrapper .dataTables_length {
float: left;
}
.dataTables_wrapper .dataTables_filter {
float: left;
text-align: left;
position: fixed;
top: 150px;
/*left: 330px;*/
/*width: 30px;
right: 220px;






}*/



*.dataTables_wrapper .dataTables_length {
float: left;
}
.dataTables_wrapper .dataTables_filter {
float: right;
text-align: right;
}
.dataTables_wrapper .dataTables_length {
float: right;
}
.dataTables_wrapper .dataTables_filter {
float: right;
text-align: left;
}
/*.dataTables_wrapper .dataTables_paginate{float: left;} */


</style>
@endpush
@section('content')
<div class="col-lg-12">
	<section class="box ">

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
						<!-- <form id="file-upload" method="post"  enctype="multipart/form-data" name="file-upload">
						<div class="col-sm-4">
							<div class="form-group">
								<label class="form-label">Upload Attendance Report:</label>
								<div class="controls">
							<input type="file" name="import_file" id="import_file"  />
						</div>
						</div>
						</div>
					</form> -->
					</div>
					</div>

				</div>
				<header class="panel_header"  style="background-color:#9ddac0;">
					<h2 class="col-sm-4 title pull-left" style="padding-left: 0px;">Attendance Sheet</h2>
				</header>

				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="attendance-table" class="table table-striped  display">
								<thead >
									<tr>
										<th class="col-sm-1">#</th>
										<th class="col-sm-3">Name</th>
										<th class="col-sm-3">Subject</th>
										<th class="col-sm-3">Report</th>
										<th class="col-sm-3">Date</th>
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
$('#import_file').on('change', function (){
		console.log('ss');
		console.log(this.files.length);
		var formData = new FormData();
		formData.append('import_file', this.files);
		console.log(formData);
                $.ajax({
                    url : 'read-file',
                    type : 'post',
                    data : formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success : function () {
                        alert("upload successfully")
                    }
                })
		// $('#file-upload').submit();
	});
	function generateReport() {
		var url='';
		var base_url=$('#base_url').val();
		batch=($('#batch').val()!='')?$('#batch').val():'0';
		subject=($('#subject').val()!='')?$('#subject').val():'0';
		standard=($('#standard').val()!='')?$('#standard').val():'0';
		medium=($('#medium').val()!='')?$('#medium').val():'0';
		startDate=($('#startDate').val()!='')?$('#startDate').val():'';
		endDate=($('#endDate').val()!='')?$('#endDate').val():'';
		url=base_url+'/generate-att-report'+'?batch='+batch+'&subject='+subject+'&standard='+standard+'&medium='+medium+'&startDate='+startDate+'&endDate='+endDate;
		window.location.href =url;
		// console.log(url);
		// $("a").attr("href", url)
				// $.ajax({
		// url : '{!! route('generate-att-report') !!}',
		// 		type : 'get',
		// 		data : {
		// 			"batch" : $('#batch').val(),
		// 			"subject" : $('#subject').val(),
		// 			"standard" : $('#standard').val(),
		// 			"medium" : $('#medium').val(),
		// 			"startDate" : $('#startDate').val(),
		// 			"endDate" : $('#endDate').val(),
		// 		},
		// 		success: function(d){
		// 			console.log(d);
		// 		}
  //   });
	}
// 	function getData(cb_func) {
// 		$.ajax({
// 		url : '{!! route('attendance-view.data') !!}',
// 				type : 'get',
// 				data : {
// 					"batch" : $('#batch').val(),
// 					"subject" : $('#subject').val(),
// 					"standard" : $('#standard').val(),
// 					"medium" : $('#medium').val(),
// 					"startDate" : $('#startDate').val(),
// 					"endDate" : $('#endDate').val(),
// 				},
// 				success: cb_func
//     });
// 	}
// 	// getData()
// 	 getData(function( data ) {
// 	 	console.log(data);
//     var columns = [];
//     data = JSON.parse(data);
//     console.log(Object.keys(data[0]));
//     columnNames = Object.keys(data[0]);
//     for (var i in columnNames) {
//       columns.push({data: columnNames[i], title: columnNames[i]});
//     }
//     $('#attendance-table').DataTable( {
// 		data: data,
// 		columns: columns,
// 		dom: 'Bfrtip',
// 			buttons: [
// 			{
// 				text: 'Print',
// 				extend: 'pdfHtml5',
// 				message: '',
// 				orientation: 'landscape',
// 				exportOptions: {
// 					columns: ':visible'
// 				},
// 				title : '"{{env('class_name')}}" - Attendances',
// 				customize: function (doc) {

// 					doc.defaultStyle.fontSize = 12;
// 					doc.styles.tableHeader.fontSize = 14;
// 					doc.styles.title.fontSize = 14;

// 			        // // Remove spaces around page title
// 			        // doc.content[1].table.widths = [ 15, '*', '*','*','*'];
// 			        // doc.content[1].table.alignment = [ 'center', 'center', 'center','center','center' ];
// 			        // doc.styles.table['body'].alignment = 'center';

// 			        doc.content[0].text = doc.content[0].text.trim();

// 			        // Styling the table: create style object

// 			    }
// 			}
// 			]
// 	} );
// });


    data();
	function data() {
		$('#attendance-table').DataTable({
			processing: true,
			lengthChange: false,
			//serverSide: true,

			ajax: {
				url : '{!! route('attendance-view.data') !!}',
				type : 'get',
				data : function(d){
					d.batch = $('#batch').val();
					d.subject = $('#subject').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
				}
			},
			columns: [
			{data: 'stu_id', name: 'students.stu_id'},
			{data: 'stu_name', name: 'stu_name'},
			{data: 'sub_name', name: 'subjects.sub_name'},
			{},
			{data : 'att_added', name: 'attendances.att_added'}
			],
			columnDefs: [{
				'targets': 3,
				'render': function (data, type, full, meta){
					var s = (full.att_result) ? 'Present' : 'Absent';
					return '<span>'+s+'</span>';
				}
			}],
			// dom: 'Bfrtip',
			// buttons: [
			// {
			// 	text: 'Print',
			// 	extend: 'pdfHtml5',
			// 	message: '',
			// 	orientation: 'portrait',
			// 	exportOptions: {
			// 		columns: ':visible'
			// 	},
			// 	title : '"{{env('class_name')}}" - Attendances',
			// 	customize: function (doc) {

			// 		doc.defaultStyle.fontSize = 12;
			// 		doc.styles.tableHeader.fontSize = 14;
			// 		doc.styles.title.fontSize = 14;

			//         // // Remove spaces around page title
			//         doc.content[1].table.widths = [ 15, '*', '*','*','*'];
			//         // doc.content[1].table.alignment = [ 'center', 'center', 'center','center','center' ];
			//         // doc.styles.table['body'].alignment = 'center';

			//         doc.content[0].text = doc.content[0].text.trim();

			//         // Styling the table: create style object

			//     }
			// }
			// ]
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

</script>
@endpush
