@extends ('layouts.main')

@section ('title', '| Register')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
    {!! Html::style('css/select2.min.css') !!}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('users.index') }}">Users</a></li>
		<li class="active">Create User</li>
	</ol>

	{!! Form::open(array('route'=>'users.store')) !!}
	<div class="row">
		<div class="col-md-9">

			@include('partials._displayErrorsWarning')

			<div class="panel panel-default">
				<div class="panel-heading">New User</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4 {{ $errors->has('username') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('username', 'Username:') }}
								{{ Form::text('username', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) }}
							</div>
							<span class="text-danger">{{ $errors->first('username') }}</span>
                       	</div>

						<div class="col-md-4 {{ $errors->has('first_name') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('first_name', 'First Name:') }}
								{{ Form::text('first_name', null, ['class'=>'form-control']) }}
							</div>
							<span class="text-danger">{{ $errors->first('first_name') }}</span>
						</div>

						<div class="col-md-4 {{ $errors->has('last_name') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('last_name', 'Last Name:') }}
								{{ Form::text('last_name', null, ['class'=>'form-control']) }}
							</div>
							<span class="text-danger">{{ $errors->first('last_name') }}</span>
						</div>
					</div>

					<div class="row">
						<div>&nbsp;</div>
					</div>

					<div class="row">
						<div class="col-md-12 {{ $errors->has('email') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('email', 'Email:') }}
								{{ Form::email('email', null, ['class'=>'form-control']) }}
							</div>
							<span class="text-danger">{{ $errors->first('email') }}</span>
						</div>
					</div>

					<div class="row">
						<div>&nbsp;</div>
					</div>

					<div class="row">
						<div class="col-md-3 {{ $errors->has('password') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('password', 'Password:') }}
								{{ Form::password('password', ['class'=>'form-control']) }}
							</div>
							<span class="text-danger">{{ $errors->first('password') }}</span>
						</div>

						<div class="col-md-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<div class="input-group input-group-sm">
								{{ Form::label('password_confirmation', 'Confirm Password:') }}
								{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
							</div>
							<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
						</div>
					</div>

					<div class="row">
						<div>&nbsp;</div>
					</div>

                    <div class="row">
                        <div class="col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
                        	<div class="select-group select-group-sm">
                            	{{ Form::label('roles', 'Roles:') }}
                            	{{ Form::select('roles[]', $roles,[], array('class' => 'form-control select2-multi','multiple')) }}
                            	<span class="text-danger">{{ $errors->first('roles') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Options</div>
                <div class="panel-body">
                    {{ Form::submit('Create User',['class'=>'btn btn-primary btn-block']) }}
                    {!! link_to(route('users.index'), 'Cancel', ['class'=>'btn btn-default btn-block']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section ('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
@stop
