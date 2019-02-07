@extends('layouts.main')

@section('title','Articles')

@section('stylesheets')
  {{ Html::style('css/styles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Articles</li>
@stop

@section('menubar')
  @include('layouts.dropdowns.import', ['name'=>'articles'])
  @include('layouts.buttons.dashboard')
  @include('layouts.buttons.add', ['name'=>'articles'])
@stop

@section('content')
  @include('layouts.partials.section_top', ['name'=>'Articles', 'icon'=>'fa-list'])

  <div class="panel-body">
    <table id="datatable" class="table table-hover table-condensed table-responsive">
      <thead>
        <tr>
          {{-- Add columns for search purposes only --}}
          <th class="hidden">English</th>
          <th class="hidden">French</th>
          {{-- Add columns for search purposes only --}}

          <th>Title</th>
          <th class="hidden-xs">Category</th>
          <th class="hidden-xs hidden-sm">Views</th>
          <th class="hidden-xs">Author</th>
          <th  class="hidden-sm hidden-xs">Created On</th>
          @if(Auth::check())
            <th data-orderable="false"></th>
          @endif
        </tr>
      </thead>
      @foreach ($articles as $key => $article)
        <tr>
          {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
          <td class="hidden">{{ $article->description_eng }}</td>
          <td class="hidden">{{ $article->description_fre }}</td>
          {{-- Hide columns at all levels. Only needed because Datatables only searches for columns in the table --}}
          
          <td><a href="{{ route('articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
          <td class="hidden-xs">{{ $article->category->name }}</td>
          <td class="hidden-xs hidden-sm">{{ $article->views }}</td>
          <td class="hidden-xs">@include('layouts.author', ['model'=>$article, 'field'=>'user'])</td>
          <td class="hidden-xs hidden-sm">@include('layouts.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
          <td class="text-right">
            @include('layouts.buttons.edit', ['model'=>$article, 'name'=>'articles', 'id'=>$article->id])
            @include('layouts.buttons.delete', ['model'=>$article, 'name'=>'articles', 'id'=>$article->id])
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@include('layouts.partials.section_close')
@stop