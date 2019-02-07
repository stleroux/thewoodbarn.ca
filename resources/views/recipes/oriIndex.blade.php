{{-- ORIGINAL INDEX FILE --}}
@extends('layouts.frontend.main')

@section ('title','Recipes')

@section ('stylesheets')
  {{ Html::style('css/recipes.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Recipes</li>
@stop

@section('page_top_menu')

{{-- <a href="{{ route('recipes.create') }}" class="btn btn-success btn-xs" title="New Recipe"> --}}
{!! button('recipe','create') !!}
{{-- model, action, icon --}}
{{-- </a> --}}
{!! icon('new') !!}

  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      @if(checkACL('author'))
        <a href="{{ route('recipes.create') }}" class="btn btn-success btn-xs" title="New Recipe">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Recipe
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Recipe
          @endif
        </a>
      @endif
      {{--================================================================================================================================--}}
      {{-- END ADD BUTTON                                                                                                                 --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- MY FAVORITES                                                                                                                   --}}
      {{--================================================================================================================================--}}
      @if(checkACL('author'))
        <a href="{{ route('recipes.myFavorites','all') }}" class="{{ Request::is('recipes/myFavorites/*') ? "btn-primary": "btn-default" }} btn btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=My Favorites' : '' }}>
          {{-- <div class="text text-left">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
          </div> --}}
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> My Favorites
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}My Favorites
          @endif
        </a>
      @endif
      {{--================================================================================================================================--}}
      {{-- END MY FAVORITES                                                                                                               --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- MY RECIPES                                                                                                                     --}}
      {{--================================================================================================================================--}}
      @if(checkACL('author'))
        <a href="{{ route('recipes.myRecipes','all') }}" class="{{ Request::is('recipes/myRecipes*') ? "btn-primary": "btn-default" }} btn btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=My Recipes' : '' }}>
{{--           <div class="text text-left">
            <i class="fa fa-list" aria-hidden="true"></i> My Recipes
          </div> --}}
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-list" aria-hidden="true"></i> My Recipes
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-list" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}My Recipes
          @endif
        </a>
      @endif
      {{--================================================================================================================================--}}
      {{-- END MY RECIPES                                                                                                                 --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ALL RECIPES                                                                                                                    --}}
      {{--================================================================================================================================--}}
      <a href="{{ route('recipes.index','all') }}" class="btn {{ Request::is('recipes/index*') ? "btn-primary": "btn-default" }} btn-xs">
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
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      @include('frontend.recipes.panels.indexAlphabet')
      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-book" aria-hidden="true"></i> Recipes</div>
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
              <thead>
                <tr>
                  {{-- Add columns for search purposes only --}}
                  <th class="hidden">Ingredients</th>
                  <th class="hidden">Methodology</th>
                  <th class="hidden">Public Notes</th>
                  <th class="hidden">Source</th>
                  {{-- Add columns for search purposes only --}}
                  
                  <th>Title</th>
                  <th class="hidden-xs">Category</th>
                  <th class="hidden-sm hidden-xs">Views</th>
                  <th class="hidden-sm hidden-xs">Author</th>
                  @if(checkACL('author'))
                    <th data-orderable="false"></th>
                    <th data-orderable="false"></th>
                    <th data-orderable="false"></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($recipes as $recipe)
                  <tr>
                    {{-- Add columns for search purposes only --}}
                    <td class="hidden">{{ $recipe->ingredients }}</td>
                    <td class="hidden">{{ $recipe->methodology }}</td>
                    <td class="hidden">{{ $recipe->public_notes }}</td>
                    <td class="hidden">{{ $recipe->source }}</td>
                    {{-- Add columns for search purposes only --}}

                    <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a></td>
                    <td class="hidden-xs">{{ $recipe->category->name }}</td>
                    <td class="hidden-sm hidden-xs">{{ $recipe->views }}</td>
                    <td class="hidden-sm hidden-xs">
                      @include('layouts.common.author', ['model'=>$recipe, 'field'=>'user'])
                    </td>
                    @if(checkACL('author'))
                      <td nowrap="nowrap" class="clearfix" width="1px">
                        @if((checkACL('editor')) || checkOwner($recipe))
                          {{--================================================================================================================================--}}
                          {{-- EDIT BUTTON                                                                                                                    --}}
                          {{--================================================================================================================================--}}
                          <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-xs" title="Edit">
                            @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                            @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                            @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                            @endif
                          </a>
                          {{--================================================================================================================================--}}
                          {{-- END EDIT BUTTON                                                                                                                --}}
                          {{--================================================================================================================================--}}
                        @endif
                      </td>

                      <td nowrap="nowrap" width="1px">
                        @if(checkACL('publisher'))
                          @if($recipe->views >= 100)
                          {{--================================================================================================================================--}}
                          {{-- PUBLISH BUTTON                                                                                                                 --}}
                          {{--================================================================================================================================--}}
                          <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-info btn-xs" title="Publish">
                            @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-arrow-up"></i> Publish
                            @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-arrow-up"></i>
                            @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Publish
                            @endif
                          </a>
                          @else
                          <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-xs" title="Unpublish">
                            @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-arrow-down"></i> Unpublish
                            @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-arrow-down"></i>
                            @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Unpublish
                            @endif
                          </a>
                          @endif
                          {{--================================================================================================================================--}}
                          {{-- END EDIT BUTTON                                                                                                                --}}
                          {{--================================================================================================================================--}}
                        @endif
                      </td>

                      <td nowrap="nowrap" width="1px">
                        @if((checkACL('manager')) || checkOwner($recipe))
                          {{--================================================================================================================================--}}
                          {{-- DELETE BUTTON                                                                                                                  --}}
                          {{--================================================================================================================================--}}
                          <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" accept-charset="UTF-8" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button
                              class="btn btn-danger btn-xs"
                              title="Delete"
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
                          {{--================================================================================================================================--}}
                          {{-- END DELETE BUTTON                                                                                                              --}}
                          {{--================================================================================================================================--}}
                        @endif
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
