<div class="row">
    <div class="col-xs-12 col-sm-6">
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			{{ Form::label('name', 'Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
			{{ Form::text('name', null, ['class' => 'form-control', 'autofocus']) }}
			<span class="text-danger">{{ $errors->first('name') }}</span>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
		<div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
			{{ Form::label('module_id', 'Module', ($action_name != "show" ? ['class'=>'required'] : "")) }}
			{{ Form::select('module_id', array(''=>'Select a module') + $modules, null, ['class'=>'form-control']) }}
			<span class="text-danger">{{ $errors->first('module_id') }} </span>
		</div>
	</div>
</div>
