@extends('layouts.master')
@section('page-title')
Add New
<div class="pull-right">
	<a href = "{{ route('telecalling.index') }}" class="btn btn-danger">Back</a>
</div>
@endsection




@section('content')



<div class="col-lg-12">
	<section class="box " style="background-color:#9ddac0;">
		<div class="content-body" style="background-color:#9ddac0;">

				<div class="row">
					<div class=" col-sm-12">

						<form class="form-horizontal" method="POST" action="{{route('telecalling.store')}}" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

				        	<div class="form-group">
						    	<label for="add-name" class="col-sm-2 form-label">Student Name<span style="color:red;">*</span>:</label>
						    	<div class="col-sm-9">
						      		<input type="text" class="form-control" id="student_name" name="student_name" placeholder="Name" value="" pattern="[ a-zA-Z]+" required>
						    	</div>
						  	</div>

						  	<div class="form-group">
						    	<label for="add-mobile" class="col-sm-2 form-label">Mobile<span style="color:red;">*</span>:</label>
						    	<div class="col-sm-9">
						      		<input type="mobile" class="form-control" id="mobile" name="mobile" maxlength="10" pattern="[0-9]{10}" placeholder="Mobile number" value="" required>
						    	</div>
						  	</div>

					  	<div class="form-group">
					    	<label for="follow1" class="col-sm-2 form-label">Follow Up1<span style="color:red;">*</span>:</label>
					    	<div class="col-sm-9">
					      		<textarea class="form-control" rows="8" wrap="follow1" id="follow1" name="follow1" placeholder="Statement here.." required></textarea>
					    	</div>
					    </div>
					    	<div class="form-group">
					    		<label for="date1" class="col-sm-2 form-label">Date<span style="color:red;">*</span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text" required="" name = "date1" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" >
					    	</div>
					    </div>


						<div class="form-group">
					    	<div class="col-sm-2">

		        				</div>
		        				<div class="col-sm-10">
		        				<button type="submit" class="btn btn-warning">Add</button>
					    	</div>
						</div>

						</form>
					</div>
				</div>

		</div>
	</section>
</div>

@endsection



