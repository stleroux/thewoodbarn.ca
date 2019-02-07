<div class="row">
	<div class="col-xs-5 col-sm-5">
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{!! Form::label("name", "Internal Name", ($action_name != "show" ? ['class'=>'required'] : "")) !!}
			{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
			<span class="text-danger">{{ $errors->first('name') }}</span>
		</div>
	</div>
	<div class="col-xs-5 col-sm-5">
		<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
			{!! Form::label("display_name", "Display name", ($action_name != "show" ? ['class'=>'required'] : "")) !!}
			{!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
			<span class="text-danger">{{ $errors->first('display_name') }}</span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-5 col-sm-5">
		<div class="form-group">
			{!! Form::label("admin", "Admin?") !!}
			@if($action_name == 'add')
				{{ Form::checkbox('admin', '1', null, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}
			@else
				{{-- http://nielson.io/2014/02/handling-checkbox-input-in-laravel/ --}}
				{{ Form::hidden('admin', 0) }}
				{{ Form::checkbox('admin', '1', $permission->admin, ['data-toggle=toggle', 'data-on="Yes"', 'data-off="No"', 'data-onstyle="success"', 'data-offstyle="danger"', 'data-size="mini"']) }}
			@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
			{{ Form::label('description', 'Description', ($action_name != "show" ? ['class'=>'required'] : "")) }}
			{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
			<span class="text-danger">{{ $errors->first('description') }}</span>
		</div>
	</div>
</div>