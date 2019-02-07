@extends ('layouts.main')

@section ('title', 'Login')

@section ('content')

{!! Form::open() !!}
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">Login 123</div>
			<div class="panel-body">
				{{ Form::label('login', 'Username or Email') }}
				{{ Form::text('login', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) }}



				{{ Form::label('password', 'Password') }}
				{{ Form::password('password', ['class'=>'form-control']) }}
				<br>
				{{ Form::checkbox('remember') }} {{ Form::label('remember', 'Remember Me') }}
				<br><br>
				{{ Form::submit('Login',['class'=>'btn btn-primary btn-side-spacing']) }}

				<a href="{{ url('password/reset') }}" class="btn btn-default pull-right">Forgot My Password</a>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}

@endsection