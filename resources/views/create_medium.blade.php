@extends('layouts.master')


@php
$ID = 'medium';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
</script>
@endpush

@section('page-title')
<div class="pull-left">
	Create {{ ucfirst($ID) }}
</div>
<div class="pull-right">
	<a href = "{{ route($ID.'.index') }}" class="btn btn-danger">Back</a>
</div>

@endsection
@section('content')

<div class="col-lg-12">
	<section class="box ">
		<br/>

		<div class="content-body">
			<form id="{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-offset-3 col-sm-6">
							<div class="form-group">
								<label class="form-label">Medium Title<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="name" placeholder="e.g. English" rquired>
								</div>
							</div>
						</div>						
					</div>
				</div>
				<div class="row">	
					<div class="col-xs-10 col-sm-12">
						<div class="text-center">
							<button type="submit" class="btn btn-success">Create</button>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center">						
				</div>
			</form>
		</div>
	</section>
</div>
<!-- END CONTAINER -->

@endsection

@push('footer')
<script>		
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{'empty' : 'name'});	
</script>
@endpush