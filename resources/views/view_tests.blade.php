@extends('layouts.master')
@section('page-title')
View Tests
@endsection
@push('header')
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

		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="test-table" >
							<thead style="background-color:#fff;">
								<tr>
									<th>Name</th>
									<th>Date</th>
									<th>Batch</th>
									<th>Standard</th>
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

		$('#test-table').DataTable({
			processing: true,
			//serverSide: true,
			searching: true,
			lengthChange: false,
			//destroy:true,
			ajax : '{!! route('test.data') !!}',
			columns: [
			{data : 'test_name' , name : 'test_name'},
			{data: 'test_date', name: 'test_date'},
			{data: 'batch_name', name: 'batch_name'},
			{data: 'std_name', name: 'std_name'},
			{}
			],
			columnDefs: [
			{
				'targets': 4,
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning"  href = "'+pr1(full.id)+'">Edit</a>'+' '+'<a class="btn btn-danger"  href = "'+pr(full.id)+'">Delete</a>';
				}
			}
			],
			"order": [[ 1, "desc" ]]
		});
	});
	function pr(id){
		return "test/delete/"+id;
	}
		function pr1(id){
		return "test/edit/"+id;
	}
	// var v = '{{ url('admission/') }}',
	// e = '{{ url('enquiry') }}';
	// function redA(id){
	// 	return v+'/confirm/'+id;
	// }
	var v = '{{ url('admission/') }}',
	e = '{{ url('enquiry') }}';
	function redA(id){
		return v+'/'+id+'/edit';
	}

		function edit(id){
		return e+'/'+id+'/edit';
	}
	//model
	function follow(id){
		var base_url=$('#base_url').val();
		$('#follow-id').val('');
		$('#testModal').modal('show');
		$('#follow-id').val(id);
            $.ajax({
                type : 'get',
                url:base_url+'/get-enquiry',
                data : {'id' : id},
                dataType: 'json',
                success : function(d){
                	var obj = JSON.parse(d);
                	console.log(obj.follow1);

                }
            });
        }

	// function edit1(id){
	// 		return e+'/'+id+'/';
	// }
</script>
@endpush