<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ $m->stu_first_name.' '.$m->stu_last_name. ' Marksheet' }}</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">

</head>
<body>

	<table class="border table-responsive">
		<tr>
			<td>
				<table class="header">
					<tr>
						<td>
							<img src="{{ asset('images/logo.png') }}"/>
						</td>
						<td class="cash-box">
							<div class="title-box">
								<p></p>
							</div>
							<div>
								<h1>{{env('class_name')}}</h1>
							</div>
							<div class="address">
								<p>{{env('address')}}</p>
							</div>
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
							<p>Name: <span>{{ $m->stu_first_name.' '.$m->stu_middle_name.' '.$m->stu_last_name }}</span></p>
						</td>
					</tr>
					<tr>
						<td>
							<p>Standard: <span>{{ $m->admission->standard->std_name }}</span></p>
						</td>
					</tr>
					<tr>
						<td>
							<p>Batch: <span>{{ $m->admission->batch->batch_name }}</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="details">
			<td>
				<table class="t-border other-info">
					<thead>
						<tr>
							<th class="t-border">Subject</th>
							<th class="t-border">Test1</th>
							<th class="t-border">Test2</th>
							<th class="t-border">Test3</th>
							<th class="t-border">Test4</th>
							<th class="t-border">Test5</th>
							<th class="t-border">Test6</th>
							<th class="t-border">Test7</th>
							<th class="t-border">Test8</th>
							<th class="t-border">Total</th>
						</tr>
					</thead>
					<tbody>
						@php
							$t = [0,0,0,0,0,0,0,0];
							$tt=0;
						@endphp
						@forelse ($m->marksheets()->get() as $mark)
						@php
							$t[0] = $t[0] + $mark->mark_test_1;
							$t[1] = $t[1] + $mark->mark_test_2;
							$t[2] = $t[2] + $mark->mark_test_3;
							$t[3] = $t[3] + $mark->mark_test_4;
							$t[4] = $t[4] + $mark->mark_test_5;
							$t[5] = $t[5] + $mark->mark_test_6;
							$t[6] = $t[6] + $mark->mark_test_7;
							$t[7] = $t[7] + $mark->mark_test_8;

						@endphp
							<tr align="center">
								<td class="t-border"><p>{{ $mark->subject->sub_name }}</p></td>
								<td class="t-border">{{ $mark->mark_test_1 }}</td>
								<td class="t-border">{{ $mark->mark_test_2 }}</td>
								<td class="t-border">{{ $mark->mark_test_3 }}</td>
								<td class="t-border">{{ $mark->mark_test_4 }}</td>
								<td class="t-border">{{ $mark->mark_test_5 }}</td>
								<td class="t-border">{{ $mark->mark_test_6 }}</td>
								<td class="t-border">{{ $mark->mark_test_7 }}</td>
								<td class="t-border">{{ $mark->mark_test_8 }}</td>
								<td class="t-border"><p>{{ $mark->mark_total }}</p></td>
							</tr>
						@empty

						@endforelse
					</tbody>
					<tfoot>
s						<tr align="center">
							<td class="t-border"><p>Total</p></td>
							<td class="t-border"><p>{{ $t[0] }}</p></td>
							<td class="t-border"><p>{{ $t[1] }}</p></td>
							<td class="t-border"><p>{{ $t[2] }}</p></td>
							<td class="t-border"><p>{{ $t[3] }}</p></td>
							<td class="t-border"><p>{{ $t[4] }}</p></td>
							<td class="t-border"><p>{{ $t[5] }}</p></td>
							<td class="t-border"><p>{{ $t[6] }}</p></td>
							<td class="t-border"><p>{{ $t[7] }}</p></td>
							<td class="t-border"><p>{{ $t[8] }}</p></td>
							<td class="t-border"><p>{{ array_sum($t) }}</p></td>
						</tr>
					</tfoot>
				</table>

			</td>
		</tr>
	</table>
</body>
</html>
