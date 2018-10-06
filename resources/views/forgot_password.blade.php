@extends('layouts.app')

@php
$ID = 'admission';
$ID2 = 'previous';
$ID3 = 'relative';
@endphp
@push('header')
<script>
	ID = '{{ $ID }}';
	ID2 = '{{ $ID2 }}';
	ID3 = '{{ $ID3 }}';
</script>
@endpush

@section('page-title')
<div class="pull-left">
	Change Password
</div>
<div class="pull-right">
	<a href = "javascript:void(0);" onclick="window.history.back()" class="btn btn-danger">Back</a>
</div>
@endsection
@section('content')
@if (session('Error'))
<div class="alert alert-danger">
{{ session('Error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">


		@if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

		<div class="panel-body" style="padding:30px">
<form id="changep" class="form-horizontal" method="POST" action="{{ route('forgot-password') }}">
{{ csrf_field() }}

<div class="form-group">
<label for="password" class="col-md-4 control-label">Email Id<span style="color:red;">*</span>:</label>
<div class="col-md-6">
	<input id="email" type="email" class="form-control"   name="email" required>
</div>
</div>
<div class="form-group">
<label for="password" class="col-md-4 control-label">Select Question<span style="color:red;">*</span>:</label>
<div class="col-md-6">
	<select id="question" name="question" required="" class="form-control">
		<option value="">Select Question</option>
		@forelse (App\Models\Question::get() as $question)
			<option  value = "{{ $question->id }}" >{{ $question->question_name }}</option>
		@empty
			{{-- empty expr --}}
		@endforelse
	</select>
</div>
</div>


<div class="form-group">
<label for="password" class="col-md-4 control-label">Answer<span style="color:red;">*</span>:</label>
<div class="col-md-6">
	<input id="answer" type="text" class="form-control"   name="answer" required>
</div>
</div>

<div class="form-group{{ $errors->has('password1') ? ' has-error' : '' }}">
<label for="password1" class="col-md-4 control-label">New Password<span style="color:red;">*</span>:</label>
<div class="col-md-6">
<input id="password1" type="password" class="form-control" name="password1" required>
@if ($errors->has('password1'))
<span class="help-block">
<strong>{{ $errors->first('password1') }}</strong>
</span>
@endif
</div>
</div>
<div class="form-group">
<label for="password_confirmation" class="col-md-4 control-label">Confirm New Password<span style="color:red;">*</span>:</label>
<div class="col-md-6">
<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
</div>
</div>
<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="btn btn-danger">
Change Password
</button>
&nbsp;&nbsp;<a  style="font-weight: 500;font-size: 20px;text-decoration:underline;" href="{{route('login')}}">Login</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</section>
@endsection

@push('footer')

<script>

	CRUD.formSubmission("{{ route($ID2.'.store') }}", 0,{}, 'previous');

	CRUD.formSubmission("{{ route($ID3.'.store') }}", 0,{}, 'relative');

	$("#addmission_form").addClass("open");

	function form_hide(){
		$("#show_otherinfo").toggle();
	}

	function prev_year_per(){
		$('#myModal').modal('show');
	}

	var find = "{{ route('find-school') }}",
	schoolUrl = "{{ route('school.store') }}";
	CRUD.formSubmission("{{ route($ID.'.store') }}", 0,{}, ID);

	$('#standard, #standardPre').on({
		'change' : function(){
			getSubject(this.value, this.id);
		}
	});
	function getSubject(id, di){
		$.ajax({
			url : '{{ route('subject-data') }}',
			type : 'post',
			data : {id : id},
			success : function(d){
				var val = [];
				if(d.length > 0){
					$.each(d, function(k,v){
						if(di == 'standardPre'){
							val.push('<div class="row">'
								+'<div class="col-xs-12 col-sm-12">'
								+'<div class="col-sm-6">'
								+'<div class="form-group">'
								+'<label class="form-label">Subject'+(++k)
								+'<span style="color:red;">*'
								+'</span>:'
								+'</label>'
								+'<div class="controls">'
								+'<input type="text" class="form-control" value="'+v.sub_name+'" disabled>'
								+'</div>'
								+'</div>'
								+'</div>'
								+'<div class="col-sm-6">'
								+'<div class="form-group">'
								+'<label class="form-label">Marks'
								+'<span style="color:red;">*'
								+'</span>:'
								+'</label>'
								+'<div class="controls">'
								+'<input type="number" class="form-control" name="mark['+v.sub_id+']" placeholder ="Mark">'
								+'</div>'
								+'</div>'
								+'</div>'
								+'</div>'
								+'</div>');
						}else{

							val.push('<div class="col-sm-6"><li><input type="checkbox" name = "subject[]" value="'+v.sub_id+'" class="skin-square-green"><label class="icheck-label form-label">'+v.sub_name+'</label></li></div>');
						}
					});
				}else{
					val.push('<div class = "alert alert-danger text-center">No Subject Found</div>');
				}
				if(di == 'standardPre'){
					$('#subjectPre').html(val);
				}else{
					$('#subject-box').show();
					$('#subjectsBox').html(val);
				}
				iCheck();
			}
		});
	}

</script>
@endpush
