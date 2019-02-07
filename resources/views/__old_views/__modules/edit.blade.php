@extends ('layouts.main')

@section ('title', '| Edit Module')

@section ('stylesheets')
	{{ Html::style('../css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('modules.index') }}">Modules</a></li>
		<li class="active">{{ $module->name}}</li>
	</ol>

	{!! Form::model($module, ['route'=>['modules.update', $module->id], 'method' => 'PUT']) !!}
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Module</div>
					<div class="panel-body">
						@include('partials._displayErrorsWarning')

						<div class="col-md-8">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								{{ Form::label ('name', 'Name:') }}
								{{ Form::text ('name', null, ['class' => 'form-control', 'autofocus']) }}
								<span class="text-danger">{{ $errors->first('name') }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Options</div>
					<div class="panel-body">
						<button type="submit" name="submit" class="btn btn-primary btn-block">
							<div class="text text-left">
								<i class="fa fa-save"></i> Update Module
							</div>
						</button>

						<a href="{{ route('modules.index') }}" class="btn btn-default btn-block">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop