@extends('layouts.master')
@section('page-title')
View Tests
@endsection

@section('content')
<div class="col-lg-12">
	<section class="box ">
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" id="test-table" >
							<thead style="background-color:#fff;">
								<tr>
									<th>Name</th>
									<th>Date</th>
									<!-- <th>Subject</th> -->
									<th>Batch</th>
									<th>Standard</th>>

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
			//destroy:true,
			ajax : '{!! route('test.data') !!}',
			columns: [
			{data : 'test_name' , name : 'test_name'},
			{data: 'test_date', name: 'test_date'},
			// {data: 'sub_name', name: 'sub_name'},
			{data: 'batch_name', name: 'batch_name'},
			{data: 'std_name', name: 'std_name'}
			],
			"order": [[ 1, "desc" ]]
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
