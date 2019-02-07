@extends('layouts.frontend.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/recipes.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
  <li>My Favorite Recipes</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      @if(checkACL('author'))
        {{--================================================================================================================================--}}
        {{-- ADD BUTTON                                                                                                                     --}}
        {{--================================================================================================================================--}}
          <a href="{{ route('recipes.create') }}" class="btn btn-success btn-xs">
            @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Recipe
            @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
            @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Recipe
            @endif
          </a>
        {{--================================================================================================================================--}}
        {{-- END ADD BUTTON                                                                                                                 --}}
        {{--================================================================================================================================--}}

        {{--================================================================================================================================--}}
        {{-- MY FAVORITES                                                                                                                   --}}
        {{--================================================================================================================================--}}
          <a href="{{ route('recipes.myFavorites','all') }}" class="{{ Request::is('recipes/myFavorites/*') ? "btn-primary": "btn-default" }} btn btn-xs">
            <div class="text text-left">
              <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
            </div>
          </a>
        {{--================================================================================================================================--}}
        {{-- END MY FAVORITES                                                                                                               --}}
        {{--================================================================================================================================--}}

        {{--================================================================================================================================--}}
        {{-- MY RECIPES                                                                                                                     --}}
        {{--================================================================================================================================--}}
          <a href="{{ route('recipes.myRecipes','all') }}" class="{{ Request::is('recipes/myRecipes/*') ? "btn-primary": "btn-default" }} btn btn-xs">
            <div class="text text-left">
              <i class="fa fa-list" aria-hidden="true"></i> My Recipes
            </div>
          </a>
        {{--================================================================================================================================--}}
        {{-- END MY RECIPES                                                                                                                 --}}
        {{--================================================================================================================================--}}

        {{--================================================================================================================================--}}
        {{-- ALL RECIPES                                                                                                                    --}}
        {{--================================================================================================================================--}}
        <a href="{{ route('recipes.index','all') }}" class="btn {{ Request::is('recipes/index/*') ? "btn-primary": "btn-default" }} btn-xs">
          @if(Auth::check())
            @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-list-alt" aria-hidden="true"></i> All Recipes
            @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-list-alt" aria-hidden="true"></i>
            @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}All Recipes
            @endif
          @else
            <i class="fa fa-list-alt" aria-hidden="true"></i> All Recipes
          @endif
        </a>
        {{--================================================================================================================================--}}
        {{-- END ALL RECIPES                                                                                                                --}}
        {{--================================================================================================================================--}}
      @endif

    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      {{-- @include('frontend.recipes.panels.myFavoritesAlphabet') --}}
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book" aria-hidden="true"></i> My Favorite Recipes</div>
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>Title</th>
                <th class="hidden-xs">Category</th>
                <th class="hidden-sm hidden-xs">Views</th>
                <th class="hidden-sm hidden-xs">Author</th>
                @if (Auth::check())
                  <th data-orderable="false"></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($recipes as $recipe)
                <tr>
                  <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a></td>
                  <td class="hidden-xs">{{ $recipe->category->name }}</td>
                  <td class="hidden-sm hidden-xs">{{ $recipe->views }}</td>
                  <td class="hidden-sm hidden-xs">@include('layouts.common.author', ['model'=>$recipe, 'field'=>'user'])</td>
                  <td>
                    @if(checkACL('author'))
                      <a href="{{ route('recipes.removefavorite', $recipe->id) }}" class="btn btn-default btn-xs pull-right">
                        <div class="text text-left">
                          <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Remove Favorite
                        </div>
                      </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
