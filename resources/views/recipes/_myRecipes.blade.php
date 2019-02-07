@extends('layouts.frontend.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/recipes.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('recipes.index','all') }}">Recipes</a></li>
  <li>My Recipes</li>
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
      @include('frontend.recipes.panels.myRecipesAlphabet')
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book" aria-hidden="true"></i> My Recipes</div>
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
                  <td>
                    @if($recipe->personal == 1)
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    @endif
                    <a href="{{ route('recipes.show', $recipe->id) }}">
                      {{ $recipe->title }}
                    </a>
                  </td>
                  <td class="hidden-xs">{{ $recipe->category->name }}</td>
                  <td class="hidden-sm hidden-xs">{{ $recipe->views }}</td>
                  <td class="hidden-sm hidden-xs">@include('layouts.common.author', ['model'=>$recipe, 'field'=>'user'])</td>
                  
                    <td nowrap="nowrap" class="text-right">
                      {{--==============================================================================================================--}}
                      {{-- EDIT BUTTON                                                                                                  --}}
                      {{--==============================================================================================================--}}
                      @if(checkACL('editor', $recipe))
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
                          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                          @endif
                        </a>
                      @endif
                      {{--==============================================================================================================--}}
                      {{-- END EDIT BUTTON                                                                                              --}}
                      {{--==============================================================================================================--}}

                      {{--==============================================================================================================--}}
                      {{-- DELETE BUTTON                                                                                                --}}
                      {{--==============================================================================================================--}}
                      @if(checkACL('manager', $recipe))
                        <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" accept-charset="UTF-8" style="display:inline">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <button
                            class="btn btn-danger btn-xs"
                            {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                            type="button"
                            data-toggle="modal"
                            data-id="{{ $recipe->id }}"
                            data-target="#confirmDelete"
                            data-title="Delete Recipe"
                            data-message="Are you sure you want to delete this recipe?">
                              @if(Auth::user()->actionButtons == 1){{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
                              @elseif(Auth::user()->actionButtons == 2){{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
                              @elseif(Auth::user()->actionButtons == 3){{-- Text Only --}}Delete
                              @endif
                          </button>
                        </form>
                      @endif
                      {{--================================================================================================================--}}
                      {{-- END DELETE BUTTON                                                                                              --}}
                      {{--================================================================================================================--}}
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
@stop
