@extends('layouts.main')

@section('title', '| Edit Comment')

@section ('stylesheets')
@stop

@section('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('posts.index') }}">Posts</a></li>
		<li><a href="{{ route('posts.show', $comment->post->id) }}">{{ ucwords($comment->post->title) }}</a></li>
		<li class="active">Edit Comment</li>
	</ol>

	{{ Form::model($comment, ['route' => ['comment.update', $comment->id], 'method' => 'PUT']) }}
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Comment</div>
					<div class="panel-body">
						{{ Form::label('name', 'Name:') }}
						{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
				
						{{ Form::label('email', 'Email:') }}
						{{ Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}
				
						{{ Form::label('comment', 'Comment:') }}
						{{ Form::textarea('comment', null, ['class' => 'form-control']) }}
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Options</div>
					<div class="panel-body">
						{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success']) }}
						<a href="{{ route('posts.show', $comment->post->id) }}" class="btn btn-default btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	{{ Form::close() }}
@stop

@section ('scripts')
@stop