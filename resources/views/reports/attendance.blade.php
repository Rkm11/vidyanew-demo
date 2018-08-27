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

	<title>Attendance Report</title>
	<style type="text/css">
		span.title {
    text-align: center !important;
    align-content: center !important;
    width: 700px;
    font-size: 25px;
    font-weight: 600;
    padding-left: 300px;
}
table.border {
    border: 1px solid;
    padding: 5px;
    text-align: center;
    margin: 5px;
    font-size: 20px;
    font-weight: 500;
}
	</style>
</head>
<body>
	<span class="title">Attendance Report</span>
	<table class="border" border="1">
		<tr>
			<?php foreach ($arrColumns as $columns) {?>
			<th>
				{{$columns}}
			</th>
			<?php }?>
		</tr>

		<?php foreach ($arrStu as $value) {?>
		<tr>
			<?php foreach ($value as $val) {?>
			<td>{{$val ? $val : '-'}}</td>
		<?php }?>
		</tr>
		<?php }?>
	</table>


</body>
</html>
