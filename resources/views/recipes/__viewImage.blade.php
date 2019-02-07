@extends('layouts.frontend.main')

@section('title', 'View Recipe Image')

@section ('stylesheets')
  {{ Html::style('css/recipes.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
  <li><a href="{{ route('recipes.show', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></li>
  <li class="active">View Recipe Image</li>
@stop

@section('menubar')
      {{--================================================================================================================================--}}
      {{-- BACK BUTTON                                                                                                                    --}}
      {{--================================================================================================================================--}}
      <a href="{{ URL::previous() }}" class="btn btn-default btn-xs">
            <div class="text text-left">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </div>
          </a>
      {{--================================================================================================================================--}}
      {{-- END BACK BUTTON                                                                                                                --}}
      {{--================================================================================================================================--}}
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Image</div>
        <div class="panel-body">
          {{ Html::image("images/recipes/" . $recipe->image, "", array('height'=>'100%','width'=>'100%')) }}
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop