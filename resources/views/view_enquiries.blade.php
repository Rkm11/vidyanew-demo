@extends('layouts.master')
@section('page-title')
View Enquiries
@endsection

@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="enquiry-table" >
							<thead style="background-color:#fff;">
								<tr>
									<th>Name</th>
									<th>Mobile</th>
									<th>Parent</th>
									<th>Parent No.</th>

									<th>School</th>
									<th>Standard</th>
									<th>Admission</th>
									<th>Date</th>
									<th>Action</th>
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

</div>
<!-- END CONTAINER -->
@endsection

@push('footer')
<script type="text/javascript">
	$(function(){

		$('#enquiry-table').DataTable({
			processing: true,
			//serverSide: true,
			searching: true,
			//destroy:true,
			ajax : '{!! route('enquiry.data') !!}',
			columns: [
			{data : 'stu_name' , name : 'stu_name'},
			{data: 'stu_mobile', name: 'stu_mobile'},
			{data: 'parent_first_name', name: 'parent_first_name'},
			{data: 'parent_mobile', name: 'parent_mobile'},
			{data: 'ad_school', name: 'ad_school'},
			{data: 'std_name', name: 'std_name'},
			{},
			{},
			{}
			],
			'columnDefs': [
			{
				'targets': 6,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning" href = "'+redA(full.ad_id)+'">Confirm Now</a>';
				}
			},{
				'targets': 7,
				'searchable': false,
				'orderable': false,
				'visible' : false,
				'render': function (data, type, full, meta){
					return full.created_at;
				}
			},{
				'targets': 8,
				'searchable': false,
				'orderable': false,
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning" href = "'+edit(full.enq_id)+'">Edit</a>';
				}
			}
// &nbsp;&nbsp;<a class="btn btn-warning" href = "'+edit1(full.enq_id)+'">folloup</a>
			],"order": [[ 7, "desc" ]]
		});
	});
	var v = '{{ url('admission/') }}',
	e = '{{ url('enquiry') }}';
	function redA(id){
		return v+'/'+id+'/edit';
	}
		function edit(id){
		return e+'/'+id+'/edit';
	}
	// function edit1(id){
	// 		return e+'/'+id+'/';
	// }
</script>
@endpush
