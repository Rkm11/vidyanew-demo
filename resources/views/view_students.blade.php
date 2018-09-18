@extends('layouts.master')
@section('page-title')
View Students
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
							<thead>
								<tr>
									<th>Name</th>
									<th>Mobile</th>
									<th>Parent</th>
									<th>Parent No.</th>
									<th>School</th>
									<th>Standard</th>
									<th>Total</th>
									<th>Remaining</th>
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

<!-- General section box modal start -->
<div class="modal" id="testModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg animated bounceInDown">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Section Settings</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Subject</th>
										<th>Test1</th>
										<th>Test2</th>
										<th>Test3</th>
										<th>Test4</th>
										<th>Test5</th>
										<th>Test6</th>
										<th>Test7</th>
										<th>Test8</th>
										<th>Total</th>
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
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-success" type="button">Print</button>
			</div>
		</div>
	</div>
</div>
<!-- modal end -->

<!-- General section box modal start -->
<div class="modal" id="installModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg animated bounceInDown">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Section Settings</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive">
							<table id = "installment-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Type</th>
										<th>Due Date</th>
										<th>Amount</th>
										<th>PDC No</th>
										<th>Date of PDC</th>
										<th>Bank</th>
										<th>Status</th>
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
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-success" type="button">Print</button>
			</div>
		</div>
	</div>
</div>
<!-- modal end -->
<!-- END CONTAINER -->
@endsection

@push('footer')
<script type="text/javascript">
	$(function(){

		$('#enquiry-table').DataTable({
			processing: true,
			//serverSide: true,
			ajax: '{!! route('student.data') !!}',
			columns: [
			{},
			{data: 'stu_mobile', name: 'stu_mobile'},
			{data: 'parent_first_name', name: 'parent_first_name'},
			{data: 'parent_mobile', name: 'parent_mobile'},
			{data: 'ad_school', name: 'ad_school'},
			{data: 'std_name', name: 'std_name'},
			{data: 'ad_fees', name: 'ad_fees'},
			{},
			{},
			{}
			],
			columnDefs: [{
				'targets': 0,

				'render': function (data, type, full, meta){
					return full.stu_first_name+' '+full.stu_last_name;
				}
			},{
				'targets': 7,

				'render': function (data, type, full, meta){
					if(full.ad_remaining_fees == 0){
						return full.ad_fees;
					}else{
						return '<button class = "btn btn-warning" onclick = "installData('+full.stu_id+');">'+full.ad_remaining_fees+'</button>';
					}
				}
			},{
				'targets': 8,
				'searchable': false,
				'orderable': false,
				'width' : '220px',
				'render': function (data, type, full, meta){
					return '<a class="btn btn-warning" href = "'+redA(full.ad_id)+'">Invoice</a>';
				}
			},{
				'targets': 9,
				'searchable': false,
				'orderable': false,
				'visible' : false,
				'width' : '220px',
				'render': function (data, type, full, meta){
					return full.created_at;
				}
			}],"order": [[ 9, "desc" ]]
		});
	});
	var v = '{{ url('invoice/') }}';
	function redA(id){
		return v+'/'+id+'/edit';
	}
	function u2(id,ins){
		return v+'/'+id+'/edit?install='+ins;
	}
	function getTestData(id){
		$.ajax({
			url : '{{ route('marksheet-get') }}',
			type : 'post',
			data : {'id' : id},
			success : function(d){
				var val = [];
				if(d.length > 0){

					$.each(d, function(k,v){
						var total = v.mark_test_1+v.mark_test_2+v.mark_test_3+v.mark_test_4+v.mark_test_5+v.mark_test_6+v.mark_test_7+v.mark_test_8;
						val.push('<tr><td>'+v.subject.sub_name+'</td><td>'+v.mark_test_1+'</td><td>'+v.mark_test_2+'</td><td>'+v.mark_test_3+'</td><td>'+v.mark_test_4+'</td><td>'+v.mark_test_5+'</td><td>'+v.mark_test_6+'</td><td>'+v.mark_test_7+'</td><td>'+v.mark_test_8+'</td><td>'+total+'</td></tr>');
					});
				}else{
					val.push('<tr><td colspan="10">No Marksheet Found</td></tr>');
				}
				$('#testModal').modal('toggle');

				$('#testModal tbody').html(val);
			}
		});
	}
	function installData(id){
		$('#installModal').modal('toggle');
		data(id);
	}
	function data(id) {
		$('#installment-table').DataTable().destroy();

		$('#installment-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url : '{!! route('installment.data') !!}',
				type : 'get',
				data : function(d){
					d.student = id;
				}
			},
			columns: [
			{data: 'install_type', name: 'install_type'},
			{},
			{data: 'install_amount', name: 'install_amount'},
			{data: 'install_pdc_no', name: 'install_pdc_no'},
			{},
			{data: 'install_bank_name', name: 'install_bank_name'},
			{},
			{}
			],
			columnDefs: [{
				'targets': 1,
				'render': function (data, type, full, meta){

					return full.install_due_date.replace(' 00:00:00','');
				}
			},{
				'targets': 4,
				'render': function (data, type, full, meta){
					return full.install_pdc_date.replace(' 00:00:00','');
				}
			},{
				'targets': 6,
				'render': function (data, type, full, meta){
					if(full.install_status == 1){
						return '<span>Not Paid</span>';
					}else{
						return '<span>Paid</span>';
					}
				}
			},{
				'targets': 7,
				'render': function (data, type, full, meta){
					if(full.install_status == 1){
						return '<a href = "'+u2(full.install_student,full.install_id)+'" class = "btn btn-success">Pay Now</a>';
					}else{
						return '-';
					}
				}
			}
			]
		});
	}
</script>
@endpush