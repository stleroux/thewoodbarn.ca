@extends('frontend.layouts.main')

@section('title', '| View Post Image')

@section ('stylesheets')
	{{ Html::style('css/main.css') }}
@stop

@section('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('blog.index') }}">Blog</a></li>
		<li><a href="{{ route('blog.single', $post->slug) }}">{{ ucwords(str_replace('-',' ', $post->slug)) }}</a></li>
		<li class="active">View Image</li>
	</ol>

	<div class="row">
		<div class="col-md-8">
			{{ Html::image('images/posts/'.$post->image_path), ['width'=>'800', 'height'=>'400'] }}
			<br /><br />
		</div>
		<div class="col-md-2 col-md-offset-1">
			<a class="btn btn-default btn-block pull-right" href="{{ URL::previous() }}">Back</a>
		</div>
	</div>
@stop

@section ('scripts')
@stop
