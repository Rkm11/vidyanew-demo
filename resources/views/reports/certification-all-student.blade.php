@php
use App\Models\Certification;
use App\Models\Setting;
$classDetais=Setting::first();
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Marksheet</title>

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
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


@foreach($students as $i )
	<table width="100%">

	<tr>
		<th colspan="2"><h4> Name of Student : {{$i->stu_first_name}} {{$i->stu_middle_name}} {{$i->stu_last_name}}</els></th>
	</tr>
	<tr>
		<th>Course Name</th>
		<th>Certificate Issued</th>
	</tr>
	@if(!empty($i->courses))
	@foreach($i->courses as $courses)
	<tr>
	<td>
		{{$courses->std_name}}
	</td>
	<td>
		@php
			$course = Certification::select(['*'])->where('cer_cid', $courses->std_id)
			->where('cer_sid', $i->stu_id)->first();
			$isChecked=(!empty($course->cer_issued)&&1==$course->cer_issued)?'Issued':'Not Issued';
		@endphp
		<b><center>{{$isChecked}}</center></b>
	</td>
</tr>
	@endforeach

	@else
	<tr>
	<td colspan="2">
		<b><center>No Course selected</center></b>
	</td>
</tr>
	@endif
	</table>
	@endforeach
</body>
</html>
