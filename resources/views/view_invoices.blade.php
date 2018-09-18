@extends('layouts.master')
@section('page-title')
View Invocies
@endsection


@push('header')

<style type="text/css">
.table-responsive,
.table .table-striped .table-bordered .w-auto{-sm|-md|-lg|-xl overflow-x:auto;
margin-top:10px}
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





}*/*.dataTables_wrapper .dataTables_length {
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

/*@media screen and (max-width: 640px){
 .dataTables_wrapper .dataTables_filter ,.dataTables_wrapper .dataTables_filter input-sm {
    float:center;
    text-align:left;
}
}
*/

</style>
@endpush

@section('content')
<div class="container-fluid">
<!-- <div class="col-lg-12">
	<section class="box ">

		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12"> -->
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="enquiry-table" >
							<thead style="background-color:#fff;">
								<tr>
									<th>UID</th>
									<th>Name</th>
									<th>Mobile</th>
									<!-- <th>Parent</th> -->
									<th>Parent No.</th>
									<th>Standard</th>
									<th>Total</th>
									<th>Remaining</th>
									<th>Action</th>
									<th>Print</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				<!-- </div>
			</div>
		</div>
	</section> -->
</div>


<!-- General section box modal start -->
<div class="modal" id="installModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg animated bounceInDown">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">All Installments</h4>
				<div id = "newInstall">

				</div>
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
				{{-- <button class="btn btn-success" type="button">Print</button> --}}
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
			lengthChange : false,
			//serverSide: true,
			ajax: '{!! route('invoice.data') !!}',
			columns: [
			{data: 'stu_uid', name: 'stu_uid'},
			{data: 'stu_name', name: 'stu_name'},
			{},
			{},
			{data: 'std_name', name: 'std_name'},
			{data: 'ad_fees', name: 'ad_fees'},
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
				'targets': 3,
				'render': function (data, type, full, meta){
					if(full.parent_mobile == 0){
						return '-';
					}else{
						return full.parent_mobile;
					}
				}
			},{
				'targets': 6,

				'render': function (data, type, full, meta){
					if(full.ad_remaining_fees == 0){
						return '-';
					}else{
						return '<h5 style="font-weight:bold;font-size:18px;font-style:italic;">'+full.ad_remaining_fees+'</h5>';
					}
				}
			},{
				'targets': 7,
				'width' : '220px',
				'render': function (data, type, full, meta){
					rm();
					return '<div id = "in-'+full.stu_id+'"><a class="btn btn-warning" href = "'+redA(full.stu_id)+'"> fees</a><button class = "btn btn-success" onclick = "installData('+full.stu_id+');">installment</button></div>';
				}
			},{
				'targets':8,
				'render': function (data, type, full, meta){
					rm1();

					return '<div id = "in-print-'+full.stu_id+'">-</div>';
				}
			},{
				'targets': 9,
				'visible' : false,
				'width' : '220px',
				'render': function (data, type, full, meta){
					return full.created_at;
				}
			}],"order": [[ 9, "desc" ]]
		});
	});
	var v = '{{ url('invoice/') }}';
	var ins = '{{ url('installment/') }}';
	function redA(id){
		return v+'/'+id+'/edit?type=3';
	}
	function pr(id){
		return "download-invoice/"+id;
	}
	function pr2(id){
		return "download-receipt/"+id;
	}
	function u2(id){
		return ins+'/'+id+'/edit';
	}
	function u3(id,i){
		return ins+'/'+id+'/edit?install='+i;
	}
	function u1(id,i,type){
		if(type){
			return v+'/'+id+'/edit?install='+i+'&type=2';
		}else{
			return v+'/'+id+'/edit?install='+i;
		}

	}
	function installData(id){
		$('#installModal').modal('toggle');
		data(id);
	}
	function data(id) {
		$('#newInstall').html('<a href="'+u2(id)+'" class="btn btn-success pull-right">Add Installment</a>');
		$('#installment-table').DataTable().destroy();

		$('#installment-table').DataTable({
			processing: true,
			serverSide: true,
			lengthChange:false,
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
			{},
			{},
			{},
			{},
			{}
			],
			columnDefs: [{
				'targets': 1,
				'render': function (data, type, full, meta){

					return full.install_due_date;
					var date = new Date(full.install_due_date);
					var c = date.getDate()+"-"+date.getMonth()+"-"+date.getFullYear();
					return c;
				}
			},{
				'targets': 3,
				'render': function (data, type, full, meta){
					return (full.install_pdc_no == null ? '-' : full.install_pdc_no);
				}
			},{
				'targets': 4,
				'render': function (data, type, full, meta){
					return full.install_pdc_date;
					var date = new Date(full.install_pdc_date);
					var c =  date.getDate() + "-"+date.getMonth()+"-" + date.getFullYear();
					return c;
				}
			},{
				'targets': 5,
				'visible':false,
				'render': function (data, type, full, meta){
					return (v.install_bank_name == null ? '-' : v.install_bank_name);
				}
			},{
				'targets': 6,
				'render': function (data, type, full, meta){
					if(full.install_status == 0){
						return '<span>Not Paid</span>';
					}else{
						return '<span>Paid</span>';
					}
				}
			},{
				'targets': 7,
				'render': function (data, type, full, meta){
					if(full.install_status == 0){

						return '<div style="display:flex;"><a href = "'+u1(full.install_student,full.install_id,'2')+'" class = "btn btn-warning  col-sm-6">PayNow</a><a href = "'+u3(full.install_student,full.install_id)+'" class = "btn btn-info  col-sm-6">Edit</a></div>';
					}else{
						return '<a class="btn btn-warning" onclick = "l();" href = "'+pr2(full.install_invoice)+'">Print</a>';
					}
				}
			}
			]
		});
	}
	function rm(){

		$.get('{{ route('data-invoice') }}', function (data) {
			$.each(data,function(k,v){
				$('#in-'+v.in_student).html('-');
			})
		});
	}
	function rm1(){

		$.get('{{ route('data-invoice') }}', function (data) {
			$.each(data,function(k,v){
				$('#in-print-'+v.in_student).html('<a class="btn btn-warning" href = "'+pr(v.in_student)+'"  onclick = "l();">Print</a>');
			})
		});
	}
	function l() {
		$('.loader').show();
		window.setTimeout(function(){
			$('.loader').hide();
		},2000);
	}
</script>
@endpush