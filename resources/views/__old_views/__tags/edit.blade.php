@extends ('layouts.main')

@section ('title', '| Edit Tag')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('tags.index') }}">Tags</a></li>
		<li class="active">Edit</li>
	</ol>

	{!! Form::model($tag, ['route'=>['tags.update', $tag->id], 'method' => 'PUT']) !!}
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Edit</div>
				<div class="panel-body">
					{{ Form::label ('name', 'Name:') }}
					{{ Form::text ('name', null, ['class' => 'form-control', 'autofocus']) }}
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<div class="panel-body">
					{{ Form::submit('Update Tag', ['class' => 'btn btn-success btn-block']) }}
					{!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-block']) !!}
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop

@section ('scripts')
@stop
