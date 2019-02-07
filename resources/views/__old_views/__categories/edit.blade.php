@extends ('layouts.main')

@section ('title', '| Edit Category')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('categories.index') }}">Categories</a></li>
		<li class="active">{{ $category->name}}</li>
	</ol>

	{!! Form::model($category, ['route'=>['categories.update', $category->id], 'method' => 'PUT']) !!}
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Category</div>
					<div class="panel-body">
						@include('partials._displayErrorsWarning')
						<div class="col-md-8">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								{{ Form::label ('name', 'Name:') }}
								{{ Form::text ('name', null, ['class' => 'form-control', 'autofocus']) }}
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
						{{ Form::submit('Update Category', ['class' => 'btn btn-success btn-block']) }}
						<a href="{{ route('categories.index') }}" class="btn btn-default btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop