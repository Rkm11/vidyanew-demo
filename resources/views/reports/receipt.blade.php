@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Invoice</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<style type="text/css">
		*{
		font-size: 16px;
	}
	p, h1{
		margin: 0;
		font-weight: 600;
	}
	.p-line{
		border-bottom: 1px solid black;
	}
	span{
		font-weight: 200;
	}
	.p-title{
		border-bottom: 3px solid white;
		font-weight: 600;
	}
	.equal{
		width: 25%;
	}
	.equal-2{
		width: 25%;
		padding: 0px 5px;
	}
	.big-title{
		font-size: 20px;
		font-weight: 600;
	}
	.box{
		border: 2px solid black;
		padding: 5px;
	}
	td{
		padding: 0;
	}
	img{
		width: 100px;
		padding: 5px;
	}
	.title{
		width: 100%;
	}
	.title td{
		text-align: right;
	}
	.border{
		width: 100%;
		border: 3px solid black;
		border-radius: 30px;
	}
	.b-line{
		border-top: 2px solid black;
	}
	.border-bottom{
		width: 100%;
		border-bottom: 2px solid black;
	}
	.cash-box{
		width: 100%;
		padding-left: 10px;
	}
	.cash-box table{
		width: 100%;
	}
	.memo{
		padding-left: 230px;
		/*padding-right: 248px;*/
	}
	.p-r{
		padding-right: 10px;
	}
	.receipt{
		background: black;
		float: right;
		color: white;
		padding: 2px;
		width: 70px;
	}
	.title-box{
		text-align: right;
		width: 85px;
	}
	.cash-box .title{
		margin: 0%;
	}
	.cash-box h1{
		font-size: 35px;
	}
	.address{
		font-size: 15px;
	}
	.details{
		width: 94%;
	}
	.details table{
		width: 100%;
		padding: 0px 15px 0px 15px;
	}
	.sub-list-td p{
		border-bottom: 1px solid black;
		width: 100%;
	}
	.name{
		width: 75%;
	}
	.dob{
		width: 60%;
	}
	.sex{
		width: 40%;
	}
	.school{
		width: 60%;
	}
	.medium{
		width: 20%;
	}
	.standard{
		width: 20%;
	}
	.ad-r{
		width: 26%;
	}
	.ad-line{
		width: 74%;
	}
	.line{
		border-bottom: 1px solid black;
	}
	.phone{
		width: 40%;
	}
	.cell{
		width: 60%;
	}
	.pre{
		width: 33%;
	}
	.o-ad{
		width: 25%;
	}
	.o-name{
		width: 30%;
	}
	.o-age{
		width: 5%;
	}
	.o-edu{
		width: 40%;
	}
	.total{
		width: 32%;
	}
	.in-words{
		width: 80%;
	}
	.ins-table{
		width: 100%;
		padding: 0px 30px;
		border-top: 3px solid black;
		border-bottom: 1px solid black;
		padding-bottom: 20px;
	}
	.can-name{
		padding: 15px 0px;
	}
	.std{
		width: 30%;
	}
	.std p{
		margin-top: 5px;
	}
	.sub-off{
		margin: 0px;
	}
	.passport-pic{
		width: 20%;
	}
	.table-ad{
		width: 3%;
	}
	.table-pay{
		width: 10%;
	}
	.table-box{
		margin-bottom: 10px;
		padding: 0px 30px 10px 30px;
	}
	.batch{
		width: 30%;
		padding: 3%;
		font-size: 20px;
	}
	.table-box table{
		border-collapse: collapse;
		width: 100%!important;
		padding: 0!important;
	}
	.set-padding{
		padding: 0px 30px 10px 30px;
	}
	.t-border {
		border: 2px solid black;
	}
	.t-pad{
		padding: 0px 0px 0px 10px;
	}
	.sub{
		width: 20%!important;
	}
	.sub-list{
		width: 85%!important;
	}
	.sub-list-td{
		width: 20%!important;
	}
	.parent{
		width: 35%;
	}
	.student{
		width: 33%;
	}

	</style>

