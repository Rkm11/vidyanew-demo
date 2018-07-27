@extends('layouts.master')
@section('page-title')
All Attendances
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
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" placeholder="dd-mm-yyyy" name="searchbydate" id="searchbydate" class="form-control datepicker">
								</div>
							</div>
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
										<th class="col-sm-4">Name</th>
										<th class="col-sm-4">Subject</th>
										<th class="col-sm-3">Report</th>
										<!--<th>Date</th>-->
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

	$('#batch, #standard, #medium, #subject, #searchbydate').on({
		'change' : function(){
			$('#attendance-table').DataTable().destroy()
			data();
		}
	});
    data();
	function data() {
		$('#attendance-table').DataTable({
			processing: true,
			//serverSide: true,

			ajax: {
				url : '{!! route('attendance-view.data') !!}',
				type : 'get',
				data : function(d){
					d.batch = $('#batch').val();
					d.subject = $('#subject').val();
					d.standard = $('#standard').val();
					d.medium = $('#medium').val();
					d.searchbydate = $('#searchbydate').val();
					console.log("date"+d.searchbydate);
				}
			},
			columns: [
			{data: 'stu_id', name: 'students.stu_id'},
			{data: 'stu_name', name: 'stu_name'},
			{data: 'sub_name', name: 'subjects.sub_name'},
			{},
			//{data : 'att_added', name: 'attendances.att_added'}
			],
			columnDefs: [{
				'targets': 3,
				'render': function (data, type, full, meta){
					var s = (full.att_result) ? 'Present' : 'Absent';
					return '<span>'+s+'</span>';
				}
			}],
			dom: 'Bfrtip',
			buttons: [
			{
				text: 'Print',
				extend: 'pdfHtml5',
				message: '',
				orientation: 'portrait',
				exportOptions: {
					columns: ':visible'
				},
				title : '"{{env('class_name')}}" - Attendances',
				customize: function (doc) {

					doc.defaultStyle.fontSize = 12;
					doc.styles.tableHeader.fontSize = 14;
					doc.styles.title.fontSize = 14;

			        // // Remove spaces around page title
			        doc.content[1].table.widths = [ 15, '*', '*','*'];
			        // doc.content[1].table.alignment = [ 'center', 'center', 'center','center','center' ];
			        // doc.styles.table['body'].alignment = 'center';

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

	// $(".datepicker").each(function(i, e) {
	// 	var $this = $(e),
	// 	options = {
	// 		onSelect: function() {
	// 			var table = $('#attendance-table').DataTable();
	// 			table.search( $(this).val() ).draw();
	// 		}
	// 	},
	// 	$nxt = $this.next(),
	// 	$prv = $this.prev();


	// 	$this.datepicker(options);

	//     // if ($nxt.is('.input-group-addon') && $nxt.has('a')) {
	//     //     $nxt.on('click', function(ev) {
	//     //         ev.preventDefault();
	//     //         $this.datepicker('show');
	//     //     });
	//     // }

	//     // if ($prv.is('.input-group-addon') && $prv.has('a')) {
	//     //     $prv.on('click', function(ev) {
	//     //         ev.preventDefault();

	//     //         $this.datepicker('show');
	//     //     });
	//     // }
	// });
</script>
@endpush