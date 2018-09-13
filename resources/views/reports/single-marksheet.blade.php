@php
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>All Student Marksheet</title>

	<!-- Fonts -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}"> -->
	<style type="text/css">
		table, th, td {
		   border: 1px solid black;
		}
		table{
			margin-bottom: 10px;


		}
		th, td {
		    padding: 5px;
		}
		body{
			padding: 20px;
		}
		tbody:before, tbody:after { display: none; }
	</style>

</head>
<body>

	<table class="border table-responsive">
		<tr>
			<td>
				<table class="header">
					<tr>
						<td>
							<img height="50" width="50"  src="images/logo.png"/>
						</td>
						<td class="cash-box">
							<div class="title-box">
								<p></p>
							</div>
							<div>
								<h1>{{ $classDetais->set_class_name }}</h1>
							</div>
							<div class="address">
								<p>{{ $classDetais->set_class_address }}</p>
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
							<p>Standard: <span>{{$i[0]->std_name}}</span></p>
						</td>
						<td>
							<p>Batch: <span>{{$i[0]->batch_name}}</span></p>
						</td>
						<td>
							<p>Test Name: <span>{{$i[0]->test_name}}</span></p>
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
							<th class="t-border">Student Name</th>
							@if(!empty($subjects))
							@foreach($subjects as $sub_name)
							<th class="t-border">{{$sub_name->sub_name}}</th>
							@endforeach
							@endif
						</tr>
					</thead>
					<tbody>
							@if(!empty($marks))
							@foreach($marks as $key=>$mark)
							<tr>
							@foreach($mark as $key=>$value)
							<td>{{$value}}</td>
							@endforeach
							</tr>
							@endforeach
							@endif

					</tbody>
				</table>

			</td>
		</tr>
	</table>
</body>
</html>
