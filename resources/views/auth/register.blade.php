@extends ('layouts.main1')

@section ('title', 'Register')

@section ('stylesheets')
	{{ Html::style('css\styles.css') }}
@stop

@section('breadcrumb')
@stop

@section ('content')

@php
    // Save entry to log file using built-in Monolog
    Log::info("Guest accessed :: Register");
@endphp

	{!! Form::open() !!}
	<br /><br /><br />
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Register New Account</div>
				<div class="panel-body">
					<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
						{{ Form::label('last_name', 'Last Name:') }}
						{{ Form::text('last_name', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) }}
						<span class="text-danger">{{ $errors->first('last_name') }}</span>
					</div>

					<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
						{{ Form::label('first_name', 'First Name:') }}
						{{ Form::text('first_name', null, ['class'=>'form-control']) }}
						<span class="text-danger">{{ $errors->first('first_name') }}</span>
					</div>

					<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
						{{ Form::label('username', 'Preferred Username:') }}
						{{ Form::text('username', null, ['class'=>'form-control']) }}
						<span class="text-danger">{{ $errors->first('username') }}</span>
					</div>

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{{ Form::label('email', 'Email:') }}
						{{ Form::email('email', null, ['class'=>'form-control']) }}
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>

					<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						{{ Form::label('password', 'Password:') }}
						{{ Form::password('password', ['class'=>'form-control']) }}
						<span class="text-danger">{{ $errors->first('password') }}</span>
					</div>

					<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						{{ Form::label('password_confirmation', 'Confirm Password:') }}
						{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
						<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
					</div>
					<br />
					{{ Form::hidden('selfRegistered', '1') }}
					{{ Form::submit('Register',['class'=>'btn btn-primary']) }}
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop
