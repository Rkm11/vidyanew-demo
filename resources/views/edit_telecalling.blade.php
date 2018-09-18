@extends('layouts.master')
@section('page-title')
Update Follow-Up
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
						<br/>
						<form class="form-horizontal" method="POST" action="{{ route('telecalling.update',['id' => $tcall->id]) }}" >
							<input type="hidden" name="_method" value="PATCH">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

				        	<div class="form-group">
						    	<label for="add-name" class="col-sm-2 control-label">Student Name</label>
						    	<div class="col-sm-10">
						      		<input type="text" title="Enter Your Name" class="form-control" id="student_name" name="student_name" placeholder="Name" value="{{$tcall->student_name}}"  rquired>
						    	</div>
						  	</div>

						  	<div class="form-group">
						    	<label for="add-mobile" class="col-sm-2 control-label">Mobile</label>
						    	<div class="col-sm-10">
						      		<input type="mobile" title="Enter Your Number" class="form-control" id="mobile" name="mobile" placeholder="Mobile number" value="{{$tcall->mobile}}" pattern="[0-9]+">
						    	</div>
						  	</div>

					  	<div class="form-group">
					    	<label for="follow1" class="col-sm-2 control-label">Follow Up 1</label>
					    	<div class="col-sm-10">
					      		<textarea  class="form-control" id="follow1"  name="follow1"  placeholder="Statement here..">{{$tcall->follow1}}</textarea>
					      	</div>
					      </div>

					      	<div class="form-group">
					    	<label for="follow2" class="col-sm-2 control-label">Date<span style="color:red;"></span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text"  name = "date1" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{ $tcall->date1 }}" >
					    	 </div>
					        </div>

						<div class="form-group">
					    	<label for="follow2" class="col-sm-2 control-label">Follow Up 2
					    	</label>
					    	<div class="col-sm-10">
					      		<textarea  class="form-control" id="follow2" name="follow2" placeholder="Statement here..">{{$tcall->follow2}}</textarea>
					      	</div>
					      </div>
					      <div class="form-group">
					    	<label for="follow3" class="col-sm-2 control-label">Date<span style="color:red;"></span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text" name = "date2" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{ $tcall->date2 }}" >
					    	 </div>
					        </div>

						<div class="form-group">
					    	<label for="follow3" class="col-sm-2 control-label">Follow Up 3
					    	</label>
					    	<div class="col-sm-10">
					      		<textarea  class="form-control" id="follow3" name="follow3" placeholder="Statement here..">{{$tcall->follow3}}</textarea>
					      	</div>
					      </div>
					      		<div class="form-group">
					    	<label for="date3" class="col-sm-2 control-label">Date<span style="color:red;"></span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text"  name = "date3" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{ $tcall->date3 }}" >
					    	 </div>
					        </div>

					  	<div class="form-group">
					    	<label for="follow1" class="col-sm-2 control-label">Follow Up 4
					    	</label>
					    	<div class="col-sm-10">
					      		<textarea  class="form-control" id="follow4" name="follow4" placeholder="Statement here..">{{$tcall->follow4}}</textarea>
					      	</div>
					      </div>
					      		<div class="form-group">
					    	<label for="date3" class="col-sm-2 control-label">Date<span style="color:red;"></span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text"  name = "date" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{ $tcall->date4 }}" >
					    	 </div>
					        </div>

						<div class="form-group">
					    	<label for="follow1" class="col-sm-2 control-label">Follow Up 5
					    	</label>
					    	<div class="col-sm-10">
					      		<textarea  class="form-control" id="follow5" name="follow5" placeholder="Statement here..">{{$tcall->follow5}}</textarea>
					      	</div>
					      </div>
					      		<div class="form-group">
					    	<label for="date5" class="col-sm-2 control-label">Date<span style="color:red;"></span>:</label>
					    		<div class="col-sm-2">
					      		<input type="text" name = "date5" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" value="{{ $tcall->date5 }}" >
					    	 </div>
					        </div>

						<div class="form-group">
					    	<div class="col-sm-2">


		        				<div class="col-sm-10">
		        				<button type="submit" class="btn btn-info">Update</button>
					    	</div>
						</div>

						</form>

				</div>

		</div>
	</section>
</div>

@endsection



