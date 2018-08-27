
@extends('layouts.master')
@php
$ID = 'installment';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
</script>
@endpush

@section('page-title')
<div class="pull-left">
	Edit {{ ucfirst($ID) }}
</div>
<div class="pull-right">
	<a href = "{{ route('invoice.index') }}" class="btn btn-danger">Back</a>
</div>

@endsection

@section('content')
<div class="col-lg-12">
	<section class="box ">
		<header class="panel_header">
			<h2 class="title pull-left">Fees Installments for {{ $stu->stu_first_name.' '.$stu->stu_last_name }}</h2>
		</header>
		<div class="content-body" style="background-color:#9ddac0";>

			<form id = "{{ $ID }}Form">
				<input type="hidden" name="student" value = "{{ $stu->stu_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Instalment Type<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select disabled="" class="form-control" name="type" >
										<option value="-1">--Select--</option>
										<option value="Instalment 1" {{$stud->install_type=='Instalment 1'?'selected=""':''}}>Instalment 1</option>
										<option value="Instalment 2" {{$stud->install_type=='Instalment 2'?'selected=""':''}}>Instalment 2</option>
										<option value="Instalment 3" {{$stud->install_type=='Instalment 3'?'selected=""':''}}>Instalment 3</option>
										<option value="Instalment 4"{{$stud->install_type=='Instalment 4'?'selected=""':''}}>Instalment 4</option>
										<option value="Instalment 5"{{$stud->install_type=='Instalment 5'?'selected=""':''}}>Instalment 5</option>
										<option value="Instalment 6"{{$stud->install_type=='Instalment 6'?'selected=""':''}}>Instalment 6</option>
										<option value="Instalment 7"{{$stud->install_type=='Instalment 7'?'selected=""':''}}>Instalment 7</option>
										<option value="Instalment 8"{{$stud->install_type=='Instalment 8'?'selected=""':''}}>Instalment 8</option>
										<option value="Instalment 9"{{$stud->install_type=='Instalment 9'?'selected=""':''}}>Instalment 9</option>
										<option value="Instalment 10"{{$stud->install_type=='Instalment 10'?'selected=""':''}}>Instalment 10</option>
										<option value="Instalment 11"{{$stud->install_type=='Instalment 11'?'selected=""':''}}>Instalment 11</option>
										<option value="Instalment 12"{{$stud->install_type=='Instalment 12'?'selected=""':''}}>Instalment 12</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Due Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name = "due_date" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{$stud->install_due_date}}" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Amount<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="amount" value="{{$stud->install_amount}}" placeholder ="Amount">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">PDC No.:</label>
								<div class="controls">
									<input type="text" class="form-control" value="{{$stud->install_pdc_no}}" name="pdc_no" placeholder="PDC No" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">PDC Date:</label>

								<div class="controls">
									<input type="text" name = "pdc_date" class="form-control datepicker" data-format="dd-mm-yyyy" value="{{$stud->install_pdc_date}}" >
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Bank Name:</label>
								<div class="controls">
									<input type="hidden" value="{{$_GET['install']}}" class="form-control" name="installment_id" placeholder="Bank Name">
									<input type="text" value="{{$stud->install_bank_name}}" class="form-control" name="bank_name" placeholder="Bank Name">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-xs-12">
						<div class="text-center">
							<button type="submit" class="btn btn-warning">Update Installment</button>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center"></div>

			</form>
		</div>
	</section>
</div>
@endsection

@push('footer')
<script type="text/javascript">
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);
</script>
@endpush