@extends('layouts.master')
@section('page-title')
Create Follow-Up
<div class="pull-right row hidden-xs hidden-sm">
	<a href = "{{ route('telecalling.create') }}" class="btn btn-warning">Add New</a>
</div>
<div class="row hidden-md hidden-lg" style="text-align: center;margin-top: 20px;">
	<a href = "{{ route('telecalling.create') }}" class="btn btn-warning">Add New</a>
</div>
@endsection

@section('content')
<div class="container-fluid">
<div class="col-lg-12">
	<!-- <section class="box "> -->

		<!-- <div class="content-body" style="background-color:#9ddac0;">  -->
			<form method="GET" action="{{'telecalling-data'}}" onsubmit="return checkdate("9")">

				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">From Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="date"   name="fromdate"   placeholder="yy-mm-dd" >
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">To date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="date"  name="todate"  placeholder="yy-mm-dd">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">

								<div class="controlss" style="text-align: center;">
									<input type="submit" class="btn btn-warning">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

			@if(!empty($telecall))

		<!-- 	<div class="row">
				<div class="col-xs-12">

							<div class="form-group">

								<div class="controls">


								</div>
							</div> -->

					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="telecalling-table" >
							<thead style="background-color:#9ddac0;">
								<tr>
								<th ><h5><b>Id</b></h4></th>
								<th ><h5><b>Student Name</b></h4></th>
						        <th ><h5><b>Mobile</h4></b></th>
						        <th ><h5><b>Follow Up 1</b></h4></th>

						        <th ><h5><b>Follow Up 2</b></h5></th>

						        <th ><h5><b>Follow Up 3</b></h4></th>

						        <th ><h5><b>Follow Up 4</b></h4</th>

						        <th ><h5><b>Follow Up 5</b></h4></th>

						       <th ><h5><b>Action</b></h4></th>

						        <th><h5><b>Print</b></h4></th>

								</tr>
							</thead>
							<tbody  >
								@if(count($telecall)>0)
								@foreach($telecall as $tellc)
								 <tr >
						        <td style="background-color:#9ddac0;" ><b>{{$loop->index+1}}</b></td>
						        <td style="background-color:#9ddac0;" name="student_name" id="student_name"><h5><b>{{$tellc->student_name}}</b></h5></td>

						        <td style="background-color:#9ddac0;"  name="mobile" id="mobile" ><h4>{{$tellc->mobile}}</h4></td>

						        <td style="background-color:#9ddac0;"  name="follow1" id="follow1"><textarea  rows="2" cols="10" style="background-color:#9ddac0;" readonly="true" font:bold;  height:100%; font-size:10pt;   border: none;">{{$tellc->follow1}}</textarea></div></td>

						        <td style="background-color:#9ddac0;" name="follow2" id="follow2" ><textarea rows="2" cols="10" readonly="true" style="background-color:#9ddac0;" height:100%; font-size:10pt; color:black;  border: none;">{{$tellc->follow2}}</textarea></td>

						        <td style="background-color:#9ddac0;"  name="follow3" id="follow3" ><textarea rows="2" cols="10" readonly="true" style="background-color:#9ddac0;" height:100%; font-size:10pt; color:black;  border: none;">{{$tellc->follow3}}</textarea></td>

						        <td style="background-color:#9ddac0;" name="follow4" id="follow4" ><textarea rows="2" cols="10" readonly="true" style="background-color:#9ddac0;" height:100%; font-size:10pt; color:black;  border: none;">{{$tellc->follow4}}</textarea></td>

						        <td style="background-color:#9ddac0;" name="follow5" id="follow5" ><textarea rows="2" cols="10" readonly="true" style="background-color:#9ddac0;"height:100%; font-size:10pt; color:black;  border: none;">{{$tellc->follow5}}</textarea></td>

						         <td style="background-color:#9ddac0;" >

						        	<div style="display: flex;">
						        	<div  class="pull-left" style="margin:0px; width:100%; height:100%;" >
						        	<a href="{{ route('telecalling.edit',['id' => $tellc->id])}}" ><button type="button" class="btn btn-info">EDIT</button></a>
                                	</div>
                                	<div class="pull-left" style="margin:0px; width:100%; height:100%;">
                                 	<form   method="POST" action="{{ 'telecalling/'.$tellc->id}}" onsubmit="return confirm('Are you sure?')">
                                 		<input type="hidden" name="_method" value="DELETE">
                                 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
						       			<button  type="submit" class="btn btn-danger" >DELETE</button>
                                 	</form>
                                 </div>
                                 </div>
						       </td>

						        <td style="background-color:#9ddac0;" ><a class="btn btn-warning"  href ="{{ 'download-telecalling/'.$tellc->id}}">Print</a></td>

						       <!-- cpy -->
 						      </tr>
						      @endforeach
						      @else
						        No Record Found!!
						    @endif
							</tbody>
						</table>
					</div>
				<!-- </div>
			</div> -->
			@endif
		<!-- </div> -->
	<!-- </section> -->
</div>
</div>

</div>
<!-- END CONTAINER -->
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
				title : 'Vidhya Bhusan - Attendances',
				customize: function (doc) {

					doc.defaultStyle.fontSize = 12;
					doc.styles.tableHeader.fontSize = 14;
					doc.styles.title.fontSize = 14;

			        // // Remove spaces around page title
			        doc.content[1].table.widths = [ '*', '*', '*','*'];
			        // doc.content[1].table.body  = {alignment:'center'};
			        // doc.content[1].table.alignment = [ 'center', 'center', 'center','center','center' ];
			        // doc.styles.table['body'].alignment = 'center';

			        doc.content[0].text = doc.content[0].text.trim();

			        // Styling the table: create style object

			    }
			}
			]
		});
	}




</script>
@endpush