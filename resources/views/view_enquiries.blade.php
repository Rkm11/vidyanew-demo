@extends('layouts.master')
@section('page-title')
View Enquiries
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
<div class="modal" id="testModal" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-lg animated bounceInDown">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">follow up</h4>
                </div>
                <div class="modal-body" style="background-color:#9ddac0;" >
                	<!--<form method="get" action="follow1" >-->
                		<!--new change is here-->
                		<form class="form-horizontal" method="POST" action="{{ route('telecalling.update',['id' =>1]) }}" >
							<input type="hidden" name="_method" value="PATCH">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                		<!--end change -->

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="mrt">

                              <thead>
                                <tr>
							       <th>
							       	<label>follow1</label>
							          <textarea id="follow1" name="follow1" class="form-control"></textarea><br></th>
							         <th>
							        <label>follow2</label>
							          <textarea id="follow2" name="follow2" class="form-control"></textarea><br></th>
							          <th>
							        <label>follow3</label>
							            <textarea id="follow3" name="follow3" class="form-control"></textarea><br></th>
							        <th><label>follow4</label>
							             <textarea id="follow4" name="follow4" class="form-control"></textarea>
							                   <br></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                <!--<input type='button' value='Submit form' onClick='submitDetailsForm()' />-->
                 <input type="hidden" id="custId" name="custId" value="3487">

                <center><input type="button" class="btn btn-success" onclick="submitFollowp()" value="Submit"></center>
            </form>





                </div>
            </div>
        </div>



 <input type="hidden" name="follow-id" id="follow-id" value="">
 <div class="container-fluid">

<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
	<!-- <section class="box"> -->

		<!-- <div class="content-body" style="background-color:#9ddac0;"> -->
			<!-- <div class="row"> -->
				<!-- <div class="col-xs-12"> -->
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
				<!-- </div> -->
			<!-- </div> -->
		<!-- </div> -->
	<!-- </section> -->
<!-- </div> -->
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

			lengthChange: false,


			// // stateSave : true,
			// scrollX : true,

			// scrollY: true,
			 // responsive: true,
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
					return '<a class="btn btn-warning" href = "'+edit(full.enq_id)+'">Edit</a>&nbsp;<a class="btn btn-warning" href = "'+print(full.enq_id)+'">Print</a>';
				}
			}
// &nbsp;&nbsp;<a class="btn btn-warning" href = "'+edit1(full.enq_id)+'">folloup</a>
			],"order": [[ 7, "desc" ]]



		});
	});
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
	function print(id){
		return e+'/print/'+id;
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
