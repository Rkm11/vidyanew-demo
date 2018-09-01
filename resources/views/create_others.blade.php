@extends('layouts.master')
@php
$ID = 'batch';
$IDSt = 'standard';
$IDM = 'medium';
$IDSub = 'subject';

@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
	IDSt = '{{ $IDSt }}';
	IDM = '{{ $IDM }}';
	IDSub = '{{ $IDSub }}';
</script>
<style type="text/css">
.margin-top-10{
	margin-top: 10px;
}
.margin-top-5{
	margin-top: 5px;
}
</style>
@endpush

@section('page-title')
<div class="pull-left">
	Create Other Details
</div>
{{-- <div class="pull-right">
	<a href = "{{ route($ID.'.index') }}" class="btn btn-danger">Back</a>
</div>
--}}
@endsection
@section('content')

<div class="col-lg-12">
	<section class="box ">
		<br/>
		<div class="content-body" >
			<form id="{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<div class="col-md-2 text-right margin-top-10">
								<label class="form-label">Batch Time<span style="color:red;">*</span>:</label>
							</div>
							<div class="col-md-8 controls">
								<input type="text" class="form-control" name="name" placeholder="e.g. 08:00 AM - 10:00 AM" required>
							</div>
							<div class="col-md-2 margin-top-5">
								<button type="submit" class="btn btn-success">Create</button>
							</div>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center">
				</div>
			</form>
		</div>
		<div class="content-body">
			<form id="{{ $IDM }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<div class="col-md-2 text-right margin-top-10">
								<label class="form-label">Education Qualification<span style="color:red;">*</span>:</label>
							</div>
							<div class="col-md-8 controls">
								<input type="text" class="form-control" name="name" placeholder="e.g.MCA" required>
							</div>
							<div class="col-md-2 margin-top-5">
								<button type="submit" class="btn btn-success">Create</button>
							</div>
						</div>
					</div>
				</div>
				<div id = "{{ $IDM }}Msg" class="text-center">
				</div>
			</form>
		</div>
		<div class="content-body">
			<form id="{{ $IDSt }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<div class="col-md-2 text-right margin-top-10">
								<label class="form-label">Course Name<span style="color:red;">*</span>:</label>
							</div>
							<div class="col-md-8 controls">
								<input type="text" class="form-control" name="name" placeholder="Course Name" required>
							</div>
							<div class="col-md-2 margin-top-5">
								<button type="submit" class="btn btn-success">Create</button>
							</div>
						</div>
					</div>
				</div>
				<div id = "{{ $IDSt }}Msg" class="text-center">
				</div>
			</form>
		</div>
		<!-- <div class="content-body">
			<form id="{{ $IDSt }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="form-group">
							<div class="col-md-2 text-right margin-top-10">
								<label class="form-label">Create Test<span style="color:red;">*</span>:</label>
							</div>
							<div class="col-md-8 controls">
								<input type="text" class="form-control" name="name" placeholder="e.g. Test No / Test-01" required>
							</div>
							<div class="col-md-2 margin-top-5">
								<button type="submit" class="btn btn-success">Create</button>
							</div>
						</div>
					</div>
				</div>
				<div id = "{{ $IDSt }}Msg" class="text-center">
				</div>
			</form>
		</div> -->
	</section>
	<!-- <section class="box ">
		<br/>
		<div class="row">
			<div class="col-xs-12 col-sm-12 ">
				<form id = "{{ $IDSub }}Form">
					<div class="col-sm-4">
						<div class="form-group">
							<label class="form-label">Standard Title<span style="color:red;">*</span>:</label>
							<span class="desc">&nbsp;</span>
							<div class="controls">

								<select class="form-control" id = "standard" name="std">
									<option value="-1">--Select--</option>
									@forelse (App\Models\Standard::get() as $s)
									<option value = "{{ $s->std_id }}">{{ $s->std_name }}</option>
									@empty
									@endforelse
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label">Subject<span style="color:red;">*</span>:</label>
							<span class="desc">&nbsp;</span>
							<div class="controls">
								<input type="text" class="form-control" name="name" placeholder="e.g. English" required>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<span class="desc">&nbsp;</span>
							<div class="controls">
								<button type="submit" class="btn btn-primary">ADD</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id = "{{ $IDSub }}Msg" class="text-center"></div>
				</form>
			</div>
			<div class="col-md-offset-2 col-xs-8 col-sm-8 ">
				<div id = "subject-table-box"  style="display: none;" class="content-body">
					<div class="row">
						<div class="table-responsive">
							<h4>Subject List</h4>
							<table id = "subject-table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Full Name</th>
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
		</div>
	</section> -->
</div>
<!-- END CONTAINER -->
@endsection

@push('footer')
<script>
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);
	CRUD.formSubmission("{{ route($IDSt.'.store') }}", 0,{}, IDSt);
	CRUD.formSubmission("{{ route($IDM.'.store') }}", 0,{}, IDM);
	CRUD.formSubmission("{{ route($IDSub.'.store') }}", 0,{'select' : 'standard'}, IDSub);

	$('#standard').on({
		'change' : function(){
			getsubject(this.value);
		}
	})

	function getsubject(id){
		$('#subject-table').DataTable().destroy();
		$('#subject-table-box').show();
		$('#subject-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url : '{!! route('subject-get') !!}',
				type : 'post',
				data : function(d){
					d.id = id;
				}
			},
			columns: [
			{data: 'sub_name', name: 'sub_name'},
			{}
			],columnDefs:[{
				'targets' : 1,
				'render': function (data, type, full, meta){
					// <button class="btn btn-success">Edit</button> |
					return '<button class="btn btn-danger" onclick = "deleteSubject('+full.sub_id+');">Delete</button>';
				}
			}]
		});
	}
	function deleteSubject(id){
		$.ajax({
			url : l(id),
			type : 'delete',
			success : function(data){
				if(data = 'success'){
					$('#subject-table').DataTable().ajax.reload();
				}
			}
		});
	}

	function l(id){
		return '{{ url('subject') }}'+'/'+id;
	}
	// getsubject(1);
</script>
@endpush