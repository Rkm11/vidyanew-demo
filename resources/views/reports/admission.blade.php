<!doctype html>
@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admission Form</title>

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
	td{
		padding: 0;
	}

	img{
		width: 100px;
		padding: 5px;
	}
	span{
		font-weight: 500;
		font-style: italic;
		font-size: 17px;
	}
	.border{
		width: 100%;
	}
	.cash-box{
		width: 100%;
		padding-left: 10px;
	}
	.title-box{
		width: 98%;
		text-align: right;
	}
	.cash-box .title-box{
		width: 98%;
		text-align: right;
	}
	.cash-box .title{
		margin: 0%;
	}
	.cash-box h1{
		font-size: 35px;
	}
	.address{
		font-size: 20px;
		font-weight: 600;
	}
	.details{
		width: 94%;
	}
	.details table{
		width: 100%;
		padding: 0px 30px 5px 30px;
	}
	.sub-list-td p{
		border-bottom: 1px solid black;
		width: 100%;
	}
	.name{
		width: 33.3333%;
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
		/*padding-bottom: 20px;*/
	}
	.can-name{
		padding: 15px 0px;
	}
	.std{
		width: 83%;
		padding-left: 200px;
	}
	.std h1{
		background: black;
		color: white;
		text-align: center;
		font-size: 25px;
		margin-top: 5px;
		border-radius: 10px;
		padding: 5px;
	}
	.passport-pic{
		width: 20%;
		text-align: right;
	}
	.table-ad{
		width: 25%;
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
		padding: 1%;
		font-size: 20px;
	}
	.other-info{
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
		width: 15%!important;
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
	.rule{
		width: 100%;
	}
	.page-break {
		page-break-after: always;
	}
	</style>

</head>
<body>
	@php

	function romanic_number($integer, $upcase = true)
	{
		$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
		$return = '';
		while($integer > 0)
		{
			foreach($table as $rom=>$arb)
			{
				if($integer >= $arb)
				{
					$integer -= $arb;
					$return .= $rom;
					break;
				}
			}
		}

		return $return;
	}
	@endphp
	<table class="border">
		<tr>
			<td>
				<table>
					<tr>
						<td>
							<img style="width:125px" src="images/logo.png"/>
						</td>
						<td class="cash-box">
							<div class="title-box">
							<div class="title-box">
								<p>Mobile No.: {{ $classDetais->set_mobile1 }}{{ ($classDetais->set_mobile2)?','.$classDetais->set_mobile2:'' }} </p>
								<p>{{ ($classDetais->set_emailid)?'Email Id: '.$classDetais->set_emailid:'' }}
								{{ ($classDetais->set_website)?'Website: '.$classDetais->set_website:'' }} </p>
							</div>
							<div>
								<h1>{{ $classDetais->set_class_name }}</h1>
							</div>
							<div class="address">
								<p class="address">{{ $classDetais->set_class_address }} </p>
							</div>
							<div class="address">

							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="installment">
			<td>
				<table class="ins-table">
					<tr>
						<td colspan="2" class="std">
							<table>
								<tbody>
									<tr>
										<td><h1>ADMISSION FORM</h1></td>
									</tr>
								</tbody>
							</table>
						</td>
						<td rowspan="3" class="passport-pic">
							@if(isset($i->student->stu_picture)&& !empty($i->student->stu_picture))
							<img alt = "Student Image" src="../{{ ($i->student->stu_picture) }}">

							@endif


						</td>
					</tr>
					<tr>
						<td>
							<table style="width: 100%;border-collapse: collapse;">
								<tbody>
									<tr>
										<td valign="center" class="t-border batch">
											<p>
												Batch
											</p>
										</td>
										<td  class="t-border" style="width: 40%;">&nbsp;<span>{{ $i->batch->batch_name }}</span></td>
										<td style="width: 30%;"></td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 30%;">
							<p>Date: <span>{{ Carbon\Carbon::parse($i->ad_date)->toFormattedDateString() }}</span></p>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="can-name">
							<p>1) Name of Candidate (in Capital Letters):</p>
						</td>
					</tr>
					<tr>
						<td class="name">
							<span>{{ $i->student->stu_last_name }}</span>
						</td>
						<td class="name">
							<span>{{ $i->student->stu_first_name }}</span>
						</td>
						<td class="name">
							<span>{{ $i->student->stu_middle_name }}</span>
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
							<p>Surname</p>
						</td>
						<td class="name">
							<p>Name</p>
						</td>
						<td class="name">
							<p>Father's Name</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="dob">
							<p>2) Date of Birth: <span>{{ Carbon\Carbon::parse($i->student->stu_dob)->toFormattedDateString() }}</span></p>
						</td>
						<td class="sex">
							<p>Sex: <span>{{ $i->student->stu_gender ? 'Male' : 'Female' }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="school">
							<p>3) School / College: <span>{{ $i->ad_school }}</span></p>
						</td>
						<td class="medium">
							<p>Medium: <span>{{ $i->medium->med_name }}</span></p>
						</td>
						<td class="standard">
							<p>Standard: <span>{{ $i->standard->std_name }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td>
							<p>4) Subject Offered:</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tbody>
						<tr>
							<td>
								<table style="padding: 0px!important;">
									<tbody>
										@php
										$subs = App\Models\Subject::whereIn('sub_id', explode(',',$i->ad_subjects))->get();
										$c = count($subs);

										$k = 1;
										@endphp
										<tr>
											@for ($ie = 0; $ie < 10; $ie++)
											@if ($ie < $c)
											<td class="sub-list-td"><p>{{ romanic_number($k++) }}. <span>{{ $subs[$ie]->sub_name }}</span></p></td>
											@else
											<td class="sub-list-td"><p>{{ romanic_number($k++) }}. </p></td>
											@endif
											@if ($ie == 4)
										</tr><tr>
											@endif
											@endfor
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="ad-r" valign="top">
							<p>5) Residential Address:</p>
						</td>
						<td class="ad-line">
							<span class="line">{{ $i->student->stu_address }}</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="phone">
							<p>Phone: <span>{{ $i->student->stu_mobile }}</span></p>
						</td>
						<td class="cell">
							<p>Cell: <span>{{ $i->student->stu_alt_mobile }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="pre">
							<p>6) Previous Year Percentage: </p>
						</td>
						<td class="line">
							<span>{{ $i->ad_pre_percent }} %</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td>
							<p>7) Other Information:</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td>
							<table class="t-border other-info">
								<thead class="t-border">
									<tr>
										<th class = "o-ad t-border ">Brother/ Sister</th>
										<th class = "o-name t-border">Name</th>
										<th class = "o-age t-border">Age</th>
										<th class = "0-edu t-border">Education</th>
									</tr>
								</thead>
								<tbody>
									@php
									$c1 = count($rel);

									$k1 = 1;
									@endphp
									@for ($ie = 0; $ie < 4; $ie++)
									<tr class="t-border">
										@if ($ie < $c1)
										<td class="t-border"> <p>&nbsp;{{ romanic_number($k1++) }}. <span>{{ $rel[$ie]->sr_relation }}</span></p></td>
										<td class="t-border">{{ $rel[$ie]->sr_full_name }}</td>
										<td class="t-border">{{ $rel[$ie]->sr_age }}</td>
										<td class="t-border">{{ $rel[$ie]->sr_education }}</td>
										@else
										<td class="t-border"> <p>&nbsp;{{ romanic_number($k1++) }}. </p></td>
										<td class="t-border">&nbsp;</td>
										<td class="t-border">&nbsp;</td>
										<td class="t-border">&nbsp;</td>
										@endif

									</tr>
									@endfor
								</tbody>
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
						<td>
							<p>8) Rules and Regulations:</p>
						</td>
					</tr>
					<tr>
						<td>
							b) It is compulsory to attend lectures unit test as per Classes timings.
						</td>
					</tr>
					<tr>
						<td>
							c) It is compulsory to obey all rules and regulations of Classes. Fees onces paid will not be returned in any conditions.
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table>
					<tr>
						<td class="parent">
							<p>Parent Sign</p>
						</td>
						<td class="student">
							<p>Student Sign</p>
						</td>
						<td>
							<p>for {{ $classDetais->set_class_name }}</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


</body>
</html>
