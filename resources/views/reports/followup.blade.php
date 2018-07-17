<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admission Form</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	 
</head>
<style type="text/css">
h2 {
    text-align: center;
}

</style>
<body>
	
	<h2>Follow Up - Status</h2>
	<hr>
	<table>
		
		<tr>
			<td><h3>Student Name: </h3></td>
			<td>{{$i->student_name}}</td>
		</tr>	
		<tr>
			<td><h3>Mobile</h3></td>
			<td>{{$i->mobile}}</td>
		</tr>
		<tr>
			<td><h3>Follow up 1</h3></td>
			<td>{{$i->follow1}}</td>
		</tr>
		<tr>
			<td><h3>Follow up 2</h3></td>
			<td>{{$i->follow2}}</td>
		</tr>
		<tr>
			<td><h3>Follow up 3</h3></td>
			<td>{{$i->follow3}}</td>
		</tr>
		<tr>
			<td><h3>Follow up 4</h3></td>
			<td>{{$i->follow4}}</td>
		</tr>
		<tr>
			<td><h3>Follow up 5</h3></td>
			<td>{{$i->follow5}}</td>
		</tr>
	</table>
	

</body>
</html>
