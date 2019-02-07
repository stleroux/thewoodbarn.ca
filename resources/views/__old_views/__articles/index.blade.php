@extends('layouts.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('content')

  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li class="active">Articles</li>
  </ol>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          {{ ucfirst($section_name) }}
          <div class="pull-right">
              @ability('admin','admin,articles_create,articles_create_admin')
                {{-- <a class="btn btn-success btn-xs" href="{{ route('articles.create') }}"> Create New {{ str_singular(ucfirst($section_name)) }}</a> --}}
                <a href="{{ route($section_name.'.create') }}" class="btn btn-success btn-xs">
                  <div class="text text-left">
                    <i class="fa fa-plus-square" aria-hidden="true"></i> New {{ str_singular(ucfirst($section_name)) }}
                  </div>
                </a>
              @endability
          </div>
        </div>
        <div class="panel-body">
          <table id="datatable" class="table table-hover table-striped table-condensed">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th class="hidden-xs">Views</th>
                <th class="hidden-xs">Author</th>
                <th  class="hidden-sm hidden-xs">Created On</th>
                @if (Auth::check())
                  <th data-orderable="false"></th>
                @endif
              </tr>
            </thead>
            @foreach ($articles as $key => $article)
              <tr>
                <td><a href="{{ route('articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
                <td>{{ $article->category->name }}</td>
                <td class="hidden-xs">{{ $article->views }}</td>
                <td class="hidden-xs">@include('partials._author', ['model'=>$article, 'field'=>'user'])</td>
                <td class="hidden-sm hidden-xs">@include('partials._dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
                @if(Auth::check())
                  <td>@include('partials._buttons', ['model'=>$article, 'field'=>'articles', 'primer'=>'articles', 'actions'=>['edit','delete']])</td>
                @endif
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  @include('admin.includes.actions.confirmDelete')
@stop

@section ('scripts')

@stop
