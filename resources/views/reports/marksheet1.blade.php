



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



	<table width="100%">

	<tr><th colspan="2"><h4> Name of Student : {{$i->stu_first_name}} {{$i->stu_middle_name}} {{$i->stu_last_name}}</h4></th></tr>
	<tr><th colspan="2"><h4> Name of School/College : {{$i->ad_school}} </h4></th></tr>
	<tr><th><h4> Standard : {{$i->std_name}}</h4></th><th><h4> Medium : {{$i->med_name}}</h4></th></tr>

	</table>
		<?php $flghassubject = 1;
?>
  		@foreach($marks as $row)
  		@if(empty($row) || empty($row['sub_name']))
  			@continue;
  			@endif
  		<?php
if ($row['sub_name']) {
	$flghassubject++;
}
?>
  		<table class="table table-bordered" width="100%">
  		<tbody>
  		<tr>
    		<th colspan="11">{{ $classDetais->set_class_name }} </th>
    		<!-- <th ></th> -->
   		</tr>
		<tr>
			<th colspan="11">Subject:{{$row['sub_name']}}</th>
		</tr>
   		<tr>
		    <!-- <th rowspan="1"></th> -->
		    <th>Test Name</th>
		    <td>Date</td>
		    <td>Marks</td>
		    <td >Out of</td>
		</tr>
		    <?php
foreach ($row['marks'] as $tests) {
	$test_name = explode('-', $tests->test_name);
	$test_name = $test_name[0];
	?>
	<tr>
	<td >{{$test_name}}</td>


	    	<td>{{$tests['test_date']}}</td>

	    	<td>{{$tests['mark_total']}}</td>


	    	<td>{{$tests['test_outof']}}</td>
	  	</tr>
		    <?php }?>

	  	</tbody>
	  	</table>

	  	<?php if ($flghassubject == 2 or $flghassubject == 4 or $flghassubject == 6) {?>
	  	<div style="page-break-after:always;"></div>
	  	<?php }?>
	  	@endforeach






</body>
</html>
