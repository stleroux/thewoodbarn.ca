{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'add')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{{ Form::label('title', 'Title', ['class'=>'required']) }}
				{!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
				<span class="text-danger">{{ $errors->first('title') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				{{ Form::label('body', 'Body', ['class'=>'required']) }}
				{!! Form::textarea('body', null, array('placeholder' => 'Body','class' => 'form-control','style'=>'height:100px')) !!}
				<span class="text-danger">{{ $errors->first('body') }}</span>
			</div>
		</div>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'edit')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
				{{ Form::label('title', 'Title', ['class'=>'required']) }}
				{!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'autofocus')) !!}
				<span class="text-danger">{{ $errors->first('title') }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8">
			<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
				{{ Form::label('body', 'Body', ['class'=>'required']) }}
				{!! Form::textarea('body', null, array('placeholder' => 'Body','class' => 'form-control','style'=>'height:100px')) !!}
				<span class="text-danger">{{ $errors->first('body') }}</span>
			</div>
		</div>
	</div>
@endif

{{--================================================================================================================================================
== 
================================================================================================================================================--}}
@if($action_name == 'show')
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6">
			<div class="form-group">
				{{ Form::label('title', 'Title') }}
				<div class="well well-sm">
                {{ $tweet->title }}
            </div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8">
			<div class="form-group">
				{{ Form::label('body', 'Body') }}
				<div class="well well-sm">
                {{ $tweet->body }}
            </div>
			</div>
		</div>
	</div>
@endif
