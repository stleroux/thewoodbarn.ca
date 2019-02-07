@extends('layouts.main')

@section('title', '| View Recipe Image')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('content')
	<ol class="breadcrumb">
	  <li><a href="/">Home</a></li>
	  <li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
	  <li><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></li>
	  <li class="active">View Recipe Image</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Image</div>
				<div class="panel-body">
					{{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'100%','width'=>'100%')) }}
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<div class="panel-body">
					<a href="{{ URL::previous() }}" class="btn btn-default btn-block">
						<div class="text text-left">
							<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop