<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admission Form</title>

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

	<tr><th colspan="2"><h4> Name of Student : {{$i[0]->stu_first_name}} {{$i[0]->stu_middle_name}} {{$i[0]->stu_last_name}}</h4></th></tr>
	<tr><th colspan="2"><h4> Name of School/College : {{$i[0]->ad_school}} </h4></th></tr>
	<tr><th><h4> Standard : {{$i[0]->std_name}}</h4></th><th><h4> Medium : {{$i[0]->med_name}}</h4></th></tr>

	</table>
		<?php $flghassubject = 1;?>
  		@foreach($i as $row)
  		<?php if ($row->sub_name) {

	$flghassubject++;
}
?>
  		<table class="table table-bordered">
  		<tbody>
  		<tr>
    		<th>{{ env('class_name') }} </th>
    		<th colspan="11"></th>
   		</tr>

   		<tr>
		    <th rowspan="4"></th>
		    <th>Test #</th>
		    <td>Test 1</td>
		    <td>Test 2</td>
		    <td>Test 3</td>
		    <td>Test 4</td>
		    <td>Test 5</td>
		    <td>Test 6</td>
		    <td>Test 7</td>
		    <td>Test 8</td>

   		</tr>
	  	<tr>
	    	<td>Date</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    	<td>{{$row->mark_added}}</td>
	    </tr>
	  	<tr>
	    	<td>Marks</td>
	    	<td>{{$row->mark_test_1}}</td>
	    	<td>{{$row->mark_test_2}}</td>
	    	<td>{{$row->mark_test_3}}</td>
	    	<td>{{$row->mark_test_4}}</td>
	    	<td>{{$row->mark_test_5}}</td>
	    	<td>{{$row->mark_test_6}}</td>
	    	<td>{{$row->mark_test_7}}</td>
	    	<td>{{$row->mark_test_8}}</td>
	  	</tr>
	   	<tr>
	    	<td>Out of</td>
	    	<td>{{$row->outof_test_1}}</td>
	    	<td>{{$row->outof_test_2}}</td>
	    	<td>{{$row->outof_test_3}}</td>
	    	<td>{{$row->outof_test_4}}</td>
	    	<td>{{$row->outof_test_5}}</td>
	    	<td>{{$row->outof_test_6}}</td>
	    	<td>{{$row->outof_test_7}}</td>
	    	<td>{{$row->outof_test_8}}</td>

	  	</tr>
	  	</tbody>
	  	</table>

	  	<?php if ($flghassubject == 2 or $flghassubject == 4 or $flghassubject == 6) {?>
	  	<div style="page-break-after:always;"></div>
	  	<?php }?>
	  	@endforeach






</body>
</html>