</head>
<body>
	@php
	$tit = ['P.C.','O.C.'];
	@endphp
	@for ($aa = 0; $aa < 2; $aa++)
	<table class="border">
		<tr>
			<td>
				<table class="border-bottom">
					<tr>
						<td>
							<img style="width:125px" src="images/logo.png"/>
						</td>
						<td class="cash-box">
							<table>
								<tr>
									<td class="memo">
										<p><i><u>{{ $tit[$aa] }}</u></i></p>
									</td>
									<td class="title-box p-r" align="right">
										<p class="receipt">RECEIPT</p>
										<p>{{ $invoice->in_type }}</p>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<h1>{{ $classDetais->set_class_name}}</h1>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<p class="address">{{$classDetais->set_class_address}}</p>
										<p>Mobile No.: {{$classDetais->set_mobile1}}{{($classDetais->set_mobile2)?','.$classDetais->set_mobile2:''}} </p>
										<p>{{($classDetais->set_emailid)?'Email Id:'.$classDetais->set_emailid:''}}
								{{($classDetais->set_website)?'Website: '.$classDetais->set_website:''}} </p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="name">
							<p>Receipt: <span>{{ $invoice->in_receipt_no }}</span></p>
						</td>
						<td class="date">
							<p>Date: <span>{{ Carbon\Carbon::parse($invoice->in_add_date)->format('d/m/Y') }}</span></p>
						</td>

					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="name">
							<p class="p-line"><span class="p-title">Received with thanks from:</span> <span>{{ $invoice->student->stu_first_name.' '.$invoice->student->stu_middle_name.' '.$invoice->student->stu_last_name }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="name">


						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="chq">
							@php
							$mode = 'Cash / <s>D.D.</s> / <s>Cheque No.</s>';
							$modeNumber = $date = $bank ='------------';

							if($invoice->in_payment_mode != 2){
								if($invoice->in_payment_mode == 1){
									$mode = '<s>Cash</s> / <s>D.D.</s> / Cheque No.';
									$modeNumber = $invoice->in_cheque_number;

								}else if($invoice->in_payment_mode == 3){
									$mode = '<s>Cash</s> / D.D. / <s>Cheque No.</s>';
									$modeNumber = $invoice->in_dd_number;
								}
								$date = Carbon\Carbon::parse($invoice->in_cheque_date)->format('d/m/Y');
								$bank = $invoice->in_cheque_bank;
							}
							@endphp
							<p class="p-line"><span class="p-title">By {!! $mode !!}:</span> <span> {{ $modeNumber }}</span></p>
						</td>
						<td class="dated">
							<p class="p-line"><span class="p-title">Dated:</span> <span> {{ $date }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="name">
							<p class="p-line"><span class="p-title">Name of the Bank:</span> <span> {{ $bank }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="name">
							<p class="p-line"><span class="p-title">Batch:</span> <span> {{ $invoice->student->admission->batch->batch_name }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td align="center" class="equal">
							<p class="big-title">Amount Paid</p>
						</td>
						<td align="center" class="equal">
							<p class="big-title">Total Balance</p>
						</td>
						<td align="center" class="equal">
							<p class="big-title">Next Installment</p>
						</td>
						<td align="center" class="equal">
							<p class="big-title">Installment</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td align="center" class="equal-2">
							<p class="box">&nbsp;{{ number_format($invoice->in_paid_amount) }}</p>
						</td>
						<td align="center" class="equal-2">
							<p class="box">&nbsp;{{ number_format($invoice->student->admission->ad_fees) }}</p>
						</td>
						@if ($invoice->student->recentInstallment()->first())
						<td align="center" class="equal-2">
							<p class="box">&nbsp;{{ Carbon\Carbon::parse($invoice->student->recentInstallment()->first()->install_due_date)->format('d/m/Y') }}</p>
						</td>
						<td align="center" class="equal-2">
							<p class="box">&nbsp;{{ number_format($invoice->student->recentInstallment()->first()->install_amount) }}</p>
						</td>
						@else
						<td align="center" class="equal-2">
							<p class="box">&nbsp;-</p>
						</td>
						<td align="center" class="equal-2">
							<p class="box">&nbsp;-</p>
						</td>
						@endif
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table style="font-weight: 600;">
					<tr>
						<td colspan="2">
							Terms & Conditions:
						</td>
					</tr>
					<tr>
						<td colspan="2">
							1)Fees once paid will not be refunded in any condition.
						</td>
					</tr>
					<tr>
						<td colspan="2">
							2)Rs.100/- Administrative charges if cheque is dishonored.
						</td>
					</tr>
					<tr>
						<td colspan="2">
							3)Payment by cheque is subject to realisation.
						</td>
					</tr>
					<tr>
						<td>
							4)All disputes are subject to Pune Juridication.
						</td>
						<td align="right">
							FOR {{ $classDetais->set_class_name }}
						</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>
	@if ($aa == 0)
	<hr>
	@endif
	@endfor
</body>
</html>
