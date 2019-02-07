{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
	<div class="row">
		<div class="col-sm-3 {{ $errors->has('username') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('username', 'Username', ['class'=>'required']) }}
				{{ Form::text('username', null, ['class'=>'form-control', 'autofocus'=>'autofocus']) }}
				<span class="text-danger">{{ $errors->first('username') }}</span>
			</div>
		</div>

		<div class="col-sm-3 {{ $errors->has('first_name') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('first_name', 'First Name', ['class'=>'required']) }}
				{{ Form::text('first_name', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('first_name') }}</span>
			</div>
		</div>

		<div class="col-sm-3 {{ $errors->has('last_name') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('last_name', 'Last Name', ['class'=>'required']) }}
				{{ Form::text('last_name', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('last_name') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('email', 'Email', ['class'=>'required']) }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('email') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3 {{ $errors->has('password') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('password', 'Password', ['class'=>'required']) }}
				{{ Form::password('password', ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('password') }}</span>
			</div>
		</div>

		<div class="col-sm-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'required']) }}
				{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('roles', 'Roles', ['class'=>'required']) }}
				{{ Form::select('roles[]', $roles,[], array('class' => 'form-control select2-multi','multiple')) }}
				<span class="text-danger">{{ $errors->first('roles') }}</span>
			</div>
		</div>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
	<div class="row">
		<div class="col-sm-3 {{ $errors->has('username') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('username', 'Username', ['class'=>'required']) }}
				{{ Form::text('username', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('username') }}</span>
			</div>
		</div>

		<div class="col-sm-3 {{ $errors->has('first_name') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('first_name', 'First Name', ['class'=>'required']) }}
				{{ Form::text('first_name', null, ['class'=>'form-control', 'autofocus'=>'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
				<span class="text-danger">{{ $errors->first('first_name') }}</span>
			</div>
		</div>

		<div class="col-sm-3 {{ $errors->has('last_name') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('last_name', 'Last Name', ['class'=>'required']) }}
				{{ Form::text('last_name', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('last_name') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('email', 'Email', ['class'=>'required']) }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}
				<span class="text-danger">{{ $errors->first('email') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
			<div class="form-group">
				{{ Form::label('roles', 'Roles', ['class'=>'required']) }}
				{{ Form::select('roles[]', $roles,[], array('class' => 'form-control select2-multi','multiple')) }}
				<span class="text-danger">{{ $errors->first('roles') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Enter password only to replace the existing one</div>
				<div class="panel-body">
					<div class="col-sm-3 {{ $errors->has('password') ? 'has-error' : '' }}">
						<div class="form-group">
							{{ Form::label('password', 'Password', ['class'=>'required']) }}
							{{ Form::password('password', ['class'=>'form-control']) }}
							<span class="text-danger">{{ $errors->first('password') }}</span>
						</div>
					</div>

					<div class="col-sm-3 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<div class="form-group">
							{{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'required']) }}
							{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
							<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				{{ Form::label('username', 'Username', ($action_name != "show" ? ['class'=>'required'] : "")) }}
				<div class="well well-sm">{!! $user->username !!}</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{{ Form::label('first_name', 'First Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
				<div class="well well-sm">{!! $user->first_name !!}</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{{ Form::label('last_name', 'Last Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
				<div class="well well-sm">{!! $user->last_name !!}</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('email', 'Email', ($action_name != "show" ? ['class'=>'required'] : "")) }}
				<div class="well well-sm">{!! $user->email !!}</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			{{ Form::label('roles', 'Roles', ($action_name != "show" ? ['class'=>'required'] : "")) }}
			<br />
			@foreach ($user->roles as $role)
				<div class="well well-sm">
					<span class="label label-default">{{ $role->display_name }}</span>
				</div>
			@endforeach
		</div>
	</div>
@endif
