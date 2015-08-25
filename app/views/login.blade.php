<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nufarm - Encuesta</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	{{ HTML::style('assets/css/login.css') }}
</head>
<body>
	<div class="container">
		{{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'form-signin', 'role' => 'form']) }}

			@if(Session::has('error_message'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('error_message') }}
				</div>
			@endif

			@if(Session::has('ok_message'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('ok_message') }}
				</div>
			@endif

			<h2 class="form-signin-heading">NUFARM</h2>

			{{ Form::label('username', 'Username', ['class' => 'sr-only']) }}
			{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autofocus' => '']) }}

			{{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
			{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}

			<div class="checkbox">
				<label>
					{{ Form::checkbox('remember', true) }} Recordarme
				</label>
			</div>

			{{ Form::submit('Iniciar sesión', ['class' => 'btn btn-login btn-block']) }}
	
		{{ Form::close() }}
	</div>
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>