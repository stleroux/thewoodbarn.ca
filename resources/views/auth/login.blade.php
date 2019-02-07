@extends ('layouts.main1')

@section ('title', '| Login')

@section ('stylesheets')
	{{-- {{ Html::style('css\styles.css') }} --}}
@stop

@section('breadcrumb')
@stop

@section ('content')

@php
    // Save entry to log file using built-in Monolog
    Log::info("Guest accessed :: Login");
@endphp

  {!! Form::open() !!}
{{--     <br />
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        @if (count($errors) > 0)
          <div class="panel panel-danger">
            <div class="panel-heading"><strong>The following errors have occured:</strong></div>
            <div class="panel-body">
              <ul>
                @foreach ($errors->all() as $error)
  	              <li class="text text-danger"> {{ $error }} </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
      </div>
    </div>
		<br /> --}}
    <br /><br /><br />
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
  			<div class="panel panel-default">
  				<div class="panel-heading">Login</div>
  				<div class="panel-body">
  					{{-- <div class="form-group"> --}}
            <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
  						<div class="input-group">
  							<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
  							<input type="text" class="form-control" name="login" id="login" autofocus="autofocus" placeholder="Username or Email">
  						</div>
              <span class="text-danger">{{ $errors->first('login') }}</span>
  					</div>
  						
  					{{-- <div class="form-group"> --}}
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
  						<div class="input-group">
  							<div class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></div>
  							<input type="password" class="form-control" name="password" id="password" autofocus="autofocus" placeholder="Password">
  						</div>
              <span class="text-danger">{{ $errors->first('password') }}</span>
  					</div>
  						
  					<div class="form-group">
  						<div class="input-group">
  							{{ Form::checkbox('remember', 1, null, ['id'=>'remember']) }}&nbsp; {{ Form::label('remember', 'Remember Me') }}
  						</div>
  					</div>

  					<div class="form-group">
  						<div class="input-group center-block">
  							{{ Form::button('<i class="fa fa-sign-in" aria-hidden="true"></i> Login', array('type' => 'submit', 'class' => 'btn btn-primary btn-block')) }}
  							<a href="{{ url('password/reset') }}" class="btn btn-default btn-block"><i class="fa fa-frown-o" aria-hidden="true"></i> Forgot My Password</a>
  							<a href="{{ url('auth/register') }}" class="btn btn-default btn-block"><i class="fa fa-check" aria-hidden="true"></i> Register An Account</a>
  						</div>
  					</div>
  				</div>
  			</div>
      </div>
    </div>
  {!! Form::close() !!}

@stop

@section ('scripts')
@stop
