@extends('layouts.master')
@section('page-title')
View Admissions
@endsection
@push('header')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
@endpush
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
									<th>ID</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Parent</th>
									<th>Parent No.</th>
									<th>Admission Date</th>
									<th>Admission</th>
									<th>Action</th>
									<th>Print</th>
									<th>Date</th>
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
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js">
</script>






<script type="text/javascript">

	 //var title = 'My title' + '\n' + 'by John';
	$(function(){
		 $('#enquiry-table').DataTable({

			processing: true,
			searching: true,
			paging: false,
    	Filter: false,
			//serverSide: true,
			ajax: '{!! route('admission.data') !!}',
			columns: [
			{data : 'ad_id', name : 'ad_id'},
			{data : 'stu_name', name : 'stu_name'},
			{},
			{data: 'parent_first_name', name: 'parent_first_name'},
			{},
			{data: 'ad_date', name: 'ad_date'},
			{},
			{},
			{},
			{}
			],
			columnDefs: [{
				'targets': 2,
				'render': function (data, type, full, meta){
					if(full.stu_mobile == 0){
						return '-';
					}else{
						return full.stu_mobile;
					}
				}
			},{
				'targets': 4,
				'render': function (data, type, full, meta){
					if(full.parent_mobile == null || full.parent_mobile==0){
						return '-';
					}else{
						return full.parent_mobile;
					}
				}
			},{
				'targets': 6,
				'render': function (data, type, full, meta){
					if(full.ad_status){
						return '<span class="btn btn-primary">Confirmed</span>';
					}else{
						return '<a class="btn btn-warning" href = "'+redA(full.ad_id)+'">Confirm Now</a>';
					}
				}
			},{
				'targets': 7,
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning" href = "'+redA(full.ad_id)+'">Edit</a>';
				}
			},{
				'targets': 8,
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning"  href = "'+pr(full.stu_id)+'">Print</a>';
				}
			},{
				'targets': 9,
				'visible' : false,
				'render': function (data, type, full, meta){
					return full.ad_id;
				}
			}
			],"order": [[ 9, "desc" ]]
		});
	});
	var v = '{{ url('admission/') }}';
	function redA(id){
		return v+'/'+id+'/edit';
	}
	function pr(id){
		return "download-admission/"+id;
	}

	function l() {
		$('.loader').show();
		window.setTimeout(function(){
			$('.loader').hide();
		},2000);
	}
</script>
@endpush
