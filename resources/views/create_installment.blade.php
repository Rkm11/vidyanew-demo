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
	Create {{ ucfirst($ID) }}
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
									<select class="form-control" name="type" >
										<option>--Select--</option>
										<?php
$a = $stud;
if (empty($a)) {?>
											<option value="Instalment 1">Instalment 1</option>
										<?php
} else {
	$a = explode(' ', $stud->install_type);
	$a = (!empty($a[1])) ? $a[1] + 1 : 0;
	if ($a > 1 && $a < 5) {?>
											<option value="Instalment <?php echo $a; ?>">Instalment <?php echo $a; ?></option>
										<?php }
}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Due Date<span style="color:red;">*</span>:</label>
								<div class="controls">
									<input type="text" name = "due_date" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" >
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
									<input type="text" class="form-control" name="amount" placeholder ="Amount">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">PDC No.:</label>
								<div class="controls">
									<input type="text" class="form-control" name="pdc_no" placeholder="PDC No" >
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
									<input type="text" name = "pdc_date" class="form-control datepicker" data-format="yyyy-mm-dd" value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" >
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Bank Name:</label>
								<div class="controls">
									<input type="text" class="form-control" name="bank_name" placeholder="Bank Name">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-xs-12">
						<div class="text-center">
							<button type="submit" class="btn btn-warning">Create Installment</button>
						</div>
					</div>
				</div>
				<div id = "{{ $ID }}Msg" class="text-center"></div>

			</form>
		</div>

		<div id = "installment-box" class="content-body" style="display: block;">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table id = "installment-table" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Type</th>
									<th>Amount</th>
									<th>Due Date</th>
									<th>PDC No</th>
									<th>Date of PDC</th>
									<th>Bank</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<br>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@push('footer')
<script type="text/javascript">
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);
	$('input[name=pdc_date]').datepicker({
    dateFormat: 'dd/mm/yy'
});
</script>
@endpush