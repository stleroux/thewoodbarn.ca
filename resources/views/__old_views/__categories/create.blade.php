@extends('layouts.main')

@section ('title', '| Create Category')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section('content')
	{!! Form::open(['route' => 'categories.store']) !!}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">New Category</div>
					<div class="panel-body">

						@include('partials._displayErrorsWarning')
						
						<div class="col-md-8">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								{{ Form::label('name', 'Name:') }}
								{{ Form::text('name', null, ['class' => 'form-control', 'autofocus']) }}
								<span class="text-danger">{{ $errors->first('name') }}</span>
							</div>
						</div>
						
						
						<div class="col-md-8">
							<div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
								{{ Form::label('module_id', 'Module:', ['class'=>'form-spacing-top']) }}
		    					{{ Form::select('module_id', $modules, null, ['class'=>'form-control']) }}
		    					<span class="text-danger">{{ $errors->first('module_id') }}</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Options</div>
					<div class="panel-body">
						{{ Form::submit('Create New Category', ['class'=>'btn btn-primary btn-block']) }}
						<a href="{{ route('categories.index') }}" class="btn btn-default btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop