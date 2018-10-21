@extends('layouts.master')
@php
$ID = 'payment';
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
		<br>
		<div class="content-body" style="background-color:#9ddac0;">
			<form id="{{ $ID }}Form">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Voucher No<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="number" class="form-control" name="voucher" value="{{$payment_voucher}}" placeholder="Voucher No" required readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name="add_date" class="form-control datepicker" placeholder="dd-mm-YYYY" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Name<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Name" class="form-control" name="first_name" placeholder="First Name" pattern=[a-zA-Z]+ required>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" title="Enter Your Last Name" class="form-control" name="last_name" placeholder="Last Name" pattern=[a-zA-Z]+ required>
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
									<input type="number" title="Enter Amount" class="form-control" name="amount" placeholder="Amount" min="1" pattern="[0-9]+" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Given For<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="given_for" required>
										<option value="">--Select--</option>
										<option value="Traveling Allowance">Traveling Allowance</option>
										<option value="Publication">Publication</option>
										<option value="Classes Maintenance">Classes Maintenance</option>
										<option value="Stationary">Stationary</option>
										<option value="Office expenses">Office exepenses</option>
										<option value="Salary and Wages">Salary and Wages</option>
										<option value="xerox">Xerox</option>
										<option value="Question Paper DTP">Question Paper DTP</option>
										<option value="Advance Salary">Advance Salary</option>
										<option value="Rent">Rent</option>
										<option value="Other Expenses">Other Expenses</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Cheque Number:</label>
								<div class="controls">
									<input type="number" class="form-control" name="cheque_number" placeholder="Cheque Number">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Dated:</label>
								<div class="controls">
									<input type="text" name="cheque_date" class="form-control datepicker" data-format="dd-mm-YYYY" value="" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-xs-12">
						<div class="text-center">
							<button type="submit" class="btn btn-warning">Save</button>
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
	var en = '{{ route('balance-sheet.index') }}';
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{});
</script>
@endpush
