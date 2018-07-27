@extends('layouts.master')
@php
$ID = 'invoice';
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
		<div class="content-body" style="background-color:#9ddac0";>
			<form id="{{ $ID }}Form">
				@if ($install != '')
				<input type="hidden" name="install" value = "{{ $install->install_id }}">
				@endif

				<input type="hidden" name="student" value = "{{ $stu->stu_id }}">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Receipt Type<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="type" required>
										<option value="">--Select--</option>
										<option value="Tution Fees">Tution Fees</option>
										<option value="Publication">Publication</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name="add_date" class="form-control datepicker" data-format="dd-mm-yyyy"  value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Receipt No<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="receipt_no" value="{{ $invoice_last}}"  placeholder="Receipt No" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">ID<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" value="{{ $stu->stu_uid }}" placeholder="ID" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Batch<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" value="{{ $stu->admission->batch->batch_name }}" placeholder="Batch" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Standard<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" value="{{ $stu->admission->standard->std_name }}" placeholder="Standard" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
						<?php if (!empty($_GET['type']) && ($_GET['type'] == 2 || $_GET['type'] == 3)) {?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="col-sm-6" >
							<div class="form-group">
								<label class="form-label">Addmission Incharge<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="admission_incharge" placeholder="Addmission Incharge" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Payable Fees<span style="color:red;">*</span>:</label>

								<div class="controls">
									<input type="text" class="form-control" name="fees" placeholder="Total Fees" id = "totalFees" value = "{{ $stu->admission->ad_remaining_fees == 0 ? $stu->admission->ad_fees : $stu->admission->ad_remaining_fees }}" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Amount<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="number" <?php echo (isset($_GET['type']) && $_GET['type'] == '2') ? 'readonly' : ''; ?> class="form-control" id = "paid" name="paid_amount" placeholder ="Amount" min="1" value = "{{ ($install)?$install->install_amount : ''}}" max="{{ $stu->admission->ad_fees }}" required>
								</div>
							</div>
						</div>
						@if(!isset($_GET['type']))
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Due Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name = "due_date" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ $install->install_due_date }}" >
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
				<?php if (!empty($_GET['type']) && ($_GET['type'] == 2 || $_GET['type'] == 3)) {?>
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Receipt Receiver Name<span style="color:red;">*</span>:</label>
								<span class="desc">&nbsp;</span>
								<div class="controls">
									<input type="text" class="form-control" name="receiver_name" placeholder="Full Name" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Mode Of Payment<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control" name="payment_mode" onchange="change(this.value)" required>
										<option value="">--Select--</option>
										<option value="1">Cheque</option>
										<option value="2">Cash</option>
										<option value="3">DD</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control" name="install_status" value="1">
				<input type="hidden" class="form-control" name="formtype" value="payment">
				<?php } else {?>
				<input type="hidden" class="form-control" name="install_status" value=0>
				<input type="hidden" class="form-control" name="formtype" value="edit">
				<?php }?>
				<div class="row" id = "chq" style="display: none;">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">PDC No.<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="number" class="form-control" name="cheque_number" id="cheque_number" placeholder="Check Number">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Account Type<span style="color:red;">*</span>:</label>
								<div class="controls">
									<select class="form-control"  id="account_type" name="account_type">
										<option value="">--Select--</option>
										<option value="current">Current</option>
										<option value="saving">Saving</option>
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="row dd" id = "dd" style="display: none;">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">PDC Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control datepicker" name="cheque_date" data-format="d-mm-Y" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" >
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Bank Name<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" name="cheque_bank" id="cheque_bank" placeholder="Bank Name">
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="row dd" style="display: none;">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">DD Number<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" class="form-control" id="dd_number" name="dd_number" placeholder="DD Number">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="col-sm-12">
							<div class="text-center ">
								<button type="submit" class="btn btn-warning">Create Invoice</button>
								{{-- <button type="submit" class="btn btn-warning">Print</button> --}}
							</div>
							{{-- <a  href="{{ route('installment.edit',['id' => $stu->stu_id]) }}" class="btn btn-danger pull-right">Create Installments</a> --}}
						</div>
					</div>
				</div>
			</form>
		</div>
		<div id = "{{ $ID }}Msg" class="text-center"></div>
	</section>
</div>
@endsection

@push('footer')
<script type="text/javascript">
	$('#paid').on({
		'keyup, blur' : function(){
			var p = parseInt(this.value),
			total = parseInt($('#totalFees').val());
			re = total - p;
			$('#remaining').val(re);
		}
	});
	function change(id){
		//cheque
		if(id=="1"){
			$("#dd").show();
			$("#chq").show();
			$("#cheque_number").prop('required',true);
			$("#account_type").prop('required',true);
			$("#cheque_bank").prop('required',true);
			$("#dd_number").prop('required',false);
		}
		//dd
		if (id == "3"){
			$(".dd").show();
			$("#chq").hide();
			$("#cheque_number").prop('required',false);
			$("#account_type").prop('required',false);
			$("#cheque_bank").prop('required',true);
			$("#dd_number").prop('required',true);
		}
		//cash
		if (id == "2"){
			$(".dd").hide();
			$("#chq").hide();
			$("#cheque_number").prop('required',false);
			$("#account_type").prop('required',false);
			$("#cheque_bank").prop('required',false);
			$("#dd_number").prop('required',false);
		}
	}
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{});
	var en = '{{ route('invoice.index') }}';
</script>
@endpush
