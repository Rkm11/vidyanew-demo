@extends('layouts.master')
@section('page-title')
View Parents
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
									<th>UID</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Parent</th>
									<th>Parent No.</th>
									<th>School</th>
									<th>Standard</th>
									<th>Action</th>
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
<!-- END CONTAINER -->
@endsection

@push('footer')
<script type="text/javascript">
	$(function(){

		$('#enquiry-table').DataTable({
			processing: true,
			//serverSide: true,
			ajax: '{!! route('admission.data') !!}',
			columns: [			
			{data : 'stu_uid', name : 'stu_uid'},			
			{data: 'stu_name', name: 'stu_name'},
			{},
			{data: 'parent_first_name', name: 'parent_details.parent_first_name'},
			{},
			{data: 'ad_school', name: 'admission_details.ad_school'},
			{data: 'std_name', name: 'standards.std_name'},
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
					if(full.parent_mobile == 0){
						return '-';
					}else{
						return full.parent_mobile;
					}
				}
			},{
				'targets': 7,
				'searchable': false,
				'orderable': false,
				'width' : '220px',
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning" href = "'+redA(full.parent_id, full.stu_id)+'">Parent Detail</a>';
				}
			},{
				'targets': 8,
				'searchable': false,
				'orderable': false,
				'visible' : false,
				'width' : '220px',
				'render': function (data, type, full, meta){
					return full.created_at;
				}
			}],"order": [[ 8, "desc" ]]
		});
	});
	var v = '{{ url('parent/') }}';
	
	function redA(id, s){		
		return v+'/'+id+'/edit?stu='+s;
	}	
</script>
@endpush