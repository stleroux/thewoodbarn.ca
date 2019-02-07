<div class="col-md-8">
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
		{{ Form::label ('name', 'Name', ($action_name != "show" ? ['class'=>'required'] : "")) }}
		{{ Form::text ('name', null, ['class' => 'form-control', 'autofocus']) }}
		<span class="text-danger">{{ $errors->first('name') }}</span>
	</div>
</div>