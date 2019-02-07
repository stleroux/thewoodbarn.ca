@extends('layouts.main')

@section('title', '| Delete Comment?')

@section ('stylesheets')
@stop

@section('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('posts.index') }}">Posts</a></li>
		<li><a href="{{ route('posts.show', $comment->post->id) }}">{{ ucwords($comment->post->title) }}</a></li>
		<li class="active">Delete Comment</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-danger">
				<div class="panel-heading">Delete comment?</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							Name:
						</div>
						<div class="col-md-10">
							{{ $comment->name }}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							Email:
						</div>
						<div class="col-md-10">
							{{ $comment->email }}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							Comment:
						</div>
						<div class="col-md-10">
							{{ $comment->comment }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-danger">
				<div class="panel-heading">Options</div>
				<div class="panel-body">
					{{ Form::open(['route' => ['comment.destroy', $comment->id], 'method' => 'DELETE']) }}
						{{ Form::submit('Delete Comment', ['class' => 'btn btn-block btn-danger']) }}
						<a href="{{ url()->previous() }}" class="btn btn-default btn-block">Cancel</a>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop
